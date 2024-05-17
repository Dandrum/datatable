<div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    @dump($columns)
    @dump($data)
    @dump($search)
    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        @foreach($columns as $c)
            @if($c->isSearchable())
                <div style="width: 300px">
                    <input
                        wire:model="search"
                        type="search"
                        name="search"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                        placeholder="Search"
                    >
                </div>
                @break
            @endif
        @endforeach
        <table class="min-w-full divide-y divide-gray-300">
            <x-dataTable::table.heading :columns="$columns"/>

            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($data as $d)
                <x-dataTable::table.row :columns="$columns" :data="$d"/>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

