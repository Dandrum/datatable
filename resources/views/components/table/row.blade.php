@props(['columns', 'data'])

<tr>
    @foreach($columns as $column)
        @if(!$column->isHidden())
            @switch($column->getType())
                @case(1)
                    test
                    @break
                @default
                    <td class="whitespace-nowrap px-5 py-3 text-left text-sm text-gray-500">
                        {{ $data[$column->getField()] }}
                    </td>
            @endswitch
        @endif
    @endforeach


    {{--    <td class="relative whitespace-nowrap py-2 pr-4 pl-3 text-right text-sm font-medium sm:pr-0">--}}
    {{--                   <span class="isolate inline-flex rounded-md shadow-sm">--}}
    {{--                      <button type="button"--}}
    {{--                              class="relative inline-flex items-center rounded-l-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Years</button>--}}
    {{--                      <button type="button"--}}
    {{--                              class="relative -ml-px inline-flex items-center bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Months</button>--}}
    {{--                      <button type="button"--}}
    {{--                              class="relative -ml-px inline-flex items-center rounded-r-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Days</button>--}}
    {{--                    </span>--}}
    {{--    </td>--}}
</tr>
