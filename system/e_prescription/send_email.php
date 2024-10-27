<?php
include_once '../init.php';
include '../../mail.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $Email = $row['Email'];
    $PatientName = $row['PatientName'];
//send Email to customer
    $msg = "<h1>Thank You for submitting prescription Order</h1>";
    $msg .= "<h2>Now,Your Order is Completed</h2>";
    $msg .= "<p>Please,Click on the below link to confirm your order</p>";
    $msg .= "<a href='http://localhost/ceymedpms/web/e_prescription_manage.php'>Click here </a>";

    sendEmail($Email, $PatientName, "e-Prescription", $msg);
}
header('location:view_quotation_items.php');