@props(['column', 'data'])

{{ $data[$column->getField()]?->count() }}
