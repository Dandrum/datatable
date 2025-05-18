<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

class RoleColumn extends Column
{
    // Type of Column
    protected ?string $type = 'role';

    public static function make(string $title, ?string $field = null): RoleColumn
    {
        return new static($title, $field);
    }
}
