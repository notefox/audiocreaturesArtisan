<div class="datalistEntry flex flex-col items-end px-5 gap-3" data-datatype-container="{{ $datatype }}"
     id="{{ $datatype }}">
    <div class="flex w-full justify-between">
        <x-primary-button wire:click="$dispatch('openModal', {component: 'create-{{$datatype}}'} )">
            {{ __('New') }} {{ generateLabel($datatype) }}
        </x-primary-button>

        <x-text-input class="w-fit text-sm" type="text"
                      placeholder="{{ __('Search') }} {{ generateLabel($datatype) }}"/>
    </div>

    <div class="w-full border-2">
        <div class="grid grid-cols-[1fr,4fr,1fr] border-b-2">
            <span>ID</span>
            <span>Name</span>
        </div>
        @foreach($entries as $entry)
            <div class="grid grid-cols-[1fr,4fr,1fr] gap-3 border-b-2">
                <span> {{ $entry->id }} </span>
                <span> {{ $entry->name }} </span>
                <form action="{{ route(str_replace('_', '-', $datatype) . '.destroy', ['id' => $entry->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <x-danger-button onClick="return confirm('Are you sure?')" type="delete" name="Delete">
                        Delete
                    </x-danger-button>
                </form>
            </div>
        @endforeach
    </div>
</div>
