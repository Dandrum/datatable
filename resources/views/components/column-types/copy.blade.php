@if($this->getFieldData($column->getField(), $data))
    <input
        class="px-3 py-2 block w-full rounded-md border-gray-300 read-only:text-neutral-600 read-only:bg-neutral-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        readonly value="{{ $this->getFieldData($column->getField(), $data) }}"/>
@endif
