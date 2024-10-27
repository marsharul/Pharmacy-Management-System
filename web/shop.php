<?php
session_start();
include '../function.php';
// Display the number of items selected in cart in header
$noitems = 0; // Number of Items
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {

        $noitems += $value['Qty'];
    }
}

// Pagination settings
$items_per_page = 6;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

$db = dbConn();
// Fetch product data
//    $sql = "SELECT * FROM stocks LIMIT $items_per_page OFFSET $offset";
//    $result = $db->query($sql);
// Fetch total number of products
$total_sql = "SELECT COUNT(*) FROM Stocks";
$total_result = $db->query($total_sql);
$total_row = $total_result->fetch_row();
$total_items = $total_row[0];
$total_pages = ceil($total_items / $items_per_page);
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
                            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="nav-item nav-link">Shop</a>
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
        <!--        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                </div>-->
        <!-- Modal Search End -->


        <!-- Single Page Header start -->
        <div class="container-fluid  py-5">

            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Shop</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5 bgcolorbody">
            <div class="container py-5">
                <h1 class="mb-4">Online Shop</h1>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            
                            <div class="col-6"></div>
                            
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Categories</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#" onclick="loadItemsByCategory('0')">All</a>
                                                        <span> </span>
                                                    </div>
                                                </li>
                                                <?php
                                                $db = dbConn();
                                                $sql3 = "SELECT * FROM `category` WHERE StatusId='1'";
                                                $result3 = $db->query($sql3);
                                                while ($row = $result3->fetch_assoc()) {
                                                    ?>
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="#" onclick="loadItemsByCategory(<?= $row['Id'] ?>)"><?= $row['CategoryName'] ?></a>
                                                            <span> </span>
                                                        </div>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Dosage Form</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                <?php
                                                $db = dbConn();
                                                $sql2 = "SELECT * FROM `dosage_form`WHERE StatusId='1'";
                                                $result2 = $db->query($sql2);
                                                while ($row = $result2->fetch_assoc()) {
                                                    ?>
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="#" onclick="loadItemsByDosageForm(<?= $row['Id'] ?>)"><?= $row['Form'] ?></a>
                                                            <span> </span>
                                                        </div>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="#" onclick="loadItemsByDosageForm('0')"> All </a>
                                                        <span> </span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-9" id="product_grid"> <!-- Product Grid Tiles start -->
                                <div class="row g-4 justify-content-center">
                                    <?php
                                    $db = dbConn();
//                                    echo$sql = "SELECT s.Id,s.Qty,s.Qty-s.IssuedQty as AvailQty,s.RetailPrice,i.ItemName,i.UploadPicture,d.Form FROM stocks s INNER JOIN items i ON i.Id=s.ItemId INNER JOIN dosage_form d ON d.Id=i.FormId";
                                    $sql = "SELECT s.Id,SUM(s.Qty) AS Qty,SUM(s.Qty-s.IssuedQty) AS AvailQty,s.RetailPrice,i.ItemName,i.UploadPicture,i.Description,i.ItemIssue,d.Form,c.CategoryName FROM stocks s INNER JOIN items i ON i.Id=s.ItemId INNER JOIN dosage_form d ON d.Id=i.FormId LEFT JOIN category c ON c.Id=i.CategoryId GROUP BY ItemId,RetailPrice LIMIT $items_per_page OFFSET $offset";
                                    $result = $db->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <div class="col-md-6 col-lg-6 col-xl-4">
                                                <div class="card">
                                                    <div class="card-body " style="min-height: 500px">
                                                        <div class="rounded position-relative fruite-item">
                                                            <div class="fruite-img">
                                                                <img src="../upload_images/<?= empty($row['UploadPicture']) ? 'no_upload_images.png' : $row['UploadPicture'] ?>" class="img-fluid w-100 rounded-top" alt="">

                                                            </div>
                                                            <div class="text-white bg-color px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?= $row['Form'] ?></div>
                                                            <div class="text-secondary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?= $row['ItemIssue'] ?></div>
                                                            <div class="p-4 rounded-bottom">
                                                                <h4><?= $row['ItemName'] ?></h4>
                                                                <p><?= $row['Description'] ?></p>
                                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                                    <p class="text-dark fs-5 fw-bold mb-0">LKR <?= $row['RetailPrice'] ?></p>
                                                                    <p  style="color: <?= $row['AvailQty'] > 0 ? 'green' : 'red' ?>;"> <?= $row['AvailQty'] > 0 ? 'In Stock' : 'Out of Stock' ?></p>

                                                                    <form method="post" action="cart_process.php">
                                                                        <input type="hidden" name="Id" value="<?= $row['Id'] ?>"><!-- StockId -->
                                                                        <?php
                                                                        if ($row['AvailQty'] > 0 && $row['ItemIssue'] == 'NonPrescription') {
                                                                            ?>
                                                                            <button type="submit" name="operate" value="add_cart" class="btn border border-secondary rounded-pill px-3 text-color"><i class="fa fa-shopping-bag me-2 ttext-color"></i> Add to cart</button>
                                                                            <?php
                                                                        } elseif ($row['ItemIssue'] == 'Prescription') {
                                                                            ?>
                                                                            <a href="upload_prescription.php" class="btn border border-secondary rounded-pill px-3 text-color"> Inquire Us</a>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <button type="submit" name="operate" value="add_cart" disabled class="btn border border-secondary rounded-pill px-3 text-color"><i class="fa fa-shopping-bag me-2 ttext-color"></i> Add to cart</button>

                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>


                                </div>
                            </div>
                            <!-- Pagination -->
                            <div class="col-12"> 
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination d-flex justify-content-center mt-5">
                                        <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                                            <a class="page-link rounded" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                                <a class="page-link rounded" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php } ?>
                                        <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                                            <a class="page-link rounded" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                           <!----------------------------------------------------->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->


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
<script>
                                                            function loadItemsByDosageForm(formId) {
                                                                if (formId) {
                                                                    $.ajax({
                                                                        url: 'shop_loadItemsByDosageForm.php?formId=' + formId,
                                                                        type: 'GET',
                                                                        success: function (data) {
                                                                            $("#product_grid").html(data);
                                                                        },
                                                                        error: function (xhr, status, error) {
                                                                            console.error('AJAX Error:', status, error);
                                                                        }
                                                                    });
                                                                }
                                                            }
                                                            function loadItemsByCategory(categoryId) {
                                                                if (categoryId) {
                                                                    $.ajax({
                                                                        url: 'shop_loadItemsByCategory.php?categoryId=' + categoryId,
                                                                        type: 'GET',
                                                                        success: function (data) {
                                                                            $("#product_grid").html(data);
                                                                        },
                                                                        error: function (xhr, status, error) {
                                                                            console.error('AJAX Error:', status, error);
                                                                        }
                                                                    });
                                                                }
                                                            }
</script>