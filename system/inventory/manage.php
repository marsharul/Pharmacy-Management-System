<?php
ob_start();
include_once '../init.php';

$link = "Inventory Management";
$breadcrumb_item1 = "Inventory";
$breadcrumb_item2 = "Manage";
?>
<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>
<style>
    .reorder-level {
        background-color: red !important;
    }
</style>
<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>inventory/add_stock.php" class="btn btn-dark mb-2"><i class="fas fa-plus-circle"></i> Add Stock</a>
        <a href="<?= SYS_URL ?>inventory/manage_quote.php" class="btn btn-success mb-2"> View Price Request</a>
        <a href="<?= SYS_URL ?>inventory/process_quote.php" class="btn btn-primary mb-2"> Get Price Request</a>
        
        <!---------  Filter Form Field ---------->
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
            <input type="date" name="date_from">
            <input type="date" name="date_to">
            <input type="text" name="item_name" placeholder="Enter Item Name">
            <input type="text" name="supplier_name" placeholder="Enter Supplier">
            <input type="submit" value="search">
        </form>
        <!------------------------------------->
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">Stock Details</h3>

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
            
            <!---- Filter Query start---------->
            <?php
                $where=null;
                if($_SERVER['REQUEST_METHOD']=='POST'){
                   extract($_POST); 
                   
                   if(!empty($date_from)&& !empty($date_to)){
                   $where.= "PurchaseDate BETWEEN '$date_from' AND '$date_to'AND";
                   }
                   if (!empty($item_name)){
                       $where.=" i.ItemName= '$item_name' AND";
                   }
                   
                    if (!empty($supplier_name)){
                       $where.=" DistributorName= '$supplier_name' AND";
                   }
                   
                  if(!empty($where)){
                      $where= substr($where,0,-3);
                      $where= "WHERE ".$where;
                  }
                }
                ?>
            <!---------- Filter Query End -------->
            
            <div class="card-body table-responsive p-0 bgcolorbody">
                
                    <table class="table table-hover text-nowrap" >
                        <?php
                        $db = dbConn();
                        $sql = "SELECT s.Id,(s.Qty-S.IssuedQty) AS AvailQty, i.ItemName,i.ReorderLevel,do.Form,sq.Qty,RetailPrice,CostPrice,PurchaseDate,ExpiryDate,LocationName,DistributorName,IssuedQty FROM stocks s LEFT JOIN locations l ON l.Id=s.LocationId INNER JOIN items i ON s.ItemId=i.Id INNER JOIN dosage_form AS do ON do.Id=i.FormId INNER JOIN distributor d ON d.Id= s.DistributorId LEFT JOIN stock_qty sq ON sq.Id=s.Qty $where";
                        $result = $db->query($sql);
                        ?>
                        <thead>
                            <tr>
                                <th>Item Name </th>
                                <th>Form Dosage </th>
                                <th>Quantity</th>
                                <th>Retail Price</th>
                                <th>Cost Price</th>
                                <th>Purchase Date</th>
                                <th>Expiry Date</th>
                                <th>Location Name</th>
                                <th>Distributor</th>
                                <th>Issued Qty</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $AvailQty = $row['AvailQty'];
                                    $ReorderLevel=$row['ReorderLevel'];
                                    ?>
                                    <tr class="<?= ($AvailQty<=$ReorderLevel)?'reorder-level':''?>">
                                        <td><?= $row['ItemName'] ?></td>
                                        <td><?= $row['Form'] ?></td>
                                        <td><?= $row['Qty'] ?></td>
                                        <td><?= $row['RetailPrice'] ?></td>
                                        <td><?= $row['CostPrice'] ?></td>
                                        <td><?= $row['PurchaseDate'] ?></td>
                                        <td><?= $row['ExpiryDate'] ?></td>
                                        <td><?= $row['LocationName'] ?></td>
                                        <td><?= $row['DistributorName'] ?></td>
                                        <td><?= $row['IssuedQty'] ?></td>
                                        <td><a href="<?= SYS_URL ?>inventory/edit.php?id=<?= $row['Id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                                        <td><a href="<?= SYS_URL ?>inventory/delete.php?id=<?= $row['Id'] ?>" class="btn btn-danger" onclick="return confirmDelete();">  <i class="fas fa-trash"></i> Delete</a></td>
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
<!--Display sweet alert after adding stock-->
<script src="../../web/assets/js/sweetalert2@11.js" type="text/javascript"></script>
<?php
extract($_GET);
if (isset($status) && @$status == 'add') {
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
    
<script>
  $(function () {
    $("#inventory").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#inventory_wrapper .col-md-6:eq(0)');
    $('#inventory2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>