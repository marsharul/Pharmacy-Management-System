<?php
include '../function.php';

$db=dbConn();
$sql="SELECT COUNT(*)AS NOOFPRESCRIPTION FROM `prescriptions` p INNER JOIN prescription_status ps ON p.StatusId=ps.Id WHERE ps.StatusName ='Pending'";
$result= $db->query($sql);
$row = $result->fetch_assoc();

echo $row['NOOFPRESCRIPTION'];
 