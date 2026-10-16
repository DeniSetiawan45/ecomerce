// ========================================
// BANNER OTOMATIS - 4 slide
// ========================================

// Ambil elemen yang dibutuhkan
const slidesContainer = document.getElementById('slides');
const slides = document.querySelectorAll('.slide');
const dotsContainer = document.getElementById('dotsContainer');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

let currentIndex = 0;
const totalSlides = slides.length;
let autoPlayTimer = null;
const INTERVAL = 4000; // 4 detik

// Buat indikator dot sesuai jumlah slide
slides.forEach((_, index) => {
    const dot = document.createElement('button');
    dot.classList.add('dot');
    if (index === 0) dot.classList.add('active');
    dot.dataset.index = index;
    dot.addEventListener('click', () => goToSlide(index));
    dotsContainer.appendChild(dot);
});

const dots = document.querySelectorAll('.dot');

// Fungsi pindah ke slide tertentu
function goToSlide(index) {
    // Loop jika di luar batas
    if (index < 0) index = totalSlides - 1;
    if (index >= totalSlides) index = 0;

    currentIndex = index;

    // Geser container
    slidesContainer.style.transform = `translateX(-${currentIndex * 100}%)`;

    // Update aktif pada dot
    dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === currentIndex);
    });

    // Reset timer autoplay
    resetAutoPlay();
}

// Fungsi next dan prev
function nextSlide() {
    goToSlide(currentIndex + 1);
}

function prevSlide() {
    goToSlide(currentIndex - 1);
}

// Autoplay
function startAutoPlay() {
    if (autoPlayTimer) clearInterval(autoPlayTimer);
    autoPlayTimer = setInterval(nextSlide, INTERVAL);
}

function resetAutoPlay() {
    if (autoPlayTimer) {
        clearInterval(autoPlayTimer);
        autoPlayTimer = null;
    }
    startAutoPlay();
}

// Event listener tombol
prevBtn.addEventListener('click', prevSlide);
nextBtn.addEventListener('click', nextSlide);

// Event klik pada slide (redirect sesuai data-url)
slides.forEach((slide) => {
    slide.addEventListener('click', function(e) {
        e.preventDefault(); // cegah aksi default <a>
        const url = this.dataset.url;
        if (url) {
            window.location.href = url; // arahkan ke URL
        } else {
            alert('Slide ini belum memiliki tautan.');
        }
    });
});

// Hentikan autoplay saat hover (opsional)
const carousel = document.getElementById('carousel');
carousel.addEventListener('mouseenter', () => {
    if (autoPlayTimer) clearInterval(autoPlayTimer);
});
carousel.addEventListener('mouseleave', startAutoPlay);

// Inisialisasi
goToSlide(0);
startAutoPlay();

console.log('✅ Banner siap!');