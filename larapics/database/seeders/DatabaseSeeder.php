<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Social;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $images = Storage::allFiles('images');        

        foreach($images as $image){
            Image::factory()->create([
                'file' => $image,
                'dimension' => Image::getDimension($image)
            ]);
        }

        Image::find([1,3,5])->each(function($image){
            User::where('id', '!=', $image->user_id)
            ->get()
            ->each(function($user) use ($image){
                $image->comments()->save(Comment::factory()->make([
                    'user_id' => $user->id
                ]));
            });
        });


        User::find([2,4,6])->each(function($user){
            $user->social()->save(Social::factory()->make());
        });
    }    
}
