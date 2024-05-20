<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Traits;

trait ReOrder
{
    public function orderUp(int $id)
    {
        $entry = $this->model::find($id);
        $entry->moveOrderUp();
    }

    public function orderDown(int $id)
    {
        $entry = $this->model::find($id);
        $entry->moveOrderDown();
    }

    public function orderFirst(int $id)
    {
        $entry = $this->model::find($id);
        $entry->moveToStart();
    }

    public function OrderLast(int $id)
    {
        $entry = $this->model::find($id);
        $entry->moveToEnd();
    }
}
