@props(['column', 'value'])

{{ date($column->getFormat(), strtotime($value)) }}
