<?php 
namespace App\Repositories\HrPayroll\Employee;

use Illuminate\Support\ServiceProvider;

class EmployeeRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\HrPayroll\Employee\EmployeeInterface', 'App\Repositories\HrPayroll\Employee\EmployeeRepository');
    }
}