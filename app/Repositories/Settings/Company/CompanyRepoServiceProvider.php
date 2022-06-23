<?php 
namespace App\Repositories\Settings\Company;


use Illuminate\Support\ServiceProvider;

class CompanyRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Settings\Company\CompanyInterface', 'App\Repositories\Settings\Company\CompanyRepository');
    }
}