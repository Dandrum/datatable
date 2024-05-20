<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Joins
{
    private function joinTables(Builder $query): Builder
    {
        foreach ($this->joins as $join) {
            $query = $query->leftJoin(
                $join[0],
                $join[1],
                '=',
                $join[2]
            );
        }

        return $query;
    }
}
