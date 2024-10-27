<?php
ob_start();
include_once '../init.php';

$link = "Inventory Management";
$breadcrumb_item1 = "Inventory";
$breadcrumb_item2 = "Manage_quote";
?>
<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>

<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>inventory/manage.php" class="btn btn-dark mb-2"><i class="fas fa-chevron-circle-left"></i> back</a>
        
<!--        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
            <input type="date" name="date_from">
            <input type="date" name="date_to">
            <input type="text" name="item_name" placeholder="Enter Item Name">
            <input type="text" name="supplier_name" placeholder="Enter Supplier">
            <input type="submit" value="search">
        </form>-->
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">Mange Distributor Price Request</h3>

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
//                $where=null;
//                if($_SERVER['REQUEST_METHOD']=='POST'){
//                   extract($_POST); 
//                   
//                   if(!empty($date_from)&& !empty($date_to)){
//                   $where.= "PurchaseDate BETWEEN '$date_from' AND '$date_to'AND";
//                   }
//                   if (!empty($item_name)){
//                       $where.=" i.ItemName= '$item_name' AND";
//                   }
//                   
//                    if (!empty($supplier_name)){
//                       $where.=" DistributorName= '$supplier_name' AND";
//                   }
//                   
//                  if(!empty($where)){
//                      $where= substr($where,0,-3);
//                      $where= "WHERE ".$where;
//                  }
//                }
//                ?>
            <div class="card-body table-responsive p-0 bgcolorbody">
               
                    <table class="table table-hover text-nowrap" >
                        <?php
                        $db = dbConn();
                        $sql = "SELECT p.DeliverDate,p.RequestDate,p.FinalUpdateDate,d.DistributorName,d.Email,p.Token FROM `price_request` p LEFT JOIN distributor d ON p.DistributorId=d.Id";
                        $result = $db->query($sql);
                        ?>
                        <thead>
                            <tr>
                                <th>Request Date </th>
                                <th>Deliver Date </th>
                                <th>Final Update Date</th>
                                <th>Distributor Name </th>
                                <th>Email</th>
                                <th>Token</th>
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
                                        <td><?= $row['RequestDate'] ?></td>
                                        <td><?= $row['DeliverDate'] ?></td>
                                        <td><?= $row['FinalUpdateDate'] ?></td>
                                        <td><?= $row['DistributorName'] ?></td>
                                        <td><?= $row['Email'] ?></td>
                                        <td><?= $row['Token'] ?></td>
                                        <td><a href="<?= SYS_URL ?>inventory/view_quote.php?token=<?= $row['Token'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> View</a></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                   
              
            </div>
            <script>
                function confirmDelete() {
                    return confirm("Are you sure you want to delete this record?");
                }
            </script>
        </div>

    </div>

</div>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>

    
