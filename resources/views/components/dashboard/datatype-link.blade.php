@props(['link', 'label'])

<a href="#{{ $link }}" class="dashboard-sidebar-link" wire:click="changeToDatatypeList">
    <span>{{ $label }}</span>
</a>
