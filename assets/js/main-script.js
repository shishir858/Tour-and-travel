        // Mobile nav category dropdown toggle
        document.querySelectorAll('.mobile-slide-nav-list .has-mobile-dropdown > a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const parent = this.parentElement;
                parent.classList.toggle('open');
            });
        });
    // Mobile Slide Nav Logic
    const mobileNavToggle = document.getElementById('mobileNavToggle');
    const mobileSlideNav = document.getElementById('mobileSlideNav');
    const mobileSlideOverlay = document.getElementById('mobileSlideOverlay');
    const mobileSlideClose = document.getElementById('mobileSlideClose');

    function openMobileSlideNav() {
        mobileSlideNav.classList.add('open');
        mobileSlideOverlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeMobileSlideNav() {
        mobileSlideNav.classList.remove('open');
        mobileSlideOverlay.classList.remove('open');
        document.body.style.overflow = '';
    }
    if (mobileNavToggle && mobileSlideNav && mobileSlideOverlay && mobileSlideClose) {
        mobileNavToggle.addEventListener('click', openMobileSlideNav);
        mobileSlideClose.addEventListener('click', closeMobileSlideNav);
        mobileSlideOverlay.addEventListener('click', closeMobileSlideNav);
        // Close on menu link click (but NOT on category parent with dropdown)
        mobileSlideNav.querySelectorAll('.mobile-slide-nav-list > li > a:not(.mobile-cat-arrow)').forEach(link => {
            // Only close if not a category parent with dropdown
            if (!link.parentElement.classList.contains('has-mobile-dropdown')) {
                link.addEventListener('click', closeMobileSlideNav);
            }
        });
    }
// TOURIST DRIVERS INDIA - Custom JavaScript

document.addEventListener('DOMContentLoaded', function() {
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href !== '') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // Navbar scroll effect
    let lastScroll = 0;
    const navbar = document.querySelector('.main-navbar');
    
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        lastScroll = currentScroll;
    });

    // Animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.category-single-card, .tour-package-card, .feature-item-box').forEach(el => {
        observer.observe(el);
    });

    // Modern Mobile Slide Menu
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileSlideMenu = document.getElementById('mobileSlideMenu');
    const mobileSlideMenuOverlay = document.getElementById('mobileSlideMenuOverlay');
    const mobileSlideMenuClose = document.getElementById('mobileSlideMenuClose');

    function openMobileMenu() {
        mobileSlideMenu.classList.add('open');
        mobileSlideMenuOverlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeMobileMenu() {
        mobileSlideMenu.classList.remove('open');
        mobileSlideMenuOverlay.classList.remove('open');
        document.body.style.overflow = '';
    }
    if (mobileMenuToggle && mobileSlideMenu && mobileSlideMenuOverlay && mobileSlideMenuClose) {
        mobileMenuToggle.addEventListener('click', openMobileMenu);
        mobileSlideMenuClose.addEventListener('click', closeMobileMenu);
        mobileSlideMenuOverlay.addEventListener('click', closeMobileMenu);
        // Close on menu link click
        mobileSlideMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });
        // Dropdown toggle
        mobileSlideMenu.querySelectorAll('.mobile-slide-menu-item.has-dropdown > a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const parent = this.parentElement;
                parent.classList.toggle('open');
            });
        });
    }

    // Lazy loading images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        imageObserver.unobserve(img);
                    }
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Add loading animation class
    setTimeout(() => {
        document.body.classList.add('loaded');
    }, 300);
});

// Page loading animation
window.addEventListener('load', () => {
    document.body.classList.add('page-loaded');
});
