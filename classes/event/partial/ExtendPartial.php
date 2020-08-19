<?php namespace Codecycler\ThemeUpdates\Classes\Event\Partial;

use Cms\Classes\Partial;
use Codecycler\ThemeUpdates\Classes\ContentTypeEvents;
use Codecycler\ThemeUpdates\Classes\Event\AbstractExtend;

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