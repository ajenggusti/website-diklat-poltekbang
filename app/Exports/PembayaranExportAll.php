<?php

namespace App\Exports;

use App\Exports\SheetsAllPembayaran\AllDataSheet;
use App\Exports\SheetsAllPembayaran\PendaftaranSheet;
use App\Exports\SheetsAllPembayaran\DiklatSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PembayaranExportAll implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new AllDataSheet(),
            new PendaftaranSheet(),
            new DiklatSheet(),
        ];
    }
}
