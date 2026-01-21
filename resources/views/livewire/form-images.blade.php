<div class="m-6">
    <h2 class="text-2xl text-center">{{__('New')}} Image</h2>
    <form wire:submit="save" class="mx-3 flex flex-col gap-2">
        <x-input-label class="w-full">{{__('Name')}}</x-input-label>
        <x-text-input class="w-full" wire:model="form.name" />
        <div>
            @error('form.name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <x-input-label class="w-full">{{__('imageUpload')}}</x-input-label>

        @if($this->form->imageReference)
            <img src="{{ $this->form->imageReference->temporaryUrl() }}" alt="preview"/>
        @endif

        <input type="file" wire:model="form.imageReference">

        <div>
            @error('form.imageReference')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <x-primary-button class="w-full text-center flex justify-center" type="submit">
            Save
        </x-primary-button>
    </form>

</div>
