<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Joins
{
    private function joinTables(Builder $query): Builder
    {
        $query->select(app($this->model)->getTable() . '.*');
        foreach ($this->joins as $join) {
            $query = $query->leftJoin(
                $join[0],
                $join[1],
                '=',
                $join[2]
            );
            if (count($join) > 3) {
                foreach ($join[3] as $field) {
                    $query->addSelect(mb_strtolower($field));
                }
            }
        }

        return $query;
    }
}
