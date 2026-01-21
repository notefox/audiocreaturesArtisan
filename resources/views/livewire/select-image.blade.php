<div class="p-4">
    <h2 class="text-xl font-semibold mb-3">
        {{ $multiple ? 'Select Images' : 'Select Image' }}
    </h2>

    <div class="mb-3">
        <input type="text" class="w-full border rounded px-3 py-2" placeholder="Search by name..." wire:model.debounce.300ms="search" />
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 max-h-[60vh] overflow-auto">
        @forelse($this->images as $img)
            @php $isSelected = $multiple && in_array($img->id, $selected ?? []); @endphp
            <div class="border rounded p-2 flex flex-col gap-2 {{ $isSelected ? 'ring-2 ring-indigo-600' : '' }}">
                <div class="aspect-square bg-gray-100 flex items-center justify-center overflow-hidden relative">
                    @php
                        $thumb = $img->parent == 0 ? optional($img->alt('thumbnail')) : $img;
                        $src = $thumb ? $thumb->absolute_path() : $img->absolute_path();
                    @endphp
                    <img src="{{ $src }}" alt="{{ $img->image_name }}" class="object-cover w-full h-full" />

                    @if($multiple)
                        <button type="button"
                                class="absolute top-2 right-2 bg-white/80 border rounded px-2 py-1 text-xs {{ $isSelected ? 'border-indigo-600 text-indigo-700' : '' }}"
                                wire:click="toggleSelect({{ $img->id }})">
                            {{ $isSelected ? 'Selected' : 'Select' }}
                        </button>
                    @endif
                </div>
                <div class="text-sm truncate" title="{{ $img->image_name }}">{{ $img->image_name }}</div>
                @if(!$multiple)
                    <button type="button" class="bg-indigo-600 text-white text-sm px-3 py-1 rounded hover:bg-indigo-700" wire:click="select({{ $img->id }})">
                        Use this
                    </button>
                @endif
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500 py-6">No images found.</div>
        @endforelse
    </div>

    <div class="mt-4 text-right">
        @if($multiple)
            <button type="button"
                    class="px-3 py-1 rounded border mr-2"
                    wire:click="closeModal">Cancel</button>
            <button type="button"
                    class="px-3 py-1 rounded bg-indigo-600 text-white disabled:opacity-50"
                    wire:click="confirmSelection"
                    @disabled="false"
                    @class(['opacity-50' => count($selected ?? []) === 0])
                    {{ (count($selected ?? []) === 0) ? 'disabled' : '' }}>
                Use selected ({{ count($selected ?? []) }})
            </button>
        @else
            <button type="button" class="px-3 py-1 rounded border" wire:click="closeModal">Close</button>
        @endif
    </div>
</div>
