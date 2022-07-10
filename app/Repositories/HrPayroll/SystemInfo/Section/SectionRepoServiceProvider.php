<?php 
namespace App\Repositories\HrPayroll\SystemInfo\Section;


use Illuminate\Support\ServiceProvider;

class SectionRepoServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Repositories\HrPayroll\SystemInfo\Section\SectionInterface', 'App\Repositories\HrPayroll\SystemInfo\Section\SectionRepository');
    }
}