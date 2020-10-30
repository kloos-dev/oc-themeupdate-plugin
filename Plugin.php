<?php namespace Kloos\ThemeUpdates;

use Event;
use Kloos\ThemeUpdates\Classes\Event\Content\ExtendContent;
use Kloos\ThemeUpdates\Classes\Event\Cms\ExtendCmsObject;
use Kloos\ThemeUpdates\Classes\Event\Partial\ExtendPartial;
use Kloos\ThemeUpdates\Classes\Event\Theme\ExtendTheme;
use Kloos\ThemeUpdates\Classes\Event\Themes\ExtendThemesController;
use Kloos\ThemeUpdates\Classes\Helper\ThemeHelper;
use Illuminate\Foundation\AliasLoader;
use System\Classes\PluginBase;

/**
 * VisualPartials Plugin Information File
 */
class Plugin extends PluginBase
{
    public $elevated = true;

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Theme updates',
            'description' => 'Theme updates for OctoberCMS',
            'author'      => 'Kloos',
            'icon'        => 'icon-leaf'
        ];
    }

    public function register()
    {
        AliasLoader::getInstance()->alias('ThemeHelper', ThemeHelper::class);
    }

    public function boot()
    {
        $themeHelper = ThemeHelper::instance();
        Event::subscribe(ExtendTheme::class);
        Event::subscribe(ExtendContent::class);
        Event::subscribe(ExtendPartial::class);
        Event::subscribe(ExtendCmsObject::class);
        Event::subscribe(ExtendThemesController::class);
    }
}
