@props(['column', 'data'])

@php($value = $this->getFieldData($column->getField(), $data))
@if($value)
    @switch($column->getColor($value))
        @case('red')
            <div class="mr-2 rounded bg-red-900 py-1 text-xs font-medium text-slate-200 px-2.5">{{__($value)}}</div>
        @break
        @case('yellow')
            <div class="mr-2 rounded bg-yellow-900 py-1 text-xs font-medium text-slate-200 px-2.5">{{__($value)}}</div>
            @break
        @case('blue')
            <div class="mr-2 rounded bg-blue-900 py-1 text-xs font-medium text-slate-200 px-2.5">{{__($value)}}</div>
            @break
        @case('green')
            <div class="mr-2 rounded bg-green-900 py-1 text-xs font-medium text-slate-200 px-2.5">{{__($value)}}</div>
            @break
        @case('purple')
            <div class="mr-2 rounded bg-purple-900 py-1 text-xs font-medium text-slate-200 px-2.5">{{__($value)}}</div>
            @break
        @case('fuchsia')
            <div class="mr-2 rounded bg-fuchsia-900 py-1 text-xs font-medium text-slate-200 px-2.5">{{__($value)}}</div>
            @break
        @default
            <div class="mr-2 rounded bg-slate-900 py-1 text-xs font-medium text-slate-200 px-2.5">{{__($value)}}</div>
            @break
    @endswitch
@endif
