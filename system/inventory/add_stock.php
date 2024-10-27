
<?php
ob_start();
include_once '../init.php';

$link = "Inventory Management";
$breadcrumb_item1 = "Inventory";
$breadcrumb_item2 = "Add Stock";
?> 
<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>inventory/manage.php" class="btn btn-dark mb-2"><i class="fas fa-chevron-circle-left"></i> View Stock</a>
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">Add New Item Stock</h3>
                
            </div>
            <!-- /.card-header -->
            <div class="card-body bgcolorbody">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    extract($_POST);
                    $ItemId = dataClean($ItemId);
//                    $Qty = dataClean($Qty);
                    $RetailPrice = dataClean($RetailPrice);
                    $CostPrice = dataClean($CostPrice);
                    $PurchaseDate = dataClean($PurchaseDate);
                    $ExpiryDate = dataClean($ExpiryDate);
                    $DistributorId = dataClean($DistributorId);

                    $message = array();
                    //Required validation-----------------------------------------------
                    if (empty($ItemId)) {
                        $message['ItemName'] = "The Item should not be blank...!";
                    }
                    if (empty($Qty)) {
                        $message['Qty'] = "The qty should not be blank...!";
                    }
                    if(empty($RetailPrice)){
                        $message['RetailPrice']="The Retail price should not be blank...!";
                    }
                     if(empty($CostPrice)){
                        $message['CostPrice']="The Cost price should not be blank...!";
                    }
                    if(empty($PurchaseDate)){
                        $message['PurchaseDate']="The purchase date should not be blank...!";
                    }
                    if(empty($ExpiryDate)){
                        $message['ExpiryDate']="The Expiry date should not be blank...!";
                    }
                    if(empty($DistributorId)){
                        $message['DistributorId']="The Distributor should not be blank...!";
                    }
                    if(empty($LocationId)){
                        $message['LocationName']="The Location should not be blank...!";
                    }
                    if (empty($message)) {
                        $db = dbConn();
                        $sql = "INSERT INTO `stocks`(`ItemId`, `Qty`, `RetailPrice`, `CostPrice`, `PurchaseDate`, `ExpiryDate`,`LocationId`, `DistributorId`) VALUES ('$ItemId','$Qty','$RetailPrice','$CostPrice','$PurchaseDate','$ExpiryDate','$LocationId','$DistributorId')";
                        $db->query($sql);
                        header("Location:manage.php?status=add");
                    }
                }
                ?>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    
                    <div class="form-group">
                        <label for="DistributorId">Distributor:</label>
                        <select name="DistributorId" id="DistributorId" class="form-control select2" >
                            <option value="">-- select --</option>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT Id, DistributorName,StatusId FROM distributor WHERE StatusId='1'";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $row['Id'] ?>"<?=@$DistributorId==$row['Id']?'selected':'' ?>><?= $row['DistributorName'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <span class='text-danger'><?= @$message['DistributorId']?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="purchase_date">Purchase Date:</label>
                        <input type="date" name="PurchaseDate" id="PurchaseDate" class="form-control" value="<?= @$PurchaseDate?>" >
                        <span class='text-danger'><?= @$message['PurchaseDate']?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="ItemId">Item Name:</label>
                        <select name="ItemId" id="ItemId" class="form-control select2" >
                            <option value="">-- select --</option>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT Id, ItemName FROM items WHERE StatusId='1'";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $row['Id'] ?>"<?=@$ItemId==$row['Id']?'selected':'' ?>><?= $row['ItemName'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                         <span class='text-danger'><?= @$message['ItemName']?></span>
                    </div>
<!--                    <div class="form-group">
                        <label for="Qty">Quantity</label>
                        <input type="number" class="form-control" id="Qty" name="Qty" placeholder="Enter Quantity" value="<?= @$Qty?>">
                        <span class='text-danger'><?= @$message['Qty']?></span>
                    </div>-->
                    <div class="form-group">
                        <label for="Qty">Quantity:</label>
                        <select name="Qty" id="Qty" class="form-control" >
                            <option value="">-- select --</option>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM stock_qty";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $row['Id'] ?>"<?=@$Qty==$row['Id']?'selected':'' ?>><?= $row['Qty'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                         <span class='text-danger'><?= @$message['Qty']?></span>
                    </div>
                    <div class="form-group">
                        <label for="ItemId">Location:</label>
                        <select name="LocationId" id="LocationId" class="form-control select2" >
                            <option value="">-- select --</option>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT Id, LocationName FROM locations";
                            $result = $db->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $row['Id'] ?>"<?=@$LocationId==$row['Id']?'selected':'' ?>><?= $row['LocationName'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                         <span class='text-danger'><?= @$message['LocationName']?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="RetailPrice">Retail Price</label>
                        <input type="text"  class="form-control" id="RetailPrice" name="RetailPrice" placeholder="Enter Unit Price" value="<?= @$RetailPrice ?>">
                        <span class='text-danger'><?= @$message['RetailPrice']?></span>
                    </div>
                    <div class="form-group">
                        <label for="CostPrice">Cost Price</label>
                        <input type="text"  class="form-control" id="CostPrice" name="CostPrice" placeholder="Enter Purchase Price" value="<?= @$CostPrice ?>">
                        <span class='text-danger'><?= @$message['CostPrice']?></span>
                    </div>
                    <div class="form-group">
                        <label for="ExpiryDate">Expiry Date</label>
                        <input type="date" class="form-control" id="ExpiryDate" name="ExpiryDate" placeholder="Enter Purchase Date" value="<?= @$ExpiryDate?>">
                        <span class='text-danger'><?= @$message['ExpiryDate']?></span>
                    </div>
                    
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