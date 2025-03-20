<x-dashboard-layout>
    <div id="dashboard" class="dashboard-outer-container block ">
        <div class="dashboard-inner-container">
            <div id="sidebar" class="dashboard-sidebar-container">
                @foreach($datatypes as $datatype => $data)
                    <x-dashboard.datatype-link link="{{ $datatype }}" label="{{ $data->label }}"/>
                @endforeach
            </div>
            <div id="dashboard-content" class="dashboard-content-container">
                <h1 class="dashboard-heading">{{ __("Dashboard") }}</h1>
                @foreach($datatypes as $datatypeData)
                    <livewire:dashboard.datatype-entry-render-factory :datatype="$datatypeData->datatype" :entries="$datatypeData->entries" :template="$datatypeData->template" />
                @endforeach
            </div>
        </div>
    </div>
</x-dashboard-layout>
