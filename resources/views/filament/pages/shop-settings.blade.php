<x-filament-panels::page>
    {{ $this->form }}

    <div class="mt-6 flex items-center gap-x-4">
        <x-filament::button wire:click="save" icon="heroicon-o-check-circle">
            {{ __('content.t_913aba9f96cf') }}
        </x-filament::button>

        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ __('content.t_eaf9b9b3b548') }}
        </p>
    </div>
</x-filament-panels::page>
