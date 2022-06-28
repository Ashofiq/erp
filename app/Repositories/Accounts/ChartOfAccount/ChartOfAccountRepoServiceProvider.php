<?php 
namespace App\Repositories\Accounts\ChartOfAccount;


use Illuminate\Support\ServiceProvider;

class ChartOfAccountRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Accounts\ChartOfAccount\ChartOfAccountInterface', 'App\Repositories\Accounts\ChartOfAccount\ChartOfAccountRepository');
    }
}