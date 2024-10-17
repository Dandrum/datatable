<ul class="my-2">
    @if($this->getFieldData($column->getField(), $data) && $this->getFieldData($column->getField(), $data) !== '')
        @foreach($this->getFieldData($column->getField(), $data) as $key => $entry)
            @if(is_array($entry))
                <li class="mb-2">
                    @foreach($entry as $eKey => $eValue)
                        {{ $eKey }}: {{ $eValue }} |
                    @endforeach
                </li>
                <hr/>
            @else
                <li class="mb-1">{{ $key }}: {{ $entry }}</li>
            @endif
        @endforeach
    @endif
</ul>
