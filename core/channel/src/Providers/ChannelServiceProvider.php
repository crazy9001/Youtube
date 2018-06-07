<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 6/7/2018
 * Time: 10:44 AM
 */

namespace Youtube\Channel\Providers;

use Youtube\Base\Supports\Helper;
use Illuminate\Support\ServiceProvider;

class ChannelServiceProvider extends ServiceProvider
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
        $this->mergeConfigFrom(__DIR__ . '/../../config/channel.php', 'channel');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'channel');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'channel');

    }
}