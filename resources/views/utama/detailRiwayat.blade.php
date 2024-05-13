
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    {{-- <link rel="stylesheet" href="/css/style.css"> --}}
    <style>
        .container {
            display:inline;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .invoice-content {
            color: #086cb9;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        
        .invoice-details p {
            margin: 5px 0;
        }
        
        .buttons {
            text-align: right;
            margin-top: 20px;
        }
        
        .btn {
            display: inline-block;
            padding: 8px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        
        .btn-primary {
            background-color: #007bff;
        }
        
        .btn-warning {
            background-color: #ffc107;
        }
    </style>
    
</head>
<body>
    <div class="container">
        <div class="invoice-content">
            <h1>INVOICE (belum ditambahkan fitur cetak)</h1>
            <div class="invoice-details">
                <p><strong>Nama Diklat:</strong> {{ $data->diklat->nama_diklat }}</p>
                <p><strong>Nama Lengkap:</strong> {{ $data->nama_lengkap }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d-m-Y') }}</p>
                <p><strong>Alamat:</strong> {{ $data->alamat }}</p>
                <p><strong>Email:</strong> {{ $data->email }}</p>
                <p><strong>No HP:</strong> {{ $data->no_hp }}</p>
                <p><strong>Pendidikan Terakhir:</strong> {{ $data->pendidikan_terakhir }}</p>
                <p><strong>Waktu Pendaftaran:</strong> {{ \Carbon\Carbon::parse($data->waktu_pendaftaran)->format('H:i:s | d-m-Y') }}</p>
                <p><strong>Status Pembayaran Pendaftaran:</strong> {{ $data->status_pembayaran_daftar }}</p>
                <p><strong>Harga Diklat:</strong> Rp. {{ number_format($data->diklat->harga, 0, ',', '.') }}</p>
                @if($data->promo)
                    <p><strong>Diskon:</strong> - Rp. {{ number_format($data->promo->potongan, 0, ',', '.') }}</p>
                @else
                    <p><strong>Diskon:</strong> - Rp. 0</p> 
                @endif
                <p><strong>Total Biaya:</strong> Rp. {{ number_format($data->harga_diklat, 0, ',', '.') }}</p>
                <p><strong>Status Pembayaran Biaya Diklat:</strong> {{ $data->status_pembayaran_diklat }}</p>
                <p><strong>Join Grup WhatsApp:</strong> <a href="{{ $data->diklat->whatsapp }}">Klik untuk bergabung!</a></p>
                @if ($data->s_doc)
                    <p><strong>Sertifikat:</strong> <a href="{{ asset('storage/' . $data->s_doc) }}">Klik untuk melihat sertifikat!</a></p>
                @elseif($data->s_gambar)
                    <p><strong>Sertifikat:</strong> <img src="{{ asset('storage/' . $data->s_gambar) }}" alt="sertifikat"></p>
                @elseif($data->s_link)
                    <p><strong>Sertifikat:</strong> <a href="{{ $data->s_link }}">Klik untuk melihat sertifikat!</a></p>
                @endif
            </div>
        </div>
        <div class="buttons">
            <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
            <a href="/kelPendaftaran/{{ $data->id }}/edit" class="btn btn-warning">Edit</a>
        </div>
    </div>
</body>
</html>
