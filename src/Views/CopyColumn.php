<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

class CopyColumn extends Column
{
    // Type of Column
    protected ?string $type = 'copy';

    public static function make(string $title, ?string $field = null): CopyColumn
    {
        return new static($title, $field);
    }
}
