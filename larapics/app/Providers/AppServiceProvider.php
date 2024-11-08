<?php

namespace App\Providers;

use App\Enums\Role;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('image', function($value){
            if(is_numeric($value)){
                return Image::where('id', $value)->firstOrFail();
            }
            return Image::where('slug', $value)->published()->firstOrFail();
        });

        Paginator::useBootstrapFive();

        Gate::define('update-image', function(User $user, Image $image){
            return $user->id === $image->user_id || $user->role === Role::Admin;
        });

        Gate::define('delete-image', function(User $user, Image $image){
            return $user->id === $image->user_id;
        });

        Gate::before(function($user, $ability){
            if($user->role === Role::Admin){
                return true;
            }
        });


    }
}
