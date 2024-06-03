@if($this->getFieldData($column->getField(), $data))
    <span
        class="bg-green-100 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{$this->getFieldData($column->getField(), $data)}}</span>
@else
    <span
        class="bg-green-100 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{__('Guest')}}</span>
@endif
