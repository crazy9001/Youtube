<?php
/**
 * Created by PhpStorm.
 * User: Toinn
 * Date: 5/17/2018
 * Time: 11:55 AM
 */
namespace Youtube\Groups\Providers;

use Youtube\Base\Supports\Helper;
use Illuminate\Support\ServiceProvider;

class GroupsServiceProvider extends ServiceProvider
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
        $this->mergeConfigFrom(__DIR__ . '/../../config/groups.php', 'groups');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'groups');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'groups');

    }
}