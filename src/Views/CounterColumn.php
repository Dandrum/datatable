<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

use Dandrum\Datatable\Errors\NotPossibleException;

class CounterColumn extends Column
{
    // Type of Column
    protected ?string $type = 'counter';

    public static function make(string $title, ?string $field = null): CounterColumn
    {
        return new static($title, $field);
    }
    public function searchable(): self
    {
        throw new NotPossibleException('Cannot search column');
    }

    public function filterable(): self
    {
        throw new NotPossibleException('Cannot filter column');
    }
}
