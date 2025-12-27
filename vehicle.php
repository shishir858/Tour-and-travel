<?php include('header.php');?>
<?php
// db connection

$sql = "SELECT * FROM contact_info LIMIT 1";
$result = $conn->query($sql);
$headerrow = $result->fetch_assoc();
?>
    <!-- Sub banner -->
    <section style="
    background-image: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.7) 100%), 
                      url(assets/images/travel.png);
    background-size: cover;
    background-position: center;
    height: 350px;" class="sub_banner_con position-relative" >
        <div class="container position-relative">
            <div class="row" style="background-image:url('')">
                <div class="col-xl-6 col-md-8 col-12 mx-auto">
                    <div class="sub_banner_content mt-5"  data-aos="fade-up">
                        <h1 class="text-white text-center">Our Vehicle</h1>
                        <!-- <p class="text-white text-size-16">Quis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore noulla pariatur ccaecat curidatat aero.</p> -->
                        <div class="box text-center">
                            <a href="index.php" class="text-decoration-none">
                                <span class="mb-0" style="color:white;">Home</span>
                            </a>|
                            <i class="arrow fa-solid fa-arrow-right" style="color:white;"></i>
                            <span class="mb-0 box_span" style="color:white;">Our Vehicle</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Contact Info -->
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
<div class="container pt-4" style="padding-top:50px; padding-bottom:50px;">
                      <h6 class="text-center">Our Vehicles</h6>

    <h2 class="text-center mb-5">Car Rental</h2>

    <div class="swiper mySwiper">
      <div class="swiper-wrapper">

        <!-- Slide 1 -->
        <div class="swiper-slide">
          <div class="card h-100">
            <img src="assets/vehicles/luxury-coaches.webp" class="card-img-top" alt="Luxury Urbania">
            <div class="card-body">
              <h5 class="card-title">Luxury Urbania / Coaches</h5>
              <p class="text-warning">Seating Capacity - 9</p>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="swiper-slide">
          <div class="card h-100">
            <img src="assets/vehicles/mini-coaches.webp" class="card-img-top" alt="Mini Coach">
            <div class="card-body">
              <h5 class="card-title">Mini Coach / Coaches</h5>
              <p class="text-warning">Seating Capacity - 22</p>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="swiper-slide">
          <div class="card h-100">
            <img src="assets/vehicles/volvo-coaches.webp" class="card-img-top" alt="Volvo Coach">
            <div class="card-body">
              <h5 class="card-title">Volvo / Coaches</h5>
              <p class="text-warning">Seating Capacity - 42</p>
            </div>
          </div>
        </div>

        <!-- Slide 4 -->
        <div class="swiper-slide">
          <div class="card h-100">
            <img src="assets/vehicles/swift-dezire.webp" class="card-img-top" alt="Toyota Innova">
            <div class="card-body">
              <h5 class="card-title">Swift Dzire / Economy Car</h5>
              <p class="text-warning">Seating Capacity - 3</p>
            </div>
          </div>
        </div>
        
        <div class="swiper-slide">
          <div class="card h-100">
            <img src="assets/vehicles/toyota-innova.webp" class="card-img-top" alt="Toyota Innova">
            <div class="card-body">
              <h5 class="card-title">Toyota Innova / SUV / MUV Cars</h5>
              <p class="text-warning">Seating Capacity - 6</p>
            </div>
          </div>
        </div>

      </div>

     
    </div>

    <!-- CTA Buttons -->
    <div class="text-center mt-4">
      <a href="vehicle.php" class="btn btn-dark me-2">See All</a>
      <a href="contact.php" class="btn " style="background-color:#F26D52;">Contact for Customized Tour</a>
    </div>
  </div>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const swiper = new Swiper('.mySwiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    autoplay: {
      delay: 3000, // Slide changes every 3 seconds
      disableOnInteraction: false, // Keeps autoplay running even after user interaction
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      576: {
        slidesPerView: 2,
      },
      992: {
        slidesPerView: 3,
      },
      1200: {
        slidesPerView: 4,
      },
    },
  });
</script>
<section class="join-con position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <div class="join_content text-center" data-aos="fade-up">
                    <h6 class="text-white">Come & Join Us</h6>
                    <h2 class="text-white">Making Adventure Tours and Activities Accessible and Affordable for
                        Everyone.</h2>
                    <a href="contact.php" class="text-decoration-none all_button">Book Now<i
                            class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include('footer.php')?>
