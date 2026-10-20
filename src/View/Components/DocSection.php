<?php

namespace PixiiBomb\Ui\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Renders a documentation section with an optional heading and body.
 */
class DocSection extends Component
{
    /**
     * Creates a documentation section.
     *
     * @param string|null $title The section title.
     * @param string|null $description The section description.
     */
    public function __construct(public ?string $title = null, public int $h = 2, public ?string $description = null)
    {
        //
    }

    public function getAnchor(): string
    {
        $anchor = strtolower($this->title);
        return str_replace(' ', '-', $anchor);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('pixii::components.doc-section');
    }
}
