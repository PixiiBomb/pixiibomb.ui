<?php

namespace PixiiBomb\Ui;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use PixiiBomb\Core\Data\Block;
use PixiiBomb\Core\Data\Page;
use PixiiBomb\Core\Support\PixiiAssetManager;
use PixiiBomb\Core\Support\PixiiBomb;
use PixiiBomb\Ui\Installers\PixiiUiInstaller;
use PixiiBomb\Ui\Layouts\UiLayout;
use PixiiBomb\Ui\Services\PixiiBombThemeService;
use PixiiBomb\Ui\Templates\UiTemplate;
use PixiiBomb\Ui\Themes\{BaseTheme, HologlassTheme, ManuscriptTheme, PixiiTheme};
use PixiiBomb\Ui\Support\PixiiThemeUtilities;

class PixiiBombUiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PixiiBombThemeService::class, fn () => new PixiiBombThemeService());
        $this->app->singleton(PixiiThemeUtilities::class, fn () => new PixiiThemeUtilities());
    }

    public function boot(PixiiAssetManager $assets): void
    {
        $assets->registerNamespace('pixii', 'vendor/pixiibomb/ui/resources');

        $this->loadViewsFrom(
            $this->getPackagePath('resources/views'),
            'pixii'
        );

        Blade::componentNamespace(
            'PixiiBomb\\Ui\\View\\Components',
            'pixii',
        );

        $this->loadRoutesFrom(
            $this->getPackagePath('routes/web.php')
        );

        $this->configureApp();
    }

    private function configureApp(): void
    {
        $pixii = app(PixiiBomb::class);
        $theme = app(PixiiBombThemeService::class);
        $priority = 10;

        $theme
            ->registerTheme(new BaseTheme(), true)
            ->registerTheme(new HologlassTheme())
            ->registerTheme(new ManuscriptTheme())
            ->registerTheme(new PixiiTheme());

        $pixii->setDefaultTemplate(new UiTemplate(), $priority);
        $pixii->setDefaultLayout(new UiLayout(), $priority);
        $pixii->registerDefaultPage($this->configureDefaultPage(), $priority);
        $pixii->registerInstaller(PixiiUiInstaller::class, $priority);
    }

    private function configureDefaultPage(): Page
    {
        $block = new Block()
            ->setView('pixii::ui-welcome')
            ->setStylesheets(['pixii::blocks/ui-welcome'])
            ->setScripts(['pixii::blocks/ui-welcome']);

        return new Page()->setBlocks([$block]);
    }

    private function getPackagePath(string $path): string
    {
        return __DIR__.'/../'.$path;
    }
}
