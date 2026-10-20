<?php

namespace PixiiBomb\Ui\Traits;

use PixiiBomb\Ui\Interfaces\IIconSet;

trait HasIcon
{
    protected IIconSet|string|null $icon = null;

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
