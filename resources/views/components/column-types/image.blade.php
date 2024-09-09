@props(['value', 'column'])

<div>
    <img
        src="{{ config('services.cdnServer.url') . '/' . $value }}"
        alt="{{ $column->getTitle() }}"
        style="max-width: 30px;max-height: 30px"
    />
</div>

