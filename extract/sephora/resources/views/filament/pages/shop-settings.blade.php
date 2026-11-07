<x-filament-panels::page>
    {{ $this->form }}

    <div class="mt-6 flex items-center gap-x-4">
        <x-filament::button wire:click="save" icon="heroicon-o-check-circle">
            Save settings
        </x-filament::button>

        <p class="text-sm text-gray-500 dark:text-gray-400">
            Changes take effect immediately on the storefront.
        </p>
    </div>
</x-filament-panels::page>
