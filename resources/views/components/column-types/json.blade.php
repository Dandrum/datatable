@if($value)
    @if(is_string($value))
        @php($value = json_decode($value, true, 512, JSON_THROW_ON_ERROR))
    @endif
    <ul>
        @foreach($value as $key=>$v)
            @if($date = strtotime($key))
                <li class="mb-2">{{ date('d-m-Y', strtotime($date)) }}: {{ $v }}</li>
            @elseif(is_array($v))
                <ul class="mb-2">
                    @foreach($v as $subKey => $sub)
                        <li>{{ $subKey }}: {{ $sub }}</li>
                    @endforeach
                </ul>
            @else
                <li class="mb-2">{{ $key }}: {{ $v }}</li>
            @endif
        @endforeach
    </ul>

@endif
