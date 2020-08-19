<?php namespace Codecycler\ThemeUpdates;

use Event;
use Backend;
use Codecycler\ThemeUpdates\Classes\Event\Content\ExtendContent;
use Codecycler\ThemeUpdates\Classes\Event\Partial\ExtendPartial;
use Codecycler\ThemeUpdates\Classes\Event\Theme\ExtendTheme;
use Codecycler\ThemeUpdates\Classes\Event\Themes\ExtendThemesController;
use Codecycler\ThemeUpdates\Classes\Helper\ThemeHelper;
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
            'author'      => 'Codecycler',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        $themeHelper = ThemeHelper::instance();
        Event::subscribe(ExtendTheme::class);
        Event::subscribe(ExtendContent::class);
        Event::subscribe(ExtendPartial::class);
        Event::subscribe(ExtendThemesController::class);
    }
}
