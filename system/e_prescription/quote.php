<?php
ob_start();
include_once '../init.php';

$link = "Appointments Management";
$breadcrumb_item = "Appointments";
$breadcrumb_item_active = "Scan QR";
?> 

<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>inventory/manage.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> View Stock</a>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add Stock</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    extract($_POST);
//                    $item_id = dataClean($item_id);
//                    $qty = dataClean($qty);
//                    $unit_price = dataClean($unit_price);


                    $message = array();
                    //Required validation-----------------------------------------------



                    if (empty($message)) {
                        $db = dbConn();
                        foreach ($ItemId as $key => $value) {
                            $q = $Qty[$key];
                            $price = $RetailPrice[$key];
                            $sql = "INSERT INTO `stocks`(`ItemId`,`Qty`,`RetailPrice`) VALUES ('$ItemId','$q','$price')";
                            $db->query($sql);
                        }
                    }
                }
                ?>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

                    <table class="table table-striped" id="items">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="items-row">
                                <td>
                                    <select name="ItemId[]" id="ItemId[]" class="form-control" >
                                        <option value="">--</option>
                                        <?php
                                        $db = dbConn();
                                        $sql = "SELECT Id, ItemName FROM items";
                                        $result = $db->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?= $row['Id'] ?>"><?= $row['ItemName'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><input type="number" name="Qty[]" id="Qty" class="form-control" ></td>
                                <td><input type="text" name="RetailPrice[]" id="RetailPrice" class="form-control" ></td>
                                <td><button class="removeBtn" type="button">Remove </button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" id="addBtn" class="btn btn-warning"> Add Items</button>

                    <br/> 
                    <br/>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
<?php
$content = ob_get_clean();
include '../layouts.php';
?>
