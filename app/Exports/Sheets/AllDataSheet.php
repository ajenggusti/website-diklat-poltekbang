<?php

namespace App\Exports\Sheets;

use Carbon\Carbon;
use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AllDataSheet implements FromQuery, WithMapping, WithHeadings, WithStyles, WithEvents
{
    protected $startDate;
    protected $endDate;
    protected $totalHargaSum = 0;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function query()
    {
        return Pembayaran::query()
            ->where('status', 'Lunas')
            ->whereBetween('updated_at', [$this->startDate, $this->endDate]);
    }

    public function map($pembayaran): array
    {
        $this->totalHargaSum += $pembayaran->total_harga;

        return [
            $pembayaran->order_id,
            $pembayaran->pendaftaran->user->name,
            $pembayaran->jenis_pembayaran,
            $pembayaran->metode_pembayaran,
            $pembayaran->total_harga,
            $pembayaran->status,
            Carbon::parse($pembayaran->updated_at)->format('d-m-Y | H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'Order_id',
            'Nama Lengkap',
            'Jenis Pembayaran',
            'Metode Pembayaran',
            'Total harga',
            'Status',
            'Waktu',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $rowCount = $sheet->getHighestRow();
                $totalRow = $rowCount + 1;

                $sheet->setCellValue('A' . $totalRow, 'Total');
                $sheet->setCellValue('E' . $totalRow, $this->totalHargaSum);

                // Bold the total row
                $sheet->getStyle('A' . $totalRow . ':G' . $totalRow)->getFont()->setBold(true);
            },
        ];
    }
}