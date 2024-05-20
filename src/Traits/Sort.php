<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Sort
{
    public $defaultOrder = ['id' => 'asc'];

    public $sort = [];

    public function changeSort(string $field): void
    {
        if (isset($this->sort[$field])) {
            if ($this->sort[$field] === 'desc') {
                unset($this->sort[$field]);
            } else {
                $this->sort[$field] = 'desc';
            }
        } else {
            $this->sort[$field] = 'asc';
        }
    }

    private function sort(Builder $query): Builder
    {
        if (count($this->sort) > 0) {
            foreach ($this->sort as $field => $direction) {
                $query = $query->orderBy($field, $direction);
            }
        } else {
            if (str_contains(key($this->defaultOrder), '.')) {
                [$orderTable, $orderField] = explode('.', key($this->defaultOrder));

                $sortField = $orderTable . '.' . $orderField;
            } else {
                $baseTableName = app($this->model)->getTable();

                $sortField = $baseTableName . '.' . key($this->defaultOrder);
            }
            $query = $query->orderBy(
                $sortField,
                $this->defaultOrder[key($this->defaultOrder)]
            );
        }

        return $query;
    }
}
