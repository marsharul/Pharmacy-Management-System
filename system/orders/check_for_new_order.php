<?php

include '../../function.php';
$db = dbConn();

$NewOrderFlag = false; //initially, assume no new orders
$sql = "SELECT * FROM `orders` WHERE NewOrderFlag='1'";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    $NewOrderFlag = true;
    $sql = "UPDATE `orders` SET `NewOrderFlag`='0'";
    $db->query($sql);
}

echo json_encode(array("NewOrderFlag" => $NewOrderFlag));
