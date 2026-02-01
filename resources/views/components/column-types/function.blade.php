@props(['column', 'data'])

@php
    $value = $data->{$column->getField()}();

    if (is_array($value)) {
        // Array → kommagetrennte Liste
        $formatted = implode(', ', array_map(fn($v) => is_array($v) ? json_encode($v) : $v, $value));
    } elseif (is_numeric($value)) {
        // Zahl → Tausendertrennzeichen, Dezimalkomma nur wenn Nachkommastellen vorhanden
        $floatVal = (float) $value;
        $decimals = ($floatVal != floor($floatVal)) ? 2 : 0;
        $formatted = number_format($floatVal, $decimals, ',', '.');
    } elseif (is_string($value) && is_array($decoded = json_decode($value, true)) && json_last_error() === JSON_ERROR_NONE) {
        // JSON-String → kompakter JSON-String
        $formatted = json_encode($decoded, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    } else {
        // Einfacher String
        $formatted = (string) $value;
    }
@endphp

{!! $formatted !!}
