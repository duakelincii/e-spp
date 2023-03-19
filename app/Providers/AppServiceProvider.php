<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::directive('rupiah', function ( $expression ) { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });
        Schema::defaultStringLength(191);



         \Carbon\Carbon::setLocale('id');
    }
}
