<?php 
namespace App\Repositories\Accounts\Transaction\AccTransactionDetails;


use Illuminate\Support\ServiceProvider;

class AccTransactionDetailsRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Accounts\Transaction\AccTransactionDetails\AccTransactionDetailsInterface', 'App\Repositories\Accounts\Transaction\AccTransactionDetails\AccTransactionDetailsRepository');
    }
}