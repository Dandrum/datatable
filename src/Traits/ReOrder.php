<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Traits;

trait ReOrder
{
    public function sortUp(int $id)
    {
        $entry = $this->model::find($id);
        $entry->moveOrderUp();
    }

    public function sortDown(int $id)
    {
        $entry = $this->model::find($id);
        $entry->moveOrderDown();
    }

    public function sortFirst(int $id)
    {
        $entry = $this->model::find($id);
        $entry->moveToStart();
    }

    public function sortLast(int $id)
    {
        $entry = $this->model::find($id);
        $entry->moveToEnd();
    }
}
