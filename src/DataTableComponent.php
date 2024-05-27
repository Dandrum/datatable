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

    private function getData(): Collection|\Illuminate\Pagination\LengthAwarePaginator
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
            [$tableName, $subFieldName] = explode('.', $field);

            $model = $data[Str::singular($tableName)] ?? $data[$tableName];
            if ($model instanceof Model) {
                if ($data[$subFieldName] instanceof \UnitEnum) {
                    return $data[$subFieldName]->name ?? '';
                }

                return $model[$subFieldName] ?? '';
            }
            if ($model instanceof Collection) {
                $collectionValues = [];
                foreach ($model as $entry) {
                    $collectionValues[] = $entry[$subFieldName] ?? '';
                }

                return $collectionValues;
            }
        }
        if ($data[$field] instanceof \UnitEnum) {
            return $data[$field]->name ?? '';
        }

        return $data[$field] ?? '';
    }
}
