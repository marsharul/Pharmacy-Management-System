<?php

ob_start();
date_default_timezone_set('Asia/Colombo');

include_once '../init.php';
include '../../mail.php';
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    extract($_GET);
    $db = dbConn();
    $sql = "SELECT pri.*,p.*,i.ItemName,D.DistributorName,D.Email FROM price_request_item pri LEFT JOIN price_request p ON pri.PriceRequestId=p.Id LEFT JOIN items i ON i.Id=pri.ItemId LEFT JOIN distributor d ON D.Id=P.DistributorId WHERE RequestDate='$date'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();

    $Email = $row ['Email'];
    $RequestDate = $row['RequestDate'];
    $Distributor= $row ['DistributorName'];
    $send_token = bin2hex(random_bytes(16));

   

    
        $db = dbConn();

        echo $sql = "UPDATE `price_request` SET `Token`='$send_token' WHERE RequestDate = '$RequestDate'";
        $db->query($sql);
        
            
           
                $reset_link = "http://localhost/ceymedpms/system/inventory/view_quote.php?token=$send_token";

                $msg = "<h1>Price Request- Ceylon Medical</h1>";
                $msg .= "<h2> </h2>";
                $msg .= "<p>Hi, click the link below to View Price Request</p>";
                $msg .= "<a href='$reset_link'> click </a>";

                sendEmail($Email, $Distributor, "Price Request-Ceylon Medical", $msg);

               header("Location:process_quote.php"); 
           
        }
    

?>




