<?php namespace Codecycler\ThemeUpdates\Classes\Event\Theme;

use Cms\Classes\Theme;

class ExtendTheme
{
    public function subscribe()
    {
        $activeTheme = Theme::getActiveTheme();
    }
}