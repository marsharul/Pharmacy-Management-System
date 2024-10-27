<?php
session_start();
include '../function.php';
extract($_GET);

$_SESSION['discount'] = $discount;
$discount = $_SESSION['discount'];

if ($_SERVER['REQUEST_METHOD'] == 'GET' && @$operate == 'Reject') {
//    <------Update Status from 'processed' to 'Reject' ----->
    $db = dbConn();
    $sql3 = "UPDATE `orders` SET `StatusId`='5' WHERE Id='$id'";
    $db->query($sql3);
//    <------------ End Status ---------------------->
}

// Display the number of items selected in cart in header
$noitems = 0; // Number of Items
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {

        $noitems += $value['Qty'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Ceylon Medical-Online Shop</title>
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


<!--         Spinner Start 
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
         Spinner End -->


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

            <div class="container">
                <?php
                $db = dbConn();
                 $sql = "SELECT * FROM orders o INNER JOIN order_items oi ON o.Id=oi.OrderId LEFT JOIN items i ON oi.ItemId=i.Id WHERE o.Id='$id'";
                $result = $db->query($sql);
                ?>
                <h2>Order Summery</h2>
                <div class="card">
                    <table class="table" border="1" width="100%" style="border: 1px solid #055160">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><img src="../upload_images/<?= $row['UploadPicture']; ?>" width="50" height="50" alt=""></td>
                                        <td><?= $row['ItemName'] ?></td>
                                        <td><?= $row['RetailPrice'] ?></td>
                                        <td class="text-center">x <?= $row['Qty'] ?></td>
                                        <td><?php
                                            $amt = $row['RetailPrice'] * $row['Qty'];
                                            $total += $amt;
                                            echo number_format($amt, 2);
                                            ?></td>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                        </tbody>
                        <?php
                        $db = dbConn();
                       $sql = "SELECT * FROM orders o INNER JOIN order_items oi ON o.Id=oi.OrderId LEFT JOIN items i ON oi.ItemId=i.Id WHERE o.Id='$id'";
                        $result = $db->query($sql);
                        $row2=$result->fetch_assoc();
                        ?>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right"><?= number_format($total, 2) ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Discount (Coupon)</td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right"><?= number_format($total * $row2['CouponDiscount'], 2) ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Net</td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right"><?= number_format(($total - $total * $row2['CouponDiscount']), 2) ?></td>
                            </tr>

                        </tfoot>
                    </table>

                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET"> <!-- Reject quotation btn -->
                        <input type="hidden" name="id" value=<?= $id ?>>
                        <?php
//                        $sql = "SELECT * FROM orders o INNER JOIN order_items oi ON o.Id=oi.OrderId LEFT JOIN items i ON oi.ItemId=i.Id WHERE o.Id='$id'";
                        $sql = "SELECT o.*,oi.*,i.ItemName,i.UploadPicture FROM orders o INNER JOIN order_items oi ON o.Id=oi.OrderId LEFT JOIN items i ON oi.ItemId=i.Id WHERE o.Id='$id'";
                        $result = $db->query($sql);
                        $row = $result->fetch_assoc();
                        if ($row['StatusId'] === '1') {
                            ?>

                            <button type="submit"  name="operate" value="Reject" class="btn btn-danger">Cancel</button> <!-- Reject quotation -->

                            <?php
                        } else {
                            ?>

                            <button type="submit" disabled name="operate" value="Reject" class="btn btn-danger">Cancel</button> <!-- Reject quotation -->


                            <?php
                        }
                        ?>
                    </form>
                </div>
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


