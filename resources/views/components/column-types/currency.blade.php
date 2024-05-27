@php($fmt = numfmt_create(Config::get('app.locale'), NumberFormatter::CURRENCY))
{!! $fmt->formatCurrency($this->getFieldData($column->getField(), $data), 'EUR') !!}
