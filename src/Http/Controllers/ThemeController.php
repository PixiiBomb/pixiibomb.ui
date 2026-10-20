<?php

namespace PixiiBomb\Ui\Http\Controllers;

use Illuminate\View\View;
use PixiiBomb\Core\Data\Block;
use PixiiBomb\Core\Data\Page;
use PixiiBomb\Core\Http\Controllers\PageController;
use PixiiBomb\Core\Support\PixiiUtilities;
use PixiiBomb\Ui\Services\PixiiBombThemeService;
use PixiiBomb\Ui\View\Components\Test;

class ThemeController extends PageController
{
    public function setTheme(string $theme, string $palette)
    {
        $themes = app(PixiiBombThemeService::class)->getThemes();

        if (! isset($themes[$theme])) {
            return redirect()->back();
        }

        $selected = $themes[$theme];

        if (! in_array($palette, $selected->getPalettes(), true)) {
            return redirect()->back();
        }

        $minutes = 60 * 24 * 365;

        return redirect()
            ->back()
            ->withCookie(cookie(
                'pixii_theme',
                $theme,
                $minutes
            ))
            ->withCookie(cookie(
                'pixii_palette',
                $palette,
                $minutes
            ));
    }

    public function test(): View
    {
        $blocks = new Block()
            ->setComponent(PixiiUtilities::formatComponentName(Test::class), ['title' => 'Hello World']);

        $page = new Page()
            ->setBlocks([$blocks]);

        return parent::view($page);
    }
}
