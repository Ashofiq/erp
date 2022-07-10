<?php 
namespace App\Repositories\HrPayroll\SystemInfo\Shift;


use Illuminate\Support\ServiceProvider;

class ShiftRepoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }


    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\HrPayroll\SystemInfo\Shift\ShiftInterface', 'App\Repositories\HrPayroll\SystemInfo\Shift\ShiftRepository');
    }
}