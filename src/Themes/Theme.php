<?php

namespace PixiiBomb\Ui\Themes;

class Theme
{
    protected ?string $directory = 'vendor/pixiibomb/ui/resources/css/themes';

    protected ?string $name = null;

    protected ?string $palette = 'null';

    protected array $palettes = [];

    public function __construct()
    {
        $this->setName($this->getDefaultThemeName());
        $this->initializePalettes();
        $this->setPalette($this->getDefaultThemePalette());
    }

    public function getDirectory(): ?string
    {
        return $this->directory;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPalette(): ?string
    {
        return $this->palette;
    }

    public function getPalettes(): array
    {
        return $this->palettes;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setDirectory(?string $directory): self
    {
        $this->directory = $directory;
        return $this;
    }

    public function setPalette(?string $palette): self
    {
        $this->palette = $palette;
        return $this;
    }

    public function getThemeStructureImport(): ?string
    {
        $directory = $this->getStructuresDirectory();

        return "$directory/_import.css";
    }

    public function getPaletteStylesheet(): ?string
    {
        $directory = $this->getPalettesDirectory();
        $palette = $this->getPalette();

        return "$directory/$palette.css";
    }

    protected function getThemeDirectory(): ?string
    {
        $directory = $this->getDirectory();
        $name = $this->getName();

        return "$directory/$name";
    }

    protected function getPalettesDirectory(): ?string
    {
        $directory = $this->getThemeDirectory();

        return "$directory/palettes";
    }

    protected function getStructuresDirectory(): ?string
    {
        $directory = $this->getThemeDirectory();

        return "$directory/structures";
    }

    private function initializePalettes(): void
    {
        $directory = base_path($this->getPalettesDirectory());
        $stylesheets = glob("$directory/*.css");

        foreach ($stylesheets as $stylesheet) {
            $this->palettes[] = str_replace('.css', '', basename($stylesheet));
        }
    }

    private function getDefaultThemeName(): string
    {
        $format = strtolower(basename(get_class($this)));
        return str_replace('theme', '', $format);
    }

    private function getDefaultThemePalette(): ?string
    {
        if (empty($this->palettes))
        {
            return null;
        }

        return $this->palettes[0];
    }
}
