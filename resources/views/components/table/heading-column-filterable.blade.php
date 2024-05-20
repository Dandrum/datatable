@props(['column'])

<div class="flex flex-auto cursor-pointer items-center group">
    <select
        name="{{$column->getField()}}__filter"
        wire:model.live="activeFilter.{{ $column->getField() }}"
        class="block w-full border-0 py-0 pr-5 pl-3 text-gray-900 ring-1 ring-inset ring-gray-300 text-uppercase focus:ring-1 focus:ring-red-600 sm:text-sm sm:leading-6"
    >
        <option value="-1">{{ $column->getTitle() }}</option>
        @foreach($this->getFilterOptions($column->getField()) as $option)
            <option value="{{ $option }}">{!! ($option && $option !== '') ? ucfirst($option) : 'NULL' !!}</option>
        @endforeach
    </select>
</div>
