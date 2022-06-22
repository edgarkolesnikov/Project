<?php

namespace App\Providers;

use App\Models\categories;
use App\Models\clothes;
use App\Models\colors;
use App\Models\Messages;
use App\Models\sizes;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = categories::all();
        view()->share('categories', $categories);

        $clothes = clothes::all();
            view()->share('clothes', $clothes);

        $sizes= sizes::all();
        view()->share('sizes', $sizes);

        $colors= colors::all();
        view()->share('colors', $colors);

        Paginator::useBootstrap();

        view()->composer('*', function ($view) {

            if (Auth::check()) {
                $notReaded = Messages::where('receiver_id', Auth::id())->where('status', 1)->count();
                $notReaded = $notReaded > 0 ? ' ('.$notReaded.')' : '';
                view()->share('notRead', $notReaded);
            }
        });
    }
}
