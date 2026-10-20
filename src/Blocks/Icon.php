<?php

namespace PixiiBomb\Ui\Blocks;

use PixiiBomb\Core\Data\ComponentBlock;
use PixiiBomb\Ui\Interfaces\IIconSet;

class Icon extends ComponentBlock
{
    protected IIconSet|string|null $icon = null;

    public function __construct(IIconSet|string|null $icon)
    {
        parent::__construct();
        $this->icon = $icon;
    }

    public function getClasses(): string
    {
        return $this->icon->classes();
    }

    public function getIcon(): IIconSet|string|null
    {
        return $this->icon;
    }

    public function setIcon(IIconSet|string|null $icon): self
    {
        $this->icon = $icon;
        return $this;
    }
}
