<?php
ob_start();
include_once '../init.php';

$link = "Location Management";
$breadcrumb_item1 = "Locations";
$breadcrumb_item2 = "Add";
?>
<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>
<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>locations/manage.php" class="btn btn-dark mb-2"> <i class="fas fa-chevron-circle-left"></i></i> View Location</a>
        <div class="card card-primary ">
            <div class="card-header bgcolor">
                <h3 class="card-title">Add Location</h3>
            </div>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    extract($_POST);
                    
                    $LocationName = dataClean($LocationName);
                    $Area = dataClean($Area);
                    $Capacity = dataClean($Capacity);
                    

                    $message = array();
                    //Required validation-----------------------------------------------
                    
                    if (empty($LocationName)) {
                        $message['LocationName'] = "The Location Name should not be blank...!";
                    }
                    if(empty($Area)){
                        $message['Area']="The Area should not be blank...!";
                    }
                    if(empty($Capacity)){
                        $message['Capacity']="The Capacity should not be blank...!";
                    }
                    
                    if (empty($message)) {
                        $db = dbConn();
                        $sql = "INSERT INTO `locations`(`LocationName`, `Area`, `Capacity`) VALUES ('$LocationName','$Area','$Capacity')";
                        $db->query($sql);
                        header("Location:manage.php?status=add");
                    }
                }
                ?>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="card-body bgcolorbody">

                    <div class="form-group">
                        <label for="LocationName">Location Name:</label>
                        <input type="text" class="form-control" id="LocationName" name="LocationName" placeholder="Enter Location Name">
                    </div>
                    <div class="form-group">
                        <label for="Area">Area (pharmacy Section):</label>
                        <input type="text" class="form-control" id="Area" name="Area" placeholder="Enter Area">
                    </div>
                    <div class="form-group">
                        <label for="Capacity">Capacity:</label>
                        <input type="text" class="form-control" id="Capacity" name="Capacity" placeholder="Enter Capacity">
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