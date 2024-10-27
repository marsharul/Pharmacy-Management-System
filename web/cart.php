<?php
session_start();
extract($_GET);
include '../function.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && @$action == 'del') {
    $cart = $_SESSION['cart'];
    unset($cart[$Id]);
    $_SESSION['cart'] = $cart;
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && @$action == 'empty') {
    $_SESSION['cart'] = array();
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && @$action == 'update_qty') {
    // Get item ID and updated quantity from the GET parameters
    $itemId = $Id;
    $newQty = $cart_qty;

    // Update the quantity for the specified item in the session cart array
    $_SESSION['cart'][$itemId]['Qty'] = $newQty;

    // Redirect back to the cart page to reflect the changes
    header('Location: cart.php');
}
// Display the number of items selected in cart in header
$noitems = 0; // Number of Items
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {

        $noitems += $value['Qty'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && @$action == 'calculate_coupon_discount') {
    $db = dbConn();
    $sql = "SELECT * FROM `coupon` WHERE CouponNumber='$coupon_value'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    if (date('Y-m-d') < $row['ExpDate']) {

        $discount = $row['Discount'];
    }
    $_SESSION['discount'] = $discount;
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Shopping Cart</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="asset2/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="asset2/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="asset2/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="asset2/css/style.css" rel="stylesheet">
        <link href="asset2/css/mystyle.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/mynewstyle.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>


        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid fixed-top bgcolor">
            <div class="container topbar bg-color d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">No.48 Fussels Lane, Wellawatte, Colombo-06</a></small>
                        <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">ceymedpms@gmail.com</a></small>
                    </div>
                    <div class="top-link pe-2">
                        <small class="me-3"><i class="fa fa-phone-alt me-2 text-secondary"></i><a class="text-white">0112 236 636</a></small>

                    </div>
                </div>
            </div>
            <div class="container px-0 ">
                <nav class="navbar navbar-light bg-white navbar-expand-xl bgcolor">
                    <a href="index.php" class="navbar-brand"><h1 class="text-color display-6">Ceylon Medical</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse " id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="index.php" class="nav-item nav-link">Home</a>
                            <a href="about.php" class="nav-item nav-link">About Us</a>
                            <a href="shop.php" class="nav-item nav-link">Shop</a>
                            <a href="upload_prescription.php" class="nav-item nav-link">Upload Prescription</a>

                            <!--                            <div class="nav-item dropdown">
                                                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                                                            <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                                                <a href="cart.html" class="dropdown-item">Cart</a>
                                                                <a href="chackout.html" class="dropdown-item">Chackout</a>
                                                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                                                <a href="404.html" class="dropdown-item">404 Page</a>
                                                            </div>
                                                        </div>-->

                        </div>
                        <!--If logged in display username-->
                        <?php
                        if (isset($_SESSION['USERID'])) {
                            echo "<li><a class='btn btn-dark' href='dashboard.php'>Welcome Back!, " . $_SESSION['FIRSTNAME'] . "</a></li>";
                        }
                        ?>
                        <div class="d-flex m-3 me-0">
<!--                            <button class="btn-search btn border border-secondary btn-md-square rounded-circle icons-bg me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-color"></i></button>-->
                            <a href="cart.php" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x text-color"></i>
                                <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;"><?= $noitems ?></span>
                            </a>
                            <div class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle active">    
                                    <i class="fas fa-user fa-2x text-color"></i>
                                    <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                        <?php
                                        if (isset($_SESSION['USERID'])) {
                                            ?>
                                            <a href="logout.php" class="dropdown-item active">Logout</a>
                                        <?php } else { ?>
                                            <a href="login.php" class="dropdown-item">Login</a>
                                        <?php } ?>   
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->

        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->


        <!-- Single Page Header start -->
        <div class="container-fluid  py-5">
            <!--            <h1 class="text-center text-white display-6">Cart</h1>-->
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Cart</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Cart Page Start -->
        <div class="container-fluid py-5 bgcolorbody">
            <div class="container py-5">

                <?php
                if (isset($_SESSION['cart'])) {
                    ?>
                    <div class="table-responsive">
                        <a href="cart.php?action=empty">Empty Cart</a>
                        <table class="table" border="1" width="100%" style="border: 1px solid #055160">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($_SESSION['cart'] as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><img src="../upload_images/<?= $value['UploadPicture']; ?>" width="50" height="50" alt=""></td>
                                        <td><?= $value['ItemName'] ?></td>
                                        <td><?= $value['RetailPrice'] ?></td>
                                        <td><form method="GET" action="cart.php"><input type="hidden" name="Id" value="<?= $key ?>"><input type="hidden" name="action" value="update_qty"><input type="text" name="cart_qty" onchange="form.submit()" value="<?= $value['Qty'] ?>"></form></td>
                                        <td><?php
                            $amt = $value['RetailPrice'] * $value['Qty'];
                            $total += $amt;
                            echo number_format($amt, 2);
                                    ?></td>
                                        <td><a href="cart.php?Id=<?= $key ?>&action=del">Remove</a></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td>Total</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right"><?= number_format($total, 2) ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Discount</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right"><?= number_format($total * @$_SESSION['discount'], 2) ?></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>Net</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right"><?= number_format(($total - $total * @$_SESSION['discount']), 2) ?></td>
                                </tr>

                            </tfoot>
                        </table>
                        <!--- Empty Cart Checkout validation ---->
                        <?php if ($_SERVER['REQUEST_METHOD'] == 'GET' && @$action == 'empty') { ?>
                        <?php } else { ?>
                            <a href="checkout.php">Checkout</a>
                        <?php } ?>
                        <!--------------->
                    </div>
                    <!-- Coupon Start -->
                    <div class="mt-5">
                        <form action="cart.php" method="GET">

                            <input type="hidden" name="action" value="calculate_coupon_discount"><!-- comment -->
                            <input type="text" name="coupon_value" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                            <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="submit">Apply Coupon</button>
                        </form>
                    </div>
                    <!-- Cart Total & Discount start -->
                    <div class="row g-4 justify-content-end">
                        <div class="col-8"></div>
                        <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                            <div class="bg-light rounded">
                                <div class="p-4">
                                    <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="mb-0 me-4">Total:</h5>
                                        <p class="mb-0"><?= number_format($total, 2) ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h5 class="mb-0 me-4">Discount (Coupon) :</h5>
                                        <div class="">
                                            <p class="mb-0"><?= number_format($total * @$_SESSION['discount'], 2) ?></p>
                                        </div>
                                    </div>
                                    <p class="mb-0 text-end"> </p>
                                </div>
                                <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                    <h5 class="mb-0 ps-4 me-4">Net Total</h5>
                                    <p class="mb-0 pe-4"><?= number_format(($total - $total * @$_SESSION['discount']), 2) ?></p>
                                </div>
                                <!--- Empty Cart Checkout validation ---->
                                <?php if ($_SERVER['REQUEST_METHOD'] == 'GET' && @$action == 'empty') { ?>
                                    <a class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" href="shop.php"> Go to Shopping </a>
                                <?php } else { ?>
                                    <a class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" href="checkout.php"> Proceed Checkout </a>
                                <?php } ?>
                                             <!--------------->
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    echo "<center><h1> Your Cart Is Empty </h1></center>";
                }
                ?>

            </div>
        </div>
        <!-- Cart Page End -->


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row g-5">
                    <div class="col-md-6 ">
                        <h5 class="text-white mb-4">Contact Us</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>No.48 Fussels Lane, Wellawatte, Colombo-06</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0112 236 636</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>ceymedpms@gmail.com</p>

                    </div>
                    <div class="col-md-6 ">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link" href="#">About Us</a>
                        <a class="btn btn-link" href="#">Contact Us</a>
                        <a class="btn btn-link" href="#">Our Services</a>
                        <a class="btn btn-link" href="#">Terms & Condition</a>
                        <a class="btn btn-link" href="#">Support</a>
                    </div>

                </div>
            </div>

        </div>
        <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light">Copyright <a href="#"> 2024 <i class="fas fa-copyright text-light me-2"></i>Ceylon Medical</a>, All right reserved.</span>
                    </div>
                    <div class="col-md-6 my-auto text-center text-md-end text-white">

                        Designed By <a class="border-bottom" href="https://htmlcodex.com">A.Arushan</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   


        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="asset2/lib/easing/easing.min.js"></script>
        <script src="asset2/lib/waypoints/waypoints.min.js"></script>
        <script src="asset2/lib/lightbox/js/lightbox.min.js"></script>
        <script src="asset2/lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="asset2/js/main.js"></script>
    </body>

</html>
