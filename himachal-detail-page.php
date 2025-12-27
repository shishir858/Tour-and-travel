

<?php include('header.php'); ?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM himachal_packages WHERE id = $id";
$result = $conn->query($sql);
$himachalrow = $result->fetch_assoc();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="whatsapp-form.js"></script>

<!-- Modern Hero Section -->
<section class="hero-section position-relative" style="height: 420px; background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%), url('admin/html/<?php echo htmlspecialchars($himachalrow['image']); ?>') center center/cover no-repeat;">
  <div class="container h-100 position-relative">
    <div class="row h-100 align-items-center">
      <div class="col-lg-8 col-md-10 col-12 mx-auto text-center text-white" style="z-index:2;">
        <h1 class="display-4 fw-bold mb-3" style="text-shadow:0 2px 16px rgba(0,0,0,0.4)"><?php echo htmlspecialchars($himachalrow['title']); ?></h1>
        <p class="lead mb-4" style="text-shadow:0 2px 8px rgba(0,0,0,0.3)">Explore the Himachal Tours with us.</p>
        <a href="#enquiry-form" class="btn btn-lg btn-primary px-5 py-2 shadow">Enquire Now</a>
      </div>
    </div>
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.25);"></div>
  </div>
</section>

<!-- Quick Info Bar -->
<section class="quick-info-bar py-3 position-relative" style="margin-top:-40px; z-index:10;">
  <div class="container">
    <div class="row g-3 justify-content-center text-center">
      <div class="col-6 col-md-3">
        <div class="info-card-glass p-3 rounded-4 h-100 shadow-sm">
          <div class="icon-circle mb-2 bg-primary bg-gradient text-white mx-auto"><i class="fa fa-clock fa-lg"></i></div>
          <div class="fw-bold text-secondary">Duration</div>
          <div class="fs-5 fw-semibold mt-1"><?php echo htmlspecialchars($himachalrow['duration']); ?></div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="info-card-glass p-3 rounded-4 h-100 shadow-sm">
          <div class="icon-circle mb-2 bg-success bg-gradient text-white mx-auto"><i class="fa fa-user fa-lg"></i></div>
          <div class="fw-bold text-secondary">Persons</div>
          <div class="fs-5 fw-semibold mt-1"><?php echo htmlspecialchars($himachalrow['persons']); ?></div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="info-card-glass p-3 rounded-4 h-100 shadow-sm">
          <div class="icon-circle mb-2 bg-info bg-gradient text-white mx-auto"><i class="fa fa-globe fa-lg"></i></div>
          <div class="fw-bold text-secondary">Tour Type</div>
          <div class="fs-5 fw-semibold mt-1">Private Tour</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <a href="https://wa.me/<?php echo isset($headerrow['whatsapp']) ? htmlspecialchars($headerrow['whatsapp']) : ''; ?>" target="_blank" class="info-card-glass p-3 rounded-4 h-100 d-block text-decoration-none shadow-sm">
          <div class="icon-circle mb-2 bg-success bg-gradient text-white mx-auto"><i class="fab fa-whatsapp fa-lg"></i></div>
          <div class="fw-bold text-secondary">WhatsApp</div>
          <div class="fs-5 fw-semibold mt-1 text-success">Let's Talk</div>
        </a>
      </div>
    </div>
  </div>
</section>
<style>
.quick-info-bar {
  background: rgba(255,255,255,0.7);
  backdrop-filter: blur(8px);
  border-radius: 1.5rem;
  box-shadow: 0 4px 24px 0 rgba(0,0,0,0.07);
}
.info-card-glass {
  background: rgba(255,255,255,0.85);
  border: 1px solid rgba(200,200,200,0.18);
  transition: transform 0.2s, box-shadow 0.2s;
}
.info-card-glass:hover {
  transform: translateY(-4px) scale(1.03);
  box-shadow: 0 8px 32px 0 rgba(0,0,0,0.12);
}
.icon-circle {
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  font-size: 1.5rem;
  box-shadow: 0 2px 8px 0 rgba(0,0,0,0.10);
}
@media (max-width: 767px) {
  .quick-info-bar { border-radius: 0.75rem; }
  .info-card-glass { border-radius: 1rem; }
}
</style>

<!-- Main Content with Left-Right Layout -->
<section class="py-5">
  <div class="container">
    <div class="row">
      <!-- Left: Main Tour Content -->
      <div class="col-lg-8 col-12 mb-4 mb-lg-0">
        <div class="card shadow-sm border-0 mb-4">
          <img style="height:350px; width:100%; object-fit:cover;" src="admin/html/<?php echo htmlspecialchars($himachalrow['image']); ?>" alt="Tour Image" class="card-img-top rounded-top">
          <div class="card-body">
            <h1 class="card-title mb-3"><?php echo htmlspecialchars($himachalrow['title']); ?></h1>
            <div class="d-flex flex-wrap mb-3">
              <div class="me-4 mb-2"><i class="fa fa-clock text-primary me-1"></i> <?php echo htmlspecialchars($himachalrow['duration']); ?></div>
              <div class="me-4 mb-2"><i class="fa fa-user text-primary me-1"></i> <?php echo htmlspecialchars($himachalrow['persons']); ?></div>
              <div class="mb-2"><i class="fa fa-map-marker-alt text-primary me-1"></i> <?php echo htmlspecialchars($himachalrow['places_covered']); ?></div>
            </div>
            <p class="card-text mb-3"><?php echo nl2br(htmlspecialchars($himachalrow['description'])); ?></p>
            <a href="https://wa.me/<?php echo isset($headerrow['whatsapp']) ? htmlspecialchars($headerrow['whatsapp']) : ''; ?>" class="btn btn-success mb-3" target="_blank"><i class="fab fa-whatsapp"></i> Let's Talk on WhatsApp</a>
          </div>
        </div>
        <!-- Itinerary Section -->
        <div class="card shadow-sm border-0 mb-4">
          <div class="card-body">
            <h4 class="mb-4 text-primary">Itinerary</h4>
            <div class="accordion" id="customItinerary">
              <?php
              for ($i = 1; $i <= 17; $i++) {
                $headingKey = "itinery_heading_" . $i;
                $descKey = "itinery_description_" . $i;
                if (!empty($himachalrow[$headingKey])) {
                  echo '<div class="accordion-item mb-3 border rounded">';
                  echo '<h2 class="accordion-header" id="heading' . $i . '">';
                  echo '<button class="accordion-button d-flex align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $i . '" aria-expanded="' . ($i === 1 ? 'true' : 'false') . '" aria-controls="collapse' . $i . '">';
                  echo '<div class="me-3 px-3 py-1 bg-orange text-white fw-bold rounded-start" style="min-width: 100px;">Day ' . str_pad($i, 2, '0', STR_PAD_LEFT) . ' :</div>';
                  echo '<div class="fw-semibold text-dark">' . htmlspecialchars($himachalrow[$headingKey]) . '</div>';
                  echo '</button>';
                  echo '</h2>';
                  echo '<div id="collapse' . $i . '" class="accordion-collapse collapse ' . ($i === 1 ? 'show' : '') . '" data-bs-parent="#customItinerary">';
                  echo '<div class="accordion-body">' . nl2br(htmlspecialchars($himachalrow[$descKey])) . '</div>';
                  echo '</div>';
                  echo '</div>';
                }
              }
              ?>
            </div>
          </div>
        </div>
        <!-- Included and Excluded -->
        <!-- <div class="card shadow-sm border-0 mb-4">
          <div class="card-body">
            <h5 class="mb-3 text-primary">Included and Excluded</h5>
            <div class="row">
              <div class="col-md-6">
                <h6 class="fw-bold mb-3">Inclusions</h6>
                <ul class="list-unstyled">
                  <li class="mb-2 text-muted"><i class="text-success me-2 fa fa-check"></i>Convenient residence in hotels or other special lodging facilities.</li>
                  <li class="mb-2 text-muted"><i class="text-success me-2 fa fa-check"></i>Transport between holidays in buses, cars and trains.</li>
                  <li class="mb-2 text-muted"><i class="text-success me-2 fa fa-check"></i>Tours to popular tourist sites and attractions</li>
                  <li class="mb-2 text-muted"><i class="text-success me-2 fa fa-check"></i>Planned trips to experience the local culture and learn about landmarks in a region.</li>
                  <li class="mb-2 text-muted"><i class="text-success me-2 fa fa-check"></i>Dinner and Breakfast (As per the itinerary to be served at hotel or other services).</li>
                </ul>
              </div>
              <div class="col-md-6">
                <h6 class="fw-bold mb-3">Exclusions</h6>
                <ul class="list-unstyled">
                  <li class="mb-2 text-muted"><i class="text-danger me-2 fa fa-times"></i>Other tours or experiences besides those facilitated by a package.</li>
                  <li class="mb-2 text-muted"><i class="text-danger me-2 fa fa-times"></i>Personal Expenses (Anything which is not mentioned)</li>
                  <li class="mb-2 text-muted"><i class="text-danger me-2 fa fa-times"></i>Only offers coverage for emergencies, health and trip cancellations.</li>
                </ul>
              </div>
            </div>
          </div>
        </div> -->
        <!-- Enquiry Form -->
        <div class="card shadow-sm border-0 mb-4" id="enquiry-form">
          <div class="card-body">
            <h3 class="mb-4 text-center text-primary">📩 Send an Enquiry</h3>
            <form action="inner-page-mail.php" method="POST">
              <div class="row g-3">
                <div class="col-md-6">
                  <input type="text" name="fname" class="form-control form-control-lg" placeholder="Your Name" required>
                </div>
                <div class="col-md-6">
                  <input type="email" name="email" class="form-control form-control-lg" placeholder="Your Email" required>
                </div>
                <div class="col-md-6">
                  <input type="tel" name="phone" class="form-control form-control-lg" placeholder="Your Phone" required>
                </div>
                <div class="col-md-6">
                  <input type="text" name="subject" class="form-control form-control-lg" placeholder="Subject">
                </div>
                <div class="col-12">
                  <textarea name="msg" class="form-control form-control-lg" rows="4" placeholder="Your Message" required></textarea>
                </div>
                <div class="col-12 text-center mt-3">
                  <button type="submit" class="btn btn-primary btn-lg px-5">Submit Enquiry</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Right: Recommended Packages -->
      <div class="col-lg-4 col-12">
        <div class="sticky-top" style="top: 100px;">
          <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
              <h5 class="mb-0">Recommended Packages</h5>
            </div>
            <ul class="list-group list-group-flush">
              <?php
              $sql = "SELECT id, title, image, duration FROM himachal_packages WHERE id != $id ORDER BY RAND() LIMIT 4";
              $result = $conn->query($sql);
              while ($row = $result->fetch_assoc()) {
                echo '<li class="list-group-item d-flex align-items-center">';
                echo '<img src="admin/html/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['title']) . '" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; margin-right: 15px;">';
                echo '<div>';
                echo '<a href="himachal-detail-page.php?id=' . $row['id'] . '" class="fw-bold text-decoration-none text-dark">' . htmlspecialchars($row['title']) . '</a><br>';
                echo '<span class="text-muted"><i class="fa fa-clock me-1"></i> ' . htmlspecialchars($row['duration']) . '</span>';
                echo '</div>';
                echo '</li>';
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Carousel of Other Himachal Packages -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="mb-4 text-center">Other Himachal Packages</h2>
    <div class="owl-carousel owl-theme">
      <?php
      $sql = "SELECT id, title, image, duration, persons, places_covered, description FROM himachal_packages WHERE id != $id ORDER BY RAND() LIMIT 8";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()) {
        $desc_words = explode(' ', strip_tags($row['description']));
        $desc_limited = htmlspecialchars(implode(' ', array_slice($desc_words, 0, 12)));
        echo '<div class="item">';
        echo '<div class="card h-100 shadow-sm">';
        echo '<img src="admin/html/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['title']) . '" class="card-img-top" style="height:200px; object-fit:cover;">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>';
        // echo '<p class="card-text">' . $desc_limited . '</p>';
        echo '<div class="mb-2"><i class="fa fa-clock me-1"></i> ' . htmlspecialchars($row['duration']) . ' | <i class="fa fa-user me-1"></i> ' . htmlspecialchars($row['persons']) . '</div>';
        // echo '<div class="mb-2"><i class="fa fa-map-marker-alt me-1"></i> ' . htmlspecialchars($row['places_covered']) . '</div>';
        echo '<a href="himachal-detail-page.php?id=' . $row['id'] . '" class="btn btn-outline-primary btn-sm mt-2">View Details</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
      ?>
    </div>
  </div>
</section>

<!-- Owl Carousel JS (ensure jQuery is loaded before this) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/owl.carousel.js"></script>
<script>
$(document).ready(function(){
  if ($.fn.owlCarousel) {
    $(".owl-carousel").owlCarousel({
      loop:true,
      margin:20,
      nav:true,
      dots:true,
      responsive:{
        0:{items:1},
        600:{items:2},
        1000:{items:3}
      }
    });
  } else {
    console.error('OwlCarousel plugin not loaded.');
  }
});
</script>
<?php include('footer.php'); ?>