<?php

namespace PixiiBomb\Ui\Blocks;

use PixiiBomb\Core\Data\ComponentBlock;
use PixiiBomb\Ui\Enums\{ ButtonStyle, ButtonVariant };
use PixiiBomb\Ui\Traits\{ HasIcon, HasStyle, HasVariant };

class Button extends ComponentBlock
{
    use HasIcon;
    use HasStyle;
    use HasVariant;

    protected ?string $text = null;

    public function __construct(?string $text = null)
    {
        parent::__construct();
        $this->setText($text);
        $this->setVariant(ButtonVariant::SOLID->value);
        $this->setAttribute('type', 'button');
    }

    /**
     * Gets all CSS classes applied to the button.
     *
     * This includes the Bootstrap base class, the classes generated from the
     * current style and variant, and any custom classes assigned through the
     * component's attributes.
     *
     * @return string The complete CSS class string.
     */
    public function getClasses(): string
    {
        $style = $this->getStyle();

        $variantClasses = match ($this->variant) {
            ButtonVariant::SOLID->value => "btn-$style",
            ButtonVariant::OUTLINE->value => "btn-outline-$style",
            ButtonVariant::LINK->value => "btn-link btn-$style",
            ButtonVariant::BLOCK->value => "btn-$style w-100",
        };

        $customClasses = $this->getAttribute('class');

        return collect([
            'btn',
            $variantClasses,
            is_string($customClasses) ? $customClasses : null,
        ])
            ->filter(fn (?string $class) => filled($class))
            ->map(fn (string $class) => trim($class))
            ->implode(' ');
    }

    protected static function getStyleEnum(): string
    {
        return ButtonStyle::class;
    }

    protected static function getVariantEnum(): string
    {
        return ButtonVariant::class;
    }

    public function getText(): ?string { return $this->text; }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
