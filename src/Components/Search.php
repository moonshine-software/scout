<?php

declare(strict_types=1);

namespace MoonShine\Scout\Components;

use MoonShine\AssetManager\Js;
use MoonShine\UI\Components\MoonShineComponent;

/**
 * @method static static make(string $key = 'search', string $action = '', string $placeholder = '')
 */
final class Search extends MoonShineComponent
{
    protected string $view = 'moonshine-scout::components.search';

    public function __construct(
        private readonly string $key = 'search',
        private string $action = '',
        private string $placeholder = '',
    ) {
        parent::__construct();

        if($this->placeholder === '') {
            $this->placeholder = __('moonshine::ui.search') . ' (Ctrl+K)';
        }
    }

    public function getAssets(): array
    {
        return [
            Js::make('vendor/moonshine-scout/scout.js')
        ];
    }

    protected function isSearchEnabled(): bool
    {
        return config('moonshine-scout.models', []) !== [];
    }


    protected function prepareBeforeRender(): void
    {
        if ($this->isSearchEnabled()) {
            $this->action = moonshineRouter()->to('global-search');
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function viewData(): array
    {
        return [
            'action' => $this->action,
            'value' => moonshine()->getRequest()->get($this->key, ''),
            'placeholder' => $this->placeholder,
            'isEnabled' => $this->isSearchEnabled(),
        ];
    }
}
