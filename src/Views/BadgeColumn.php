<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

use Dandrum\Datatable\Errors\NotPossibleException;

class BadgeColumn extends Column
{
    // Type of Column
    protected ?string $type = 'badge';

    private array $colors = [];

    public function searchable(): self
    {
        throw new NotPossibleException('Cannot search date column');
    }

    public function colors(array $colors): self
    {
        $this->colors = $colors;
        return $this;
    }

    public function getColor(string $value): string
    {
        return $this->colors[mb_strtolower($value)] ?? 'slate';
    }
}
