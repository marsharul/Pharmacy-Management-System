<?php

session_start();
include '../function.php';

extract($_GET);

if ($_SERVER['REQUEST_METHOD'] == "POST" && $operate == 'Accept') {

    $db = dbConn();
//    $sql = "SELECT * FROM quotation_items qi INNER JOIN items i ON qi.ItemId=i.Id";
    $sql="SELECT * FROM quotation q INNER JOIN quotation_items qi ON q.Id=qi.QuotationId LEFT JOIN items i ON qi.ItemId=i.Id WHERE PrescriptionId=$id";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

//    if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$Id])) {
//        $current_qty = $_SESSION['cart'][$Id]['Qty'] += 1;
//    } else {
//        $current_qty = 1;
//    }


    $_SESSION['cart2'][$id] = array( 'ItemId' => $row['ItemId'], 'ItemName' => $row['ItemName'], 'RetailPrice' => $row['RetailPrice'], 'UploadPicture' => $row['UploadPicture'], 'Qty' => $row['Qty']);
   
    if(isset($_SESSION['cart2'])){
    print_r($_SESSION['cart2']);
    }else{
        echo 'cart not assigned';
    }
//    header('location:quotation_cart.php');
}