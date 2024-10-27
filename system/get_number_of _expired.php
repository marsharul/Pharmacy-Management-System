<?php
include '../function.php';

$db=dbConn();
$sql="SELECT COUNT(*) AS NOOFEXPIRED FROM `stocks` WHERE ExpiryDate < CURDATE()";
$result= $db->query($sql);
$row = $result->fetch_assoc();

echo $row['NOOFEXPIRED'];
 