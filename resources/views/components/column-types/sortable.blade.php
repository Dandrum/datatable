<div class="flex gap-1">
    <div wire:click="sortDown({{$row->id}})" class="cursor-pointer">
        <i class="fa-solid fa-arrow-down"></i>
    </div>
    <div>
        {{$value}}
    </div>
    <div wire:click="sortUp({{$row->id}})" class="cursor-pointer">
        <i class="fa-solid fa-arrow-up"></i>
    </div>
</div>
