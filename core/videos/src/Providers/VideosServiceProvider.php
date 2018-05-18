<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/18/2018
 * Time: 6:57 PM
 */

namespace Youtube\Videos\Providers;

use Youtube\Base\Supports\Helper;
use Illuminate\Support\ServiceProvider;

class VideosServiceProvider extends ServiceProvider
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
        $this->mergeConfigFrom(__DIR__ . '/../../config/videos.php', 'videos');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'videos');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'videos');

    }
}