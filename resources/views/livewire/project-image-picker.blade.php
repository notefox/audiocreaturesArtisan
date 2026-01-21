<div>
    <div class="flex items-center justify-between">
        <x-input-label>{{ __('Images') }}</x-input-label>
        <div class="flex gap-2">
            <button type="button"
                    class="px-3 py-1 rounded bg-indigo-600 text-white hover:bg-indigo-700"
                    x-data
                    x-on:click="$dispatch('openModal', { component: 'select-image', arguments: { emitTo: @js($emitTo), event: 'imagesSelected', originalOnly: true, multiple: true, preselected: @js($selectedIds) } })">
                {{ __('Pick images') }}
            </button>
            <button type="button"
                    class="px-3 py-1 rounded border hover:bg-gray-50"
                    wire:click="clear">
                {{ __('Clear') }}
            </button>
        </div>
    </div>

    @php $images = $this->images; @endphp
    @if($images->count() > 0)
        <div class="mt-3 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach($images as $img)
                @php
                    $thumb = $img->parent == 0 ? optional($img->alt('thumbnail')) : $img;
                    $src = $thumb ? $thumb->absolute_path() : $img->absolute_path();
                @endphp
                <div class="border rounded p-2 flex flex-col gap-2">
                    <div class="aspect-square overflow-hidden bg-gray-100">
                        <img src="{{ $src }}" alt="{{ $img->image_name }}" class="object-cover w-full h-full" />
                    </div>
                    <div class="text-sm truncate" title="{{ $img->image_name }}">{{ $img->image_name }}</div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-sm text-gray-500 mt-2">{{ __('No images selected.') }}</div>
    @endif
    <p class="text-xs text-gray-500 mt-1">{{ __('The first selected image will be used as the project heading image.') }}</p>
</div>
