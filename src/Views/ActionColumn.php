<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

use Dandrum\Datatable\Errors\NotPossibleException;

class ActionColumn extends Column
{
    protected ?string $type = 'actions';

    private ?string $viewRoute;

    private ?string $viewPermission;

    private ?string $editRoute;

    private ?string $editPermission;

    private ?string $deleteRoute;

    private ?string $deletePermission;

    public static function make(string $title, ?string $field = null): ActionColumn
    {
        return new static($title, $field);
    }

    public function viewRoute(string $route, ?string $permission): self
    {
        $this->viewRoute = $route;
        $this->viewPermission = $permission;

        return $this;
    }

    public function editRoute(string $route, ?string $permission): self
    {
        $this->editRoute = $route;
        $this->editPermission = $permission;

        return $this;
    }

    public function deleteRoute(string $route, ?string $permission): self
    {
        $this->deleteRoute = $route;
        $this->deletePermission = $permission;

        return $this;
    }

    public function getViewRoute(): ?string
    {
        return $this->viewRoute ?? null;
    }

    public function getViewPermission(): ?string
    {
        return $this->viewPermission ?? null;
    }

    public function getEditRoute(): ?string
    {
        return $this->editRoute ?? null;
    }

    public function getEditPermission(): ?string
    {
        return $this->editPermission ?? null;
    }

    public function getDeleteRoute(): ?string
    {
        return $this->deleteRoute ?? null;
    }

    public function getDeletePermission(): ?string
    {
        return $this->deletePermission ?? null;
    }

    public function searchable(): self
    {
        throw new NotPossibleException('Cannot search date column');
    }
}
