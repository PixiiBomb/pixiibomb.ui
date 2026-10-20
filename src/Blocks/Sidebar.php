<?php

namespace PixiiBomb\Ui\Blocks;

use PixiiBomb\Core\Data\Block;
use PixiiBomb\Core\Data\ComponentBlock;
use PixiiBomb\Core\Data\MenuGroup;
use PixiiBomb\Core\Data\SectionDirective;
use PixiiBomb\Ui\Enums\SidebarStyle;
use PixiiBomb\Ui\Traits\HasStyle;

class Sidebar extends ComponentBlock
{
    use HasStyle;

    protected Block|SectionDirective|string|array|null $header = null;
    protected Block|SectionDirective|string|array|null $body = null;
    protected array $menuGroups = [];

    protected static function getStyleEnum(): string
    {
        return SidebarStyle::class;
    }

    public function getHeader(): Block|SectionDirective|string|array|null
    {
        return $this->header;
    }

    public function getBody(): Block|SectionDirective|string|array|null
    {
        return $this->body;
    }

    public function getMenuGroups(): array
    {
        return $this->menuGroups;
    }

    public function setMenuGroups(array $menuGroups): self
    {
        $this->menuGroups = collect($menuGroups)
            ->filter(fn($item) => $item instanceof MenuGroup)
            ->values()
            ->all();
        return $this;
    }

    public function getActiveClassname(string $route): string
    {
        $path = '/'.request()->path();

        if($path == $route)
        {
            return 'active';
        }

        return '';
    }

    public function setHeader(Block|SectionDirective|string|array|null $header): self
    {
        $this->header = $this->validateContent($header);
        return $this;
    }

    public function setBody(Block|SectionDirective|string|array|null $body): self
    {
        $this->body = $this->validateContent($body);
        return $this;
    }
}
