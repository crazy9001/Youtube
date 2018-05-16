<?php

namespace Youtube\Base\Providers;

use Assets;
use Sentinel;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * @author Toinn
     */
    public function boot()
    {

        view()->composer(['bases::layouts.base'], function ($view) {

            $headScripts = Assets::getJavascript('top');
            $bodyScripts = Assets::getJavascript('bottom');
            $appModules = Assets::getAppModules();
            $groupedBodyScripts = array_merge($bodyScripts, $appModules);
            $view->with('headScripts', $headScripts);
            $view->with('bodyScripts', $groupedBodyScripts);
            $view->with('stylesheets', Assets::getStylesheets(['core']));
        });

    }
}
