<?php

namespace PixiiBomb\Ui\Traits;

use BackedEnum;
use InvalidArgumentException;
use PixiiBomb\Core\Data\ComponentBlock;

/**
 * Provides style support for a component.
 *
 * Components using this trait define a backed enum that represents the
 * collection of valid style values. Any assigned style is validated against
 * that enum before being applied.
 */
trait HasStyle
{
    /**
     * The current style applied to the component.
     */
    protected string $style = 'primary';

    /**
     * Gets the backed enum class that defines the valid style values.
     *
     * @return class-string<BackedEnum>|null The style enum class.
     */
    abstract protected static function getStyleEnum(): ?string;

    /**
     * Gets the current style.
     *
     * @return string The current style value.
     */
    public function getStyle(): string
    {
        return $this->style;
    }

    /**
     * Sets the component style.
     *
     * The supplied value may be either a string or a backed enum instance. The
     * resulting value is validated against the component's supported style enum.
     *
     * @param string|BackedEnum $style The style to apply.
     *
     * @return ComponentBlock|HasStyle Returns the current instance for method chaining.
     */
    public function setStyle(string|BackedEnum $style): self
    {
        $value = $style instanceof BackedEnum
            ? $style->value
            : $style;

        $enumClass = static::getStyleEnum();

        if ($enumClass::tryFrom($value) === null) {
            throw new InvalidArgumentException(
                "Invalid style [$value] for " . static::class
            );
        }

        $this->style = $value;

        return $this;
    }
}
