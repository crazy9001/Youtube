<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/16/2018
 * Time: 6:36 PM
 */
namespace Youtube\Users\Providers;

use Youtube\Base\Supports\Helper;
use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
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
        $this->mergeConfigFrom(__DIR__ . '/../../config/users.php', 'users');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'users');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'users');

    }
}