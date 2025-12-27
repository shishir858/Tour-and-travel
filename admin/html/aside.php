<?php include('connection.php'); ?>
<!-- Sidebar Start -->
<aside class="left-sidebar">
  <?php  
  $logo = "SELECT `logo` FROM `contact_info`";
$result = $conn->query($logo);
  if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()){
  ?>
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="dashboard.php" class="text-nowrap logo-img">
            <img style="margin-left:50px;margin-top:20px" src="../../<?php  echo $row['logo']; }}?>" width="100px" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="dashboard.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">COMPONENTS</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="header-changes.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Header info Changes</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="footer-changes.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Footer info Changes</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="add-meta-tags.php" aria-expanded="false">
                <span>
                  <i class="ti ti-tag"></i>
                </span>
                <span class="hide-menu">Add Meta Tags</span>
              </a>
            </li>
            <!--<li class="sidebar-item">
              <a class="sidebar-link" href="gallery-section.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Our Gallery Photos</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="video-gallery.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Our Video Gallery</span>
              </a>
            </li>-->
            <li class="sidebar-item">
              <a class="sidebar-link" href="add-golden-triangle.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>

                </span>
                <span class="hide-menu">Add Golden Triangle Packages</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="add-tajmahal-tours.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>

                </span>
                <span class="hide-menu">Add Tajmahal Tours</span>
              </a>
            </li>
             <li class="sidebar-item">
              <a class="sidebar-link" href="add-pilgrimage.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>

                </span>
                <span class="hide-menu">Add Pilgrimage Tours</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="add-himachal-package.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>

                </span>
                <span class="hide-menu">Add Himachal Tours</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="add-rajasthan-tour.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>

                </span>
                <span class="hide-menu">Add Rajasthan Tour</span>
              </a>
            </li>
            <!-- <li class="sidebar-item">
              <a class="sidebar-link" href="add-packages2.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Add Packages row2</span>
              </a>
            </li> -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="add-testimonial.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Add Testimonial</span>
              </a>
            </li>        
            <!-- <li class="sidebar-item">
              <a class="sidebar-link" href="add-other-services.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Add Other Services Packages</span>
              </a>
            </li>    -->
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>