<?php
include '../../function.php';

$db=dbConn();
$sql="SELECT COUNT(*) AS NOOFORDERS FROM orders o INNER JOIN order_status os ON o.StatusId=os.Id WHERE os.StatusName='Pending'";
$result= $db->query($sql);
$row = $result->fetch_assoc();

echo $row['NOOFORDERS'];
 