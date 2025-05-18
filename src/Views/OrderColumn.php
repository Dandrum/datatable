<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

class OrderColumn extends Column
{
    // Type of Column
    protected ?string $type = 'order';

    public static function make(string $title, ?string $field = null): OrderColumn
    {
        return new static($title, $field);
    }
}
