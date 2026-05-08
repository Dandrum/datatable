<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;

trait Filter
{
    private array $filterOptions = [];

    public array $activeFilter = [];

    public $preFilter = [];

    public array $filterOptionsBy = [];

    public array $filterNullable = [];

    public function updatingActiveFilter(): void
    {
        $this->resetPage();
    }

    /**
     * Tries to resolve the Eloquent model instance for a given table name
     * by inspecting the root model's relations.
     */
    private function resolveModelForTable(string $table): ?Model
    {
        $rootModel = app($this->model);
        foreach (get_class_methods($rootModel) as $method) {
            try {
                $result = $rootModel->$method();
                if ($result instanceof Relation) {
                    $related = $result->getRelated();
                    if ($related->getTable() === $table) {
                        return $related;
                    }
                }
            } catch (\Throwable) {
            }
        }
        return null;
    }

    /**
     * Checks if the given field is a translatable (JSON) field.
     * Resolves the correct model when a table name is provided.
     */
    private function isTranslatableField(string $fieldName, ?string $table = null): bool
    {
        $rootModel = app($this->model);

        if ($table && $table !== $rootModel->getTable()) {
            $model = $this->resolveModelForTable($table) ?? $rootModel;
        } else {
            $model = $rootModel;
        }

        if (property_exists($model, 'translatable') && is_array($model->translatable)) {
            return in_array($fieldName, $model->translatable, true);
        }
        return false;
    }

    /**
     * Returns the current app locale for JSON operators.
     */
    private function filterLocale(): string
    {
        return app()->getLocale();
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

                $table = mb_strtolower($filterTable);
                $isTranslatable = $this->isTranslatableField($fieldName, $table);

                if ($isTranslatable) {
                    $locale = $this->filterLocale();
                    $query = DB::table($table)
                        ->selectRaw("DISTINCT ({$table}.{$fieldName}->>'$locale') AS {$fieldName}");
                    $orderByRaw = "({$table}.{$fieldName}->>'$locale') ASC";
                } else {
                    $query = DB::table($table)
                        ->selectRaw("DISTINCT CAST({$table}.{$fieldName} AS TEXT) AS {$fieldName}");
                    $orderByRaw = "CAST({$table}.{$fieldName} AS TEXT) ASC";
                }

                if (count($this->filterOptionsBy) > 0 && count($this->activeFilter) > 0) {
                    $mainTable = app($this->model)->getTable();

                    // If the filter options table differs from the main table,
                    // join back via $this->joins so filterOptionsBy columns are resolvable.
                    if ($table !== $mainTable) {
                        foreach ($this->joins as $join) {
                            [$joinTable, $joinFirst, $joinSecond] = $join;
                            if (mb_strtolower($joinTable) === $table) {
                                // ordered_products.order_id = orders.id  →  join orders
                                $query->join($mainTable, $joinSecond, '=', $joinFirst);
                                break;
                            }
                            if (mb_strtolower($joinTable) === $mainTable) {
                                // orders.user_id = users.id  →  join main via inverse
                                $query->join($mainTable, $joinFirst, '=', $joinSecond);
                                break;
                            }
                        }
                    }

                    foreach ($this->filterOptionsBy as $fob) {
                        // Qualify with main table to avoid ambiguous column errors
                        $qualified = str_contains($fob, '.') ? $fob : "{$mainTable}.{$fob}";
                        $query->where($qualified, '=', $this->activeFilter[$fob] ?? null);
                    }
                }

                $this->filterOptions[$column->getField()] = $query
                    ->orderByRaw($orderByRaw)
                    ->get()
                    ->pluck($fieldName)
                    ->filter()
                    ->values()
                    ->toArray();
            }
        }
    }

    private function filter($query)
    {
        if (count($this->preFilter)) {
            foreach ($this->preFilter as $filter) {
                $field = $filter['field'];
                $operator = $filter['operator'] ?? '=';
                $value = $filter['value'];

                $query->where($field, $operator, $value);
            }
        }

        foreach ($this->activeFilter as $field => $value) {
            if (is_array($value)) {
                $field .= '.' . key($value);
                $value = $value[key($value)];
            } else {
                $field = app($this->model)->getTable() . '.' . $field;
            }

            if ($value !== '-1') {
                if ($value === '') {
                    $value = null;
                }

                $parts = explode('.', $field);
                $fieldName = end($parts);
                $tableName = count($parts) >= 2 ? $parts[count($parts) - 2] : null;

                if ($this->isTranslatableField($fieldName, $tableName) && $value !== null) {
                    $locale = $this->filterLocale();
                    $query = $query->whereRaw("({$field}->>'$locale') = ?", [$value]);
                } else {
                    $query = $query->where(mb_strtolower($field), $value);
                }

                if (in_array($fieldName, $this->filterNullable, true)) {
                    $query = $query->orWhereNull($field);
                }
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
