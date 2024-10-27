<?php
ob_start();
include_once '../init.php';

$link = "Orders Management";
$breadcrumb_item1 = "Orders";
$breadcrumb_item2 = "View Orders";

extract($_GET);
$db = dbConn();
$sql = "SELECT * FROM orders o INNER JOIN order_status os ON o.StatusId=os.Id INNER JOIN customers c ON c.CustomerId= o.CustomerId LEFT JOIN users u ON u.UserId=c.UserId WHERE o.Id='$id' ";
$result = $db->query($sql);
$row = $result->fetch_assoc();
?> 
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Billing Details</h4>
                <label>Customer Name:</label>
                <?= $row['FirstName'] ?>  <?= $row['LastName'] ?><br/>
                <label>Billing Name :</label>
                <?= $row['BillingName'] ?><br/>
                <label>Billing Address:</label>
                <?= $row['BillingAddress'] ?><br/>
                <label>Billing Contact :</label>
                <?= $row['BillingPhone'] ?><br/>
            </div>

        </div>

    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Delivery Details</h4>
                <label>Delivery Name:</label>
                <?= $row['DeliveryName'] ?><br/>
                <label>Delivery Address</label>
                <?= $row['DeliveryAddress'] ?><br/>
                <label>Delivery Contact No:</label>
                <?= $row['DeliveryPhone'] ?><br/>
            </div>    
        </div>   
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Order Details</h4>
                <label>Order Date:</label>
                <?= $row['OrderDate'] ?><br/>
                <label>Order Number:</label>
                <?= $row['OrderNumber'] ?><br/>
                <label>Order Notes:</label>
                <?= $row['OrderNotes'] ?><br/>
                <label>Order Status:</label>
                <?= $row['StatusName'] ?>
            </div>

        </div>

    </div>

</div>
<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>orders/manage.php" class="btn btn-dark mb-2"> <i class="fas fa-chevron-circle-left"></i> Back</a>
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white"> Order Items</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                extract($_GET);
                $db = dbConn();
                 $sql = "SELECT * FROM order_items oi INNER JOIN items i ON oi.ItemId= i.Id WHERE OrderId='$id'";
                $result = $db->query($sql);
            } else {
                extract($_POST);
                $db = dbConn();
                $sql = "UPDATE `orders` SET `StatusId`='2' WHERE Id='$id'";
                $result = $db->query($sql);
            }
            ?>
            <!-- /.card-header -->
            <form action="../inventory/issue.php" method="POST" >
                <div class="card-body table-responsive p-0 bgcolorbody">

                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Unit Price</th>
                                <th>Qty </th>
                                <th>Available Qty</th>
                                <th>Issued Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $row['ItemName'] ?> </td>
                                        <td><?= $row['RetailPrice'] ?></td>
                                        <td><?= $row['Qty'] ?> </td>
                                        <td> 
                                            <?php
                                            $ItemId = $row['ItemId'];
                                            $RetailPrice = $row['RetailPrice'];
                                            $sql = "SELECT SUM(`Qty`-`IssuedQty`) AS AvailableQty FROM `stocks` WHERE ItemId='$ItemId'AND RetailPrice='$RetailPrice' ";
                                            $availqty_result = $db->query($sql);
                                            $availqty_row = $availqty_result->fetch_assoc();
                                            echo $availqty_row['AvailableQty'];
                                            ?>
                                        </td>
                                        
                                        <td>
                                                <input type="hidden" name="Items[]" value="<?= $row['ItemId'] ?>">
                                                <input type="hidden" name="OrderId" value="<?= $id ?>"><!-- comment -->
                                                <input type="hidden" name="RetailPrice[]" value="<?= $row['RetailPrice'] ?>"><!-- Retail Price of Order Items -->
                                                <input type="text" name="IssuedQty[]"><!-- Issued Qty -->  
                                                
                                            </td>
                                            
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>



                    </div>

                    <input type="hidden" name="id" value="<?= $id ?>">
                    <button type="submit" class="btn btn-primary">Issue</button>

                </form>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <?php
    $content = ob_get_clean();
    include '../layouts.php';
    ?>