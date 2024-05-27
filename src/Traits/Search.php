<?php

declare(strict_types=1);

namespace Dandrum\Datatable\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Url;

trait Search
{
    #[Url]
    public ?string $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function highlight($text): string
    {
        // Erzeugen Sie das hervorgehobene Wort mit HTML-Tag
        $highlighted = '<span style="color: red;font-weight: bold">' . $this->search . '</span>';

        // Ersetzen Sie das Wort im Text durch das hervorgehobene Wort (unabhängig von Groß- und Kleinschreibung)
        return str_ireplace($this->search, $highlighted, $text);
    }

    public function getSearchableColumnNames(): array
    {
        $searchableColumns = [];
        foreach ($this->columns() as $c) {
            if ($c->isSearchable()) {
                $searchableColumns[] = $c->getTitle();
            }
        }

        return $searchableColumns;
    }

    private function search(Builder|Model $query): Builder
    {
        $searchFields = [];
        foreach ($this->columns() as $c) {
            if ($c->isSearchable()) {
                $searchFields[] = mb_strtolower($c->getField());
            }
        }

        // Searchable
        if (count($searchFields) > 0 && $this->search !== '') {
            $query = $query->whereAny($searchFields, 'LIKE', '%' . $this->search . '%');
        }

        return $query;
    }
}
