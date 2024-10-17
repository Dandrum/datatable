<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait Filter
{
    private array $filterOptions = [];

    public array $activeFilter = [];

    public array $filterOptionsBy = [];

    public function updatingActiveFilter(): void
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

                $query = DB::table(mb_strtolower($filterTable))
                    ->select(mb_strtolower($filterTable) . '.' . $fieldName)
                    ->distinct();

                if (count($this->filterOptionsBy) > 0 && count($this->activeFilter) > 0) {
                    foreach ($this->filterOptionsBy as $fob) {
                        $query->where(mb_strtolower($fob), '=', $this->activeFilter[$fob]);
                    }
                }
                $this->filterOptions[$column->getField()] = $query
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
                $field .= '.' . key($value);
                $value = $value[key($value)];
            } else {
                $field = app($this->model)->getTable() . '.' . $field;
            }
            if (!($value === '-1')) {
                if ($value === '') {
                    $value = null;
                }
                $query = $query->where(mb_strtolower($field), $value);
            }
        }

        return $query;
    }

    public function getFilterOptions(string $field): array
    {
        if (isset($this->filterOptions[$field])) {
            return $this->filterOptions[$field];
        }
        return [];
    }
}
