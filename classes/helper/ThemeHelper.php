<?php namespace Codecycler\ThemeUpdates\Classes\Helper;

use Yaml;
use Cms\Classes\Theme;
use October\Rain\Support\Traits\Singleton;

class ThemeHelper
{
    use Singleton;

    public $activeTheme;

    public $childTheme;

    public function init()
    {
        $this->activeTheme = Theme::getActiveTheme();
        $this->childTheme = $this->getChildTheme();

        $this->validateChildTheme();
    }

    public function getChildTheme()
    {
        if ($this->childTheme) {
            return $this->childTheme;
        }

        foreach (Theme::all() as $theme) {
            if ($theme->getDirName() == $this->activeTheme->getDirName() . '-child') {
                return $theme;
            }
        }
    }

    protected function validateChildTheme()
    {
        $config = $this->childTheme->getConfig();

        if ($config['extends'] != $this->activeTheme->getConfig()['code']) {
            $this->childTheme = null;
        }
    }
}