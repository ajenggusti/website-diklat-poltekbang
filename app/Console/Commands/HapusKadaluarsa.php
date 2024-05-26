<?php
namespace App\Console\Commands;

use App\Models\Pembayaran;
use Illuminate\Console\Command;
use Carbon\Carbon;

class HapusKadaluarsa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hapus-kadaluarsa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menghapus data pembayaran yang kadaluarsa lebih dari satu hari';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->hapusKadaluarsa();
    }

    /**
     * Menghapus data pembayaran yang kadaluarsa lebih dari satu hari.
     */
    protected function hapusKadaluarsa()
    {
        $data = Pembayaran::where('status', 'kadaluarsa')
                          ->where('updated_at', '<=', Carbon::now())
                          ->get();
        
        // Menghapus data yang sesuai
        $jumlahDihapus = 0;
        foreach ($data as $pembayaran) {
            $pembayaran->delete();
            $jumlahDihapus++;
        }

        // Menampilkan jumlah data yang dihapus
        $this->info('Jumlah data yang dihapus: ' . $jumlahDihapus);
        // $this->info($tanggal_kadaluarsa);
        // $this->info($data);
    }
}
