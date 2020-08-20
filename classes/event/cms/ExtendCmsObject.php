<?php namespace Codecycler\ThemeUpdates\Classes\Event\Cms;

use Event;
use Cms\Widgets\TemplateList;
use Codecycler\ThemeUpdates\Classes\Helper\ThemeHelper;

class ExtendCmsObject
{
    public function subscribe()
    {
        TemplateList::extend(function ($controller) {
            $controller->addDynamicProperty('backendUseTheme', ThemeHelper::instance()->backendGetUseTheme());

            $controller->addViewPath(plugins_path('codecycler/themeupdates/classes/event/cms/partials'));
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