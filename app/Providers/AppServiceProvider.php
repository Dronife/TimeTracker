<?php

namespace App\Providers;

use App\Interfaces\Exportation\ExportInterface;
use App\Interfaces\Exportation\SetupInterface;
use App\Interfaces\TaskInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TaskInterface::class, function(){
            return new TaskInterface();
        });
        $this->app->bind(ExportInterface::class, function(){
            return new ExportInterface();
        });
        $this->app->bind(SetupInterface::class, function(){
            return new SetupInterface();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
