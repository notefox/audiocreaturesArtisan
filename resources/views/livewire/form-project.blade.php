<div class="m-6">
    <h2 class="text-2xl text-center">{{ __('New') }} Project</h2>

    <form wire:submit="save" class="mx-3 flex flex-col gap-4">
        <div>
            <x-input-label class="w-full">{{ __('Name') }}</x-input-label>
            <x-text-input class="w-full" wire:model.defer="form.name" />
            @error('form.name') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <x-input-label class="w-full">{{ __('Description') }}</x-input-label>
            <textarea class="w-full border rounded px-3 py-2" rows="4" wire:model.defer="form.description"></textarea>
            @error('form.description') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label class="w-full">{{ __('Release Date') }}</x-input-label>
                <x-text-input type="date" class="w-full" wire:model.defer="form.release_date" />
                @error('form.release_date') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <x-input-label class="w-full">{{ __('Publisher') }}</x-input-label>
                <x-text-input type="number" min="0" class="w-full" wire:model.defer="form.publisher_id" />
                @error('form.publisher_id') <span class="error text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Image selection (multi-select) extracted to its own component -->
        <livewire:project-image-picker :selected-ids="$form->image_ids" />

        <x-primary-button class="w-full text-center flex justify-center" type="submit">
            {{ __('Save') }}
        </x-primary-button>
    </form>
</div>
