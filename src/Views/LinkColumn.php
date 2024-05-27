<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

class LinkColumn extends Column
{
    // Type of Column
    protected ?string $type = 'link';

    private string $target = '_blank';

    private array $route = ['route' => null, 'id' => null];

    public function link(array $href, string $target = '_blank'): self
    {
        $this->route = $href;
        $this->target = $target;

        return $this;
    }

    public function getRoute(): array
    {
        return $this->route;
    }

    public function getTarget(): string
    {
        return $this->target;
    }
}
