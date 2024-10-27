<?php
include'../../function.php';
//                Display 
$db = dbConn();

$sql = "SELECT DATE_FORMAT(OrderDate,'%Y') AS YEAR,DATE_FORMAT(OrderDate,'%M') AS MONTH, COUNT(*) AS NOOFORDERS FROM orders o LEFT JOIN customers c ON o.CustomerId=c.CustomerId LEFT JOIN users u ON u.UserId=c.UserId GROUP BY DATE_FORMAT(OrderDate,'%Y-%m')";
$result = $db->query($sql);
?>
<html>
    <head>
        <title>No Of Orders</title>
    </head>
    <body>


        <!-- /.card-header -->
        <div class="card-body table-responsive p-0 bgcolorbody">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>Year </th>
                        <th>Month</th>
                        <th>Number Of Orders</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?= $row['YEAR'] ?></td>
                                <td><?= $row['MONTH'] ?></td>
                                <td><?= $row['NOOFORDERS'] ?> </td>
                            </tr>
        <?php
    }
}
?>
                </tbody>
            </table>
        </div>
    </body> 
</html>