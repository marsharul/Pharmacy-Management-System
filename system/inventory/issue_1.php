<?php

include_once '../init.php';
$db = dbConn();

$IssuedQty = 4;
$ItemId = 32;

while ($IssuedQty > 0) {
    $sql = "SELECT * FROM `stocks` WHERE ItemId = $ItemId AND (Qty - IssuedQty)>0 ORDER BY PurchaseDate ASC LIMIT 1"; //select 'first in stock'(out of same multiple stock of different puchase date) according to ascending order of purchase date(FIFO)
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $AvailableQty = $row['Qty'] - $row['IssuedQty'];

        if ($IssuedQty <= $AvailableQty) {

            $i_qty = $IssuedQty;
            $StockId = $row['Id'];

            $sql = "UPDATE `stocks` SET `IssuedQty`= `IssuedQty` + $i_qty WHERE Id=$StockId";
            $db->query($sql);
            $IssuedQty = 0;
        }else{
            $i_qty = $AvailableQty;
            $StockId = $row['Id'];
            $sql = "UPDATE `stocks` SET `IssuedQty` = `IssuedQty` + $i_qty WHERE Id = $StockId";
            $db->query($sql);
            $IssuedQty -= $i_qty;  
            
        }
    }else{
        break;
    }
}

