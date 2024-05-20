@props(['columns', 'data'])

<tr>
    @foreach($columns as $column)
        @if(!$column->isHidden())
            <td class="whitespace-nowrap px-2 py-2 text-left text-sm text-gray-500"
                wire:key="item-{{$data->id}}">
                @switch($column->getType())
                    @case('order')
                        <x-dataTable::column-types.sortable :column="$column" :data="$data"/>
                        @break
                    @case('date')
                        <x-dataTable::column-types.date :column="$column"
                                                        :value="$this->getFieldData($column->getField(), $data)"/>
                        @break
                    @case('boolean')
                        <x-dataTable::column-types.boolean :status="$this->getFieldData($column->getField(), $data)"/>
                        @break
                    @case('image')
                        <x-dataTable::column-types.image :column="$column"
                                                         :value="$this->getFieldData($column->getField(), $data)"/>
                        @break
                    @case('actions')
                        <x-dataTable::column-types.actions :column="$column"
                                                           :value="$this->getFieldData($column->getField(), $data)"/>
                        @break
                    @default
                        <x-dataTable::column-types.default :column="$column"
                                                           :value="$this->getFieldData($column->getField(), $data)"/>
                @endswitch
            </td>
        @endif
    @endforeach
</tr>
