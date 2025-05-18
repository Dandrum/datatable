<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

use Dandrum\Datatable\Errors\NotPossibleException;

class CustomValueColumn extends Column
{
    // Type of Column
    protected ?string $type = 'customValue';
    public $customValue = '';

    public static function make(string $title, ?string $field = null): CustomValueColumn
    {
        return new static($title, $field);
    }

    public function setCustomValue($value): self
    {
        $this->customValue = $value;

        return $this;
    }

    public function getCustomValue()
    {
        return $this->customValue;
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
