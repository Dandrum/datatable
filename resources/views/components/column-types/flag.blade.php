@if($this->getFieldData($column->getField(), $data))
    <img src="{{ asset('/img/flags/' . strtolower($this->getFieldData($column->getField(), $data)) . '.png') }}"
         alt="FLAG"/>
@else
    -
@endif
