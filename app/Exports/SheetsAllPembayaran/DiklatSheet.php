<?php

namespace App\Exports\SheetsAllPembayaran;

use Carbon\Carbon;
use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DiklatSheet implements FromQuery, WithMapping, WithHeadings, WithStyles, WithEvents
{
    protected $totalHargaSum = 0;

    public function query()
    {
        return Pembayaran::query()->where('status', 'Lunas')->where('jenis_pembayaran', 'diklat');
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
            1 => ['font' => ['bold' => true]], // Make the heading row bold
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
