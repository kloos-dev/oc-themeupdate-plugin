<?php namespace Kloos\ThemeUpdates\Classes\Event\Partial;

use Cms\Classes\Partial;
use Kloos\ThemeUpdates\Classes\ContentTypeEvents;
use Kloos\ThemeUpdates\Classes\Event\AbstractExtend;

class ExtendPartial extends AbstractExtend
{
    public function getContentType()
    {
        return ContentTypeEvents::PARTIAL;
    }

    protected function resolve($name)
    {
        return Partial::loadCached($this->childTheme, $name);
    }
}