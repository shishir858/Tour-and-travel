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
                      url(assets/images/inner-page-bredcrumb.avif);
    background-size: cover;
    background-position: center;
    height: 350px;" class="sub_banner_con position-relative" >
        <div class="container position-relative">
            <div class="row" style="background-image:url('')">
                <div class="col-xl-6 col-md-8 col-12 mx-auto">
                    <div class="sub_banner_content mt-5"  data-aos="fade-up">
                        <h1 class="text-white text-center">Gallery</h1>
                        <!-- <p class="text-white text-size-16">Quis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore noulla pariatur ccaecat curidatat aero.</p> -->
                        <div class="box text-center">
                            <a href="index.php" class="text-decoration-none">
                                <span class="mb-0">Home</span>
                            </a>|
                            <i class="arrow fa-solid fa-arrow-right"></i>
                            <span class="mb-0 box_span">Our Gallery</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


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
<?php include('footer.php')?>
