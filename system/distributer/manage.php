<?php
ob_start();
include_once '../init.php';

$link = "Distributer Management";
$breadcrumb_item1 = "Distributer";
$breadcrumb_item2 = "Manage";
?> 
<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>distributer/add.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> Add Distributor</a>
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">Distributor Details</h3>

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
                $sql = "SELECT d.Id,d.DistributorName,d.RegisterDate,s.StatusName FROM distributor d INNER JOIN status s WHERE s.Id= d.StatusId";
                $result = $db->query($sql);
                ?>
                
                <table class="table table-hover text-nowrap" id="myTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Distributor Name</th>
                            <th>Register Date</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $row['Id'] ?></td>
                                    <td><?= $row['DistributorName'] ?></td>
                                    <td><?= $row['RegisterDate'] ?></td>
                                    <td class="<?=$row['StatusName']=='Active'?'text-success':'text-danger'; ?>"><?= $row['StatusName'] ?></td>
                                    <td><a href="<?=SYS_URL?>distributer/edit.php?id=<?= $row['Id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                                    <td><a href="<?=SYS_URL?>distributer/delete.php?id=<?=$row['Id'] ?>" class="btn btn-danger" onclick="return confirmDelete();"><i class="fas fa-trash"></i> Delete</a></td>
                                   
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
                    return confirm("Are You sure you want to delete this record?")
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
