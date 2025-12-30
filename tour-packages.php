<?php include('header.php'); ?>
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
                        <h1 class="text-white text-center">Tour Packages</h1>
                        <!-- <p class="text-white text-size-16">Quis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore noulla pariatur ccaecat curidatat aero.</p> -->
                        <div class="box text-center">
                            <a href="index.php" class="text-decoration-none">
                                <span class="mb-0" style="color:white;">Home</span>
                            </a>|
                            <i class="arrow fa-solid fa-arrow-right" style="color:white;"></i>
                            <span class="mb-0 box_span" style="color:white;">Tour Packages</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- About -->
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
                    <a href="golden-triangle-detail-page.php?id='. $id .'" class="text-decoration-none">
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
                    <a href="tajmahal-detail-page.php?id='. $id .'" class="text-decoration-none">
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
                    <a href="pilgrimage-detail-page.php?id='. $id .'" class="text-decoration-none">
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
                    <a href="/himachal-detail-page.php?id='. $id .'" class="text-decoration-none">
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
                    <a href="/rajasthan-detail-page.php?id='. $id .'" class="text-decoration-none">
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
<!-- Footer -->
<?php include('footer.php') ?>