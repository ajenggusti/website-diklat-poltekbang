<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Sheets\AllDataSheet;
use App\Exports\Sheets\PendaftaranSheet;
use App\Exports\Sheets\DiklatSheet;

class PembayaranExport implements WithMultipleSheets
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function sheets(): array
    {
        return [
            'All Data' => new AllDataSheet($this->startDate, $this->endDate),
            'Pendaftaran' => new PendaftaranSheet($this->startDate, $this->endDate),
            'Diklat' => new DiklatSheet($this->startDate, $this->endDate),
        ];
    }
}
