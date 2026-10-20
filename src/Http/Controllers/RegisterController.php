<?php

namespace PixiiBomb\Ui\Controllers\User;

use Illuminate\View\View;
use PixiiBomb\Core\Data\Meta;
use PixiiBomb\Core\Data\Page;
use PixiiBomb\Core\Http\Controllers\PageController;

/**
 * Handle frontend registration page rendering.
 *
 * Provides:
 *  - registration page rendering
 *  - PixiiBomb page/layout integration
 *  - registration-specific stylesheets
 */
class RegisterController extends PageController
{
    /**
     * Display the registration page.
     */
    public function index(): View
    {
        $page = new Page('blocks.auth.register', new Meta('Register'));
        $page->setStylesheets(['register']);

        return parent::view($page);
    }
}
