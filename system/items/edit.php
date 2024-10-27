<?php
ob_start();
include_once '../init.php';

$link = "Item Management";
$breadcrumb_item1 = "Item";
$breadcrumb_item2 = "Edit";
?>
<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>
<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>items/manage.php" class="btn btn-dark mb-2"> <i class="fas fa-chevron-circle-left"></i> View Items</a>
        <div class="card card-primary">
            <div class="card-header bgcolor">
                <h3 class="card-title">Edit Item </h3>
            </div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                extract($_GET);

                $db = dbConn();
                $sql = "SELECT * FROM items WHERE Id='$id'";
                $result = $db->query($sql);
                $row = $result->fetch_assoc();

                $ItemName = $row['ItemName'];
                $PackSize = $row['PackSize'];
                $FormId = $row['FormId'];
                $Strength = $row['Strength'];
                $UnitId = $row['UnitId'];
                $ItemIssue = $row['ItemIssue'];
                $ReorderLevel = $row['ReorderLevel'];
                $Status = $row['StatusId'];
                $Description = $row['Description'];
                $Id = $row['Id'];
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                extract($_POST);
                $ItemName = dataClean(ucwords($ItemName));
                $PackSize = dataClean($PackSize);
                $FormId = dataClean($FormId);
                $Strength = dataclean($Strength);
                $UnitId = dataclean($UnitId);
                $ItemIssue = dataclean($ItemIssue);
                $ReorderLevel = dataClean($ReorderLevel);
                $Status = dataClean($Status);

                $message = array();
                //Required validation-----------------------------------------------
                if (empty($ItemName)) {
                    $message['ItemName'] = "The Item Name should not be blank...!";
                }
                if (empty($PackSize)) {
                    $message['PackSize'] = "The Pack Size should not be blank...!";
                }
                if (empty($FormId)) {
                    $message['FormId'] = "The Dosage Form should not be blank...!";
                }
                if (empty($ReorderLevel)) {
                    $message['ReorderLevel'] = "The Reorder Level should not be blank...!";
                }
                if (empty($Status)) {
                    $message['Status'] = "The Status should not be blank...!";
                }


                if (empty($message)) {
                    $db = dbConn();
                    $sql = "UPDATE items SET ItemName='$ItemName',PackSize='$PackSize',FormId='$FormId',Strength='$Strength',UnitId='$UnitId',ItemIssue='$ItemIssue',ReorderLevel='$ReorderLevel',StatusId='$Status',Description='$Description' WHERE Id='$Id'";
                    $db->query($sql);

                    header('location:manage.php');
                }
            }
            ?>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body bgcolorbody">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="ItemName">Item Name</label>
                            <input type="text" class="form-control" id="ItemName" name="ItemName" placeholder="Enter Item Name" value="<?= @$ItemName ?>">
                            <span class='text-danger'><?= @$message['ItemName'] ?></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="PackSize">Pack Size</label>
                            <input type="text" class="form-control" id="PackSize" name="PackSize" placeholder="Enter Item Pack Size" value="<?= @$PackSize ?>">
                            <span class='text-danger'><?= @$message['PackSize'] ?></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="Form">Dosage Form</label>
                            <select name="FormId" id="FormId" class="form-control" value="" >
                                <option value="">-- Select Form Type --</option>
                                <?php
                                $db = dbConn();
                                $sql = "SELECT * FROM dosage_form WHERE StatusId='1'";
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row['Id'] ?>" <?= @$FormId == $row['Id'] ? 'selected' : '' ?>><?= $row['Form'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class='text-danger'><?= @$message['FormId'] ?></span>

                        </div>
                    </div>
                    <div><!-- medicine strength with units -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Strength</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>   <input type="number" class="form-control" id="Strength" name="Strength" placeholder="Enter medicine strength in Numbers" value="<?= @$Strength ?>">   </td>
                                    <td>
                                        <select name="UnitId" id="UnitId" class="form-control" value="" >
                                            <option value="">-- Select Units --</option>
                                            <?php
                                            $db = dbConn();
                                            $sql = "SELECT * FROM units";
                                            $result = $db->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $row['Id'] ?>" <?= @$UnitId == $row['Id'] ? 'selected' : '' ?>><?= $row['UnitName'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="form-group col-md-1">

                        <label> Item Issue</label><br/>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="Prescription" name="ItemIssue" value="Prescription"<?= $ItemIssue == 'Prescription' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="Prescription">Prescription</label><br/>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="NonPrescription" name="ItemIssue" value="NonPrescription"<?= $ItemIssue == 'NonPrescription' ? 'checked' : '' ?> >
                            <label class="form-check-label" for="NonPrescription"> None_Prescription </label>
                        </div>
                        <span class="text-danger"> <?= @$message['ItemIssue'] ?> </span>
                    </div>

                    <div class="form-group">
                        <label for="CategoryName">Reorder Level</label>
                        <input type="text" class="form-control" id="ReorderLevel" name="ReorderLevel" placeholder="Enter Item Category" value="<?= @$ReorderLevel ?>">
                        <span class='text-danger'><?= @$message['ReorderLevel'] ?></span>

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
                                    <option value="<?= $row['Id'] ?>"<?= @$Status == $row['Id'] ? 'selected' : '' ?>><?= $row['StatusName'] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <span class='text-danger'><?= @$message['Status'] ?></span>

                    </div>
<!--                    <div class="form-group">
                        <label for="file">Upload Picture</label>
                        <input type="file" class="form-control" id="file" name="file" >
                        <span class='text-danger'><?= @$message['file_error'] ?></span>

                    </div>-->

                    <div class="form-group">
                        <label for="Description">Description</label>
                        <textarea class="form-control" id="Description" name="Description" rows="3"><?= @$Description ?></textarea>
                    </div>
                </div>

                <div class="card-footer bgcolorbody">
<!--                    <input type="text" name="PrevImage" value="<?= $file ?>" >-->
                    <input type="hidden" name="Id" value="<?= $Id ?>">
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
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
            .create(document.querySelector('#Description'))
            .catch(error => {
                console.error(error);
            });
</script>
