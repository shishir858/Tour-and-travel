    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>Tourist Drivers India</h5>
                    <p class="text-white-50">Your trusted partner for exploring the wonders of India with professional drivers.</p>
                    <div class="footer-social-links mt-3">
                        <?php if(getSetting('facebook_url')): ?>
                        <a href="<?php echo getSetting('facebook_url'); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <?php endif; ?>
                        <?php if(getSetting('instagram_url')): ?>
                        <a href="<?php echo getSetting('instagram_url'); ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                        <?php endif; ?>
                        <?php if(getSetting('twitter_url')): ?>
                        <a href="<?php echo getSetting('twitter_url'); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo SITE_URL; ?>">Home</a></li>
                        <li class="mb-2"><a href="<?php echo SITE_URL; ?>about.php">About</a></li>
                        <li class="mb-2"><a href="<?php echo SITE_URL; ?>contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Categories</h5>
                    <ul class="list-unstyled">
                        <?php
                        $footer_cats = $conn->query("SELECT * FROM categories WHERE is_active = 1 ORDER BY display_order LIMIT 5");
                        while($fcat = $footer_cats->fetch_assoc()):
                        ?>
                        <li class="mb-2">
                            <a href="<?php echo SITE_URL; ?>tour-packages.php?category=<?php echo $fcat['id']; ?>">
                                <?php echo htmlspecialchars($fcat['name']); ?>
                            </a>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact</h5>
                    <p class="text-white-50">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <?php echo getSetting('site_address') ?: 'New Delhi, India'; ?>
                    </p>
                    <p class="text-white-50">
                        <i class="fas fa-phone me-2"></i>
                        <?php echo getSetting('site_phone'); ?>
                    </p>
                </div>
            </div>
            <div class="row mt-4 pt-4 border-top border-secondary">
                <div class="col-12 text-center">
                    <p class="text-white-50 mb-0">© <?php echo date('Y'); ?> Tourist Drivers India. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float Button -->
    <?php if(getSetting('whatsapp_number')): ?>
    <a href="https://wa.me/<?php echo getSetting('whatsapp_number'); ?>" 
       class="whatsapp-float-btn" 
       target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
    <?php endif; ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo SITE_URL; ?>assets/js/main-script.js"></script>
    
    <style>
        /* Footer */
        .main-footer {
            background: #1F2937;
            color: white;
            padding: 60px 0 30px;
        }
        .main-footer h5 {
            color: white;
            margin-bottom: 25px;
            font-weight: 700;
        }
        .main-footer a {
            color: #D1D5DB;
            text-decoration: none;
            transition: all 0.3s;
        }
        .main-footer a:hover {
            color: #FF6B35;
            padding-left: 5px;
        }
        .footer-social-links a {
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 12px;
            transition: all 0.3s;
        }
        .footer-social-links a:hover {
            background: #FF6B35;
            transform: translateY(-4px);
        }
        
        /* WhatsApp Float */
        .whatsapp-float-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 65px;
            height: 65px;
            background: #25D366;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.5);
            z-index: 9999;
            transition: all 0.3s;
            animation: pulse 2s infinite;
        }
        .whatsapp-float-btn:hover {
            background: #128C7E;
            transform: scale(1.1);
            color: white;
        }
        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 4px 15px rgba(37, 211, 102, 0.5);
            }
            50% {
                box-shadow: 0 4px 25px rgba(37, 211, 102, 0.7);
            }
        }
    </style>

</body>
</html>
