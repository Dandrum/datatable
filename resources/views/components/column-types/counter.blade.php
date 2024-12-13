@props(['column', 'data'])

@dump($column->getField())
@dump($data)
@dump($data[$column->getField()])

