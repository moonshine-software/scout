@props([
    'enabled' => $isEnabled ?? true,
    'action' => '',
    'value' => '',
    'placeholder' => '',
])
@if($enabled)
    <div x-data="moonshineScout(`{{ $action }}`)">
        <a
            @click.prevent="modal"
            @keyup.ctrl.k.window="modal"
            @keyup.ctrl.period.window="modal"
        >
            <x-moonshine::icon
                icon="magnifying-glass"
                size="6"
            />
        </a>

        <x-moonshine::modal name="global-search" title="Search" :closeOutside="true">
            <x-moonshine::form name="search">
                <x-moonshine::form.input
                    class="search-input"
                    x-model.debounce.300ms="query"
                />
            </x-moonshine::form>

            <div class="search-loading" style="display: none;">
                <x-moonshine::loader />
            </div>

            <ul>
                <template x-for="(data, key) in groups" :key="key">
                    <li x-html="group(key, data)" />
                </template>
            </ul>
        </x-moonshine::modal>
    </div>
@endif
