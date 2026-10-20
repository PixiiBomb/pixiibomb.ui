<?php

namespace PixiiBomb\Ui\Templates;

use PixiiBomb\Core\Templates\Template;
use PixiiBomb\Ui\Services\PixiiBombThemeService;
use PixiiBomb\Ui\Themes\Theme;

class UiTemplate extends Template
{
    protected ?string $defaultView = 'ui-template';

    protected ?Theme $theme = null;

    public function __construct()
    {
        $this->setView($this->defaultView);
    }

    public function getTheme(): ?Theme
    {
        return $this->theme
            ?? app(PixiiBombThemeService::class)->getActiveTheme();
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
}
