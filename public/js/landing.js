// Script Slideshow gambar
document.addEventListener("DOMContentLoaded", function() {
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let slides = document.getElementsByClassName("mySlides");
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        slides[slideIndex - 1].style.display = "block";
        moveSlidesLeft();

        setTimeout(showSlides, 2000);
    }

    function moveSlidesLeft() {
        let slideshowContainer = document.querySelector('.slideshow-container');
        slideshowContainer.scrollLeft += slideshowContainer.offsetWidth;
    }
});




// Script Slideshow Testimoni
document.addEventListener("DOMContentLoaded", function() {
    let slideIndex = 0;

    function showSlides() {
        let slides = document.getElementsByClassName("card-slides");
        let dots = document.getElementsByClassName("dot");
        
        // Sembunyikan semua slide dan atur semua titik menjadi tidak aktif
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
            dots[i].classList.remove("active-dot");
        }
        
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].classList.add("active-dot");

        setTimeout(showSlides, 3000);
    }

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Tambahkan event listener untuk tombol "Sebelumnya" dan "Selanjutnya"
    let prevButton = document.querySelector(".sblm");
    let nextButton = document.querySelector(".ssdh");
    prevButton.addEventListener("click", function() {
        plusSlides(-1);
    });
    nextButton.addEventListener("click", function() {
        plusSlides(1);
    });

    // Inisialisasi titik-titik (hanya 3 titik)
    let dotsContainer = document.querySelector(".dots-container");
    let slides = document.getElementsByClassName("card-slides");
    // Hapus titik-titik yang berlebih
    while (dotsContainer.children.length > slides.length) {
        dotsContainer.removeChild(dotsContainer.lastChild);
    }

    // Tambahkan titik-titik baru jika diperlukan
    for (let i = dotsContainer.children.length; i < slides.length; i++) {
        let dot = document.createElement("span");
        dot.classList.add("dot");
        dot.setAttribute("onclick", "currentSlide(" + (i + 1) + ")");
        dotsContainer.appendChild(dot);
    }

    showSlides();
});

function currentSlide(n) {
    showSlides(slideIndex = n);
}


// Script untuk go to top
document.addEventListener("DOMContentLoaded", function() {
    let mybutton = document.getElementById("myBtn");
    
    mybutton.addEventListener("click", function() {
        topFunction();
    });
    window.addEventListener("scroll", function() {
        scrollFunction();
    });

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
});

// Script untuk FAQ



