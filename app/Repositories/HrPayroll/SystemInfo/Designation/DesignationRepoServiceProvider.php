<?php 
namespace App\Repositories\HrPayroll\SystemInfo\Designation;


use Illuminate\Support\ServiceProvider;

class DesignationRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\HrPayroll\SystemInfo\Designation\DesignationInterface', 'App\Repositories\HrPayroll\SystemInfo\Designation\DesignationRepository');
    }
}