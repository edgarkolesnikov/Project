<?php

namespace App\Providers;

use App\Models\Messages;
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
        view()->composer('*', function ($view) {

            if (Auth::check()) {
                $notReaded = Messages::where('receiver_id', Auth::id())->where('status', 1)->count();
                $notReaded = $notReaded > 0 ? ' ('.$notReaded.')' : '';
                view()->share('notRead', $notReaded);
            }
        });
    }
}
