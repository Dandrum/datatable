@props(['columns'])

<thead>
<tr>
    @foreach($columns as $column)
        @if(!$column->isHidden())
            <x-dataTable::table.heading-column :column="$column"/>
        @endif
    @endforeach
</tr>
</thead>
