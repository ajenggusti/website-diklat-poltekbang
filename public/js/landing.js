// Script Slideshow gambar
document.addEventListener("DOMContentLoaded", function() {
    let slideIndex = 0;
    showSlides(); // Panggil showSlides pertama kali saat dokumen dimuat

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        
        // Sembunyikan semua slide
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        
        // Hapus kelas active dari semua titik navigasi
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        
        // Geser ke slide berikutnya
        slideIndex++;
        
        // Jika sudah mencapai slide terakhir, kembali ke slide pertama
        if (slideIndex > slides.length) {slideIndex = 1}
        
        // Tampilkan slide yang sesuai dan tandai titik navigasi yang sesuai
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        
        // Panggil kembali fungsi showSlides setelah 2 detik
        setTimeout(showSlides, 2000);
    }
});











// Script Slideshow Testimoni
document.addEventListener("DOMContentLoaded", function() {
    var slideIndex = 1;
    SlideShows(slideIndex);

    function plusSlides(n) {
        SlideShows(slideIndex += n);
    }

    function currentSlide(n) {
        SlideShows(slideIndex = n);
    }

    function SlideShows(n) {
        var i;
        var slides = document.getElementsByClassName("card-slides");
        if (n > slides.length) {slideIndex = 1}    
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        slides[slideIndex-1].style.display = "block";  
    }

    // Tambahkan event listener untuk tombol "Sebelumnya" dan "Selanjutnya"
    var prevButton = document.querySelector(".sblm");
    var nextButton = document.querySelector(".ssdh");
    prevButton.addEventListener("click", function() {
        plusSlides(-1);
    });
    nextButton.addEventListener("click", function() {
        plusSlides(1);
    });
});