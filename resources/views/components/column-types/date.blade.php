@props(['column', 'value'])

@if($value)
    {{ date($column->getFormat(), strtotime($value)) }}
@endif
