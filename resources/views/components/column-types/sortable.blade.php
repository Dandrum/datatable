@props(['column', 'data'])

<div class="flex gap-1">
    <button wire:click="orderDown({{$data->id}})" class="cursor-pointer">
        <i class="fa-solid fa-arrow-down"></i>
    </button>
    <div>
        {{$this->getFieldData($column->getField(), $data)}}
    </div>
    <button wire:click="orderUp({{$data->id}})" class="cursor-pointer">
        <i class="fa-solid fa-arrow-up"></i>
    </button>
</div>
