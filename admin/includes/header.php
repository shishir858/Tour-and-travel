<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>Tourist Drivers India Admin</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom Admin CSS -->
    <style>
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #004e92;
            --sidebar-width: 260px;
            --header-height: 60px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
        }
        
        /* Top Header */
        .admin-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            padding: 0 20px;
            z-index: 1000;
        }
        
        .admin-header .logo {
            font-size: 20px;
            font-weight: bold;
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .admin-header .header-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .admin-header .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .admin-header .admin-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        /* Sidebar */
        .admin-sidebar {
            position: fixed;
            top: var(--header-height);
            left: 0;
            width: var(--sidebar-width);
            height: calc(100vh - var(--header-height));
            background: white;
            box-shadow: 2px 0 4px rgba(0,0,0,0.1);
            overflow-y: auto;
            z-index: 999;
        }
        
        .admin-sidebar .sidebar-menu {
            list-style: none;
            padding: 20px 0;
        }
        
        .admin-sidebar .menu-item {
            padding: 0;
        }
        
        .admin-sidebar .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .admin-sidebar .menu-link:hover {
            background: #f8f9fa;
            color: var(--primary-color);
        }
        
        .admin-sidebar .menu-link.active {
            background: var(--primary-color);
            color: white;
            border-left: 4px solid var(--secondary-color);
        }
        
        .admin-sidebar .menu-link i {
            width: 25px;
            margin-right: 10px;
            font-size: 18px;
        }
        
        /* Main Content */
        .admin-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 30px;
            min-height: calc(100vh - var(--header-height));
        }
        
        /* Page Header */
        .page-header {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .page-header h1 {
            font-size: 28px;
            color: #333;
            margin: 0;
        }
        
        .page-header .breadcrumb {
            margin: 10px 0 0 0;
            background: none;
            padding: 0;
        }
        
        /* Cards */
        .admin-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        
        .admin-card h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
        }
        
        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .stat-card .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }
        
        .stat-card.primary .stat-icon {
            background: linear-gradient(135deg, var(--primary-color), #ff8c5a);
        }
        
        .stat-card.success .stat-icon {
            background: linear-gradient(135deg, #28a745, #34ce57);
        }
        
        .stat-card.info .stat-icon {
            background: linear-gradient(135deg, #17a2b8, #1fc8de);
        }
        
        .stat-card.warning .stat-icon {
            background: linear-gradient(135deg, #ffc107, #ffcd39);
        }
        
        .stat-card .stat-content h3 {
            font-size: 28px;
            font-weight: bold;
            margin: 0;
            color: #333;
        }
        
        .stat-card .stat-content p {
            margin: 0;
            color: #666;
        }
        
        /* Tables */
        .admin-table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .admin-table table {
            margin: 0;
        }
        
        .admin-table th {
            background: #f8f9fa;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            color: #666;
        }
        
        /* Buttons */
        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background: #e55a2b;
            border-color: #e55a2b;
        }
        
        /* Badge Status */
        .badge-active {
            background: #28a745;
        }
        
        .badge-inactive {
            background: #dc3545;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }
            
            .admin-sidebar.active {
                transform: translateX(0);
            }
            
            .admin-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <header class="admin-header">
        <a href="<?php echo BASE_URL; ?>dashboard.php" class="logo">
            <i class="fas fa-plane-departure"></i> Tourist Drivers India
        </a>
        
        <div class="header-right">
            <a href="<?php echo SITE_URL; ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-globe"></i> Visit Website
            </a>
            
            <div class="admin-profile dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <div class="admin-avatar">
                        <?php echo strtoupper(substr($_SESSION['admin_name'] ?? 'A', 0, 1)); ?>
                    </div>
                    <span class="ms-2"><?php echo $_SESSION['admin_name'] ?? 'Admin'; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>settings/profile.php"><i class="fas fa-user"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>settings/general.php"><i class="fas fa-cog"></i> Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </header>
