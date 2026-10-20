<?php

namespace PixiiBomb\Ui\Layouts;

use PixiiBomb\Core\Layouts\Layout;

class UiLayout extends Layout
{
    protected ?string $defaultView = 'ui-layout';

    public function __construct()
    {
        parent::__construct();
        $this->setView($this->defaultView);
    }
}
