@php use Illuminate\Support\Facades\Storage; @endphp
@props(['value', 'column'])

@php
    $img = '';

    if($column->getUseValueDirect()){
        if($column->getBaseUrl() !== ''){
            $img = $column->getBaseUrl() . $value;
        }else{
            $img = $value;
        }
    }else{
        if($column->getBaseUrl() !== ''){
           $img = 'data:' . Storage::mimeType($column->getBaseUrl() . $value) . ';base64,' . base64_encode(Storage::get($column->getBaseUrl() . $value));
        }else{
           $img = 'data:' . Storage::mimeType($value) . ';base64,' . base64_encode(Storage::get($value));
        }
    }
@endphp
<div>
    <img
        src="{{ $img }}"
        alt="{{ $column->getTitle() }}"
        style="max-width: 30px;max-height: 30px"
    />
</div>

