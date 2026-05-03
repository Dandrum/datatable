<?php

declare(strict_types=1);

namespace Dandrum\Datatable;

use Dandrum\Datatable\Traits\Filter;
use Dandrum\Datatable\Traits\GlobalFilter;
use Dandrum\Datatable\Traits\Joins;
use Dandrum\Datatable\Traits\Paging;
use Dandrum\Datatable\Traits\ReOrder;
use Dandrum\Datatable\Traits\Search;
use Dandrum\Datatable\Traits\Sort;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;

abstract class DataTableComponent extends Component
{
    use Joins;
    use Paging;
    use Filter;
    use GlobalFilter;
    use Search;
    use Sort;
    use ReOrder;

    public $model = null;

    public $joins = [];

    abstract public function columns(): array;

    protected function queryString(): array
    {
        return [
            'search' => ['as' => 'search'],
            'sort' => ['as' => 'sort'],
            'activeFilter' => ['as' => 'filter'],
        ];
    }

    private function getData(): \Illuminate\Contracts\Pagination\LengthAwarePaginator | \Illuminate\Database\Eloquent\Collection
    {
        $query = app($this->model)::query();
        $query = $this->joinTables($query);
        $query = $this->sort($query);
        $query = $this->filter($query);
        $query = $this->search($query);

        if ($this->disablePagination) {
            return $query->get();
        }
        return $query->paginate($this->pageSize);
    }

    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $this->generateFilterOptions();
        return view('dataTable::datatable', [
            'columns' => $this->columns(),
            'data' => $this->getData(),
        ]);
    }

    public function getFieldData(string $field, $data)
    {
        if (str_contains($field, '.')) {
            $segments = explode('.', $field);
            return $this->resolveNestedField($segments, $data);
        }

        if ($data[$field] instanceof \UnitEnum) {
            return $data[$field]->name ?? '';
        }

        return $data[$field] ?? '';
    }

    private function resolveNestedField(array $segments, $data): mixed
    {
        $key = array_shift($segments);

        // Try singular and original key
        $value = null;
        if ($data instanceof Model || is_array($data) || $data instanceof \ArrayAccess) {
            $value = $data[Str::singular($key)] ?? $data[$key] ?? null;
        }

        if ($value === null) {
            return '';
        }

        // No more segments → return the value
        if (empty($segments)) {
            if ($value instanceof \UnitEnum) {
                return $value->name ?? '';
            }
            return $value ?? '';
        }

        // Recurse into a Collection: resolve for each entry and flatten one level
        if ($value instanceof Collection) {
            $results = [];
            foreach ($value as $entry) {
                $resolved = $this->resolveNestedField($segments, $entry);
                if (is_array($resolved)) {
                    array_push($results, ...$resolved);
                } else {
                    $results[] = $resolved;
                }
            }
            return $results;
        }

        // Recurse into a nested Model / array
        if ($value instanceof Model || is_array($value) || $value instanceof \ArrayAccess) {
            return $this->resolveNestedField($segments, $value);
        }

        return '';
    }
}
