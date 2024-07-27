<?php

declare(strict_types=1);

namespace MoonShine\Scout\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

final class ScoutServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/moonshine-scout'),
        ], ['moonshine-scout-assets', 'laravel-assets']);

        $this->publishes([
            __DIR__ . '/../../config/moonshine-scout.php' => config_path('moonshine-scout.php'),
        ]);

        $this->loadRoutesFrom(__DIR__ . '/../../routes/scout.php');


        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'moonshine-scout');

        Blade::componentNamespace('MoonShine\\Scout\\Components', 'moonshine-scout');
    }
}
