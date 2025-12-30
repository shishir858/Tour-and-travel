<?php require('header.php'); ?>
<!-- Swiper CSS -->
<style>
    .places {
        padding-top: 30px;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


<!-- Banner -->
<section class="banner-con position-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 mx-auto">
                <div class="banner_content text-center" data-aos="fade-up">
                    <h3 class="text-white">Tourist Drivers India Private Tours</h3>
                    <h1 class="text-white">Explore India with Our Exclusive Private Tour Packages</h1>
                    <div class="banner-box">
                        <form action="banner-email.php" method="POST">
                            <div class="form-group float-left mb-0">
                                <div class="upper">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <label for="destination">Destination</label>
                                </div>
                                <input type="text" class="form_style" id="destination" name="destination" placeholder="Destination">
                            </div>

                            <div class="form-group float-left mb-0">
                                <div class="upper">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <label for="date">Date</label>
                                </div>
                                <input type="date" class="form_style" id="date" name="date">
                            </div>

                            <div class="form-group float-left mb-0">
                                <div class="upper">
                                    <i class="fa-solid fa-users"></i>
                                    <label for="people">People</label>
                                </div>
                                <input type="text" class="form_style" id="people" name="people" placeholder="4 People">
                            </div>

                            <div class="form-group float-left mb-0">
                                <div class="upper">
                                    <i class="fa-solid fa-phone"></i>
                                    <label for="number">Phone Number</label>
                                </div>
                                <input type="tel" class="form_style" id="number" name="number" placeholder="Enter phone number">
                            </div>

                            <div class="form-group float-left mb-0 mt-2">
                                <div class="upper">
                                    <i class="fa-solid fa-comment-dots"></i>
                                    <label for="remark">Remark</label>
                                </div>
                                <textarea class="form_style" id="remark" name="remark" style="border-radius:10px; border:none;" placeholder="Add any remarks here..." rows="2"></textarea>
                            </div>
                            <button type="submit" style="margin-top:37px!important;">Book Now</button>

                        </form>


                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-1 mx-auto">
                <a href="#dropdown" class="top-btn text-center">
                    <figure class="banner-dropdownimage mb-0">
                        <img src="./assets/images/banner-dropdownimage.png" class="img-fluid" alt="image">
                    </figure>
                </a>
            </div>
        </div>
    </div>
</section>
</div>
<!-- Explore -->
<section class="explore-con" id="dropdown">
    <div class="container-fluid">
        <div class="row">
            <div class="explore_content" data-aos="fade-up">
                <h6>Trending Tour</h6>
                <h2>Trending Tour Packages</h2>
            </div>
        </div>
        <style>
            .equal {
                height: 350px;
                object-fit: cover;
            }
        </style>
        <div class="row" data-aos="fade-up">
            <div class="owl-carousel">
                <div class="item">
                    <div class="explore-box">
                        <figure class="image mb-0">
                            <img src="./assets/images/taj-mahal.avif" alt="image" class="img-fluid equal">
                        </figure>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <span class="text-white">5.0</span>
                        </div>
                        <div class="content">
                            <div class="text">
                                <!-- <div class="place">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="text-white">Agra</span>
                                </div> -->
                                <h4 class="text-white mb-0">Taj Mahal</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="explore-box">
                        <figure class="image mb-0">
                            <img src="./assets/images/mathura-vrindavan.webp" alt="image" class="img-fluid equal">
                        </figure>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <span class="rate text-white">5.0</span>
                        </div>
                        <div class="content">
                            <div class="text">
                                <!-- <div class="place">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="text-white">Mathura Vrindavan</span>
                                </div> -->
                                <h4 class="text-white mb-0">Mathura Vrindavan</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="explore-box">
                        <figure class="image mb-0">
                            <img src="./assets/images/trending-tours/amarnath.jpg" alt="image" class="img-fluid equal">
                        </figure>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <span class="rate text-white">5.0</span>
                        </div>
                        <div class="content">
                            <div class="text">
                                <!-- <div class="place">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="text-white">15 Places</span>
                                </div> -->
                                <h4 class="text-white mb-0">Amarnath Yatra</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="explore-box">
                        <figure class="image mb-0">
                            <img src="./assets/images/trending-tours/chardham.jpg" alt="image" class="img-fluid equal">
                        </figure>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <span class="rate text-white">5.0</span>
                        </div>
                        <div class="content">
                            <div class="text">
                                <!-- <div class="place">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="text-white">C</span>
                                </div> -->
                                <h4 class="text-white mb-0">Chardham Yatra</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="explore-box">
                        <figure class="image mb-0">
                            <img src="./assets/images/trending-tours/kashmir.webp" alt="image" class="img-fluid equal">
                        </figure>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <span class="rate text-white">4.5</span>
                        </div>
                        <div class="content">
                            <div class="text">
                                <!-- <div class="place">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span class="text-white">16 Places</span>
                                </div> -->
                                <h4 class="text-white mb-0">Kashmir</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="explore-box">
                        <figure class="image mb-0">
                            <img src="./assets/images/trending-tours/uttrakhand.jpg" alt="image"
                                class="img-fluid equal">
                        </figure>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <span class="rate text-white">3.8</span>
                        </div>
                        <div class="content">
                            <!-- <div class="place">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="text-white">17 Places</span>
                            </div> -->
                            <h4 class="text-white mb-0">Uttrakhand</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About -->
<section class="about-con position-relative">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-12 text-lg-left text-center">
                <div class="about_wrapper position-relative" data-aos="zoom-in">
                    <figure class="about-image mb-0">
                        <img src="./assets/images/about-us-image.avif" style="max-width: 90%;" alt="image"
                            class="img-fluid">
                    </figure>
                    <!-- <figure class="about-locationimage mb-0">
                            <img src="./assets/images/about-locationimage.png" alt="image" class="img-fluid">
                        </figure> -->
                    <!-- <div class="box" data-aos="fade-up">
                            <div class="images">
                                <figure class="about-personimage1 mb-0 ml-0">
                                    <img src="./assets/images/about-personimage1.jpg" alt="image" class="img-fluid">
                                </figure>
                                <figure class="about-personimage2 mb-0">
                                    <img src="./assets/images/about-personimage2.jpg" alt="image" class="img-fluid">
                                </figure>
                                <figure class="about-personimage3 mb-0">
                                    <img src="./assets/images/about-personimage3.jpg" alt="image" class="img-fluid">
                                </figure>
                            </div>
                            <div class="text">
                                <span class="value"><span class="numb counter">156</span>+</span>
                                <span class="review">Satisfied Clients</span>
                            </div>
                        </div> -->
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="about_content" data-aos="fade-up">
                    <h6>About Us</h6>
                    <h2>Your Gateway to Indian Adventures</h2>
                    <p class="text-size-16 text">
                        We specialize in personalized private tours across India – from the royal palaces of Rajasthan
                        and the iconic Taj Mahal
                        to the spiritual serenity of Chardham and Amarnath Yatra. With decades of experience, we ensure
                        each journey is comfortable,
                        memorable, and truly unforgettable.
                    </p>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <span class="value"><span class="counter">15</span>k</span>
                            <p class="text-size-14 mb-0">Happy Travelers</p>
                        </li>
                        <li>
                            <span class="value"><span class="counter">5</span>+</span>
                            <p class="text-size-14 mb-0">Awards & Recognitions</p>
                        </li>
                        <li>
                            <span class="value"><span class="counter">14</span>+</span>
                            <p class="text-size-14 mb-0">Years of Experience</p>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Golden Triangle section -->
<section class="place-con position-relative pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <div class="place_content text-center" data-aos="fade-up">
                    <h6 class="places">Best Places</h6>
                    <h2>Golden Triangle Private Tours
                    </h2>
                </div>
            </div>
        </div>
        <div class="row" data-aos="fade-up">
            <?php

            $sql = "SELECT * FROM golden_triangle";
            $result = $conn->query($sql);



            if ($result->num_rows > 0) {
                echo '<div class="owl-carousel owl-theme">';
                while ($goldentrianglerow = $result->fetch_assoc()) {
                    // Sanitize and prepare fields
                    $id = htmlspecialchars($goldentrianglerow["id"]);

                    $image = htmlspecialchars($goldentrianglerow["image"]);
                    $duration = htmlspecialchars($goldentrianglerow["duration"]);
                    $persons = htmlspecialchars($goldentrianglerow["persons"]);
                    $title = htmlspecialchars($goldentrianglerow["title"]);

                    // Limit places_covered to 5 words
                    $places = htmlspecialchars($goldentrianglerow["places_covered"]);
                    $places_words = explode(' ', $places);
                    $places_limited = implode(' ', array_slice($places_words, 0, 5));

                    // Limit description to 10 words
                    $description = strip_tags($goldentrianglerow["description"]);
                    $desc_words = explode(' ', $description);
                    $desc_limited = htmlspecialchars(implode(' ', array_slice($desc_words, 0, 10)));

                    echo '<div class="item">
            <div class="place-box">
                <figure class="image mb-0">
                    <img style="height:250px; object-fit:cover;" src="' . $image . '" alt="image" class="img-fluid">
                </figure>
                <div class="lower_content">
                    <div class="content">
                        <div class="calendar">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span class="day">' . $duration . '</span>
                        </div>
                        <div class="people">
                            <i class="fa-solid fa-user"></i>
                            <span class="person">' . $persons . '</span>
                        </div>
                    </div>
                    <div>
                        <span class="person">' . $places_limited . '</span>
                    </div>
                    <a href="golden-triangle-detail-page.php?id=' . $id . '" class="text-decoration-none">
                        <h4>' . $title . '</h4>';

                    if (!empty($goldentrianglerow["description"])) {
                        echo '<p>' . $desc_limited . '</p>';
                    }

                    echo '</a>
                    <div class="value">
                        <a href="tel:8800608559" class="text-decoration-none book_now">Call Now<i class="fa-solid fa-arrow-right"></i></a>
                        <a href="#" data-toggle="modal" data-target="#blog-model-1" class="text-decoration-none book_now">Book Now<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>';
                }
                echo '</div>';
            } else {
                echo "No packages available.";
            }
            ?>



        </div>
    </div>
</section>

<!-- tajmahal_tours section -->
<section class="place-con position-relative pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <div class="place_content text-center" data-aos="fade-up">
                    <h6>Best Places</h6>
                    <h2>Tajmahal Tours
                    </h2>
                </div>
            </div>
        </div>
        <div class="row" data-aos="fade-up">
            <?php

            $sql = "SELECT * FROM tajmahal_tours";
            $result = $conn->query($sql);



            if ($result->num_rows > 0) {
                echo '<div class="owl-carousel owl-theme">';
                while ($goldentrianglerow = $result->fetch_assoc()) {
                    // Sanitize and prepare fields
                    $id = htmlspecialchars($goldentrianglerow["id"]);

                    $image = htmlspecialchars($goldentrianglerow["image"]);
                    $duration = htmlspecialchars($goldentrianglerow["duration"]);
                    $persons = htmlspecialchars($goldentrianglerow["persons"]);
                    $title = htmlspecialchars($goldentrianglerow["title"]);

                    // Limit places_covered to 5 words
                    $places = htmlspecialchars($goldentrianglerow["places_covered"]);
                    $places_words = explode(' ', $places);
                    $places_limited = implode(' ', array_slice($places_words, 0, 5));

                    // Limit description to 10 words
                    $description = strip_tags($goldentrianglerow["description"]);
                    $desc_words = explode(' ', $description);
                    $desc_limited = htmlspecialchars(implode(' ', array_slice($desc_words, 0, 10)));

                    echo '<div class="item">
            <div class="place-box">
                <figure class="image mb-0">
                    <img style="height:250px; object-fit:cover;" src="' . $image . '" alt="image" class="img-fluid">
                </figure>
                <div class="lower_content">
                    <div class="content">
                        <div class="calendar">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span class="day">' . $duration . '</span>
                        </div>
                        <div class="people">
                            <i class="fa-solid fa-user"></i>
                            <span class="person">' . $persons . '</span>
                        </div>
                    </div>
                    <div>
                        <span class="person">' . $places_limited . '</span>
                    </div>
                    <a href="tajmahal-detail-page.php?id=' . $id . '" class="text-decoration-none">
                        <h4>' . $title . '</h4>';

                    if (!empty($goldentrianglerow["description"])) {
                        echo '<p>' . $desc_limited . '</p>';
                    }

                    echo '</a>
                    <div class="value">
                        <a href="tel:8800608559" class="text-decoration-none book_now">Call Now<i class="fa-solid fa-arrow-right"></i></a>
                        <a href="#" data-toggle="modal" data-target="#blog-model-1" class="text-decoration-none book_now">Book Now<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>';
                }
                echo '</div>';
            } else {
                echo "No packages available.";
            }
            ?>



        </div>
    </div>
</section>



<!-- Pilgrimage tours -->
<section class="place-con position-relative pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <div class="place_content text-center" data-aos="fade-up">
                    <h6>Best Places</h6>
                    <h2>Pilgrimage Tours
                    </h2>
                </div>
            </div>
        </div>
        <div class="row" data-aos="fade-up">
            <?php

            $sql = "SELECT * FROM pilgrimage_package";
            $result = $conn->query($sql);



            if ($result->num_rows > 0) {
                echo '<div class="owl-carousel owl-theme">';
                while ($goldentrianglerow = $result->fetch_assoc()) {
                    // Sanitize and prepare fields
                    $id = htmlspecialchars($goldentrianglerow["id"]);

                    $image = htmlspecialchars($goldentrianglerow["image"]);
                    $duration = htmlspecialchars($goldentrianglerow["duration"]);
                    $persons = htmlspecialchars($goldentrianglerow["persons"]);
                    $title = htmlspecialchars($goldentrianglerow["title"]);

                    // Limit places_covered to 5 words
                    $places = htmlspecialchars($goldentrianglerow["places_covered"]);
                    $places_words = explode(' ', $places);
                    $places_limited = implode(' ', array_slice($places_words, 0, 5));

                    // Limit description to 10 words
                    $description = strip_tags($goldentrianglerow["description"]);
                    $desc_words = explode(' ', $description);
                    $desc_limited = htmlspecialchars(implode(' ', array_slice($desc_words, 0, 10)));

                    echo '<div class="item">
            <div class="place-box">
                <figure class="image mb-0">
                    <img style="height:250px; object-fit:cover;" src="' . $image . '" alt="image" class="img-fluid">
                </figure>
                <div class="lower_content">
                    <div class="content">
                        <div class="calendar">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span class="day">' . $duration . '</span>
                        </div>
                        <div class="people">
                            <i class="fa-solid fa-user"></i>
                            <span class="person">' . $persons . '</span>
                        </div>
                    </div>
                    <div>
                        <span class="person">' . $places_limited . '</span>
                    </div>
                    <a href="pilgrimage-detail-page.php?id=' . $id . '" class="text-decoration-none">
                        <h4>' . $title . '</h4>';

                    if (!empty($goldentrianglerow["description"])) {
                        echo '<p>' . $desc_limited . '</p>';
                    }

                    echo '</a>
                    <div class="value">
                        <a href="tel:8800608559" class="text-decoration-none book_now">Call Now<i class="fa-solid fa-arrow-right"></i></a>
                        <a href="#" data-toggle="modal" data-target="#blog-model-1" class="text-decoration-none book_now">Book Now<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>';
                }
                echo '</div>';
            } else {
                echo "No packages available.";
            }
            ?>



        </div>
    </div>
</section>


<!-- Himachal tours -->
<section class="place-con position-relative pb-5">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <div class="place_content text-center" data-aos="fade-up">
                    <h6>Best Places</h6>
                    <h2>Himachal Pradesh Tours
                    </h2>
                </div>
            </div>
        </div>
        <div class="row" data-aos="fade-up">
            <?php

            $sql = "SELECT * FROM himachal_packages";
            $result = $conn->query($sql);



            if ($result->num_rows > 0) {
                echo '<div class="owl-carousel owl-theme">';
                while ($goldentrianglerow = $result->fetch_assoc()) {
                    // Sanitize and prepare fields
                    $id = htmlspecialchars($goldentrianglerow["id"]);

                    $image = htmlspecialchars($goldentrianglerow["image"]);
                    $duration = htmlspecialchars($goldentrianglerow["duration"]);
                    $persons = htmlspecialchars($goldentrianglerow["persons"]);
                    $title = htmlspecialchars($goldentrianglerow["title"]);

                    // Limit places_covered to 5 words
                    $places = htmlspecialchars($goldentrianglerow["places_covered"]);
                    $places_words = explode(' ', $places);
                    $places_limited = implode(' ', array_slice($places_words, 0, 5));

                    // Limit description to 10 words
                    $description = strip_tags($goldentrianglerow["description"]);
                    $desc_words = explode(' ', $description);
                    $desc_limited = htmlspecialchars(implode(' ', array_slice($desc_words, 0, 10)));

                    echo '<div class="item">
            <div class="place-box">
                <figure class="image mb-0">
                    <img style="height:250px; object-fit:cover;" src="' . $image . '" alt="image" class="img-fluid">
                </figure>
                <div class="lower_content">
                    <div class="content">
                        <div class="calendar">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span class="day">' . $duration . '</span>
                        </div>
                        <div class="people">
                            <i class="fa-solid fa-user"></i>
                            <span class="person">' . $persons . '</span>
                        </div>
                    </div>
                    <div>
                        <span class="person">' . $places_limited . '</span>
                    </div>
                    <a href="/himachal-detail-page.php?id=' . $id . '" class="text-decoration-none">
                        <h4>' . $title . '</h4>';

                    if (!empty($goldentrianglerow["description"])) {
                        echo '<p>' . $desc_limited . '</p>';
                    }

                    echo '</a>
                    <div class="value">
                        <a href="tel:8800608559" class="text-decoration-none book_now">Call Now<i class="fa-solid fa-arrow-right"></i></a>
                        <a href="#" data-toggle="modal" data-target="#blog-model-1" class="text-decoration-none book_now">Book Now<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>';
                }
                echo '</div>';
            } else {
                echo "No packages available.";
            }
            ?>



        </div>
    </div>
</section>

<!--15 Days Rajasthan Tours Package-->
<section class="place-con position-relative pt-0">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <div class="place_content text-center" data-aos="fade-up">
                    <h6>Best Places</h6>
                    <h2>15 Days Rajasthan Tours Package
                    </h2>
                </div>
            </div>
        </div>
        <div class="row" data-aos="fade-up">
            <?php

            $sql = "SELECT * FROM rajasthan_tour";
            $result = $conn->query($sql);



            if ($result->num_rows > 0) {
                echo '<div class="owl-carousel owl-theme">';
                while ($goldentrianglerow = $result->fetch_assoc()) {
                    // Sanitize and prepare fields
                    $id = htmlspecialchars($goldentrianglerow["id"]);

                    $image = htmlspecialchars($goldentrianglerow["image"]);
                    $duration = htmlspecialchars($goldentrianglerow["duration"]);
                    $persons = htmlspecialchars($goldentrianglerow["persons"]);
                    $title = htmlspecialchars($goldentrianglerow["title"]);

                    // Limit places_covered to 5 words
                    $places = htmlspecialchars($goldentrianglerow["places_covered"]);
                    $places_words = explode(' ', $places);
                    $places_limited = implode(' ', array_slice($places_words, 0, 5));

                    // Limit description to 10 words
                    $description = strip_tags($goldentrianglerow["description"]);
                    $desc_words = explode(' ', $description);
                    $desc_limited = htmlspecialchars(implode(' ', array_slice($desc_words, 0, 10)));

                    echo '<div class="item">
            <div class="place-box">
                <figure class="image mb-0">
                    <img style="height:250px; object-fit:cover;" src="' . $image . '" alt="image" class="img-fluid">
                </figure>
                <div class="lower_content">
                    <div class="content">
                        <div class="calendar">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span class="day">' . $duration . '</span>
                        </div>
                        <div class="people">
                            <i class="fa-solid fa-user"></i>
                            <span class="person">' . $persons . '</span>
                        </div>
                    </div>
                    <div>
                        <span class="person">' . $places_limited . '</span>
                    </div>
                    <a href="/rajasthan-detail-page.php?id=' . $id . '" class="text-decoration-none">
                        <h4>' . $title . '</h4>';

                    if (!empty($goldentrianglerow["description"])) {
                        echo '<p>' . $desc_limited . '</p>';
                    }

                    echo '</a>
                    <div class="value">
                        <a href="tel:8800608559" class="text-decoration-none book_now">Call Now<i class="fa-solid fa-arrow-right"></i></a>
                        <a href="#" data-toggle="modal" data-target="#blog-model-1" class="text-decoration-none book_now">Book Now<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>';
                }
                echo '</div>';
            } else {
                echo "No packages available.";
            }
            ?>



        </div>
    </div>
</section>
<style>
    .custome-img-fluid {
        height: 250px;
    }
</style>

<!-- Service -->
<section class="service-con position-relative">
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <div class="service_content text-center" data-aos="fade-up">
                    <h6>features</h6>
                    <h2>Our Best Features</h2>
                </div>
            </div>
        </div>
        <div class="row" data-aos="fade-up">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="service-box">
                    <figure class="icon">
                        <img src="./assets/images/service-icon1.png" alt="image" class="img-fluid">
                    </figure>
                    <h4>Exciting Journeys</h4>
                    <p class="text-size-16">Embark on thrilling expeditions and immerse yourself in unforgettable
                        experiences.</p>
                    <!-- <a href="./service.html" class="text-decoration-none learn_more">Learn More<i
                            class="fa-solid fa-arrow-right"></i></a> -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="service-box">
                    <figure class="icon">
                        <img src="./assets/images/service-icon2.png" alt="image" class="img-fluid">
                    </figure>
                    <h4>Expert Guides</h4>
                    <p class="text-size-16">Our seasoned guides ensure a safe and enriching adventure, tailored to
                        your needs.</p>
                    <!-- <a href="./service.html" class="text-decoration-none learn_more">Learn More<i
                            class="fa-solid fa-arrow-right"></i></a> -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="service-box">
                    <figure class="icon">
                        <img src="./assets/images/service-icon3.png" alt="image" class="img-fluid">
                    </figure>
                    <h4>Personalized Packages</h4>
                    <p class="text-size-16">Choose from a variety of custom packages designed to suit every
                        traveler's desire.</p>
                    <!-- <a href="./service.html" class="text-decoration-none learn_more">Learn More<i
                            class="fa-solid fa-arrow-right"></i></a> -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="service-box">
                    <figure class="icon">
                        <img src="./assets/images/service-icon4.png" alt="image" class="img-fluid">
                    </figure>
                    <h4>Scenic Trails</h4>
                    <p class="text-size-16">Explore breathtaking trails and discover the beauty of untouched nature.
                    </p>
                    <!-- <a href="./service.html" class="text-decoration-none learn_more">Learn More<i
                            class="fa-solid fa-arrow-right"></i></a> -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="service-box">
                    <figure class="icon">
                        <img src="./assets/images/service-icon5.png" alt="image" class="img-fluid">
                    </figure>
                    <h4>Family Adventures</h4>
                    <p class="text-size-16">Create lasting memories with family trips that are fun and suitable for
                        all ages.</p>
                    <!-- <a href="./service.html" class="text-decoration-none learn_more">Learn More<i
                            class="fa-solid fa-arrow-right"></i></a> -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="service-box">
                    <figure class="icon">
                        <img src="./assets/images/service-icon6.png" alt="image" class="img-fluid">
                    </figure>
                    <h4>Comprehensive Support</h4>
                    <p class="text-size-16">Receive a complete guide to make your adventure seamless and worry-free.
                    </p>
                    <!-- <a href="./service.html" class="text-decoration-none learn_more">Learn More<i
                            class="fa-solid fa-arrow-right"></i></a> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Join -->
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

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
<div class="container py-5">
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



<!-- Testimonial -->

<?php

$sql = "SELECT * FROM client_reviews ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<section class="testimonial-con position-relative">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="testimonial_wrapper position-relative" data-aos="zoom-in">
                    <figure class="testimonial-circle image mb-0">
                        <img src="./assets/images/testimonial-centerimage.jpg" alt="image" class="img-fluid">
                    </figure>
                    <figure class="testimonial-image1 image mb-0">
                        <img src="./assets/images/testimonial-image1.jpg" alt="image" class="img-fluid">
                    </figure>
                    <figure class="testimonial-image2 image mb-0">
                        <img src="./assets/images/testimonial-image2.jpg" alt="image" class="img-fluid">
                    </figure>
                    <figure class="testimonial-image3 image mb-0">
                        <img src="./assets/images/testimonial-image3.jpg" alt="image" class="img-fluid">
                    </figure>
                    <figure class="testimonial-image4 image mb-0">
                        <img src="./assets/images/testimonial-image4.jpg" alt="image" class="img-fluid">
                    </figure>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12 col-12">
                <div class="testimonial_contentwrapper" data-aos="fade-up">
                    <div class="testimonial_content">
                        <h6>Testimonials</h6>
                        <h2>What Our Customer Say About Us</h2>
                    </div>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $isFirst = true;
                            while ($reviewrow = $result->fetch_assoc()):
                            ?>
                                <div class="carousel-item <?php if ($isFirst) {
                                                                echo 'active';
                                                                $isFirst = false;
                                                            } ?>">
                                    <div class="testimonial-box">
                                        <div class="content-box">
                                            <p class="text-size-16">
                                                <?php echo htmlspecialchars($reviewrow['client_review']); ?>
                                            </p>
                                            <div class="content">
                                                <figure class="testimonial-quote">
                                                    <img src="./assets/images/testimonial-quote.png" alt="image"
                                                        class="img-fluid">
                                                </figure>
                                                <div class="designation-outer">
                                                    <span
                                                        class="name"><?php echo htmlspecialchars($reviewrow['client_name']); ?></span>
                                                    <span
                                                        class="review"><?php echo htmlspecialchars($reviewrow['client_location']); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>

                        <div class="pagination-outer">
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                data-slide="prev">
                                <i class="fa-solid fa-arrow-left"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                data-slide="next">
                                <i class="fa-solid fa-arrow-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    @media only screen and (max-width: 767px) {
        /* Styles for devices with width 767px and below (phones) */


        .custome-container-fluid {
            padding: 0px !important;
            margin: 0px !important;

        }
    }
</style>

<!-- <div class="container py-5">
  <h2 class="text-center mb-4">Gallery</h2>
  <div class="row">
    <?php


    // Fetch gallery images
    // $sql = "SELECT * FROM gallery ORDER BY id ASC";
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    //   while ($galleryrow = $result->fetch_assoc()) {
    //     echo '
    //       <div class="col-md-3 mb-4">
    //         <div class="card shadow-sm">
    //           <img  style="height:200px; object-fit:cover;" src="admin/html/' . $galleryrow["image_url"] . '" class="card-img-top" alt="Gallery Image">

    //        </div>
    //       </div>
    //
    //      ';
    //   }
    //  } else {
    //   echo '<p class="text-center">No images found.</p>';
    // }


    ?>
  </div>
</div> -->

<div class="container py-5">
    <div class="row">
        <div class="col-12 mx-auto">
            <div class="service_content text-center pb-4" data-aos="fade-up">
                <h6>Our Videos</h6>
                <h2>Our Videos Gallery</h2>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="ratio ratio-9x16">
                <blockquote class="instagram-media"
                    data-instgrm-permalink="https://www.instagram.com/reel/C7-r4Y0S1Ju/?utm_source=ig_embed&amp;utm_campaign=loading"
                    data-instgrm-version="14"></blockquote>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="ratio ratio-9x16">
                <blockquote class="instagram-media"
                    data-instgrm-permalink="https://www.instagram.com/reel/C7HCyn7ShlO/?utm_source=ig_embed&amp;utm_campaign=loading"
                    data-instgrm-version="14"></blockquote>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="ratio ratio-9x16">
                <blockquote class="instagram-media"
                    data-instgrm-permalink="https://www.instagram.com/reel/C_K207Kyuom/"
                    data-instgrm-version="14"></blockquote>
            </div>
        </div>
    </div>
</div>


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


<!-- Instagram Embed Script -->
<script async src="https://www.instagram.com/embed.js"></script>

<!-- Trigger Embed Rendering -->
<script>
    window.addEventListener("load", function() {
        if (window.instgrm) {
            window.instgrm.Embeds.process();
        }
    });
</script>
<div class="d-flex justify-content-center align-items-center bg-light py-3">
    <div id="TA_selfserveprop126" class="TA_selfserveprop">
        <ul id="iKJiU8UHX" class="TA_links jXc79ZG">
            <li id="hz9l8JkBRjv" class="KqQqqFQkNOX7"><a target="_blank" href="https://www.tripadvisor.in/Attraction_Review-g304551-d2350110-Reviews-Tourist_Drivers_India_Private_Tours-New_Delhi_National_Capital_Territory_of_Delhi.html"><img src="https://www.tripadvisor.in/img/cdsi/img2/branding/v2/Tripadvisor_lockup_horizontal_secondary_registered-11900-2.svg" alt="TripAdvisor" /></a></li>
        </ul>
    </div>
    <script async src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=126&amp;locationId=2350110&amp;lang=en_IN&amp;rating=true&amp;nreviews=5&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=false&amp;border=true&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>

    <div id="TA_certificateOfExcellence480" class="TA_certificateOfExcellence">
        <ul id="Jh3XixJWr" class="TA_links 5SV6Lnt23">
            <li id="RLAw2pKd5H" class="kx7hY3"><a target="_blank" href="https://www.tripadvisor.in/Attraction_Review-g304551-d2350110-Reviews-Tourist_Drivers_India_Private_Tours-New_Delhi_National_Capital_Territory_of_Delhi.html"><img src="https://static.tacdn.com/img2/travelers_choice/widgets/tchotel_2024_LL.png" alt="TripAdvisor" height="100" class="widCOEImg" id="CDSWIDCOELOGO" /></a></li>
        </ul>
    </div>
    <script async src="https://www.jscache.com/wejs?wtype=certificateOfExcellence&amp;uniq=480&amp;locationId=2350110&amp;lang=en_IN&amp;year=2024&amp;display_version=2" data-loadtrk onload="this.loadtrk=true"></script>

</div>


<!-- Add this CSS to fix the widget -->


<!-- Footer -->
<?php include "footer.php"; ?>