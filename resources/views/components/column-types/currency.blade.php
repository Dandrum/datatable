@if($value !== null)
    @php($fmt = numfmt_create( $language, NumberFormatter::CURRENCY ))
    {{$fmt->formatCurrency($value, "EUR")}}
@endif
