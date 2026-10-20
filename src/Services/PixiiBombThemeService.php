<?php

namespace PixiiBomb\Ui\Services;

use PixiiBomb\Ui\Themes\Theme;

class PixiiBombThemeService
{
    protected const string COOKIE_THEME_KEY = 'pixii_theme';
    protected const string COOKIE_PALETTE_KEY = 'pixii_palette';

    /**
     * @var array<class-string<Theme>, Theme>
     */
    protected array $themes = [];

    protected ?Theme $defaultTheme = null;

    public function getDefaultTheme(): ?Theme
    {
        return $this->defaultTheme;
    }

    /**
     * @return array<class-string<Theme>, Theme>
     */
    public function getThemes(): array
    {
        return $this->themes;
    }

    public function registerTheme(Theme $theme, bool $isDefault = false): self
    {
        $key = str_replace("theme", "", strtolower(basename($theme::class)));
        $this->themes[$key] = $theme;

        if ($isDefault) {
            $this->setDefaultTheme($theme);
        }

        return $this;
    }

    public function setDefaultTheme(Theme $theme): self
    {
        $this->defaultTheme = $theme;

        return $this;
    }

    public function getCookieTheme(): ?string
    {
        return request()->cookie(self::COOKIE_THEME_KEY);
    }

    public function getCookiePalette(): ?string
    {
        return request()->cookie(self::COOKIE_PALETTE_KEY);
    }

    public function getActiveTheme(): ?Theme
    {
        $themeKey = $this->getCookieTheme();
        $palette = $this->getCookiePalette();

        $theme = $themeKey !== null
            ? ($this->themes[$themeKey] ?? null)
            : null;

        $theme ??= $this->defaultTheme;

        if (
            $theme !== null
            && $palette !== null
            && in_array($palette, $theme->getPalettes(), true)
        ) {
            $theme->setPalette($palette);
        }

        return $theme;
    }
}
