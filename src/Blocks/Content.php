<?php

namespace PixiiBomb\Ui\Blocks;
use PixiiBomb\Core\Data\Block;
use PixiiBomb\Core\Data\ComponentBlock;
use PixiiBomb\Ui\Traits\HasContent;

class Content extends ComponentBlock
{
    public Block|string|null $body = null;
}
