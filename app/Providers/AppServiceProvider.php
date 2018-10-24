<?php

namespace App\Providers;

use Session;
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

        // $loggedInUserId = auth()->user()->id;

        view()->composer('admin.layouts.master', function ($view){
            $view->with([
                'agent_applications'=> User::where('status', 0)->whereRoleIs('agent')->get(),
                'all_offers' => Offer::where('status', 1)->get(),
                'all_demands' => Offer::whereIn('status', [2, 3, 4, 5, 6, 7])->get(),
                // 'agent_demands' => Offer::whereIn('status', [2, 3, 4, 5, 6, 7])->where('assigned_agent', $loggedInUserId)->get(),
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
