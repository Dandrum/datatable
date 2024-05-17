@props(['column', 'value'])

@if($column->isSearchable())
    {!! $this->highlight($value) !!}
@else
    {{ $value }}
@endif
