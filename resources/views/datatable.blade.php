<div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        @if(count($globalFilters) > 0)
            <div style="width: 300px">
                @foreach($globalFilters as $filter)
                    <select
                        name="{{ $filter }}"
                        wire:model.live="{{ $filter }}"
                        class="block w-full mb-3 border-0 py-0 pr-5 pl-3 text-gray-900 ring-1 ring-inset ring-gray-300 text-uppercase focus:ring-1 focus:ring-red-600 sm:text-sm sm:leading-6"
                    >
                        @foreach($this->getGlobalFilterOptions($filter) as $name => $id)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                @endforeach
            </div>
        @endif
        @foreach($columns as $c)
            @if($c->isSearchable())
                <div style="width: 300px">
                    <input
                        wire:model.live="search"
                        type="search"
                        name="search"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Search {{ implode(', ', $this->getSearchableColumnNames()) }}"
                    />
                </div>
                @break
            @endif
        @endforeach
        <table class="min-w-full mb-5  divide-y divide-gray-300 border-b border-gray-300">
            <x-dataTable::table.heading :columns="$columns"/>

            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($data as $d)
                <x-dataTable::table.row :columns="$columns" :data="$d"/>
            @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
</div>

