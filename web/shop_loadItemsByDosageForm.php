<?php
include'../function.php';
extract($_GET);
?>
<?php if ($formId == "0") { ?>
    <div class="col-lg-9" id="product_grid"> <!-- Product Grid Tiles start -->
        <div class="row g-4 justify-content-center">
            <?php
            $db = dbConn();
//                                    echo$sql = "SELECT s.Id,s.Qty,s.Qty-s.IssuedQty as AvailQty,s.RetailPrice,i.ItemName,i.UploadPicture,d.Form FROM stocks s INNER JOIN items i ON i.Id=s.ItemId INNER JOIN dosage_form d ON d.Id=i.FormId";
            $sql = "SELECT s.Id,SUM(s.Qty) AS Qty,SUM(s.Qty-s.IssuedQty) AS AvailQty,s.RetailPrice,i.ItemName,i.UploadPicture,i.Description,i.ItemIssue,d.Form,c.CategoryName FROM stocks s INNER JOIN items i ON i.Id=s.ItemId INNER JOIN dosage_form d ON d.Id=i.FormId LEFT JOIN category c ON c.Id=i.CategoryId GROUP BY ItemId,RetailPrice;";
            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="rounded position-relative fruite-item">
                            <div class="fruite-img">
                                <img src="../upload_images/<?= empty($row['UploadPicture']) ? 'no_upload_images.png' : $row['UploadPicture'] ?>" class="img-fluid w-100 rounded-top" alt="">

                            </div>
                            <div class="text-white bg-color px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?= $row['Form'] ?></div>
                            <div class="text-secondary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?= $row['ItemIssue'] ?></div>
                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                <h4><?= $row['ItemName'] ?></h4>
                                <p><?= $row['Description'] ?></p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold mb-0">LKR.<?= $row['RetailPrice'] ?></p>
                                    <p  style="color: <?= $row['AvailQty'] > 0 ? 'green' : 'red' ?>;"> <?= $row['AvailQty'] > 0 ? 'In Stock' : 'Out of Stock' ?></p>

                                    <form method="post" action="cart_process.php">
                                        <input type="hidden" name="Id" value="<?= $row['Id'] ?>"><!-- StockId -->
                                        <?php
                                        if ($row['AvailQty'] > 0 && $row['ItemIssue']== 'NonPrescription') {
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
                    <?php
                }
            }
            ?>


        </div>
    </div>

    <?php
} else {
    ?>

    <div class="col-lg-9" id="product_grid"> <!-- Product Grid Tiles start -->
        <div class="row g-4 justify-content-center">

            <?php
            $db = dbConn();
// echo$sql = "SELECT s.Id,s.Qty,s.Qty-s.IssuedQty as AvailQty,s.RetailPrice,i.ItemName,i.UploadPicture,d.Form FROM stocks s INNER JOIN items i ON i.Id=s.ItemId INNER JOIN dosage_form d ON d.Id=i.FormId";
            $sql = "SELECT s.Id,SUM(s.Qty) AS Qty,SUM(s.Qty-s.IssuedQty) AS AvailQty,s.RetailPrice,i.ItemName,i.UploadPicture,i.Description,i.ItemIssue,d.Form FROM stocks s INNER JOIN items i ON i.Id=s.ItemId INNER JOIN dosage_form d ON d.Id=i.FormId WHERE i.FormId='$formId' GROUP BY ItemId,RetailPrice";
            $result = $db->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="rounded position-relative fruite-item">
                            <div class="fruite-img">
                                <img src="../upload_images/<?= empty($row['UploadPicture']) ? 'no_upload_images.png' : $row['UploadPicture'] ?>" class="img-fluid w-100 rounded-top" alt="">

                            </div>
                            <div class="text-white bg-color px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?= $row['Form'] ?></div>
                            <div class="text-secondary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;"><?= $row['ItemIssue'] ?></div>
                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                <h4><?= $row['ItemName'] ?></h4>
                                <p><?= $row['Description'] ?></p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold mb-0"><?= $row['RetailPrice'] ?></p>
                                    <p  style="color: <?= $row['AvailQty'] > 0 ? 'green' : 'red' ?>;"> <?= $row['AvailQty'] > 0 ? 'In Stock' : 'Out of Stock' ?></p>

                                    <form method="post" action="cart_process.php">
                                        <input type="hidden" name="Id" value="<?= $row['Id'] ?>"><!-- StockId -->
                                        <?php
                                        if ($row['AvailQty'] > 0 && $row['ItemIssue']== 'NonPrescription') {
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
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <?php
}
?>
