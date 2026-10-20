<?php

namespace PixiiBomb\Ui\Traits;

use PixiiBomb\Core\Data\Block;
use PixiiBomb\Ui\Blocks\Content;

trait HasContent
{
    protected ?string $title = null;
    protected ?string $subtitle = null;
    protected ?Content $header = null;
    protected ?Content $body = null;
    protected ?Content $footer = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function getHeader(): Block|string|null
    {
        return $this->header;
    }

    public function getBody(): Block|string|null
    {
        return $this->body;
    }

    public function getFooter(): Block|string|null
    {
        return $this->footer;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    public function setHeader(Block $header): self
    {
        $this->header = $this->tryParseContent($header);;
        return $this;
    }

    public function setBody(Block $body): self
    {
        $this->body = $this->tryParseContent($body);
        return $this;
    }

    public function setFooter(Block $footer): self
    {
        $this->footer = $this->tryParseContent($footer);;
        return $this;
    }

    protected function tryParseContent(Block|string $content)
    {
        if (is_string($content))
        {
            return new Block($content);
        }


    }
}
