<?php

session_start();
include '../function.php';

extract($_POST);

if ($_SERVER['REQUEST_METHOD'] == "POST" && $operate == 'add_cart') {

    $db = dbConn();
    $sql = "SELECT * FROM stocks s INNER JOIN items i ON s.ItemId=i.Id WHERE s.Id='$Id'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$Id])) {
        $current_qty = $_SESSION['cart'][$Id]['Qty'] += 1;
    } else {
        $current_qty = 1;
    }


    $_SESSION['cart'][$Id] = array('StockId' => $Id, 'ItemId' => $row['ItemId'], 'ItemName' => $row['ItemName'], 'RetailPrice' => $row['RetailPrice'], 'UploadPicture' => $row['UploadPicture'], 'Qty' => $current_qty);

    header('location:shop.php');
} 