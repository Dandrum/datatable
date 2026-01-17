@if($this->getFieldData($column->getField(), $data))
    @foreach($this->getFieldData($column->getField(), $data) as $role)
        <span
            class="bg-green-600 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
            {{$role}}
        </span>
    @endforeach
@else
    <span
        class="bg-green-600 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
        {{__('Guest')}}
    </span>
@endif
