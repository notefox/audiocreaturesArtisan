@props(['link', 'label'])

<a class="dashboard-sidebar-link" data-tab="{{$link}}" href="#{{$link}}">
    <span>{{ $label }}</span>
</a>
