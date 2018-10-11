<?php

namespace App\Providers;

use App\User;
use App\Offer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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

        view()->composer('admin.layouts.master', function ($view){
            $view->with([
                'agent_applications'=> User::where('status', 0)->whereRoleIs('agent')->get(),
                'all_offers' => Offer::where('status', 1)->get()
            ]);
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
