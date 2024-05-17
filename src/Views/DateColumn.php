<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

use Dandrum\Datatable\Errors\NotPossibleException;

class DateColumn extends Column
{
    // Type of Column
    protected ?string $type = 'date';

    private string $format = 'Y-m-d';

    public function outputFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function searchable(): self
    {
        throw new NotPossibleException('Cannot search date column');
    }
}
