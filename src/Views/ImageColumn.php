<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

use Dandrum\Datatable\Errors\NotPossibleException;

class ImageColumn extends Column
{
    // Type of Column
    protected ?string $type = 'image';

    private string $width = 'auto';

    private string $height = 'auto';

    private string $fit = 'contain';

    public function width(int $width): self
    {
        $this->width = $width.'px';

        return $this;
    }

    public function height(int $height): self
    {
        $this->height = $height.'px';

        return $this;
    }

    public function fit(string $value): self
    {
        $this->fit = $value;

        return $this;
    }

    public function getWidth(): string
    {
        return $this->width;
    }

    public function getHeight(): string
    {
        return $this->height;
    }

    public function getFit(): string
    {
        return $this->fit;
    }

    public function searchable(): self
    {
        throw new NotPossibleException('Cannot search image column');
    }

    public function sortable(): self
    {
        throw new NotPossibleException('Cannot sort image column');
    }
}
