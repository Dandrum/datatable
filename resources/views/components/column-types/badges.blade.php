@if($value)
    @switch($colors[$value])
        @case('blue')
            <div class="bg-blue-900 text-blue-200 text-xs font-medium mr-2 px-2.5 py-1 rounded">{{__($value)}}</div>
        @break
        @case('green')
            <div class="bg-green-900 text-green-200 text-xs font-medium mr-2 px-2.5 py-1 rounded">{{__($value)}}</div>
            @break
        @case('red')
            <div class="bg-red-900 text-red-200 text-xs font-medium mr-2 px-2.5 py-1 rounded">{{__($value)}}</div>
            @break
        @case('purple')
            <div class="bg-purple-900 text-purple-200 text-xs font-medium mr-2 px-2.5 py-1 rounded">{{__($value)}}</div>
            @break
        @default
            <div class="bg-slate-900 text-slate-200 text-xs font-medium mr-2 px-2.5 py-1 rounded">{{__($value)}}</div>
        @break
    @endswitch
@endif
