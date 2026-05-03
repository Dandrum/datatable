@props(['column', 'value'])

@if($column->isSearchable())
    @if(is_array($value))
        {!! implode(', ', $value) !!}
    @else
        {!! $this->highlight(__($value)) !!}
    @endif
@else
    @if(is_array($value))
        {!! implode(', ', $value) !!}
    @else
        {!! __($value) !!}
    @endif
@endif
