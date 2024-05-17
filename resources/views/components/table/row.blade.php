@props(['columns', 'data'])

<tr>
    @foreach($columns as $column)
        @if(!$column->isHidden())
            @switch($column->getType())
                @case('date')
                    <td class="whitespace-nowrap px-5 py-3 text-left text-sm text-gray-500">
                        <x-dataTable::column-types.date :column="$column" :value="$data[$column->getField()]"/>
                    </td>
                    @break
                @case('boolean')
                    <td class="whitespace-nowrap px-5 py-3 text-left text-sm text-gray-500">
                        <x-dataTable::column-types.boolean :status="$data[$column->getField()]"/>
                    </td>
                    @break
                @case('image')
                    <td class="whitespace-nowrap px-5 py-3 text-left text-sm text-gray-500">
                        <x-dataTable::column-types.image :column="$column" :value="$data[$column->getField()]"/>
                    </td>
                    @break
                @case('actions')
                    <td class="whitespace-nowrap px-5 py-3 text-left text-sm text-gray-500">
                        <x-dataTable::column-types.actions :column="$column" :value="$data[$column->getField()]"/>
                    </td>
                    @break
                @default
                    <td class="whitespace-nowrap px-5 py-3 text-left text-sm text-gray-500">
                        <x-dataTable::column-types.default :column="$column" :value="$data[$column->getField()]"/>
                    </td>
            @endswitch
        @endif
    @endforeach
</tr>
