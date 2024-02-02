<?php

namespace App\Exports;

use App\Models\CapexReport;
use Maatwebsite\Excel\Concerns\FromCollection;

class CapexExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CapexReport::all();
    }
}
