<?php
session_start();
include '../function.php';
if (!isset($_SESSION['USERID'])) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Ceylon Medical Pharmacy</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/mynewstyle.css" rel="stylesheet" type="text/css"/>
        
    </head>

    <body class="bgcolorbody">

        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top d-flex align-items-center bgcolor">
            <div class="container d-flex align-items-center justify-content-between">

                <div class="logo">
                    <h1 class="text-light font"><a href="index.php"><span>Ceylon Medical Pharmacy</span></a></h1>
                    <!-- Uncomment below if you prefer to use an image logo -->
<!--                     <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
                </div>

                <nav id="navbar" class="navbar">
                    <ul>
                        <li><a class="getstarted scrollto bg-success" href="index.php">Home</a></li>
                         <li><a class="nav-link scrollto" href="about.php">About Us</a></li>
                        <li><a class="nav-link scrollto" href="shop.php">Shop</a></li>
                        <li><a class="nav-link scrollto" href="upload_prescription.php">Upload Prescription</a></li>
                        <li><a class="nav-link scrollto" href="cart.php">Cart</a></li>
                        <li><a class="getstarted scrollto register-btn" href="">Welcome Back! <?= $_SESSION['FIRSTNAME'] ?></a></li>
                        <li><a class="getstarted scrollto bg-success" href="logout.php">Logout</a></li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->

            </div>
        </header><!-- End Header -->

        <main id="main">
            <section class="breadcrumbs bgcolorfooter">
                <div class="container">

                    <div class="d-flex justify-content-between align-items-center">
                        <h2>Dashboard</h2>
                        <ol>
                            <li><a href="dashboard.php">Customer</a></li>
                            <li>Dashboard</li>
                        </ol>
                    </div>

                </div>
            </section>
            <section class="inner-page">
                <div class="container">
                    <p>
                        Dashboard Area
                    </p>
                </div>
            </section>
            <div class="row">
            <div class="container col-md-4">
                <a href="e_prescription_manage.php">
                <div class="card m-5" style="width: 18rem;">
                    <img class="card-img-top" src="assets/img/precription.jpg ?>" alt="Card image cap">
                    <div class="card-body">
                        
                        <p class="card-text"> Prescription Orders </p>
<!--                        <form>
                            <input type="hidden">
                            <input type="submit" value="Prescription Orders" name="operate">
                            <a href="e_prescription_manage.php" class="btn btn-primary"> Prescription Orders</a>  
                        </form>-->
                    </div>
                </div>
                </a>
            </div>
                
            <div class="container col-md-8">
                <a href="shop_orders.php">
                <div class="card m-5" style="width: 18rem;">
                    <img class="card-img-top" src="assets/img/shop_orders.png?>" alt="Card image cap">
                    <div class="card-body">
                        
                        <p class="card-text"> Shop Orders </p>
                       
                    </div>
                </div>
                </a>
            </div>
            
            </div>

        </main>
        

        <!-- ======= Footer ======= -->
        <footer id="footer" class="bgcolor">

            <div class="container py-4 ">
                <div class="copyright">
                    &copy; Copyright <strong><span>Ceylon Medical</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/ninestars-free-bootstrap-3-theme-for-creative/ -->
                    Designed by A.Arushan 
                </div>
            </div>
        </footer><!-- End Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center arrowup"><i class="bi bi-arrow-up-short "></i></a>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/aos/aos.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

    </body>

</html>