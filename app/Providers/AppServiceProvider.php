<?php

namespace App\Providers;

use App\Http\Services\Export\ExportService;
use App\Http\Services\TaskService;
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
