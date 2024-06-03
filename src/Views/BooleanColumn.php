<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

use Dandrum\Datatable\Errors\NotPossibleException;

class BooleanColumn extends Column
{
    // Type of Column
    protected ?string $type = 'boolean';

    public function searchable(): self
    {
        throw new NotPossibleException('Cannot search boolean column');
    }
}
