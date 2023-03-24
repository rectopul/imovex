<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\View\Composers\WebComposer;
use App\View\Composers\DashboardSidebarComposer;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('web.*', WebComposer::class);
        View::composer('layouts.dashboard', DashboardSidebarComposer::class);
    }
}
