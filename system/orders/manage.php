<?php
ob_start();
include_once '../init.php';

$link = "Orders Management";
$breadcrumb_item1 = "Orders";
$breadcrumb_item2 = "Manage";
?> 
<div class="row">
    <div class="col-12">
        <!--------- Filter Form ------------------------>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
            <input type="date" name="date_from">
            <input type="date" name="date_to">
            <input type="text" name="item_name" placeholder="Enter Item Name">
            <input type="text" name="supplier_name" placeholder="Enter Supplier">
            <input type="submit" value="search">
        </form>
        <!------------------------------------------------>
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">Orders</h3>

                
            </div>
            <!-------------- $where ---------------------------------->
            <?php
                $where=null;
                if($_SERVER['REQUEST_METHOD']=='POST'){
                   extract($_POST); 
                   
                   if(!empty($date_from)&& !empty($date_to)){
                   $where.= "OrderDate BETWEEN '$date_from' AND '$date_to'AND";
                   }
//                   if (!empty($item_name)){
//                       $where.=" i.ItemName= '$item_name' AND";
//                   }
//                   
//                    if (!empty($supplier_name)){
//                       $where.=" DistributorName= '$supplier_name' AND";
//                   }
                   
                  if(!empty($where)){
                      $where= substr($where,0,-3);
                      $where= "WHERE ".$where;
                  }
                }
                ?>
            <!-------------------------------------------------------->
            <?php
//                Display 
                $db= dbConn();
                //$sql="SELECT * FROM orders o INNER JOIN order_status os ON o.StatusId=os.Id  INNER JOIN customers c ON c.CustomerId= o.CustomerId LEFT JOIN users u ON u.UserId=c.UserId";
                $sql= "SELECT o.*,os.StatusName,c.*,u.* FROM orders o INNER JOIN order_status os ON o.StatusId=os.Id INNER JOIN customers c ON c.CustomerId= o.CustomerId LEFT JOIN users u ON u.UserId=c.UserId $where";
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
                            <th>Delivery Method </th>
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
                            <td><?= $row['DeliveryMethod'] ?> </td>
                            <td><?= $row['OrderNotes'] ?> </td>
                            <td><?= $row['OrderNumber'] ?></td>
                            <td><?= $row['StatusName'] ?></td>
                            <td><a href="<?= SYS_URL ?>orders/view.php?id=<?=$row['Id'] ?>" class="btn btn-primary"> View</a> </td>
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