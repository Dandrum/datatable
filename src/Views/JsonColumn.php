<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

use Dandrum\Datatable\Errors\NotPossibleException;
use PHPUnit\Util\Json;

class JsonColumn extends Column
{
    // Type of Column
    protected ?string $type = 'json';

    public static function make(string $title, ?string $field = null): JsonColumn
    {
        return new static($title, $field);
    }
    public function searchable(): self
    {
        throw new NotPossibleException('Cannot search date column');
    }
}
