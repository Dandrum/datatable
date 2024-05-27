<ul class="my-2">
    @foreach($this->getFieldData($column->getField(), $data) as $key => $entry)
        <li class="mb-1">{{ $key }}: {{ $entry }}</li>
    @endforeach
</ul>
