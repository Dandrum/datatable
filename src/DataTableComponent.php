<?php

declare(strict_types=1);

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

    private function getData(): Collection
    {
        $query = $this->sort(app($this->model));
        $query = $this->search($query);

        return $query->get();
    }

    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('dataTable::datatable', [
            'columns' => $this->columns(),
            'data' => $this->getData(),
        ]);
    }
}
