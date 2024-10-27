<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>
<?php
ob_start();
include_once '../init.php';

$link = "Dosage Form";
$breadcrumb_item1 = "Dosage Form";
$breadcrumb_item2 = "Edit";
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    extract($_GET);

    $db = dbConn();
    $sql = "SELECT * FROM dosage_form WHERE Id='$id'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    $Form = $row['Form'];
    $Status = $row['StatusId'];
    $Id=$row['Id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);

    $Form = dataClean(ucwords($Form));
    $Status = dataClean($Status);

    $message = array();
    //Required validation-----------------------------------------------


    if (empty($Form)) {
        $message['Form'] = "The Dosage Form Type should not be blank...!";
    }
    if (empty($Status)) {
        $message['Status'] = "The Status should not be blank...!";
    }


    if (empty($message)) {
        $db = dbConn();
        $sql="UPDATE dosage_form SET Form ='$Form',StatusId ='$Status' WHERE Id ='$Id'";
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
                <h3 class="card-title">Edit Dosage Form</h3>
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
                                    <option value="<?= $row['Id']?>"<?= @$Status==$row['Id']?'selected':'' ?>><?= $row['StatusName']?></option>
                                    <?php
                                }
                            }
                                    ?>
                                </select>
                                <span class="text-danger"><?= @$message['Status'] ?></span>
                            </div>

                        </div>
                        <div class="card-footer bgcolorbody">
                            <input type="hidden" name="Id" value="<?= $Id?>">
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