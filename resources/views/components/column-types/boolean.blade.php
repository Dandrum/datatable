@props(['status'])

@if($status)
    <i class="fa-solid fa-circle-check text-green-600"></i>
@else
    <i class="fa-solid fa-circle-xmark text-red-600"></i>
@endif
