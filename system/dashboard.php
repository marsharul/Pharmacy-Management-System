<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'init.php';

$link = "Dashboard";
$breadcrumb_item1 = "Dashboard";
$breadcrumb_item2 = "View";
$userid=$_SESSION['USERID'];
$db= dbConn();
$sql="SELECT * FROM employee INNER JOIN designation ON designation.DesigId=employee.DesigId WHERE employee.UserId='$userid'";
$result=$db->query($sql);
$row=$result->fetch_assoc();

$dashboard="dashboard_".$row['Designation'].".php";

include $dashboard;
?>
