<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\Role;
use Illuminate\Support\Facades\Storage;
use App\Models\Comment;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'profile_image',
        'cover_image',
        'city',
        'country',
        'about_me'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => Role::class
        ];
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function profileImageUrl(){
        return Storage::url($this->profile_image ? $this->profile_image : "users/user-default.png");
    }

    public function coverImageUrl(){
        return Storage::url($this->cover_image);
    }

    public function hasCoverImage(){
        return !!$this->cover_image; //einai enallaktikos tropos na peis -> !is_null($this->cover_image)
    }

    public function url(){
        return route('author.show', $this->username);
    }

    public function inlineProfile(){
        /* Eding Muhamad Saprudin &nbsp; • &nbsp; Indonesia &nbsp; • &nbsp; Member since Oct. 28,2017 &nbsp; • &nbsp; 40 images */

        return collect([
            $this->name,
            trim(join("/", [$this->city, $this->country]), "/"),
            "Member since " . $this->created_at->toFormattedDateString(),
            $this->getImagesCount(),
        ])->filter()->implode(" • ");
    }


    public function updateSettings($data){
        $this->update($data['user']);
        $this->updateSocialProfile($data['social']);
        $this->updateOptions($data['options']);
    }

    protected function updateOptions($options){
        $this->setting()->update($options);
    }

    protected function updateSocialProfile($social){
        Social::updateOrCreate(
            ['user_id' => $this->id],
            $social
        );
    }

    public static function makeDirectory(){
        $directory = 'user';
        Storage::makeDirectory($directory);
        return $directory;
    }



    public function images(){
        return $this->hasMany(Image::class);
    }

    public function social(){
        return $this->hasOne(Social::class)->withDefault();
    }


    public function setting(){
        return $this->hasOne(Setting::class)->withDefault();
    }

    protected static function booted(){
        static::created(function($user){
            $user->setting()->create([
                "email_notification" =>[
                    "new_comment" => 1,
                    "new_image" => 1
                ]
            ]);
        });
    }



    /* public function recentSocial(){
        return $this->hasOne(Social::class)->latestOfMany();
    }

    public function oldestSocial(){
        return $this->hasOne(Social::class)->oldestOfMany();
    }

    public function socialPriority(){
        return $this->hasOne(Social::class)->ofMany('priority', 'min');
    } */

    public function getImagesCount(){
        $imageCount = $this->images()->published()->count();
        return $imageCount . str()->plural(' image', $imageCount);
    }
}
