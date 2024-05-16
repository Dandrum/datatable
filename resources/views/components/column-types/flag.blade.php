@if($value !== '')
    <img src="{{ asset('/img/flags/' . strtolower($value) . '.png') }}" alt="FLAG"/>
@else
    -
@endif
