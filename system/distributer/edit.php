<?php
ob_start();
include_once '../init.php';

$link = "Distributer Management";
$breadcrumb_item1 = "Distributer";
$breadcrumb_item2 = "Edit";
?>
<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>
<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>distributer/manage.php" class="btn btn-dark mb-2"> <i class="fas fa-chevron-circle-left"></i></i> View Distributor</a>
        <div class="card card-primary ">
            <div class="card-header bgcolor">
                <h3 class="card-title">Edit Distributor</h3>
            </div>
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'GET'){
                    extract($_GET);
                    
                    $db= dbConn();
                    $sql="SELECT * FROM distributor WHERE Id='$id' ";
                    $result= $db->query($sql);
                    $row=$result->fetch_assoc();
                    
                    $DistributorName= $row['DistributorName'];
                    $RegisterDate= $row['RegisterDate'];
                    $Status=$row['StatusId'];
                    $Id=$row['Id'];
                }
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
                        $sql="UPDATE `distributor` SET `DistributorName`='$DistributorName',`RegisterDate`='$RegisterDate',`StatusId`='$Status' WHERE Id='$Id'";
                        $db->query($sql);
                        header("Location:manage.php");
                    }
                }
                ?>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="card-body bgcolorbody">

                    <div class="form-group">
                        <label for="$DistributorName">Distributor Name</label>
                        <input type="text" class="form-control" id="DistributorName" name="DistributorName" placeholder="Enter Supplier Name" value="<?= $DistributorName?>">
                    </div>

                    <div class="form-group">
                        <label for="RegisterDate">Register Date</label>
                        <input type="date" class="form-control" id="RegisterDate" name="RegisterDate" value="<?= $RegisterDate?>">
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
                    <input type="hidden" name="Id" value="<?=$Id?>">
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