/**
 * Expreso a Oriente - Main JS
 * Hamburger menu + carousel interactions
 */

document.addEventListener('DOMContentLoaded', function () {
    initMobileMenu();
    initCarousel();
    initHeaderScroll();
});

/* ─── Mobile Menu ────────────────────────────────── */

function initMobileMenu() {
    var toggle = document.getElementById('menu-toggle');
    var nav = document.getElementById('main-nav');
    var header = document.getElementById('site-header');

    if (!toggle || !nav) return;

    toggle.addEventListener('click', function () {
        var expanded = toggle.getAttribute('aria-expanded') === 'true';
        toggle.setAttribute('aria-expanded', String(!expanded));
        nav.classList.toggle('is-open');
        header.classList.toggle('menu-open');
        document.body.classList.toggle('no-scroll');
    });

    // Close menu when clicking a link
    var links = nav.querySelectorAll('.nav-link');
    for (var i = 0; i < links.length; i++) {
        links[i].addEventListener('click', function () {
            toggle.setAttribute('aria-expanded', 'false');
            nav.classList.remove('is-open');
            header.classList.remove('menu-open');
            document.body.classList.remove('no-scroll');
        });
    }
}

/* ─── Header Scroll Effect ───────────────────────── */

function initHeaderScroll() {
    var header = document.getElementById('site-header');
    if (!header) return;

    var lastScroll = 0;
    var ticking = false;

    window.addEventListener('scroll', function () {
        lastScroll = window.pageYOffset;
        if (!ticking) {
            window.requestAnimationFrame(function () {
                if (lastScroll > 80) {
                    header.classList.add('is-scrolled');
                } else {
                    header.classList.remove('is-scrolled');
                }
                ticking = false;
            });
            ticking = true;
        }
    });
}

/* ─── Home Carousel ──────────────────────────────── */

function initCarousel() {
    var carousel = document.getElementById('chapter-carousel');
    if (!carousel) return;

    var track = carousel.querySelector('.carousel-track');
    var slides = carousel.querySelectorAll('.carousel-slide');
    var dots = carousel.querySelectorAll('.carousel-dot');
    var prevBtn = carousel.querySelector('.carousel-prev');
    var nextBtn = carousel.querySelector('.carousel-next');

    if (!track || slides.length === 0) return;

    var currentIndex = 0;
    var totalSlides = slides.length;

    // Dot click navigation
    for (var i = 0; i < dots.length; i++) {
        (function (index) {
            dots[index].addEventListener('click', function () {
                goToSlide(index);
            });
        })(i);
    }

    // Arrow navigation
    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            goToSlide(currentIndex > 0 ? currentIndex - 1 : totalSlides - 1);
        });
    }
    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            goToSlide(currentIndex < totalSlides - 1 ? currentIndex + 1 : 0);
        });
    }

    // Keyboard navigation
    carousel.addEventListener('keydown', function (e) {
        if (e.key === 'ArrowLeft') {
            goToSlide(currentIndex > 0 ? currentIndex - 1 : totalSlides - 1);
        } else if (e.key === 'ArrowRight') {
            goToSlide(currentIndex < totalSlides - 1 ? currentIndex + 1 : 0);
        }
    });

    // Scroll-snap change detection
    var scrollTimer = null;
    track.addEventListener('scroll', function () {
        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(function () {
            var slideWidth = slides[0].offsetWidth;
            var newIndex = Math.round(track.scrollLeft / slideWidth);
            if (newIndex !== currentIndex && newIndex >= 0 && newIndex < totalSlides) {
                currentIndex = newIndex;
                updateDots();
            }
        }, 100);
    });

    function goToSlide(index) {
        currentIndex = index;
        slides[index].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
        updateDots();
    }

    function updateDots() {
        for (var j = 0; j < dots.length; j++) {
            dots[j].classList.toggle('is-active', j === currentIndex);
            dots[j].setAttribute('aria-current', j === currentIndex ? 'true' : 'false');
        }
    }
}
