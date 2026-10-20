<?php

namespace PixiiBomb\Ui\Blocks;

use PixiiBomb\Core\Data\Block;
use PixiiBomb\Core\Data\ComponentBlock;
use PixiiBomb\Ui\Enums\AlertStyle;
use PixiiBomb\Ui\Traits\{HasIcon, HasStyle, HasVariant};
use PixiiBomb\Ui\Enums\AlertVariant;
use PixiiBomb\Ui\Enums\BootstrapIconSet;
use PixiiBomb\Ui\Enums\ButtonVariant;

class Alert extends ComponentBlock
{
    use HasIcon;
    use HasStyle;
    use HasVariant;

    protected ?string $title = null;
    protected Block|string|null $body = null;
    protected ?Button $buttonClose = null;
    protected bool $isDismissible = true;

    /**
     * @param string $body
     * @see $this->styles
     */
    public function __construct(string $body = 'You got a message')
    {
        parent::__construct();

        $this->setBody($body);
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function getButtonClose(): ?Button
    {
        $this->buttonClose ??= $this->getDefaultButtonClose();
        return $this->buttonClose;
    }

    public function getIsDismissible(): bool
    {
        return $this->isDismissible;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setBody(Block|string|null $body): self
    {
        $this->body = $body;
        return $this;
    }

    public function setButtonClose(?Button $buttonClose): self
    {
        $buttonClose->setAttribute('data-bs-dismiss', 'alert');
        $buttonClose->setAttribute('aria-label', 'Close');

        $this->buttonClose = $buttonClose;

        return $this;
    }

    public function setIsDismissible(bool $isDismissible): self
    {
        $this->isDismissible = $isDismissible;
        return $this;
    }

    protected function defineClasses(): void
    {
        $style = $this->getStyle();
        $dismissable = $this->getIsDismissible();

        $dismissableClasses = $dismissable ? 'alert-dismissible fade show' : '';
        $customClasses = $this->getAttribute('class');

        $this->classes = [
            'alert',
            "alert-$style",
            $dismissableClasses,
            is_string($customClasses) ? $customClasses : null,
        ];
    }

    protected static function getStyleEnum(): string
    {
        return AlertStyle::class;
    }

    protected static function getVariantEnum(): string
    {
        return AlertVariant::class;
    }

    protected function getDefaultButtonClose(): ?Button
    {
        return new Button()
            ->setIcon(BootstrapIconSet::X)
            ->setVariant(ButtonVariant::LINK);
    }
}
