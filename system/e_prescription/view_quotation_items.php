<?php
ob_start();
include_once '../init.php';
include '../../mail.php';
?> 
<?php
$link = "E-Precription Management";
$breadcrumb_item1 = "Quotation";
$breadcrumb_item2 = "View_Quotation";

extract($_GET);
$db = dbConn();
$sql = "SELECT * FROM prescriptions p WHERE p.Id='$id'";
$result = $db->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && @$operate == 'send_email') {

    $Email = $row['Email'];
    $PatientName = $row['PatientName'];
//send Email to customer
    $msg = "<h1>Thank You for submitting prescription Order</h1>";
    $msg .= "<h2>Now,Your Order is Completed</h2>";
    $msg .= "<p>Please,Click on the below link to confirm your order</p>";
    $msg .= "<a href='http://localhost/ceymedpms/web/dashboard.php'>Click here </a>";

    sendEmail($Email, $PatientName, "e-Prescription", $msg);
//    <------Update Status from 'processed' to 'e-mail sent' ----->
    $db = dbConn();
    $sql3 = "UPDATE `prescriptions` SET `StatusId`='3' WHERE Id='$id'";
    $db->query($sql3);
//    <------------ End Status ---------------------->
}
?>
<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>

<div class="row">
    <div class="col-12">
        <a href="add.php" class="btn btn-dark mb-2"> <i class="fas fa-plus-circle"></i> Add Item</a>
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">Quotation Details</h3>

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
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 bgcolorbody">
                <?php
                $db = dbConn();
                $sql = "SELECT * FROM quotation q INNER JOIN quotation_items qi ON q.Id=qi.QuotationId LEFT JOIN items i ON qi.ItemId=i.Id WHERE PrescriptionId='$id'";
                $result = $db->query($sql);
                ?>
                <table class="table table-hover text-nowrap ">
                    <thead>
                        <tr>

                            <th>Item Name</th>
                            <th>Qty</th>
                            <th>Retail Price</th>
                            <th>Total Price </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $row['ItemName'] ?></td>
                                    <td><?= $row['Qty'] ?></td>
                                    <td><?= $row['RetailPrice'] ?></td>
                                    <td><?php
                                        $total = 0;
                                        $amt = $row['RetailPrice'] * $row['Qty'];
                                        $total += $amt;
                                        echo number_format($total, 2);
                                        ?></td>

                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                    <?php
                    $db = dbConn();
                    $sql = "SELECT q.PrescriptionId,SUM(qi.RetailPrice * qi.Qty) AS TOTALAMOUNT FROM quotation q INNER JOIN quotation_items qi ON q.Id=qi.QuotationId LEFT JOIN items i ON qi.ItemId=i.Id WHERE PrescriptionId='$id' GROUP BY PrescriptionId;";
                    $result = $db->query($sql);
                    $row2=$result->fetch_assoc();
                    ?>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td><?= number_format($row2['TOTALAMOUNT'], 2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- /.card-body -->
        </div>
        <?php
        $sql = "SELECT * FROM prescriptions p WHERE p.Id='$id'";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        if ($row['StatusId'] === '2') {
            ?>
            <form action="view_quotation_items.php" method="GET">
                <!--<a href="view_quotation_items.php" class="btn btn-warning"> Send Email</a>-->
                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="submit" name="operate" value="send_email" class="btn btn-warning">Send Email</button>
            </form>
            <?php
        } else {
//        
            ?> <!--- Disable Send Email ---->
            <form action="view_quotation_items.php" method="GET">
                <!--<a href="view_quotation_items.php" class="btn btn-warning"> Send Email</a>-->
                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="submit" disabled name="operate" value="send_email" class="btn btn-warning">Send Email</button>
            </form>
            <?php
        }
        ?>
        <!-- /.card -->
    </div>
</div>
<?php
$content = ob_get_clean();
include '../layouts.php';
?>
