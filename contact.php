<?php include('header.php'); ?>
<?php
// db connection

$sql = "SELECT * FROM contact_info LIMIT 1";
$result = $conn->query($sql);
$headerrow = $result->fetch_assoc();
?>
<!-- Sub banner -->
<section style="
    background-image: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%), 
                      url(assets/images/inner-page-bredcrumb.avif);
    background-size: cover;
    background-position: center;
    height: 350px;" class="sub_banner_con position-relative">
    <div class="container position-relative">
        <div class="row" style="background-image:url('')">
            <div class="col-xl-6 col-md-8 col-12 mx-auto">
                <div class="sub_banner_content mt-5" data-aos="fade-up">
                    <h1 class="text-white text-center">Contact Us</h1>
                    <!-- <p class="text-white text-size-16">Quis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore noulla pariatur ccaecat curidatat aero.</p> -->
                    <div class="box text-center">
                        <a href="index.php" class="text-decoration-none">
                            <span class="mb-0">Home</span>
                        </a>|
                        <i class="arrow fa-solid fa-arrow-right"></i>
                        <span class="mb-0 box_span">Contact Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<!-- Contact Info -->
<section class="contactinfo-con">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contactinfo_content text-center" data-aos="fade-up">
                    <h6>Contact Info</h6>
                    <h2>Our Contact Information</h2>
                </div>
            </div>
        </div>
        <div class="row" data-aos="fade-up">
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="contact-box">
                    <figure class="icon icon1">
                        <img src="./assets/images/contact-icon1.png" alt="image" class="img-fluid">
                    </figure>
                    <h4>Our Location</h4>
                    <a href="https://www.google.com/maps/place/21+King+St,+Melbourne+VIC+3000,+Australia/@-37.8199805,144.9529083,18z/data=!4m6!3m5!1s0x6ad65d52754eaecb:0x22f367daf52cbd47!8m2!3d-37.819936!4d144.9570765!16s%2Fg%2F11c2dj2n2c?entry=ttu"
                        class="text-decoration-none text-size-16 mb-0"><?php echo $headerrow['address']; ?>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="contact-box">
                    <figure class="icon">
                        <img src="./assets/images/contact-icon2.png" alt="image" class="img-fluid">
                    </figure>
                    <h4>Phone Number</h4>
                    <a href="tel:+61383766284" class="mb-0 text-decoration-none text-size-16"> <?php echo $headerrow['phone']; ?></a>
                    <!-- <a href="tel:+80023456789" class="text-decoration-none text-size-16 mb-0"> <?php echo $headerrow['phone']; ?></a> -->
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="contact-box mb-0">
                    <figure class="icon">
                        <img src="./assets/images/contact-icon3.png" alt="image" class="img-fluid">
                    </figure>
                    <h4>Our Email</h4>
                    <a href="mailto:info@atreves.com" class="mb-0 text-decoration-none text-size-16"> <?php echo $headerrow['email1']; ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Form -->
<section class="contactform-con position-relative">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="contact_wrapper position-relative" data-aos="zoom-in">
                    <figure class="contact-leftbackground mb-0">
                        <img src="assets/images/contact-leftbackground.jpg" alt="image" class="img-fluid">
                    </figure>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="contact_content" data-aos="fade-up">
                    <h6 class="text-white">Get In Touch</h6>
                    <h2 class="text-white">Send us a Message</h2>
                    <form method="post" action="banner-email.php" class="position-relative">
                        <div class="form-group input1 float-left">
                            <input type="text" class="form_style" placeholder="Name" name="fname" id="fname" required>
                        </div>
                        <div class="form-group float-left">
                            <input type="tel" class="form_style" placeholder="Phone" name="phone" id="phone" required>
                        </div>
                        <div class="form-group input1 float-left">
                            <input type="email" class="form_style" placeholder="Email" name="email" id="email" required>
                        </div>
                        <div class="form-group float-left">
                            <input type="text" class="form_style" placeholder="Subject" name="subject" id="subject" required>
                        </div>
                        <div class="form-group message">
                            <textarea class="form_style" placeholder="Message" rows="3" name="msg" required></textarea>
                        </div>
                        <button type="submit" id="submit" class="submit_now text-decoration-none">
                            Submit <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <figure class="contact-bottomimage mb-0">
        <img src="assets/images/tour-packages-photos/delhi.webp" alt="image" class="img-fluid">
    </figure>
</section>
<!-- Map -->
<div class="map-con">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14008.773565540336!2d77.2717112845291!3d28.623965446030077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce3005b06bfb3%3A0x57ddebfd983ddf39!2sGanesh%20Nagar%20pandav%20nagar%20complex!5e0!3m2!1sen!2sin!4v1746766698668!5m2!1sen!2sin" style="border:none;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<?php include('footer.php') ?>
