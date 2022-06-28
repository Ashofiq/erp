<?php 
namespace App\Repositories\Accounts\FinancialYear;


use Illuminate\Support\ServiceProvider;

class FinancialYearRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\Accounts\FinancialYear\FinancialYearInterface', 'App\Repositories\Accounts\FinancialYear\FinancialYearRepository');
    }
}