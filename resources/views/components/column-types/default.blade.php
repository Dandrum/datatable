@props(['column', 'value'])

@if($column->isSearchable())
    @if(is_array($value))
        {!! implode(', ', $value) !!}
    @else
        {!! __($this->highlight($value)) !!}
    @endif
@else
    @if(is_array($value))
        {!! implode(', ', $value) !!}
    @else
        {!! __($value) !!}
    @endif
@endif
