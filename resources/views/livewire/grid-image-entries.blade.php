<div class="datalistEntry flex flex-col items-end px-5 gap-3" data-datatype-container="{{ $datatype }}"
     id="{{ $datatype }}">
    <div class="flex w-full justify-between">
        <x-primary-button wire:click="$dispatch('openModal', {component: 'create-{{$datatype}}'} )">
            {{ __('New') }} {{ generateLabel($datatype) }}
        </x-primary-button>

        <x-text-input class="w-fit text-sm" type="text"
                      placeholder="{{ __('Search') }} {{ generateLabel($datatype) }}"/>
    </div>

    <div class="flex-grow w-full overflow-y-scroll h-screen pb-[200px] relative isolate">
        <div class="h-6 w-full sticky top-0 z-20 bg-gradient-to-b from-white to-transparent"></div>
        <!--
            needed functional padding-bottom defined in grid-minmax (with square aspect)
            else please reimplement if become smarter
         -->
        <div class="w-full grid grid-minmax gap-4">
            @foreach($entries as $entry)
                <div class="col-span-1 isolate">
                    <div class="w-full aspect-square rounded-md overflow-hidden border-2 relative">
                        <div class="w-full h-full h-full bg-cover bg-center"
                             style="background-image: url('{{ asset('storage/' . $entry->image_path) }}')">
                        </div>
                        <div class="absolute pl-2 pt-5 bottom-0 w-full z-10 bg-gradient-to-t from-white from-20% to-transparent">
                            <p>{{$entry->image_name}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
