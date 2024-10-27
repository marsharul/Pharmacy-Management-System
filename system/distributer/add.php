<?php
ob_start();
include_once '../init.php';

$link = "Distributer Management";
$breadcrumb_item1 = "Distributer";
$breadcrumb_item2 = "Add";
?>
<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>
<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>distributer/manage.php" class="btn btn-dark mb-2"> <i class="fas fa-chevron-circle-left"></i></i> View Distributor</a>
        <div class="card card-primary ">
            <div class="card-header bgcolor">
                <h3 class="card-title">Add New Distributor</h3>
            </div>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    extract($_POST);
                    
                    $DistributorName = dataClean($DistributorName);
                    $RegisterDate = dataClean($RegisterDate);
                    $Status = dataClean($Status);
                    

                    $message = array();
                    //Required validation-----------------------------------------------
                    
                    if (empty($DistributorName)) {
                        $message['DistributorName'] = "The Distributor should not be blank...!";
                    }
                    if(empty($RegisterDate)){
                        $message['RegisterDate']="The Register Date should not be blank...!";
                    }
                    if(empty($Status)){
                        $message['Status']="The Status should not be blank...!";
                    }
                    
                    if (empty($message)) {
                        $db = dbConn();
                        echo $sql = "INSERT INTO `distributor`(`DistributorName`,`RegisterDate`,`StatusId`) VALUES ('$DistributorName','$RegisterDate','$Status')";
                        $db->query($sql);
                        header("Location:manage.php?status=add");
                    }
                }
                ?>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="card-body bgcolorbody">

                    <div class="form-group">
                        <label for="$DistributorName">Distributor Name</label>
                        <input type="text" class="form-control" id="DistributorName" name="DistributorName" placeholder="Enter Supplier Name">
                    </div>

                    <div class="form-group">
                        <label for="RegisterDate">Register Date</label>
                        <input type="date" class="form-control" id="RegisterDate" name="RegisterDate">
                    </div>

                    <div class="form-group">
                        <label for="Status">Status</label>
                        <select class="form-control" id="Status" name="Status">
                            <option value="">-- Select --</option>
                            <?php
                                $db= dbConn();
                                $sql="SELECT * FROM status ";
                                $result=$db->query($sql);
                                
                                if($result->num_rows>0){
                                    while($row=$result->fetch_assoc()){
                                        ?>
                            <option value="<?=$row['Id'] ?>"<?= @$Status==$row['Id']?'selected':''?>><?= $row['StatusName']?></option>
                            <?php
                                    }
                                }
                                ?>
                        </select>
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