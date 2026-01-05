<?php
require_once 'includes/config.php';
$page_title = "Thank You - Tourist Drivers India";
include 'includes/header.php';

// Get parameters
$type = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : 'booking';
$ref = isset($_GET['ref']) ? htmlspecialchars($_GET['ref']) : '';
?>

<style>
    .thank-you-section {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, rgba(255,107,53,0.05) 0%, rgba(247,147,30,0.05) 100%);
        padding: 60px 20px;
    }
    
    .thank-you-card {
        background: white;
        border-radius: 20px;
        padding: 60px 40px;
        max-width: 700px;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        animation: slideUp 0.6s ease-out;
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .success-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        animation: scaleIn 0.5s ease-out 0.2s both;
    }
    
    @keyframes scaleIn {
        from {
            transform: scale(0);
        }
        to {
            transform: scale(1);
        }
    }
    
    .success-icon i {
        font-size: 50px;
        color: white;
    }
    
    .thank-you-card h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #FF6B35;
        margin-bottom: 20px;
    }
    
    .thank-you-card .subtitle {
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 30px;
        line-height: 1.6;
    }
    
    .reference-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin: 30px 0;
        border-left: 4px solid #FF6B35;
    }
    
    .reference-box p {
        margin: 0;
        font-size: 0.9rem;
        color: #666;
    }
    
    .reference-box strong {
        font-size: 1.3rem;
        color: #FF6B35;
        display: block;
        margin-top: 10px;
        letter-spacing: 1px;
    }
    
    .info-list {
        text-align: left;
        margin: 30px 0;
        padding: 0;
        list-style: none;
    }
    
    .info-list li {
        padding: 12px 0;
        border-bottom: 1px solid #eee;
        color: #555;
    }
    
    .info-list li i {
        color: #FF6B35;
        margin-right: 10px;
        width: 20px;
    }
    
    .action-buttons {
        margin-top: 40px;
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .btn-primary-custom {
        background: linear-gradient(135deg, #FF6B35 0%, #F7931E 100%);
        color: white;
        padding: 15px 40px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        display: inline-block;
    }
    
    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(255,107,53,0.3);
        color: white;
    }
    
    .btn-secondary-custom {
        background: white;
        color: #FF6B35;
        padding: 15px 40px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        border: 2px solid #FF6B35;
        display: inline-block;
    }
    
    .btn-secondary-custom:hover {
        background: #FF6B35;
        color: white;
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .thank-you-card {
            padding: 40px 25px;
        }
        
        .thank-you-card h1 {
            font-size: 2rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-primary-custom,
        .btn-secondary-custom {
            width: 100%;
        }
    }
</style>

<section class="thank-you-section">
    <div class="thank-you-card">
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>
        
        <h1>Thank You!</h1>
        <p class="subtitle">
            <?php if($type == 'enquiry'): ?>
                Your enquiry has been successfully submitted. Our team will contact you shortly to discuss your travel plans.
            <?php else: ?>
                Your booking request has been successfully submitted. We will review your details and get back to you within 24 hours.
            <?php endif; ?>
        </p>
        
        <?php if(!empty($ref)): ?>
        <div class="reference-box">
            <p>Your Reference Number</p>
            <strong><?php echo $ref; ?></strong>
            <p style="margin-top: 10px; font-size: 0.85rem;">Please save this reference number for future communication</p>
        </div>
        <?php endif; ?>
        
        <ul class="info-list">
            <li><i class="fas fa-check-circle"></i> Your request has been saved in our system</li>
            <li><i class="fas fa-headset"></i> Our team will contact you within 24 hours</li>
            <li><i class="fas fa-envelope"></i> Check your email for updates</li>
            <li><i class="fas fa-phone"></i> For urgent queries, call us at <?php echo getSetting('site_phone') ?: '+91-XXXXXXXXXX'; ?></li>
        </ul>
        
        <div class="action-buttons">
            <a href="<?php echo SITE_URL; ?>" class="btn-primary-custom">
                <i class="fas fa-home"></i> Back to Home
            </a>
            <a href="<?php echo SITE_URL; ?>tour-packages.php" class="btn-secondary-custom">
                <i class="fas fa-search"></i> Browse More Packages
            </a>
        </div>
        
        <div style="margin-top: 40px; padding-top: 30px; border-top: 1px solid #eee;">
            <p style="color: #888; font-size: 0.9rem; margin: 0;">
                <i class="fas fa-shield-alt" style="color: #FF6B35;"></i>
                Your information is safe and secure with us
            </p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
