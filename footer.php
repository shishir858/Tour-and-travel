<?php

$sql = "SELECT * FROM footer_content LIMIT 1";
$result = $conn->query($sql);
$footerrow = $result->fetch_assoc();
?>
<section class="footer-con position-relative">
    <div class="footer_upperportion position-relative">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="upper_portion">
                        <a href="index.html">
                            <figure class="footer-logo mb-0"><img class="img-fluid bg-white"
                                    src="admin/html/<?php echo $headerrow['logo']; ?>" alt="image"></figure>
                        </a>
                        <p class="text-size-18 mb-0">Sign up for the newsletter:</p>

                        <?php

                        use PHPMailer\PHPMailer\PHPMailer;
                        use PHPMailer\PHPMailer\Exception;

                        require 'vendor/autoload.php';

                        if ($_SERVER["REQUEST_METHOD"] === "POST") {
                            $email = htmlspecialchars(trim($_POST['email']));

                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                echo "<script>alert('Invalid email address.');</script>";
                            } else {
                                $mail = new PHPMailer(true);

                                try {
                                    $mail->isSMTP();
                                    $mail->Host       = 'smtp.gmail.com';
                                    $mail->SMTPAuth   = true;
                                    $mail->Username   = 'sspappkeys@gmail.com';
                                    $mail->Password   = 'momcjmfzwcfastuu';
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                    $mail->Port       = 587;

                                    $mail->setFrom('sspappkeys@gmail.com', 'Website Newsletter');
                                    $mail->addAddress('touristdriversindiapvttours@gmail.com', 'Admin');

                                    $mail->isHTML(true);
                                    $mail->Subject = 'New Email Subscription';
                                    $mail->Body    = "<h3>New Subscriber</h3><p>Email: {$email}</p>";

                                    $mail->send();
                                    echo "<script>alert('Thank you for subscribing!');</script>";
                                } catch (Exception $e) {
                                    echo "<script>alert('Mailer Error: " . addslashes($mail->ErrorInfo) . "');</script>";
                                }
                            }
                        }
                        ?>

                        <!-- HTML FORM -->
                        <form method="POST" action="">
                            <div class="form-group position-relative mb-0">
                                <input type="text" class="form_style" placeholder="Enter Email Address" name="email" required>
                                <button type="submit"><i class="send fa-sharp fa-solid fa-paper-plane"></i></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_lowerportion position-relative">
        <div class="container">
            <div class="middle_portion">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="logo-content">
                            <h5 class="heading">About Us</h5>
                            <p class="text-size-14 text">
<?php
$about = strip_tags($footerrow['about_us']);
$words = explode(' ', $about);
if(count($words) > 25) {
    echo implode(' ', array_slice($words, 0, 25)) . '...';
} else {
    echo $about;
}
?>
                            </p>
                            <ul class="list-unstyled mb-0 social-icons">
                                <li><a href="<?php echo $headerrow['facebook']; ?>" class="text-decoration-none"><i
                                            class="fa-brands fa-facebook-f social-networks"></i></a></li>
                                <li><a href="<?php echo $headerrow['instagram']; ?>" class="text-decoration-none"><i
                                            class="fa-brands fa-instagram social-networks"></i></a></li>
                                <li><a href="<?php echo $headerrow['twitter']; ?>" class="text-decoration-none"><i
                                            class="fa-brands fa-youtube social-networks"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6">
                        <div class="links">
                            <h5 class="heading">Quick Links</h5>
                            <ul class="list-unstyled mb-0">
                                <li><i class="fa-solid fa-arrow-right"></i><a href="index.php">Home</a></li>
                                <li><i class="fa-solid fa-arrow-right"></i><a href="about.php">About Us</a></li>
                                <li><i class="fa-solid fa-arrow-right"></i><a href="tour-packages.php">Tour Packages</a>
                                </li>
                                <li><i class="fa-solid fa-arrow-right"></i><a href="vehicles.php">Vehicles</a></li>
                                <li><i class="fa-solid fa-arrow-right"></i><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-6">
                        <div class="use-link links">
                            <h5 class="heading">Explore</h5>
                            <ul class="list-unstyled mb-0">
                                <li><i class="fa-solid fa-arrow-right"></i><a href="service.php">Tour Packages</a></li>
                                <li><i class="fa-solid fa-arrow-right"></i><a href="service.php">Taxi Services</a>
                                </li>
                                <li><i class="fa-solid fa-arrow-right"></i><a href="service.php">Car Rentals</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                        <div class="icon">
                            <h5 class="heading">Contact Us</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="text">
                                    <i class="fa-solid fa-phone"></i>
                                    <a href="tel:<?php echo $headerrow['whatsapp']; ?>"
                                        class="text-decoration-none"><?php echo $headerrow['phone']; ?>

                                    </a>
                                </li>

                                </a>
                                <li class="text">
                                    <i class="fa-solid fa-envelope"></i>
                                    <a href="mailto:<?php echo $headerrow['email1']; ?>"
                                        class="text-decoration-none"><?php echo $headerrow['email1']; ?></a>
                                </li>
                                <li class="text">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <a href="https://www.google.com/maps/place/21+King+St,+Melbourne+VIC+3000,+Australia/@-37.8199805,144.9529083,18z/data=!4m6!3m5!1s0x6ad65d52754eaecb:0x22f367daf52cbd47!8m2!3d-37.819936!4d144.9570765!16s%2Fg%2F11c2dj2n2c?entry=ttu"
                                        class="text-decoration-none address mb-0"><?php echo $footerrow['branch1']; ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p class="mb-0">Copyright ©2025 Tourist Drivers India Private Tours
                All Rights Reserved | Designed by <a href="">SSP Softpro India PVT LTD</a></p>
        </div>
    </div>
</section>
<!-- Project SECTION POPUP -->
<div class="project_modal">
    <div id="blog-model-1" class="modal fade blog-model-con" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"><i class="fa-solid fa-x"></i></span></button>
                </div>
                <div class="modal-body">
                    <div class=" mb-0">
                        <form action="pop-up-mail.php" method="POST">
                          <div class="mb-3">
                              <label class="form-label">Full Name</label>
                              <input type="text" name="fullName" class="form-control" required>
                          </div>

                          <div class="mb-3">
                              <label class="form-label">Email</label>
                              <input type="email" name="email" class="form-control" required>
                          </div>

                          <div class="mb-3">
                              <label class="form-label">Phone</label>
                              <input type="tel" name="phone" class="form-control" required>
                          </div>

                          <div class="row mb-3">
                              <div class="col">
                                  <label class="form-label">Travel Date</label>
                                  <input type="date" name="travelDate" class="form-control" required>
                              </div>
                              <div class="col">
                                  <label class="form-label">Count</label>
                                  <input type="number" name="count" class="form-control" min="1" required>
                              </div>
                          </div>

                          <div class="mb-3">
                              <label class="form-label">Message</label>
                              <textarea name="message" class="form-control" rows="3"></textarea>
                          </div>

                          <button type="submit" class="btn text-white" style="background:#f97316;">
                              Submit
                          </button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<script>
    function sendToWhatsApp() {
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;
        var travelDate = document.getElementById("travelDate").value;
        var count = document.getElementById("count").value;
        var message = document.getElementById("message").value;

        var fullMessage = "Full Name: " + name +
            "%0AEmail: " + email +
            "%0APhone: " + phone +
            "%0ATravel Date: " + travelDate +
            "%0ACount: " + count +
            "%0AMessage: " + message;

        var whatsappNumber = "918800608559"; // Replace with your WhatsApp number (with country code, no +)

        var whatsappURL = "https://wa.me/" + whatsappNumber + "?text=" + fullMessage;

        window.open(whatsappURL, '_blank');
    }
</script> -->

<style>
    .btn-sonar {
    background: #d31f26;
    border: 0;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    display: inline-block;
    color: #fff;
    outline: 0;
    position: fixed;
    text-align: center;
    line-height: 80px;
    left: 10px;
    bottom: 50px;
    z-index: 99;
}
.btn-sonar img {
    width: 35px;
    height: 35px;
    margin-top: -20px;
    animation: rotate-img 1s infinite;
}

.btn-sonar::before {
    content: "";
    display: inline-block;
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    top: 0;
    left: 0;
    animation: sonar-effect 1s ease-in-out .1s infinite;
}



@keyframes rotate-in {
  0% {
    -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg);
    transform: perspective(120px) rotateX(0deg) rotateY(0deg);
  }
  50% {
    -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
    transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
  }
  100% {
    -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
    transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
  }
}


@keyframes sonar-effect{0%{opacity:.3}40%{opacity:.5;box-shadow:0 0 0 5px #d31f26,0 0 10px 10px #d31f26,0 0 0 10px #d31f26}100%{box-shadow:0 0 0 5px #d31f26,0 0 10px 10px #d31f26,0 0 0 10px #1fd3ba;transform:scale(1.5);opacity:0}}

  @media (max-width: 767.98px){
    .section-top-spacing {
        padding-top: 80px;
    }
  }
    .contact-whatsapp {
    width: 50px;
    position: fixed;
    bottom: 150px;
    left: 15px;
    z-index: 9999;
    display: inline-block;
    animation: up-down 1s infinite;
}

@keyframes up-down {
    0% {transform:translateY(0px);}
    50% {transform:translateY(20px);}
    100% {transform:translateY(0px);}
    50% {margin-top:-20px;}
    100% {margin-top: 0px;}

}
 </style>
<a href="https://wa.me/<?php echo $headerrow['whatsapp']; ?>" class="whatsapp-fixed" target="_blank">
    <img src="https://www.sspsoftproindia.com/assets/img/whatsapp-icon.webp" class="contact-whatsapp" alt="Whatsapp Icon">
</a>
<a href="tel:<?php echo $headerrow['whatsapp']; ?>" target="_blank" class="btn-sonar">
    <img src="https://www.sspsoftproindia.com/assets/img/call-icon.webp" alt="Call Icon">
</a>





<!-- Latest compiled JavaScript -->
<script src="assets/js/jquery-3.7.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/aos.js"></script>
<script src="assets/js/owl.carousel.js"></script>
<script src="assets/js/carousel.js"></script>
<script src="assets/js/animation.js"></script>
<script src="assets/js/back-to-top-button.js"></script>
<script src="assets/js/preloader.js"></script>
<script src="assets/js/counter.js"></script>
</body>

</html>