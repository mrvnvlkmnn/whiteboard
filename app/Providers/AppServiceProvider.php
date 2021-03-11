<?php

namespace App\Providers;

use App\Project;
use App\Observers\ProjectObserver;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
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
        #setlocale(LC_TIME, 'de_DE');
        Carbon::setLocale('de');
        Schema::defaultStringLength(191);
        Project::observe(ProjectObserver::class);
    }
}
