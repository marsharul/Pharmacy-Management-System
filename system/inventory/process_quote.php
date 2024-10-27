<?php
ob_start();
include_once '../init.php';

$link = "Inventory Management";
$breadcrumb_item1 = "Inventory";
$breadcrumb_item2 = "Manage";

extract($_POST);
?>


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$action == 'add') {
    $db = dbConn();
    $sql = "SELECT * FROM price_request WHERE RequestDate='$RequestDate'";
    $result = $db->query($sql);
    // Add 2 days to the RequestDate
    $FinalUpdateDate = date('Y-m-d', strtotime($RequestDate . ' +2 days'));
    if ($result->num_rows <= 0) {
        $sql = "INSERT INTO `price_request`(`DistributorId`, `DeliverDate`,`RequestDate`,`FinalUpdatedate`) VALUES ('$Distributor','$DeliverDate','$RequestDate','$FinalUpdateDate')";
        $db->query($sql);
        $PriceRequestId = $db->insert_id;
    } else {
        $PriceRequestId = $result->fetch_assoc()['Id'];
    }

    $sql = "INSERT INTO `price_request_item`( `PriceRequestId`, `ItemId`, `Qty`) VALUES ('$PriceRequestId','$Item','$Qty')";
    $db->query($sql);
}
?>
<div class="row">
    <div class="col-12">
<a href="<?= SYS_URL ?>inventory/manage.php" class="btn btn-dark mb-2"><i class="fas fa-chevron-circle-left"></i> back</a>
        <div class="card card-primary ">
            <div class="card-header bgcolor">
                <h3 class="card-title"></h3>
            </div>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="card-body bgcolorbody">

                    <div class="form-group">
                        <label for="Status">Select Distributor:</label>
                        <select class="form-control" id="Distributor" name="Distributor">
                            <option value="">-- select Distributor --</option>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM distributor WHERE StatusId='1'";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $row['Id'] ?>"<?= @$Distributor == $row['Id'] ? 'selected' : '' ?>><?= $row['DistributorName'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="Form">Deliver Date :</label>
                        <input type="date" class="form-control" id="DeliverDate" name="DeliverDate" placeholder="Enter Deliver Date" value="<?= @$DeliverDate ?>">
                        <span class="text-danger"><?= @$message['ExpiryDate'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="Form">Request Date :</label>
                        <input type="date" class="form-control" id="RequestDate" name="RequestDate" placeholder="Enter Deliver Date" value="<?= @$RequestDate ?>">
                        <span class="text-danger"><?= @$message['RequestDate'] ?></span>
                    </div>
                    <table class="table table-striped" id="items">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>    
                            <tr class="items-row">
                                <td>
                                    <select name="Item" id="Item" class="form-control  " >
                                        <option value="">--</option>
                                        <?php
                                        $db = dbConn();
                                        $sql = "SELECT Id, ItemName FROM items where StatusId='1'";
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
                                <td><input type="number" name="Qty" id="Qty" class="form-control" ></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="card-footer bgcolorbody">
                    <button type="submit" class="btn btn-primary" name='action' value="add">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//            $sql="SELECT * FROM price_request_item WHERE PriceRequestId='$PriceRequestId'";
    $sql = "SELECT pri.*,p.*,i.ItemName,D.DistributorName FROM price_request_item pri LEFT JOIN price_request p ON pri.PriceRequestId=p.Id LEFT JOIN items i ON i.Id=pri.ItemId LEFT JOIN distributor d ON D.Id=P.DistributorId WHERE PriceRequestId='$PriceRequestId'";
    $result = $db->query($sql);
    ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap ">
                        <tr>
                            <th>Request Date</th>
                            <th>Distributor</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th></th>
                        </tr>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $row['RequestDate'] ?></td>
                                    <td><?= $row['DistributorName'] ?></td>
                                    <td><?= $row['ItemName'] ?></td>
                                    <td><?= $row['Qty'] ?></td>
                                    <td><a href="<?= SYS_URL ?>inventory/send_quote.php?date=<?= $row['RequestDate'] ?>" class="btn btn-success">Send Price Request</a></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                    
                </div>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <?php
}
?>


<?php
$content = ob_get_clean();
include '../layouts.php';
?>
