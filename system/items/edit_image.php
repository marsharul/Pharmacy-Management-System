<?php
ob_start();
include_once '../init.php';

$link = "Item Management";
$breadcrumb_item1 = "Item_Image";
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
                
                $Id = $row['Id'];
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                extract($_POST);
                $message = array();
                //Required validation-----------------------------------------------
               

//                //------------------------------image upload start-----------------------------------
                if (empty($message)) {
                    $files = $_FILES['file']; //get the file
                    if (!empty($_FILES['file']['name'])) { // with or without upload files
                        $file_name = $files['name'];
                        $file_tmp = $files['tmp_name'];
                        $file_size = $files['size'];
                        $file_error = $files['error'];

            //The file extension
                        $ext = explode('.', $file_name);
                        $ext = strtolower(end($ext));

            //allowed file type
                        $allowed = array('png', 'jpg', 'jpeg');
                        if (in_array($ext, $allowed)) {
                            if ($file_error === 0) {
                                if ($file_size <= 2097152) { // 2MB file size limit
                                    $prefix = "item_img_";
                                    $file_name = uniqid($prefix, true) . '.' . $ext;
                                    $file_destination = '../../upload_images/' . $file_name;
                                    move_uploaded_file($file_tmp, $file_destination);
                                } else {
                                    $message['file_error'] = "The file is too large (less than 2MB)...!";
                                }
                            } else {
                                $message['file_error'] = "The upload file has error..!";
                            }
                        } else {
                            $message['file_error'] = "Invalid file type..!";
                        }
                    } 
//                    else {
//                        $file_name = $PrevImage;
//                    }
                }
//                //-------------------------------------image upload end---------------------------------------------------------
//

                if (empty($message)) {
                    $db = dbConn();
                    $sql = "UPDATE items SET UploadPicture='$file_name' WHERE Id='$Id'";
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
                            <input type="text" disabled class="form-control" id="ItemName" name="ItemName" placeholder="Enter Item Name" value="<?= @$ItemName ?>">
                        </div>
                        </div>
                    <img src="../../upload_images/<?= empty($row['UploadPicture'])?"no_upload_images.png": $row['UploadPicture']?>" width="150" height="150">
                    </div>
                   
                    <div class="form-group">
                        <label for="file">Upload Picture</label>
                        <input type="file" class="form-control" id="file" name="file" >
                        <span class='text-danger'><?= @$message['file_error'] ?></span>

                    </div>

                    
                </div>

                <div class="card-footer bgcolorbody">
<!--                    <input type="text" name="PrevImage" value="<?= $file ?>" >-->
                    <input type="hidden" name="Id" value="<?= $Id ?>">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
$content = ob_get_clean();
include '../layouts.php';
?>


