<?php
include_once '../init.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    extract($_GET);
    $db = dbConn();
   echo $sql = "DELETE FROM coupon  WHERE Id = '$id'";
    $result = $db->query($sql); 
    header("Location:manage.php");
}
