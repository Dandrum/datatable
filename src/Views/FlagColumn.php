<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

class FlagColumn extends Column
{
    // Type of Column
    protected ?string $type = 'flag';

    public static function make(string $title, ?string $field = null): FlagColumn
    {
        return new static($title, $field);
    }
}
