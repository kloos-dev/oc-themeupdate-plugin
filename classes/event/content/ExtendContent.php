<?php namespace Kloos\ThemeUpdates\Classes\Event\Content;

use Cms\Classes\Content;
use Kloos\ThemeUpdates\Classes\ContentTypeEvents;
use Kloos\ThemeUpdates\Classes\Event\AbstractExtend;

class ExtendContent extends AbstractExtend
{
    public function getContentType()
    {
        return ContentTypeEvents::CONTENT;
    }

    protected function resolve($name)
    {
        return Content::loadCached($this->childTheme, $name);
    }
}