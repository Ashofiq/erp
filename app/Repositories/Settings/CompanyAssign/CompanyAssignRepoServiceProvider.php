<?php 
namespace App\Repositories\Settings\CompanyAssign;


use Illuminate\Support\ServiceProvider;

class CompanyAssignRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Settings\CompanyAssign\CompanyAssignInterface', 'App\Repositories\Settings\CompanyAssign\CompanyAssignRepository');
    }
}