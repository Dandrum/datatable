<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait Filter
{
    private $filterOptions = [];

    public $activeFilter = [];

    public function updatingActiveFilter()
    {
        $this->resetPage();
    }

    private function generateFilterOptions(): void
    {
        $columns = $this->columns();

        foreach ($columns as $column) {
            if ($column->isFilterable()) {
                if (str_contains($column->getField(), '.')) {
                    [$filterTable, $fieldName] = explode('.', $column->getField());
                } else {
                    $filterTable = app($this->model)->getTable();
                    $fieldName = $column->getField();
                }
                $this->filterOptions[$column->getField()] = DB::table($filterTable)
                    ->select($filterTable . '.' . $fieldName)
                    ->distinct()
                    ->get()
                    ->pluck($fieldName)
                    ->toArray();
            }
        }
    }

    private function filter(Builder $query): Builder
    {
        foreach ($this->activeFilter as $field => $value) {
            if (is_array($value)) {
                $field = $field . '.' . key($value);
                $value = $value[key($value)];
            } else {
                $field = app($this->model)->getTable() . '.' . $field;
            }
            if (!($value === '-1')) {
                if ($value === '') {
                    $value = null;
                }
                $query = $query->where($field, $value);
            }
        }
        return $query;
    }

    public function getFilterOptions(string $field): array
    {
        if (isset($this->filterOptions[$field])) {
            return $this->filterOptions[$field];
        }

        throw new \Exception("Filter option '$field' not found");
    }
}
