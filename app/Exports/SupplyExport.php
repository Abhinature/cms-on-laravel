<?php

namespace App\Exports;

use App\Models\SupplyReport;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupplyExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SupplyReport::all();
    }
}
