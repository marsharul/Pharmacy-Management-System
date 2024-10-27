<?php
include_once '../init.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    extract($_GET);
    $db = dbConn();
    $sql = "DELETE FROM distributor  WHERE Id = '$id'";
    $result = $db->query($sql); 
    header("Location:manage.php");
}
