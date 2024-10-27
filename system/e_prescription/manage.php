<?php
ob_start();
include_once '../init.php';
?> 
<?php
$link = "E-Precription Management";
$breadcrumb_item1 = "E-Precription";
$breadcrumb_item2 = "Manage";
?>
<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>

<div class="row">
    <div class="col-12">
        <a href="add.php" class="btn btn-dark mb-2"> <i class="fas fa-plus-circle"></i> Add Item</a>
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">Prescription Details</h3>

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
                $sql = "SELECT p.*,ps.StatusName FROM prescriptions p INNER JOIN prescription_status ps ON ps.Id=p.StatusId ";
                $result = $db->query($sql);
                ?>
                <table class="table table-hover text-nowrap ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>Patient Age</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Comments</th>
                            <th>Status</th>
                            <th> </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $row['Id'] ?>  </td>
                                    <td><?= $row['PatientName'] ?></td>
                                    <td><?= $row['PatientAge'] ?></td>
                                    <td><?= $row['Email'] ?></td>
                                    <td><?= $row['ContactNo'] ?></td>
                                    <td><?= $row['Comments'] ?></td>
                                    <td><?= $row['StatusName'] ?></td>
                                    <td><a href="<?= SYS_URL ?>e_prescription/view.php?id=<?= $row['Id'] ?>" class="btn btn-primary"><i class="far fa-eye"></i> View</a></td>
                                    <td><?php if($row['StatusName']== 'Pending') {?>
                                        
                                    <?php }else{ ?>
                                        <a href="<?= SYS_URL ?>e_prescription/view_quotation_items.php?id=<?= $row['Id'] ?>" class="btn btn-secondary"><i class="far fa-eye"></i> View Quotation details</a></td>
                                    <?php } ?>    
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<?php
$content = ob_get_clean();
include '../layouts.php';
?>
