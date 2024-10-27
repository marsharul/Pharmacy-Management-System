<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>
<?php
ob_start();
include_once '../init.php';

$link = "Category";
$breadcrumb_item1 = "Item Category Management";
$breadcrumb_item2 = "Edit";
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    extract($_GET);

    $db = dbConn();
    $sql = "SELECT * FROM category WHERE Id='$id'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    $Category = $row['CategoryName'];
    $Status = $row['StatusId'];
    $Id=$row['Id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);

    $Category = dataClean(ucwords($Category));
    $Status = dataClean($Status);

    $message = array();
    //Required validation-----------------------------------------------


    if (empty($Category)) {
        $message['CategoryName'] = "The Category Type should not be blank...!";
    }
    if (empty($Status)) {
        $message['Status'] = "The Status should not be blank...!";
    }


    if (empty($message)) {
        $db = dbConn();
        $sql="UPDATE category SET CategoryName ='$Category',StatusId ='$Status' WHERE Id ='$Id'";
        $db->query($sql);
        header("Location:manage.php");
    }
}
?>


<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>category/manage.php" class="btn btn-dark mb-2"><i class="fas fa-chevron-circle-left"></i>  View</a>
        <div class="card card-primary ">
            <div class="card-header bgcolor">
                <h3 class="card-title">Edit Category</h3>
            </div>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="card-body bgcolorbody">

                    <div class="form-group">
                        <label for="Category">Category :</label>
                        <input type="text" class="form-control" id="Category" name="Category" placeholder="Enter Category" value="<?= @$Category ?>">
                        <span class="text-danger"><?= @$message['CategoryName'] ?></span>
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