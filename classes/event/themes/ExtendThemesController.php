<?php namespace Codecycler\ThemeUpdates\Classes\Event\Themes;

use Cms\Controllers\Themes;

class ExtendThemesController
{
    public function subscribe()
    {
        Themes::extend(function ($controller) {
            $controller->addViewPath(plugins_path('codecycler/themeupdates/classes/event/themes/partials'));
        });
    }
}