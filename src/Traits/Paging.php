<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Traits;

use Livewire\WithPagination;

trait Paging
{
    use WithPagination;

    public $disablePagination = false;

    public $pageSize = 20;
}
