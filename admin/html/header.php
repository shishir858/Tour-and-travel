<?php
include('auth.php');
include("connection.php");
// extract($_POST);

// if (isset($search_data)) {
//     $search = mysqli_real_escape_string($con, $_POST['search']);

//     // Array of tables to search in
//     $tables = ['aniversary', 'aniversary-decoration', 'wedding', 'baby-shower-decoration', 'baby-decoration', 'birthday-decoration', 'cartoon-theme', '	love-theme-decortation', 'premium-balloon', 'ring-setup', 'ring-setup-decoration', 'wedding-decoration', 'welcome-baby-decoration'];

//     // Store results
//     $results = [];

//     foreach ($tables as $table) {
//         // Construct the SQL query for each table
//         $query = "SELECT `name` FROM `$table` WHERE `name` LIKE '%$search%'";
//         $result = mysqli_query($con, $query);

//         // Fetch results and store them in the results array
//         while ($row = mysqli_fetch_assoc($result)) {
//             $results[] = ['table' => $table, 'name' => $row['name']];
//         }
//     }

//     // Display the results
//     if (!empty($results)) {
//         foreach ($results as $item) {
//             echo "<p><strong>" . ucfirst($item['table']) . ":</strong> " . $item['name'] . "</p>";
//         }
//     } else {
//         echo "<p>No results found</p>";
//     }
// }
?>

<!-- HTML Form -->
<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                    <i class="ti ti-bell-ringing"></i>
                    <div class="notification bg-primary rounded-circle"></div>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="dashboard.php" id="drop2" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <img src="../assets/admin.jpg" alt="" width="35" height="35" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <!-- <a href="" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a> -->
                            <a href="logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
