<?php
ob_start();
include_once '../init.php';
?> 
<?php
$link = "Item Management";
$breadcrumb_item1 = "Item";
$breadcrumb_item2 = "Manage";
?>
<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>

<div class="row">
    <div class="col-12">
        <a href="add.php" class="btn btn-dark mb-2"> <i class="fas fa-plus-circle"></i> Add Item</a>
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">Items Details</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 bgcolorbody">
                <?php
                $db = dbConn();
                $sql = "SELECT i.Id,i.ItemName,i.PackSize,d.Form,i.ReorderLevel,s.StatusName,i.UploadPicture,i.Description FROM items i INNER JOIN dosage_form d ON d.Id= i.FormId INNER JOIN status s ON s.Id= i.StatusId";
                $result = $db->query($sql);
                ?>
                <table class="table table-hover text-nowrap ">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Pack Size</th>
                            <th>Dosage Form</th>
                            <th>Reorder Level</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Picture</th>
                            <th> </th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                
                                ?>
                                <tr>
                                    <td><?= $row['ItemName'] ?>  </td>
                                    <td><?= $row['PackSize'] ?></td>
                                    <td><?= $row['Form'] ?></td>
                                    <td><?= $row['ReorderLevel'] ?></td>
                                    <td><?= $row['Description'] ?></td>
                                    <td class="<?=$row['StatusName']=='Active'?'text-success':'text-danger' ?>"><?= $row['StatusName'] ?></td>
                                    <td><a href="<?= SYS_URL ?>items/edit_image.php?id=<?=$row['Id'] ?>"><img src="../../upload_images/<?= empty($row['UploadPicture'])?"no_upload_images.png": $row['UploadPicture']?>" width="50" height="50"></a></td>
                                    <td><a href="<?= SYS_URL ?>items/edit.php?id=<?=$row['Id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                                    <td><a href="<?= SYS_URL ?>items/delete.php?id=<?=$row['Id'] ?>" class="btn btn-danger" onclick="return confirmDelete();"><i class="fas fa-trash"></i> Delete</a></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <script>
                function confirmDelete(){
                    return confirm("Are you sure you want to delete this record?")
                }
            </script>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<?php
$content = ob_get_clean();
include '../layouts.php';
?>
<!--Display sweet alert after adding stock-->
<script src="../../web/assets/js/sweetalert2@11.js" type="text/javascript"></script>
<?php 
    extract($_GET);
    if(isset($status)&& @$status=='add'){
?>
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Successfully Added!",
        showConfirmButton: false,
        timer: 1500
    });
</script>
<?php 
    }
?>
<!--End sweet alert-->