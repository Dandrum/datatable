<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Views;

use Illuminate\Support\Str;

class Column
{
    // What displays in the columns header
    protected string $title;

    // Act as a unique identifier for the column
    protected string $hash;

    // The underlying columns name: i.e. name
    protected ?string $field = null;

    // Type of Column
    protected ?string $type = 'text';

    // Is Column Hidden
    private bool $hidden = false;

    // Is column searchable
    private bool $searchable = false;

    // Is column sortable
    private bool $sortable = false;

    // Is column filterable
    private bool $filterable = false;

    // Field is function
    private bool $fieldIsFunction = false;

    public function __construct(string $title, ?string $field)
    {
        $this->title = trim($title);

        if ($field) {
            $this->field = $field;
        } else {
            $this->field = Str::snake($title);
            $this->hash = md5($this->field);
        }
    }

    public static function make(string $title, ?string $field = null): Column
    {
        return new static($title, $field);
    }

    public function hidden(): self
    {
        $this->hidden = true;

        return $this;
    }

    public function searchable(): self
    {
        $this->searchable = true;

        return $this;
    }

    public function sortable(): self
    {
        $this->sortable = true;

        return $this;
    }

    public function filterable(): self
    {
        $this->filterable = true;

        return $this;
    }

    public function fieldIsFunction(): self
    {
        $this->fieldIsFunction = true;

        return $this;
    }

    // GETTER
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getField(): ?string
    {
        return $this->field;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    public function isSortable(): bool
    {
        return $this->sortable;
    }

    public function isFilterable(): bool
    {
        return $this->filterable;
    }

    public function isFunction(): bool
    {
        return $this->fieldIsFunction;
    }
}
