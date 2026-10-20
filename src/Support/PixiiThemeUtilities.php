<?php

namespace PixiiBomb\Ui\Support;

use PixiiBomb\Ui\Blocks\Button;
use PixiiBomb\Ui\Enums\ButtonStyle;
use PixiiBomb\Ui\Enums\ButtonVariant;

/**
 * Provides helpers for constructing theme component examples.
 */
class PixiiThemeUtilities
{
    /**
     * Formats a button style for display.
     *
     * @param ButtonStyle $style The button style to format.
     *
     * @return string The formatted style name.
     */
    public static function formatButtonText(ButtonStyle $style): string
    {
        return str_replace('_', ' ', $style->name);
    }

    /**
     * Creates a button for every supported style using the given variant.
     *
     * @param ButtonVariant $variant The variant applied to each button.
     *
     * @return array<int, Button> The generated button collection.
     */
    public static function getButtonGroup(ButtonVariant $variant): array {
        $buttons = [];

        foreach (ButtonStyle::cases() as $style) {
            $buttons[] = new Button(self::formatButtonText($style))
                ->setStyle($style)
                ->setVariant($variant);
        }

        return $buttons;
    }
}
