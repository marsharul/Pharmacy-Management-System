<?php

session_start();
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
        <script src="assets/js/sweetalert2@11.js" type="text/javascript"></script>
    </head>

    <body class="bgcolorbody">

        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top d-flex align-items-center bgcolor">


            <div class="container d-flex align-items-center justify-content-between">


                <div class="logo">
                    <h1 class="text-light font "><a href="index.php"><span>Ceylon Medical</span></a></h1>
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
                </div>

                <nav id="navbar" class="navbar">

                    <ul>
                        <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
                        <li><a class="nav-link scrollto" href="about.php">About Us</a></li>
                        <li><a class="nav-link scrollto" href="shop.php">Shop</a></li>
                        <li><a class="nav-link scrollto" href="upload_prescription.php">Upload Prescription</a></li>
                        <li><a class="nav-link scrollto" href="cart.php">Cart</a></li>

                        <!--If logged in display username-->
                        <?php
                        if (isset($_SESSION['USERID'])) {
                            echo "<li><a class='getstarted scrollto register-btn' href='dashboard.php'>Welcome Back!, " . $_SESSION['FIRSTNAME'] . "</a></li>";
                        }
                        ?>

<!--                        <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="#">Drop Down 1</a></li>
                                <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                                    <ul>
                                        <li><a href="#">Deep Drop Down 1</a></li>
                                        <li><a href="#">Deep Drop Down 2</a></li>
                                        <li><a href="#">Deep Drop Down 3</a></li>
                                        <li><a href="#">Deep Drop Down 4</a></li>
                                        <li><a href="#">Deep Drop Down 5</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Drop Down 2</a></li>
                                <li><a href="#">Drop Down 3</a></li>
                                <li><a href="#">Drop Down 4</a></li>
                            </ul>
                        </li>-->
                        <?php
                        if (isset($_SESSION['USERID'])) {
                            echo '<li><a class="getstarted scrollto bg-success" href="logout.php">Logout</a></li>';
                        } else {
                            echo '<li><a class = "getstarted scrollto register-btn" href = "register.php">Register</a></li>';
                            echo'<li><a class = "getstarted scrollto bg-success" href = "login.php">Login</a></li>';
                        }
                        ?>

                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->

            </div>
        </header><!-- End Header -->
        