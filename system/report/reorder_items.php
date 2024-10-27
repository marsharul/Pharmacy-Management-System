<?php
ob_start();
include_once '../init.php';


$link = "Report Management";
$breadcrumb_item1 = "Reports";
$breadcrumb_item2 = "Reorder Items";



?> 

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">Reorder Items</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 bgcolorbody">
                <?php
                $db = dbConn();
                $sql = "SELECT s.Id AS StockId,i.ItemName,(s.Qty-s.IssuedQty) AS current_available_qty,i.ReorderLevel,s.PurchaseDate,s.ExpiryDate,s.RetailPrice,s.CostPrice,l.LocationName,l.Area,d.DistributorName FROM stocks s LEFT JOIN distributor d ON s.DistributorId=d.Id LEFT JOIN locations l ON l.Id=s.LocationId LEFT JOIN items i ON i.Id=s.ItemId WHERE (s.Qty-s.IssuedQty) <= i.ReorderLevel";
                $result = $db->query($sql);
                ?>
                <table class="table table-hover text-nowrap " id="printTable">
                    <thead>
                        <tr>
                            <th>Stock Id</th>
                            <th>Item Name</th>
                            <th>Current Stock Qty</th>
                            <th>Reorder Level</th>
                            <th>Purchase Date</th>
                            <th>Expiry Date</th>
                            <th>Retail Price</th>
                            <th>Cost Price</th>
                            <th>Location Name</th>
                            <th>Area</th>
                            <th>Distributor Name</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $row['StockId'] ?>  </td>
                                    <td><?= $row['ItemName'] ?></td>
                                    <td><?= $row['current_available_qty'] ?></td>
                                    <td><?= $row['ReorderLevel'] ?></td>
                                    <td><?= $row['PurchaseDate'] ?></td>
                                    <td><?= $row['ExpiryDate'] ?></td>
                                    <td><?= $row['RetailPrice'] ?></td>
                                    <td><?= $row['CostPrice'] ?></td>
                                    <td><?= $row['LocationName'] ?></td>
                                    <td><?= $row['Area'] ?></td>
                                    <td><?= $row['DistributorName'] ?></td>
                                    
                                       
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <button onclick="printData()">print</button>
            </div>

            <!-- /.card-body -->
        </div>
    </body>
</html>

   

<?php
$content = ob_get_clean();
include '../layouts.php';
?>
<script>
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
</script>