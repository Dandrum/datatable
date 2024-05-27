<?php

namespace Dandrum\Datatable\Interfaces;

interface GlobalFilterInterface
{
    public function getGlobalFilterOptions($name): array;
}
