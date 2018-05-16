<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/11/2018
 * Time: 6:39 PM
 */

namespace Youtube\Base\Providers;

use Youtube\Assets\Providers\AssetsServiceProvider;
use Youtube\Auth\Providers\AuthServiceProvider;
use Youtube\Base\Supports\Helper;
use Youtube\Dashboard\Providers\DashboardServiceProvider;
use Illuminate\Support\ServiceProvider;
use Youtube\Users\Providers\UsersServiceProvider;

class BaseServiceProvider extends  ServiceProvider
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

        $this->app->register(AssetsServiceProvider::class);
    }

    /**
     * Boot the service provider.
     * @return void
     * @author Toinn
     */
    public function boot()
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(DashboardServiceProvider::class);
        $this->app->register(ComposerServiceProvider::class);
        $this->app->register(UsersServiceProvider::class);

        $this->mergeConfigFrom(__DIR__ . '/../../config/youtube.php', 'youtube');
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'bases');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'bases');

    }
}