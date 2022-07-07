<?php 
namespace App\Repositories\Customer;


use Illuminate\Support\ServiceProvider;

class CustomerRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Customer\CustomerInterface', 'App\Repositories\Customer\CustomerRepository');
    }
}