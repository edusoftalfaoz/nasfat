<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}

        <div style="margin-top: 1.5rem; display: flex; gap: .75rem; align-items: center;">
            <x-filament::button type="submit" size="lg">
                Save changes
            </x-filament::button>
            <span wire:loading wire:target="save" style="font-size: .9rem; opacity: .7;">Saving...</span>
        </div>
    </form>
</x-filament-panels::page>
