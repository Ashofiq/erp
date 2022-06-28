<?php 
namespace App\Repositories\Accounts\Transaction\AccTransaction;

use Illuminate\Support\ServiceProvider;

class AccTransactionRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Accounts\Transaction\AccTransaction\AccTransactionInterface', 'App\Repositories\Accounts\Transaction\AccTransaction\AccTransactionRepository');
    }
}