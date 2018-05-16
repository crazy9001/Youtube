<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/11/2018
 * Time: 7:02 PM
 */

namespace Youtube\Dashboard\Providers;

use Youtube\Base\Supports\Helper;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     * @author Toinn
     */
    public function register()
    {
        Helper::autoload(__DIR__ . '/../../helpers');
    }

    /**
     * Boot the service provider.
     * @return void
     * @author Toinn
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->mergeConfigFrom(__DIR__ . '/../../config/dashboard.php', 'dashboard');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'dashboard');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'dashboard');

    }
}