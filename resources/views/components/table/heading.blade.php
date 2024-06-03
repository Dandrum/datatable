@props(['columns'])

<thead>
<tr>
    @foreach($columns as $column)
        @if(!$column->isHidden())
            <th scope="col"
                class="px-2 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                @if($column->isSortable())
                    <x-dataTable::table.heading-column-sortable :column="$column"/>
                    @continue
                @endif
                @if($column->isFilterable())
                    <x-dataTable::table.heading-column-filterable :column="$column"/>
                    @continue
                @endif
                <x-dataTable::table.heading-column :column="$column"/>
            </th>
        @endif
    @endforeach
</tr>
</thead>
