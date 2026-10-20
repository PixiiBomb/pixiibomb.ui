<?php

namespace PixiiBomb\Ui\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\View\ComponentSlot;

/**
 * Displays a rendered component preview alongside its source code.
 */
class CodeExample extends Component
{
    /**
     * Creates a code example.
     *
     * @param string $language The source-code language.
     * @param string|null $label An optional label displayed above the source.
     */
    public function __construct(public string $language = 'html', public ?string $label = null, public ?string $code = null) {
    }

    /**
     * Gets the label displayed above the source code.
     */
    public function getLabel(): string
    {
        return $this->label ?? strtoupper($this->language);
    }

    /**
     * Removes shared Blade indentation from source code while preserving its
     * internal indentation.
     *
     * @param ComponentSlot|string $source The source code to normalize.
     *
     * @return string The normalized source code.
     */
    public function formatSource(ComponentSlot|string $source): string
    {
        $source = str_replace(
            ["\r\n", "\r"],
            "\n",
            (string) $source,
        );

        $lines = explode("\n", $source);

        while ($lines !== [] && trim($lines[0]) === '') {
            array_shift($lines);
        }

        while (
            $lines !== [] &&
            trim($lines[array_key_last($lines)]) === ''
        ) {
            array_pop($lines);
        }

        if ($lines === []) {
            return '';
        }

        $firstLineIndentation = $this->getIndentation($lines[0]);
        $indentations = [];

        foreach ($lines as $index => $line) {
            if (trim($line) === '') {
                continue;
            }

            if ($index === 0 && $firstLineIndentation === 0) {
                continue;
            }

            $indentations[] = $this->getIndentation($line);
        }

        if ($indentations === []) {
            return implode("\n", $lines);
        }

        $sharedIndentation = min($indentations);

        $lines = array_map(
            function (string $line) use ($sharedIndentation): string {
                if (trim($line) === '') {
                    return '';
                }

                $lineIndentation = $this->getIndentation($line);
                $removeLength = min(
                    $lineIndentation,
                    $sharedIndentation,
                );

                return substr($line, $removeLength);
            },
            $lines,
        );

        return implode("\n", $lines);
    }

    /**
     * Gets the number of leading whitespace characters on a line.
     */
    private function getIndentation(string $line): int
    {
        preg_match('/^[ \t]*/', $line, $matches);

        return strlen($matches[0]);
    }

    /**
     * Gets the view that represents the component.
     */
    public function render(): View
    {
        return view('pixii::components.code-example');
    }
}
