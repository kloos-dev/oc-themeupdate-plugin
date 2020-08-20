<?php namespace Codecycler\ThemeUpdates\Classes\Event\Theme;

use Event;
use Config;
use Request;
use Codecycler\ThemeUpdates\Classes\Helper\ThemeHelper;

class ExtendTheme
{
    public function subscribe()
    {
        $backendUri = Config::get('cms.backendUri');
        $requestUrl = Request::url();
        $backendUri = str_replace('/', '', $backendUri);

        Event::listen('cms.theme.getActiveTheme', function () use ($backendUri, $requestUrl) {
                if (preg_match('/'.$backendUri.'/i', $requestUrl) && ThemeHelper::instance()->backendUseTheme == 'child') {
                    return ThemeHelper::instance()->childTheme->getDirName();
                }
            }
        );
    }
}