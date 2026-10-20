<?php

namespace PixiiBomb\Ui\Blocks;

use PixiiBomb\Core\Data\Block;
use PixiiBomb\Core\Data\ComponentBlock;

class Section extends ComponentBlock
{
    private const string DEFAULT_TITLE = 'Section Title';
    private const string DEFAULT_DESCRIPTION = 'Section Description';

    protected string $title = self::DEFAULT_TITLE;
    protected string $description = self::DEFAULT_DESCRIPTION;
    protected array $body = [];
    protected int $h = 2;

    public function __construct(array $body, string $title = self::DEFAULT_TITLE, int $h = 2, string $description = self::DEFAULT_DESCRIPTION)
    {
        parent::__construct();
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setBody($body);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getH(): int
    {
        return $this->h;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set the blocks rendered by this component.
     *
     * Non-Block values are ignored.
     *
     * @param array $blocks Candidate block values.
     */
    public function setBody(array $blocks): self
    {
        $this->body = collect($blocks)
            ->filter(fn ($block) => $block instanceof Block)
            ->values()
            ->all();

        return $this;
    }

    public function setH(int $h): self
    {
        $this->h = $h;
        return $this;
    }
}
