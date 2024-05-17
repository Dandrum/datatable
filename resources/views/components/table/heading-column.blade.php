@props(['column'])

<th scope="col"
    class="px-5 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
    @if($column->isSortable())
        <div class="flex flex-auto items-center group cursor-pointer"
             wire:click="changeSort('{{ $column->getField() }}')">
            {{ $column->getTitle() }}
            @if(isset($this->sort[$column->getField()]))
                <span class="ml-2 flex-none rounded bg-gray-100 text-gray-900 group-hover:bg-gray-200">
                    @if($this->sort[$column->getField()] === 'desc')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5"/>
                        </svg>
                    @endif
                </span>
            @else
                <span class="ml-2 flex-none rounded bg-gray-100 text-gray-900 group-hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor"
                         class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                    </svg>
                </span>
            @endif
        </div>
    @else
        <div class="flex flex-auto items-center" style="height: 24px;">
            {{ $column->getTitle() }}
        </div>
    @endif
</th>
