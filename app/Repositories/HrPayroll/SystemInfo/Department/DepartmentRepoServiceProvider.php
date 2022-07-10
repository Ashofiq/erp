<?php 
namespace App\Repositories\HrPayroll\SystemInfo\Department;


use Illuminate\Support\ServiceProvider;

class DepartmentRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\HrPayroll\SystemInfo\Department\DepartmentInterface', 'App\Repositories\HrPayroll\SystemInfo\Department\DepartmentRepository');
    }
}