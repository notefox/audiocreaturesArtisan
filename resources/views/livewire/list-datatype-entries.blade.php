<div class="datalistEntry hidden flex flex-col items-end px-5 gap-3" data-datatype-container="{{ $datatype }}" id="{{ $datatype }}">
    <div class="flex w-full justify-between">
        <x-primary-button wire:click="$dispatch('openModal', {component: 'create-{{$datatype}}'} )" >
            {{ __('New') }} {{ generateLabel($datatype) }}
        </x-primary-button>

        <x-text-input class="w-fit text-sm" type="text"
                      placeholder="{{ __('Search') }} {{ generateLabel($datatype) }}"/>
    </div>

    <ul class="w-full">
        @foreach($entries as $entry)
            <li>{{ $entry }}</li>
        @endforeach
    </ul>
</div>
