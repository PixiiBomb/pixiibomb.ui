<?php

namespace PixiiBomb\Ui\Blocks;

use PixiiBomb\Core\Data\ComponentBlock;
use PixiiBomb\Ui\Enums\CardStyle;
use PixiiBomb\Ui\Traits\HasContent;

class Card extends ComponentBlock
{
    use HasContent;

    protected string|null $thumbnail = null;

    protected static function getStyleEnum(): string
    {
        return CardStyle::class;
    }

    public function getThumbnail(): string|null
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }
}
