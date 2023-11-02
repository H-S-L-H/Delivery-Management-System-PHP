<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php if (isset($title)) {echo $title;}?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" href="img/logo.png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/orders.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                  <img src="img/logo.png" class="img-fluid w-100" alt="Logo">
                </a>
                <div class="ms-4 mb-4">
                    <h3 class="mb-0">Admin Panel</h3>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link <?php if (isset($title)) {if($title=="Dashboard") {echo "active";}} ?>"><i class="fa-solid fa-gauge-high me-2"></i>Dashboard</a>
                    <a href="users.php" class="nav-item nav-link <?php if (isset($title)) {if($title=="Users") {echo "active";}} ?>"><i class="fa-solid fa-users me-2"></i>Users</a>
                    <a href="orders.php" class="nav-item nav-link <?php if (isset($title)) {if($title=="Orders") {echo "active";}} ?>"><i class="fa-sharp fa-solid fa-truck me-2"></i>Orders</a>
                    <a href="contacts.php" class="nav-item nav-link <?php if (isset($title)) {if($title=="Contacts") {echo "active";}} ?>"><i class="fa-solid fa-address-book me-2"></i>Contacts</a>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand sticky-top px-4 py-0" style="background-color: #07509E;">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars text-white"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div>
                        <img class="rounded-circle me-lg-2" src="img/profile.png" alt="" style="width: 40px; height: 40px;">
                        <span class="d-none d-lg-inline-flex text-white pb-4 pt-4">Admin</span>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->