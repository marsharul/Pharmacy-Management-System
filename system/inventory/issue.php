<?php

include_once '../init.php';
$db = dbConn();
extract($_POST);

foreach ($IssuedQty as $key => $value) {

    $IssuedQty = $value;
    $ItemId = $Items[$key];
    $RetailPrice = $RetailPrice[$key];

    while ($IssuedQty > 0) {
        $sql = "SELECT * FROM `stocks` WHERE ItemId = $ItemId AND (Qty - IssuedQty)>0 ORDER BY PurchaseDate ASC LIMIT 1"; //select 'first in stock'(out of same multiple stock of different puchase date) according to ascending order of purchase date(FIFO)
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $AvailableQty = $row['Qty'] - $row['IssuedQty'];
            $ItemId = $row['ItemId'];
            $IssuedDate = date('Y-m-d');
            $RetailPrice = $row['RetailPrice'];

            if ($IssuedQty <= $AvailableQty) {

                $i_qty = $IssuedQty;
                $StockId = $row['Id'];

                $sql = "UPDATE `stocks` SET `IssuedQty`= `IssuedQty` + $i_qty WHERE Id=$StockId";
                $db->query($sql);

                $sql = "INSERT INTO `order_items_issue`(`OrderId`, `ItemId`, `StockId`, `RetailPrice`, `IssuedQty`, `IssueDate`) VALUES ('$OrderId','$ItemId','$StockId','$RetailPrice','$i_qty','$IssuedDate')";
                $db->query($sql);

                $IssuedQty = 0;
            } else {
                $i_qty = $AvailableQty;
                $StockId = $row['Id'];
                $sql = "UPDATE `stocks` SET `IssuedQty` = `IssuedQty` + $i_qty WHERE Id = $StockId";
                $db->query($sql);

                $sql = "INSERT INTO `order_items_issue`(`OrderId`, `ItemId`, `StockId`, `RetailPrice`, `IssuedQty`, `IssueDate`) VALUES ('$OrderId','$ItemId','$StockId','$RetailPrice','$i_qty','$IssuedDate')";
                $db->query($sql);

                $IssuedQty -= $i_qty;
            }
        } else {
            break;
        }
    }
}
//Update Order Status
$sql = "UPDATE `orders` SET `StatusId`='2' WHERE Id=$OrderId";
$db->query($sql);
header("Location:../orders/view.php?id=$OrderId");
