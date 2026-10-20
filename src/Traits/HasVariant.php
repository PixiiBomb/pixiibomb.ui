<?php

namespace PixiiBomb\Ui\Traits;

use BackedEnum;
use InvalidArgumentException;

/**
 * Provides variant support for a component.
 *
 * Components using this trait define a backed enum that represents the
 * collection of valid variant values. Any assigned variant is validated against
 * that enum before being applied.
 */
trait HasVariant
{
    /**
     * The current variant applied to the component.
     */
    protected string $variant = 'primary';

    /**
     * Gets the backed enum class that defines the valid variant values.
     *
     * @return class-string<BackedEnum> The variant enum class.
     */
    abstract protected static function getVariantEnum(): string;

    /**
     * Gets the current variant.
     *
     * @return string The current variant value.
     */
    public function getVariant(): string
    {
        return $this->variant;
    }

    /**
     * Sets the component variant.
     *
     * The supplied value may be either a string or a backed enum instance. The
     * resulting value is validated against the component's supported variant enum.
     *
     * @param string|BackedEnum $variant The variant to apply.
     *
     * @return HasVariant Returns the current instance for method chaining.
     */
    public function setVariant(string|BackedEnum $variant): self
    {
        $value = $variant instanceof BackedEnum
            ? $variant->value
            : $variant;

        $enumClass = static::getVariantEnum();

        if ($enumClass::tryFrom($value) === null) {
            throw new InvalidArgumentException(
                "Invalid variant [$value] for " . static::class
            );
        }

        $this->variant = $value;

        return $this;
    }
}
