<div class="m-6">
    <h2 class="text-2xl text-center">{{ __('New') }} Publisher</h2>

    <form wire:submit="save" class="mx-3">
        <x-input-label class="mt-2">{{__('Name')}}</x-input-label>
        <x-text-input wire:model="form.name" />
        <div>
            @error('form.name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <x-input-label class="mt-2">{{__('Country')}}</x-input-label>
        <x-text-input wire:model="form.country" />
        <div>
            @error('form.content') <span class="error">{{ $message }}</span> @enderror
        </div>

        <x-input-label class="mt-2">{{__('Link')}}</x-input-label>
        <x-text-input wire:model="form.link" />
        <div>
            @error('form.link') <span class="error">{{ $message }}</span> @enderror
        </div>

        <x-input-label class="mt-2">{{__('Logo')}}</x-input-label>
        <input type="file" wire:model="form.logo">
        <div>
            @error('form.logo') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Save</button>
    </form>
</div>
