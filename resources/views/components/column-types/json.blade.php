<ul class="my-2">
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
</ul>
