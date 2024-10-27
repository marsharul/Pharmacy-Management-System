<?php
ob_start();
include_once '../init.php';


$link = "Report Management";
$breadcrumb_item1 = "Reports";
$breadcrumb_item2 = "Items to be expire";



?> 

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        
        
        extract($_POST); 
        $db = dbConn();

        $sql = "SELECT s.Id AS StockId,i.ItemName,(s.Qty-s.IssuedQty) AS current_available_qty,s.RetailPrice,s.CostPrice,s.ExpiryDate,l.LocationName,l.Area,d.DistributorName FROM stocks s LEFT JOIN distributor d ON s.DistributorId=d.Id LEFT JOIN locations l ON l.Id=s.LocationId LEFT JOIN items i ON i.Id=s.ItemId WHERE ExpiryDate <= DATE_ADD(CURDATE(), INTERVAL 3 MONTH)AND s.ExpiryDate > CURDATE();";
        $result = $db->query($sql);
        ?>
        <table class="table table-hover text-nowrap" id="printTable">
            <thead>
                <tr>
                    <th> Stock Id</th>
                    <th> Item Name</th>
                    <th> Current Stock Qty</th>
                    <th> Retail Price</th>
                    <th> Cost Price</th>
                    <th> Expiry Date</th>
                    <th> Location Name</th>
                    <th> Area</th>
                    <th> Distributor Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <?= $row['StockId'] ?>
                        </td>
                        <td><?= $row['ItemName'] ?></td>
                        <td><?= $row['current_available_qty'] ?></td>
                        <td><?= $row['RetailPrice'] ?></td>
                        <td><?= $row['CostPrice'] ?></td>
                        <td><?= $row['ExpiryDate'] ?></td>
                        <td><?= $row['LocationName'] ?></td>
                        <td><?= $row['Area'] ?></td>
                        <td><?= $row['DistributorName'] ?></td>
                        
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <button onclick="printData()">print</button>
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