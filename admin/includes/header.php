<nav id="top-navbar">
    <a href="dashboard.php" class="navbar-brand">
        <img src="assets/images/logo/logo.png" alt="Logo" onerror="this.style.display='none'">
        <span>Travel Admin</span>
    </a>
    <div class="navbar-user">
        <span>Welcome, Admin</span>
        <div class="user-avatar">A</div>
    </div>
</nav>
<header class="admin-header bg-white shadow-sm border-bottom sticky-top">
  <nav class="navbar navbar-expand-lg navbar-light py-2 px-3">
    <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
      <img src="assets/images/logo.png" alt="Logo" width="40" class="me-2">
      <span class="fw-bold fs-4 text-primary">Travel Admin</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="adminNavbar">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item me-3">
          <a class="nav-link position-relative" href="#">
            <i class="ti ti-bell-ringing fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="assets/images/admin.jpg" alt="Admin" width="35" height="35" class="rounded-circle me-2">
            <span class="fw-semibold">Admin</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
