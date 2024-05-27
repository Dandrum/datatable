@props(['column', 'data'])

@php($value = $this->getFieldData($column->getField(), $data))
@if($value)
    <div
        class="mr-2 rounded bg-{{ $column->getColor($value) }}-900 py-1 text-xs font-medium text-slate-200 px-2.5">{{__($value)}}</div>
@endif
