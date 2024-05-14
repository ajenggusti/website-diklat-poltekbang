<?php

namespace App\Exports;

use App\Models\Pembayaran;
use GuzzleHttp\Psr7\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PembayaranExport implements FromQuery,WithMapping, WithHeadings
{
    use Exportable;

    protected $startDate;
    protected $endDate;

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
        // This example will return 3 rows.
        // First row will have 2 column, the next 2 will have 1 column
        return [
            [
                $pembayaran->order_id,
                $pembayaran->pendaftaran->nama_lengkap,
                $pembayaran->jenis_pembayaran,
                $pembayaran->metode_pembayaran,
                $pembayaran->total_harga,
                $pembayaran->status,
                $pembayaran->updated_at,
            ]
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
            'status',
            'Wakyu',
        ];
    }
}