<?php
ob_start();
session_start();
include_once '../init.php';

extract($_POST);
$db = dbConn();
$sql = "SELECT * FROM orders o INNER JOIN order_status os ON o.StatusId=os.Id INNER JOIN customers c ON c.CustomerId= o.CustomerId LEFT JOIN users u ON u.UserId=c.UserId WHERE o.Id='$id' ";
$result = $db->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bill</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 80%;
                margin: auto;
            }
            .header, .footer {
                text-align: center;
                padding: 10px;
            }
            .header {
                border-bottom: 1px solid #000;
            }
            .footer {
                border-top: 1px solid #000;
                margin-top: 20px;
            }
            .customer-details, .bill-details, .items {
                margin: 20px 0;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 10px;
                text-align: left;
            }
            .total {
                text-align: right;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Ceylon Medical</h1>
                <p>No.48 Fussels Lane,Wellawatte</p>
                <p>Colombo-06</p>
                <p>Phone: 0112 236 636 | Email: ceymedpms@gmail.com</p>
            </div>

            <div class="customer-details">
                <h2>Bill To:</h2>
                <p><?= $row['BillingName'] ?></p>
                <p><?= $row['BillingAddress'] ?></p>
                <p><?= $row['BillingPhone'] ?></p>
            </div>

            <div class="bill-details">
                <p><b>Bill Number:</b> <?php echo $row['OrderNumber']; ?></p>
                <p><b>Date:</b> <?php echo date('Y-m-d'); ?></p>

                <p><b>Cashier:</b> <?php
                    if (isset($_SESSION['USERID'])) {
                        echo $_SESSION['FIRSTNAME'] . " " . $_SESSION['LASTNAME'];
                    }
                    ?></p>
            </div>

            <div class="items">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    extract($_POST);
                    $db = dbConn();
                    $sql = "SELECT ois.*,i.ItemName,(ois.RetailPrice * ois.IssuedQty)AS Total FROM `order_items_issue` ois LEFT JOIN `items`i ON ois.ItemId= i.Id WHERE OrderId='$id'";
                    $result = $db->query($sql);
                }
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['ItemName']; ?></td>
                                    <td><?php echo $row['IssuedQty']; ?></td>
                                    <td><?php echo $row['RetailPrice']; ?></td>
                                    <td><?php echo $row['IssuedQty'] * $row['RetailPrice']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                    <?php
                    $db = dbConn();
                    $sql2 = "SELECT SUM(ois.RetailPrice * ois.IssuedQty)AS SubTotal,o.CouponDiscount FROM `order_items_issue` ois LEFT JOIN `items`i ON ois.ItemId= i.Id LEFT JOIN `orders`o ON ois.OrderId=o.Id WHERE OrderId='$id'";
                    $result2 = $db->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $total = $row2['SubTotal'];
                    ?>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="total">Total</td>
                            <td><?php echo number_format($total, 2); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="total">Discount (Coupon)</td>
                            <td><?= number_format($total * $row2['CouponDiscount'], 2) ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="total">Net total</td>
                            <td><?= number_format(($total - $total * $row2['CouponDiscount']), 2) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="print-button">
                <button onclick="printInvoice()">Print Invoice</button>
            </div>
            <div class="footer">
                <p>Thank you for your business! Get Well Soon.</p>
            </div>
            <?php
            $sql = "UPDATE `orders` SET `StatusId`='3' WHERE Id=$id";
            $db->query($sql);
            ?>
        </div>
    </body>
</html>

<script>
    function printInvoice() {
        window.print();
    }
</script>