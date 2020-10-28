<?php namespace Codecycler\ThemeUpdates\Classes\Helper;

use Session;
use Cms\Classes\Theme;
use October\Rain\Support\Traits\Singleton;

class ThemeHelper
{
    use Singleton;

    public $activeTheme;

    public $childTheme;

    public $backendUseTheme;

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
        if (!$this->childTheme) {
            return;
        }
        
        $config = $this->childTheme->getConfig();

        if ($config['extends'] != $this->activeTheme->getConfig()['code']) {
            $this->childTheme = null;
        }
    }

    public function isThemeExtended($checkTheme)
    {
        foreach (Theme::all() as $theme) {
            if ($theme->getDirName() == $checkTheme->getDirname() . '-child') {
                $data = $theme->getConfig();

                if ($data['extends'] == $checkTheme->getConfig()['code']) {
                    return true;
                }
            }
        }
    }

    public function isEditingActiveTheme()
    {
        if (Theme::getActiveTheme() != $this->activeTheme) {
            return false;
        }
    }

    public function backendUseTheme($theme)
    {
        Session::put('codecycler.theme_updates::backend_use_theme', $theme);
        $this->backendUseTheme = $theme;
    }

    public function backendGetUseTheme()
    {
        $this->backendUseTheme = Session::get('codecycler.theme_updates::backend_use_theme', 'child');

        return $this->backendUseTheme;
    }
}
