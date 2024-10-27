<?php
include '../function.php';

$db=dbConn();
$sql="SELECT COUNT(*) AS NOOFITEMS FROM `stocks`s LEFT JOIN items i ON s.ItemId = i.Id WHERE (s.Qty-s.IssuedQty) <= ReorderLevel";
$result= $db->query($sql);
$row = $result->fetch_assoc();

echo $row['NOOFEXPIRED'];