<?php
ob_start();
include_once '../init.php';
?> 
<?php
$link = "Coupon ";
$breadcrumb_item1 = "Coupon";
$breadcrumb_item2 = "Manage";
?>
<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>

<div class="row">
    <div class="col-12">
        <a href="add.php" class="btn btn-dark mb-2"> <i class="fas fa-plus-circle"></i> Add Coupon</a>
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">Coupon</h3>

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
                $sql = "SELECT c.*,s.StatusName FROM coupon c INNER JOIN status s ON s.Id= c.StatusId";
                $result = $db->query($sql);
                ?>
                <table class="table table-hover text-nowrap ">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Coupon Number</th>
                            <th>Discount</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
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
                                    <td><?= $row['Id'] ?></td>
                                    <td><?= $row['CouponNumber'] ?></td>
                                    <td><?= $row['Discount'] ?></td>
                                    <td><?= $row['ExpDate'] ?></td>
                                    <td class="<?=$row['StatusName']=='Active'?'text-success':'text-danger'; ?>"><?= $row['StatusName'] ?></td>
                                    <td><a href="<?= SYS_URL ?>Coupon/edit.php?id=<?= $row['Id']?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                                    <td><a href="<?= SYS_URL ?>Coupon/delete.php?id=<?= $row['Id']?>" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a></td>
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