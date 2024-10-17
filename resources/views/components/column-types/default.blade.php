@props(['column', 'value'])

@if($column->isSearchable())
    @if(is_array($value))
        {!! implode(', ', $value) !!}
    @else
        {!! $this->highlight($value) !!}
    @endif
@else
    @if(is_array($value))
        {!! implode(', ', $value) !!}
    @else
        {!! $value !!}
    @endif
@endif
