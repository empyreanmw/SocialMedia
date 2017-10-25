<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Trend;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('home.left-sidebar', function ($view) {

            $trends = Trend::getTrends();

            $view->with(compact('trends'));
        });

        view()->composer('home.right-sidebar', function ($view) {
         
            $peopleYouMayKnow = User::where('id', '!=', auth()->id())
            ->get()
            ->filter(function ($value) {        
                return $value->isFollowing == false;
            })
            ->sortByDesc('popularity')
            ->take(5);
       
             $view->with(compact('peopleYouMayKnow'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
