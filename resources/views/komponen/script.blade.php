<script>
    function previewImage() {
        const preview = document.querySelector('.img-preview');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }

    $(document).ready(function(){
        $('#tgl_awal, #tgl_akhir').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
            autoclose: true,
        });
    });

    $(document).ready(function() {
        $('#harga').on('input', function() {
            var value = $(this).val();
            if (value !== '') {
                // Menghapus semua karakter selain angka
                var cleanValue = value.replace(/[^\d]/g, '');
                // Konversi nilai ke format Rupiah
                var rupiah = formatRupiah(cleanValue);
                // Tampilkan nilai dalam input
                $(this).val(rupiah);
            }
        });
    });
        
    // Fungsi untuk mengonversi nilai ke format Rupiah
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        var hasil = ribuan.join('.').split('').reverse().join('');
        return 'Rp ' + hasil;
    }

    
    
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/super-build/ckeditor.js"></script>