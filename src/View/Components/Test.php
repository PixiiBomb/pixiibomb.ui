<?php

namespace PixiiBomb\Ui\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Test extends Component
{
    public function __construct(public string $title)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('pixii::components.test');
    }
}
