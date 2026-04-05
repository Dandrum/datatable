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
        $storagePath = $column->getBaseUrl() !== '' ? $column->getBaseUrl() . $value : $value;
        if ($storagePath && Storage::exists($storagePath)) {
            $mimeType    = Storage::mimeType($storagePath) ?: 'image/jpeg';
            $fileContent = Storage::get($storagePath);
            if ($fileContent) {
                $img = 'data:' . $mimeType . ';base64,' . base64_encode($fileContent);
            }
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

