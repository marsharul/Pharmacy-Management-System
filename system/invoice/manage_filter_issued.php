<?php
ob_start();
include_once '../init.php';

$link = "Orders Management";
$breadcrumb_item1 = "Invoice";
$breadcrumb_item2 = "Manage";
?> 
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">Orders</h3>

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
            <?php
//                Display 
                $db= dbConn();
                $sql= "SELECT o.*,os.StatusName,c.*,u.* FROM orders o INNER JOIN order_status os ON o.StatusId=os.Id INNER JOIN customers c ON c.CustomerId= o.CustomerId LEFT JOIN users u ON u.UserId=c.UserId WHERE os.StatusName='Issued'";
                $result=$db->query($sql);
                
            ?>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 bgcolorbody">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Order Date</th>
                            <th>Customer Name</th>
                            <th>Delivery Name</th>
                            <th>Delivery Address</th>
                            <th>Delivery Phone </th>
                            <th>Order Notes </th>
                            <th>Order Number</th>
                            <th>Status</th>
                            <th> </th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($result->num_rows>0){
                                while($row=$result->fetch_assoc()){
                            
                        ?>
                        <tr>
                            <td><?= $row['OrderDate'] ?></td>
                            <td><?= $row['FirstName'] ?>  <?= $row['LastName']?> </td>
                            <td><?= $row['DeliveryName'] ?> </td>
                            <td><?= $row['DeliveryAddress'] ?></td>
                            <td><?= $row['DeliveryPhone'] ?> </td>
                            <td><?= $row['OrderNotes'] ?> </td>
                            <td><?= $row['OrderNumber'] ?></td>
                            <td><?= $row['StatusName'] ?></td>
                            <td><a href="<?= SYS_URL ?>invoice/view.php?id=<?=$row['Id'] ?>" class="btn btn-primary"> View</a> </td>
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