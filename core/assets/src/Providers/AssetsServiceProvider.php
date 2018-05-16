<?php
/**
 * Created by PhpStorm.
 * User: Demon Warlock
 * Date: 5/11/2018
 * Time: 6:46 PM
 */

namespace Youtube\Assets\Providers;

use Youtube\Assets\Facades\AssetsFacade;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AssetsServiceProvider extends ServiceProvider
{
    /**
     * @author Toinn
     */
    public function register()
    {
        AliasLoader::getInstance()->alias('Assets', AssetsFacade::class);
    }

    /**
     * @author Toinn
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/assets.php', 'assets');
        if (app()->runningInConsole()) {
            $this->publishes([__DIR__ . '/../../config/assets.php' => config_path('assets.php')], 'config');
        }
    }
}