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
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        extract($_GET);
        if (@$operate = 'update_to_delivered') {
            $db = dbConn();
            $sql = "UPDATE `orders` SET `StatusId`='4' WHERE Id='$id'";
            $db->query($sql);
        }
    }
    ?>
    <form action= "<?= $_SERVER['PHP_SELF'] ?>" method="GET">

        <input type="hidden" name="id" value="<?= $id ?>">
        <button type="submit" name="operate" value="update_to_delivered" class="btn btn-warning">Delivered</button>
    </form>

</div>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>