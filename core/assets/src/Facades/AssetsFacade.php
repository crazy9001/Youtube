<?php

namespace Youtube\Assets\Facades;

use Youtube\Assets\Assets;
use Illuminate\Support\Facades\Facade;

/**
 * Class AssetsFacade
 * @package Botble\Assets\Facade
 * @author Toinn
 */
class AssetsFacade extends Facade
{

    /**
     * @return string
     * @author Toinn
     */
    protected static function getFacadeAccessor()
    {
        return Assets::class;
    }
}
