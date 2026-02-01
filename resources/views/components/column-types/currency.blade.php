@php($fmt = numfmt_create(Config::get('app.locale'), NumberFormatter::CURRENCY))
{!! $fmt->formatCurrency((float) $this->getFieldData($column->getField(), $data), 'EUR') !!}
