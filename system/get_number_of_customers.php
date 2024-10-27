<?php
include '../function.php';

$db=dbConn();
$sql="SELECT COUNT(*) AS NOOFCUSTOMERS FROM `users` WHERE UserType='customer'";
$result= $db->query($sql);
$row = $result->fetch_assoc();

echo $row['NOOFCUSTOMERS'];
 