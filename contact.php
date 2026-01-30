<?php
require_once 'includes/config.php';

$page_title = "Contact Us - Tourist Drivers India";

// Get package if specified
$selected_package = null;
if(isset($_GET['package'])) {
    $pkg_id = intval($_GET['package']);
    $pkg_result = $conn->query("SELECT id, title FROM tour_packages WHERE id = $pkg_id");
    if($pkg_result->num_rows > 0) {
        $selected_package = $pkg_result->fetch_assoc();
    }
}

include 'includes/header.php';
?>

<style>
    body {
        background: #f8f9fa;
    }
    .contact-hero {
        background: linear-gradient(135deg, rgba(255, 107, 53, 0.95) 0%, rgba(247, 147, 30, 0.95) 100%), url('assets/images/inner-page-bredcrumb.avif');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 140px 0 100px;
        color: white;
        text-align: center;
        position: relative;
    }
    .contact-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.3);
    }
    .contact-hero > .container {
        position: relative;
        z-index: 1;
    }
    .contact-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 15px;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
    }
    .contact-hero p {
        font-size: 1.3rem;
        opacity: 0.95;
    }
    .contact-section {
        padding: 80px 0;
        position: relative;
        margin-top: -50px;
    }
    .contact-card {
        background: white;
        border-radius: 20px;
        padding: 45px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        height: 100%;
        border: 1px solid #f0f0f0;
    }
    .contact-card h3 {
        font-size: 2rem;
        font-weight: 800;
        color: #333;
        margin-bottom: 35px;
        position: relative;
        padding-bottom: 15px;
    }
    .contact-card h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
        border-radius: 2px;
    }
    .contact-info-item {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 25px;
        padding: 25px;
        /* background: #f8f9fa; */
        border-radius: 15px;
        transition: all 0.3s;
        border: 2px solid transparent;
    }
    .contact-info-item:hover {
        background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
        color: white;
        transform: translateX(10px);
        box-shadow: 0 5px 20px rgba(255, 107, 53, 0.3);
    }
    .contact-info-item i {
        font-size: 2rem;
        color: #FF6B35;
        min-width: 50px;
        transition: all 0.3s;
    }
    .contact-info-item:hover i {
        color: white;
    }
    .contact-info-item h5 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 8px;
        color:#000;
    }
    .contact-info-item p {
        margin-bottom: 0;
        font-size: 1rem;
        color:#000;
    }
    .form-control {
        padding: 15px 20px;
        border: 2px solid #eee;
        border-radius: 10px;
        transition: all 0.3s;
        font-size: 1rem;
    }
    .form-control:focus {
        border-color: #FF6B35;
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.15);
        background: #fff;
    }
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        font-size: 1rem;
    }
    .submit-btn {
        padding: 16px 50px;
        background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
        color: white;
        border: none;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 700;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        cursor: pointer;
    }
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(255, 107, 53, 0.5);
    }
    .alert {
        border-radius: 15px;
        padding: 20px 25px;
        margin-bottom: 30px;
        border: none;
        font-weight: 500;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
    }
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
    }
    .map-container {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        margin-top: 60px;
        border: 5px solid white;
    }
    @media (max-width: 768px) {
        .contact-hero h1 {
            font-size: 2.5rem;
        }
        .contact-hero p {
            font-size: 1.1rem;
        }
        .contact-card {
            padding: 30px 25px;
        }
        .contact-info-item {
            padding: 20px;
        }
        .submit-btn {
            width: 100%;
        }
    }
</style>

<!-- Hero Section -->
<section class="contact-hero">
    <div class="container">
        <h1>Contact Us</h1>
        <p>Get in touch with us for any inquiries or bookings</p>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <!-- Contact Info -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="contact-card">
                    <h3 class="mb-4">Get In Touch</h3>
                    
                    <div class="contact-info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h5>Address</h5>
                            <p class="mb-0"><?php echo getSetting('site_address') ?: 'Plot No C 50 Ganesh Nagar Complex, New Delhi 110092'; ?></p>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h5>Phone</h5>
                            <p class="mb-0">
                                <a href="tel:<?php echo getSetting('site_phone'); ?>" style="color: inherit; text-decoration: none;">
                                    <?php echo getSetting('site_phone') ?: '+91 9310042916'; ?>
                                </a>
                            </p>
                        </div>
                    </div>
                    
                    <div class="contact-info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h5>Email</h5>
                            <p class="mb-0">
                                <a href="mailto:<?php echo getSetting('site_email'); ?>" style="color: inherit; text-decoration: none;">
                                    touristdriversindiapvttours <br/> @gmail.com
                                </a>
                            </p>
                        </div>
                    </div>
                    
                    <?php if(getSetting('whatsapp_number')): ?>
                    <div class="contact-info-item">
                        <i class="fab fa-whatsapp"></i>
                        <div>
                            <h5>WhatsApp</h5>
                            <p class="mb-0">
                                <a href="https://wa.me/<?php echo getSetting('whatsapp_number'); ?>" target="_blank" style="color: inherit; text-decoration: none;">
                                    <?php echo getSetting('whatsapp_number'); ?>
                                </a>
                            </p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="contact-card">
                    <h3 class="mb-4">Send us a Message</h3>
                    
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Name *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Address *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" name="phone" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Interested In Package (Optional)</label>
                                <select name="package_id" class="form-control">
                                    <option value="">Select a package</option>
                                    <?php
                                    $packages = $conn->query("SELECT id, title FROM tour_packages WHERE is_active = 1 ORDER BY title");
                                    while($pkg = $packages->fetch_assoc()):
                                    ?>
                                        <option value="<?php echo $pkg['id']; ?>" <?php echo ($selected_package && $selected_package['id'] == $pkg['id']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($pkg['title']); ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Your Message *</label>
                            <textarea name="message" class="form-control" rows="6" required></textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Map -->
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.162890261989!2d77.27894531508064!3d28.625701082424156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjjCsDM3JzMyLjUiTiA3N8KwMTYnNTEuOSJF!5e0!3m2!1sen!2sin!4v1234567890" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
            </iframe>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    
    if(contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('.submit-btn');
            const originalText = submitBtn.innerHTML;
            
            // Disable button and show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            
            fetch('process-contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Message Sent!',
                        html: data.message + '<br><br><strong>Reference: ' + data.contact_number + '</strong>',
                        confirmButtonColor: '#FF6B35',
                        confirmButtonText: 'OK'
                    });
                    contactForm.reset();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message,
                        confirmButtonColor: '#FF6B35'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.',
                    confirmButtonColor: '#FF6B35'
                });
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }
});
</script>

<?php include 'includes/footer.php'; ?>
