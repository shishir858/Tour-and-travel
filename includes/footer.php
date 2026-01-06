    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <!-- Categories with Packages -->
            <div class="row mb-5">
                <?php
                $footer_categories = $conn->query("SELECT * FROM categories WHERE is_active = 1 AND show_in_header = 1 ORDER BY display_order LIMIT 5");
                while($footer_cat = $footer_categories->fetch_assoc()):
                    $footer_packages = $conn->query("SELECT id, title, slug FROM tour_packages WHERE category_id = {$footer_cat['id']} AND is_active = 1 ORDER BY display_order LIMIT 5");
                ?>
                <div class="col-lg col-md-4 col-sm-6 mb-4">
                    <h5 class="footer-category-title"><?php echo htmlspecialchars($footer_cat['name']); ?></h5>
                    <ul class="footer-links-list">
                        <?php while($footer_pkg = $footer_packages->fetch_assoc()): ?>
                        <li>
                            <a href="<?php echo SITE_URL; ?>package/<?php echo $footer_pkg['slug'] ?: $footer_pkg['id']; ?>">
                                <i class="fas fa-angle-right"></i> <?php echo htmlspecialchars(substr($footer_pkg['title'], 0, 30)); ?>...
                            </a>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <?php endwhile; ?>
            </div>
            
            <!-- About Us Section -->
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h4 class="footer-section-title">About Us</h4>
                    <p class="footer-about-text">
                        Tourist Drivers India Private Tours offers a hire private drivers in India and hire a private tour guide in India with reliable taxi services, customized tour packages, and affordable car rentals across India, ensuring safe, comfortable, and memorable travel experiences. Tourist Drivers India Private Tours Company managed by Mr. Rajan Singh, his Drivers team of professionally qualified youngsters are fully equipped to offer you the best of Real Indian experience. Tourist Drivers India Private Tours doesn't just offer you how to explore a destination but to experience it as well. A great variety of tours which can be customized...
                    </p>
                    <div class="footer-social-links mt-4">
                        <a href="<?php echo getSetting('facebook_url') ?: '#'; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="<?php echo getSetting('instagram_url') ?: '#'; ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="<?php echo getSetting('youtube_url') ?: '#'; ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div class="row mb-4">
                <div class="col-12">
                    <h4 class="footer-section-title text-center">Quick Links</h4>
                    <ul class="footer-quick-links">
                        <li><a href="<?php echo SITE_URL; ?>"><i class="fas fa-circle"></i> Home</a></li>
                        <li><a href="<?php echo SITE_URL; ?>about"><i class="fas fa-circle"></i> About Us</a></li>
                        <li><a href="<?php echo SITE_URL; ?>tour-packages"><i class="fas fa-circle"></i> Tour Packages</a></li>
                        <li><a href="<?php echo SITE_URL; ?>gallery"><i class="fas fa-circle"></i> Gallery</a></li>
                        <li><a href="<?php echo SITE_URL; ?>vehicles"><i class="fas fa-circle"></i> Our Vehicles</a></li>
                        <li><a href="<?php echo SITE_URL; ?>contact"><i class="fas fa-circle"></i> Contact Us</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="row mb-4">
                <div class="col-12">
                    <h4 class="footer-section-title text-center">Contact Info</h4>
                    <div class="footer-contact-info">
                        <div class="contact-info-item">
                            <i class="fas fa-phone"></i>
                            <a href="tel:<?php echo getSetting('site_phone'); ?>"><?php echo getSetting('site_phone') ?: '+91 9310042916'; ?></a>
                        </div>
                        <div class="contact-info-item">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:<?php echo getSetting('site_email'); ?>"><?php echo getSetting('site_email') ?: 'touristdriversindiapvttours@gmail.com'; ?></a>
                        </div>
                        <div class="contact-info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo getSetting('site_address') ?: 'Plot No C 50 Ganesh Nagar Complex - New Delhi 110092'; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="row mt-4 pt-4 border-top border-secondary">
                <div class="col-12 text-center">
                    <p class="footer-copyright mb-0">© <?php echo date('Y'); ?> Tourist Drivers India. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <?php if(getSetting('whatsapp_number')): ?>
    <a href="https://wa.me/<?php echo getSetting('whatsapp_number'); ?>" 
       class="whatsapp-float-btn" 
       target="_blank"
       title="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    <?php endif; ?>
    
    <!-- Call Float Button -->
    <a href="tel:<?php echo getSetting('site_phone'); ?>" 
       class="call-float-btn" 
       title="Call Us">
        <i class="fas fa-phone"></i>
    </a>
    
    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top-btn" title="Back to Top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    
    <script src="<?php echo SITE_URL; ?>assets/js/main-script.js"></script>
    
    <script>
        // Back to Top Button
        const backToTopBtn = document.getElementById('backToTop');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });
        
        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
    
    <style>
        /* Footer */
        .main-footer {
            background: #2d2d2d;
            color: #999;
            padding: 60px 0 20px;
        }
        .footer-category-title {
            color: white;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .footer-links-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-links-list li {
            margin-bottom: 10px;
        }
        .footer-links-list a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .footer-links-list a i {
            font-size: 10px;
        }
        .footer-links-list a:hover {
            color: #FF6B35;
            padding-left: 5px;
        }
        .footer-section-title {
            color: white;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .footer-about-text {
            color: white;
            font-size: 14px;
            line-height: 1.8;
            max-width: 1000px;
            margin: 0 auto;
        }
        .footer-social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        .footer-social-links a {
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            transition: all 0.3s;
            text-decoration: none;
        }
        .footer-social-links a:hover {
            background: #FF6B35;
            transform: translateY(-4px);
        }
        .footer-quick-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            list-style: none;
            padding: 0;
            margin: 20px 0 0 0;
        }
        .footer-quick-links a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .footer-quick-links a i {
            font-size: 6px;
        }
        .footer-quick-links a:hover {
            color: #FF6B35;
        }
        .footer-contact-info {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 40px;
            margin-top: 20px;
        }
        .contact-info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            font-size: 14px;
        }
        .contact-info-item i {
            color: #FF6B35;
            font-size: 16px;
        }
        .contact-info-item a {
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }
        .contact-info-item a:hover {
            color: #FF6B35;
        }
        .footer-copyright {
            color: #666;
            font-size: 14px;
        }
        
        /* WhatsApp Float Button */
        .whatsapp-float-btn {
            position: fixed;
            bottom: 140px;
            left: 20px;
            width: 60px;
            height: 60px;
            background: #25D366;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.5);
            z-index: 9999;
            transition: all 0.3s;
            text-decoration: none;
        }
        .whatsapp-float-btn:hover {
            background: #128C7E;
            transform: scale(1.1);
            color: white;
        }
        
        /* Call Float Button */
        .call-float-btn {
            position: fixed;
            bottom: 70px;
            left: 20px;
            width: 60px;
            height: 60px;
            background: #FF6B35;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.5);
            z-index: 9999;
            transition: all 0.3s;
            text-decoration: none;
            animation: pulse 2s infinite;
        }
        .call-float-btn:hover {
            background: #F7931E;
            transform: scale(1.1);
            color: white;
        }
        
        /* Back to Top Button */
        .back-to-top-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: #FF6B35;
            color: white;
            border: none;
            border-radius: 5px;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.5);
            z-index: 9999;
            cursor: pointer;
            transition: all 0.3s;
        }
        .back-to-top-btn:hover {
            background: #F7931E;
            transform: translateY(-5px);
        }
        .back-to-top-btn.show {
            display: flex;
        }
        
        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 4px 15px rgba(255, 107, 53, 0.5);
            }
            50% {
                box-shadow: 0 4px 25px rgba(255, 107, 53, 0.7);
            }
        }
        
        @media (max-width: 768px) {
            .footer-quick-links {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }
            .footer-contact-info {
                flex-direction: column;
                align-items: center;
                gap: 20px;
            }
        }
    </style>

<script>
// Hero Enquiry Form Submission - Show loading on submit
document.addEventListener('DOMContentLoaded', function() {
    const enquiryForm = document.getElementById('heroEnquiryForm');
    
    if(enquiryForm) {
        enquiryForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('.enquiry-submit-btn');
            const originalBtnText = submitBtn.innerHTML;
            
            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            
            // Submit with AJAX to show SweetAlert
            fetch('<?php echo SITE_URL; ?>process-enquiry.php', {
                method: 'POST',
                body: new FormData(this)
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    // Show success SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Thank You!',
                        html: `<p>${data.message}</p><p><strong>Reference Number:</strong><br><span style="font-size:1.2em;color:#FF6B35;">${data.booking_number}</span></p><p style="font-size:0.9em;color:#666;">We will contact you shortly!</p>`,
                        confirmButtonColor: '#FF6B35',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        enquiryForm.reset();
                    });
                } else {
                    // Show error SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message,
                        confirmButtonColor: '#FF6B35'
                    });
                }
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred. Please try again.',
                    confirmButtonColor: '#FF6B35'
                });
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;
            });
        });
    }
});
</script>

<!-- Instagram Embed Script -->
<script async src="//www.instagram.com/embed.js"></script>

</body>
</html>
