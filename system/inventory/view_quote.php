<?php
ob_start();
include_once '../init.php';
?> 

<div class="row">
    <?php
    extract($_GET);
    extract($_POST);

    $db = dbConn();
    $sqlcheck = "SELECT * FROM price_request  WHERE Token='$token'";

    $resultcheck = $db->query($sqlcheck);

    $rowcheck = $resultcheck->fetch_assoc();

    $FinalUpdateDate = $rowcheck['FinalUpdateDate'];
    $cur_date = date('Y-m-d');

    if ($cur_date > $FinalUpdateDate) {
        header("Location:expired_price_request.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && @$action = 'submit') {
        extract($_POST);
        // read the submited array fields from html form
        foreach ($RequestId as $key => $RId) {
            //update the releven item request id with the price,
            $sql = "UPDATE `price_request_item` SET `UnitPrice`='$UnitPrice[$key]',UpdatedDate='$cur_date' WHERE Id='$RId'";
            $db->query($sql);
        }
    }
    //get the token from email and load relevent data via below query
    $sql = "SELECT pri.*,p.*,i.ItemName,D.DistributorName,pri.Id as irid FROM price_request_item pri LEFT JOIN price_request p ON pri.PriceRequestId=p.Id LEFT JOIN items i ON i.Id=pri.ItemId LEFT JOIN distributor d ON D.Id=P.DistributorId WHERE Token='$token'";
    $result = $db->query($sql);
    ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">

                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <table class="table table-hover text-nowrap ">
                            <tr>
                                <th>Request Date</th>
                                <th>Delivery Date</th>
                                 <th>Final Update Date</th>
                                <th>Distributor</th>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Unit Price</th>

                            </tr>
<?php
if ($result->num_rows > 0) {
    //use while loop to etrate the selecte data  and fill to the form below
    while ($row = $result->fetch_assoc()) {
        ?>
                                    <tr>
                                        <td><?= $row['RequestDate'] ?></td>
                                        <td><?= $row['DeliverDate'] ?></td>
                                        <td><?= $row['FinalUpdateDate'] ?></td>
                                        <td><?= $row['DistributorName'] ?></td>
                                        <td><?= $row['ItemName'] ?></td>
                                        <td><?= $row['Qty'] ?></td>

                                        <td> 
                                            <!-- add hidden field to keep the request item id -->
                                            <input type="hidden" name="RequestId[]" value="<?= $row['irid'] ?>">
                                            <!-- add text field to enter the price , both field are the array type due to request multiple price for the several item-->
                                            <input type="text"  name="UnitPrice[]" id="UnitPrice" placeholder="Enter Unit Price" value="<?= $row['UnitPrice'] ?>">
                                        </td> 
                                    </tr>
        <?php
    }
}
?>
                        </table>



                        <!-- add hidden file to kept the token for future references-->
                        <input type="hidden" name="token" value="<?= $token ?>">
                        <button type="submit" name='action' value="submit">Submit </button>
                    </form>
                </div>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

</div>
