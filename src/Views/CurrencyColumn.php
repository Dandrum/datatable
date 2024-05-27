<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

use Dandrum\Datatable\Errors\NotPossibleException;

class CurrencyColumn extends Column
{
    // Type of Column
    protected ?string $type = 'currency';

    public function searchable(): self
    {
        throw new NotPossibleException('Cannot search date column');
    }
}
