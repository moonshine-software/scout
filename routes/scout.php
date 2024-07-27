<?php

declare(strict_types=1);

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use MoonShine\Scout\Http\Controllers\GlobalSearchController;

$authMiddleware = moonshineConfig()->getAuthMiddleware();

Route::moonshine(static function(Router $router) use($authMiddleware): void {
    $router->middleware(
        $authMiddleware
    )->group(function (): void {
        Route::get(
            'search',
            GlobalSearchController::class
        )->name('global-search');
    });
});
