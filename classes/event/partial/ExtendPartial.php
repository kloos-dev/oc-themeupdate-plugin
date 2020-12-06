<?php namespace Kloos\ThemeUpdates\Classes\Event\Partial;

use Cms\Classes\CmsException;
use Cms\Classes\ComponentPartial;
use Cms\Classes\Partial;
use Kloos\ThemeUpdates\Classes\ContentTypeEvents;
use Kloos\ThemeUpdates\Classes\Event\AbstractExtend;
use Lang;

/**
 * Class ExtendPartial
 *
 * @package Codecycler\ThemeUpdates\Classes\Event\Partial
 * @property \Cms\Classes\Controller $controller
 */
class ExtendPartial extends AbstractExtend
{
    public function getContentType()
    {
        return ContentTypeEvents::PARTIAL;
    }

    /**
     * @param $name
     *
     * @return false|mixed|void
     * @throws \Cms\Classes\CmsException
     */
    protected function resolve($name)
    {
        if (strpos($name, '::') !== false) {
            list($componentAlias, $partialName) = explode('::', $name);
            if (empty($componentAlias)) {
                return false;
            }

            if (($componentObj = $this->controller->findComponentByName($componentAlias)) === null) {
                throw new CmsException(Lang::get('cms::lang.component.not_found', ['name' => $componentAlias]));
            }

            // Load from child partial
            $partial = ComponentPartial::loadOverrideCached($this->childTheme, $componentObj, $partialName);

            if (empty($partial)) {
                $partial = ComponentPartial::loadOverrideCached($this->activeTheme, $componentObj, $partialName);
            }

            if (empty($partial)) {
                $partial = ComponentPartial::loadCached($componentObj, $partialName);
            }

            return $partial;
        }

        return Partial::loadCached($this->childTheme, $name);
    }
}
