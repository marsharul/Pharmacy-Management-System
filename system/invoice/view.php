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
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">Issued Order Items</h3>

            </div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                extract($_GET);
                $db = dbConn();
                $sql = "SELECT ois.*,i.ItemName,(ois.RetailPrice * ois.IssuedQty)AS Total FROM `order_items_issue` ois LEFT JOIN `items`i ON ois.ItemId= i.Id WHERE OrderId='$id'";
                $result = $db->query($sql);
            }
            ?>
            <!-- /.card-header -->
            <form action="../invoice/invoice.php" method="POST" >
                <div class="card-body table-responsive p-0 bgcolorbody">

                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Unit Price</th>
                                <th>Issued Qty </th>
                                <th>Total </th>
                                <th>Issued Date</th>    
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
                                        <td><?= $row['IssuedQty'] ?> </td>
                                        <td><?= $row['Total'] ?> </td>
                                        <td>
                                            <?= $row['IssueDate'] ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                        <?php
                        $db = dbConn();
//                        $sql2 = "SELECT SUM(ois.RetailPrice * ois.IssuedQty)AS SubTotal FROM `order_items_issue` ois LEFT JOIN `items`i ON ois.ItemId= i.Id WHERE OrderId='$id'";
                        $sql2 = "SELECT SUM(ois.RetailPrice * ois.IssuedQty)AS SubTotal,o.CouponDiscount FROM `order_items_issue` ois LEFT JOIN `items`i ON ois.ItemId= i.Id LEFT JOIN `orders`o ON ois.OrderId=o.Id WHERE OrderId='$id'";
//                         "SELECT ois.*,i.ItemName,(ois.RetailPrice * ois.IssuedQty)AS SubTotal,o.CouponDiscount FROM `order_items_issue`ois LEFT JOIN `items`i ON ois.ItemId= i.Id LEFT JOIN `orders`o ON ois.OrderId=o.Id WHERE OrderId='';";
                        $result2 = $db->query($sql2);
                        $row2 = $result2->fetch_assoc();
                        $total = $row2['SubTotal'];
                        ?>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td><?= number_format($total, 2) ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Discount (Coupon)</td>
                                <td></td>
                                <td></td>
                                <td><?= number_format($total * $row2['CouponDiscount'], 2) ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Net Total</td>
                                <td></td>
                                <td></td>
                                <td><?= number_format(($total - $total * $row2['CouponDiscount']), 2) ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>



                </div>

                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="submit" onclick="printInvoice()" class="btn btn-primary">Invoice</button>

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