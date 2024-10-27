<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>
<?php
ob_start();
include_once '../init.php';

$link = "Coupon";
$breadcrumb_item1 = "Coupon";
$breadcrumb_item2 = "Add";
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);

  
    $Coupon = dataClean($Coupon);
    $Discount = dataClean($Discount);
    $Status = dataClean($Status);

    $message = array();
    //Required validation-----------------------------------------------

    
    if (empty($Coupon)) {
        $message['Coupon'] = "This Field should not be blank...!";
    }
    if (empty($Discount)) {
        $message['Discount'] = "This Field should not be blank...!";
    }
    if (empty($ExpiryDate)) {
        $message['ExpiryDate'] = "This Field should not be blank...!";
    }
    if (empty($Status)) {
        $message['Status'] = "The Status should not be blank...!";
    }
    
    if(!empty($Coupon)){
        $db = dbConn();
        echo$sql= "SELECT * FROM `coupon` WHERE Discount='$Discount' || CouponNumber='$Coupon'";
        $result=$db->query($sql);
        if($result->num_rows>0){
            $message['Discount']="This Coupon Discount Already Exist...!";
        }
    }
    if (empty($message)) {
        $db = dbConn();
        $sql = "INSERT INTO `coupon`(`CouponNumber`,`Discount`,`ExpDate`,`StatusId`) VALUES ('$Coupon','$Discount','$ExpiryDate','$Status')";
        $db->query($sql);
        header("Location:manage.php");
    }
}
?>


<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>Coupon/manage.php" class="btn btn-dark mb-2"><i class="fas fa-chevron-circle-left"></i>  View</a>
        <div class="card card-primary ">
            <div class="card-header bgcolor">
                <h3 class="card-title">Add Coupon</h3>
            </div>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="card-body bgcolorbody">

                    <div class="form-group">
                        <label for="Form">Coupon Number :</label>
                        <input type="text" class="form-control" id="Coupon" name="Coupon" placeholder="Enter Coupon" value="<?= @$Coupon ?>">
                        <span class="text-danger"><?= @$message['Coupon'] ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="Form">Discount :</label>
                        <input type="text" class="form-control" id="Discount" name="Discount" placeholder="Enter Discount" value="<?= @$Discount ?>">
                        <span class="text-danger"><?= @$message['Discount'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="Form">Expiry Date :</label>
                        <input type="date" class="form-control" id="ExpiryDate" name="ExpiryDate" placeholder="Enter Expiry Date" value="<?= @$ExpiryDate ?>">
                        <span class="text-danger"><?= @$message['ExpiryDate'] ?></span>
                    </div>

                    <div class="form-group">
                        <label for="Status">Status</label>
                        <select class="form-control" id="Status" name="Status">
                            <option value="">-- select status --</option>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM status";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $row['Id']?>"<?=@$Status==$row['Id']?'selected':'' ?>><?= $row['StatusName']?></option>
                                    <?php
                                }
                            }
                                    ?>
                                </select>
                                <span class="text-danger"><?= @$message['Status'] ?></span>
                            </div>

                </div>
                <div class="card-footer bgcolorbody">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>