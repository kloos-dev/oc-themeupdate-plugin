<?php namespace Kloos\ThemeUpdates\Classes\Event;

use Event;
use Kloos\ThemeUpdates\Classes\ContentTypeEvents;
use Kloos\ThemeUpdates\Classes\Helper\ThemeHelper;

abstract class AbstractExtend
{
    protected $activeTheme;

    protected $childTheme;

    protected $controller;

    public function __construct()
    {
        $this->activeTheme = ThemeHelper::instance()->activeTheme;
        $this->childTheme = ThemeHelper::instance()->childTheme;
    }

    public function subscribe()
    {
        Event::listen($this->getContentType(), function ($controller, $contentName) {
            $this->controller = $controller;

            if (!$this->childTheme) {
                return;
            }

            return $this->resolve($contentName);
        });
    }

    protected function resolve($name)
    {
    }

    protected function getContentType()
    {
        return ContentTypeEvents::CONTENT;
    }
}