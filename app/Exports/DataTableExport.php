<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataTableExport implements FromCollection, WithHeadings
{
    protected $headings;

    protected $query;

    protected $columns;

    public function __construct(array $headings, Builder $query, array $columns)
    {
        $this->headings = $headings;
        $this->query = $query;
        $this->columns = $columns;
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function collection()
    {
        return $this->query->get($this->columns)->each(function (Model $item) {
            return $item->setAppends([]);
        });
    }
}
