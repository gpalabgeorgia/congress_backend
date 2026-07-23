<x-filament::page>
    <form wire:submit.prevent="submit" class="space-y-6">
        {{ $this->form }}

        <div class="flex justify-start">
            <x-filament::button type="submit">
                ახალი პაროლის შენახვა
            </x-filament::button>
        </div>
    </form>
</x-filament::page>
