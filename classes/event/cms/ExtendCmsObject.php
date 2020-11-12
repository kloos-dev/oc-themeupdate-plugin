<?php namespace Kloos\ThemeUpdates\Classes\Event\Cms;

use Event;
use Cms\Widgets\TemplateList;
use Kloos\ThemeUpdates\Classes\Helper\ThemeHelper;

class ExtendCmsObject
{
    public function subscribe()
    {
        TemplateList::extend(function ($controller) {
            $controller->addDynamicProperty('backendUseTheme', ThemeHelper::instance()->backendGetUseTheme());
            $controller->addDynamicProperty('childTheme', ThemeHelper::instance()->childTheme);

            $controller->addViewPath(plugins_path('kloos/themeupdates/classes/event/cms/partials'));
        });

        Event::listen('backend.ajax.beforeRunHandler', function ($controller, $handler) {
            if ($handler == 'onSwitchTheme') {
                $this->switchTheme(input('theme'));

                return redirect()->refresh();
            }
        });
    }

    protected function switchTheme($theme)
    {
        ThemeHelper::instance()->backendUseTheme($theme);
    }
}