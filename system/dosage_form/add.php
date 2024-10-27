<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>
<?php
ob_start();
include_once '../init.php';

$link = "Dosage Form";
$breadcrumb_item1 = "Dosage Form";
$breadcrumb_item2 = "Add";
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);

  
    $Form = dataClean(ucwords($Form));
    $Status = dataClean($Status);

    $message = array();
    //Required validation-----------------------------------------------

    
    if (empty($Form)) {
        $message['Form'] = "The Dosage Form should not be blank...!";
    }
    if (empty($Status)) {
        $message['Status'] = "The Status should not be blank...!";
    }
    
    if(!empty($Form)){
        $db = dbConn();
        $sql="SELECT * FROM dosage_form WHERE Form='$Form'";
        $result=$db->query($sql);
        if($result->num_rows>0){
            $message['Form']="This Dosage Form Type Already Exist...!";
        }
    }
    if (empty($message)) {
        $db = dbConn();
        $sql = "INSERT INTO `dosage_form`(`Form`,`StatusId`) VALUES ('$Form','$Status')";
        $db->query($sql);
        header("Location:manage.php");
    }
}
?>


<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>dosage_form/manage.php" class="btn btn-dark mb-2"><i class="fas fa-chevron-circle-left"></i>  View</a>
        <div class="card card-primary ">
            <div class="card-header bgcolor">
                <h3 class="card-title">Add Item Dosage Form</h3>
            </div>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="card-body bgcolorbody">

                    <div class="form-group">
                        <label for="Form">Dosage Form</label>
                        <input type="text" class="form-control" id="Form" name="Form" placeholder="Enter Dosage Form" value="<?= @$Form ?>">
                        <span class="text-danger"><?= @$message['Form'] ?></span>
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