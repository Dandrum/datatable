<?php

namespace Dandrum\Datatable;

use Dandrum\Datatable\Traits\Search;
use Dandrum\Datatable\Traits\Sort;
use Illuminate\Support\Collection;
use Livewire\Component;

abstract class DataTableComponent extends Component
{
    use Search;
    use Sort;

    public $model = null;

    abstract public function columns(): array;

    public function getData(): Collection
    {
//        $searchFields = [];
//        foreach ($this->columns() as $c) {
//            if ($c->isSearchable()) {
//                $searchFields[] = $c->getField();
//            }
//        }

//        if (count($searchFields) > 0) {
//            return $this->model::whereAny($searchFields, 'LIKE', '%' . $this->search . '%')
//                ->get();
//        }
        return $this->model::get();
    }

    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('dataTable::datatable', [
            'columns' => $this->columns(),
            'data' => $this->getData(),
        ]);
    }
}
