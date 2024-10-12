<div class="m-6">
    <h2 class="text-2xl text-center">{{__('New')}} Project Type </h2>
    <form wire:submit="save" class="mx-3 flex flex-col gap-2">
        <x-input-label class="w-full">{{__('Name')}}</x-input-label>
        <x-text-input class="w-full" wire:model="form.name" />
        <div>
            @error('form.name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <x-primary-button class="w-full text-center flex justify-center" type="submit">Save</x-primary-button>
    </form>
</div>
