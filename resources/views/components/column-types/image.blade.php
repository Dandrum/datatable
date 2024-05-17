@props(['value', 'column'])

<div>
    <img
        src="{{ config('services.cdnServer.url') . $value }}"
        alt="{{ $column->getTitle() }}"
    />
</div>

