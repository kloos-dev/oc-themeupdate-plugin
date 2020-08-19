<?php namespace Codecycler\ThemeUpdates\Classes\Event\Content;

use Cms\Classes\Content;
use Codecycler\ThemeUpdates\Classes\ContentTypeEvents;
use Codecycler\ThemeUpdates\Classes\Event\AbstractExtend;

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