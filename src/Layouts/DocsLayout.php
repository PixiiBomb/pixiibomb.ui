<?php

namespace PixiiBomb\Ui\Layouts;

use PixiiBomb\Core\Layouts\Layout;

class DocsLayout extends Layout
{
    protected ?string $defaultView = 'docs-layout';

    public function __construct()
    {
        parent::__construct();
        $this->setView($this->defaultView);
        $this->setStylesheets(['pixii::layouts/docs-layout']);
        $this->setScripts(['pixii::blocks/docs-layout']);
    }
}
