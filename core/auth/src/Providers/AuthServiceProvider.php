<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/11/2018
 * Time: 6:51 PM
 */

namespace Youtube\Auth\Providers;

use Youtube\Base\Supports\Helper;
use Youtube\Auth\Http\Middleware\Authenticate;
use Youtube\Auth\Http\Middleware\RedirectIfAuthenticated;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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

        /**
         * @var Router $router
         */
        $router = $this->app['router'];

        $router->aliasMiddleware('auth', Authenticate::class);
        $router->aliasMiddleware('guest', RedirectIfAuthenticated::class);

    }

    /**
     * Boot the service provider.
     * @return void
     * @author Toinn
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->mergeConfigFrom(__DIR__ . '/../../config/auth.php', 'auth');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'auth');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'auth');

    }
}