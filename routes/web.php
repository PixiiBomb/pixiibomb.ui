<?php

use Illuminate\Support\Facades\Route;
use PixiiBomb\Ui\Http\Controllers\{ThemeController};

Route::post('/theme/{theme}/{palette}', [ThemeController::class, 'setTheme']);

Route::get('test', [ThemeController::class, 'test']);
