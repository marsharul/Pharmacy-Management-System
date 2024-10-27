<?php
ob_start();
include_once 'init.php';

$link = "Dashboard";
$breadcrumb_item1 = "Dashboard";
$breadcrumb_item2 = "View";
?>     
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <a href="<?= SYS_URL ?>/orders/manage_filter_pending.php" class="small-box-footer">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="NumberOfOrders"></h3>

                    <h5>New Online Shop Orders</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <a href="<?= SYS_URL ?>/e_prescription/manage_filter_pending.php" class="small-box-footer">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 id="NumberOfPrescription"></h3>

                    <h5>New e-Prescription Orders</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <a href="<?= SYS_URL ?>/users/manage_customer.php" class="small-box-footer">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="NumberOfCustomers"></h3>

                    <h5>Customer Registrations</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </a>
    </div>
    
    <!-- ./col -->
  
    <!-- ./col -->
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <a href="<?= SYS_URL ?>/report/reorder_items.php" class="small-box-footer">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3 id="NumberOfReorder">
                        <?php
                        $db = dbConn();
                        $sql = "SELECT COUNT(*) AS NOOFITEMS FROM `stocks`s LEFT JOIN items i ON s.ItemId = i.Id WHERE (s.Qty-s.IssuedQty) <= ReorderLevel";
                        $result = $db->query($sql);
                        $row = $result->fetch_assoc();
                        
                        echo $row['NOOFITEMS'];
                        ?>
                    </h3>

                    <h5>Reorder Items</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
<!-- Main row -->

<div class="row">
    <!-- Left col -->
    <section class="col-lg-6 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
            <?php
//                Display 
            $db = dbConn();

            $sql = "SELECT DATE_FORMAT(OrderDate,'%Y') AS YEAR,DATE_FORMAT(OrderDate,'%M') AS MONTH, COUNT(*) AS NOOFORDERS FROM orders o LEFT JOIN customers c ON o.CustomerId=c.CustomerId LEFT JOIN users u ON u.UserId=c.UserId GROUP BY DATE_FORMAT(OrderDate,'%Y-%m')";
            $result = $db->query($sql);
            ?>
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">Online Shop Orders</h3>

            </div>
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
        </div>
        <!-- /.card -->



    </section>
    <section class="col-lg-6 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
            <?php
//                Display 
            $db = dbConn();

            $sql = "SELECT DATE_FORMAT(uploaded_at,'%Y') AS YEAR,DATE_FORMAT(uploaded_at,'%M') AS MONTH,COUNT(*) AS NOOFORDERS FROM `prescriptions` GROUP BY DATE_FORMAT(uploaded_at,'%Y-%m')";
            $result = $db->query($sql);
            ?>
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">e-Prescription Orders</h3>

            </div>
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
        </div>
        <!-- /.card -->



    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">



    </section>
    <!-- right col -->
</div>
<!-- /.row (main row) -->

<?php
$content = ob_get_clean();
include 'layouts.php';
?>

<script>
    $(document).ready(function () {

        function playSound(url) {
            var audio = new Audio(url);
            audio.play();
        }
        function checkForNewOrder() {
            $.ajax({
                url: 'orders/check_for_new_order.php', // Path to PHP file that checks for new orders
                type: 'GET',
                dataType: 'json',
                success: function (response) {

                    if (response.NewOrderFlag) {
                        // Play sound when a new order is detected
                        playSound('assets/mixkit-access-allowed-tone-2869.wav');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', status, error);
                }
            });
        }
        setInterval(checkForNewOrder, 5000);

        function getNumberOfOrders() {
            $.ajax({
                url: 'orders/get_number_of_orders.php', // request the 'data'(no of orders) from 'getNumberOfOrders.php' file
                type: 'GET',
                success: function (data) { //pass the 'data' to the function
                    $("#NumberOfOrders").html(data); // display the data in relevent id <h3 id="NumberOfOrders"></h3>
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }
        getNumberOfOrders();

        //check for no of orders periodically (eg :- every 5 seconds)
        setInterval(getNumberOfOrders, 5000);

        //--------------------------------
        function getNumberOfCustomers() {
            $.ajax({
                url: 'get_number_of_customers.php', // request the 'data'(no of customers) from 'get_number_of_customers.php' file
                type: 'GET',
                success: function (data) { //pass the 'data' to the function
                    $("#NumberOfCustomers").html(data); // display the data in relevent id <h3 id="NumberOfOrders"></h3>
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }
        getNumberOfCustomers();

        //check for no of customers periodically (eg :- every 5 seconds)
        setInterval(getNumberOfCustomers, 5000);

        //--------------------------------------------------
        function getNumberOfPrescription() {
            $.ajax({
                url: 'get_number_of_prescription.php', // request the 'data'(no of Prescription) from 'get_number_of_customers.php' file
                type: 'GET',
                success: function (data) { //pass the 'data' to the function
                    $("#NumberOfPrescription").html(data); // display the data in relevent id <h3 id="NumberOfOrders"></h3>
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }
        getNumberOfPrescription();

        //check for no of orders periodically (eg :- every 5 seconds)
        setInterval(getNumberOfPrescription, 5000);

        //--------------------------------------------------
        function getNumberOfExpired() {
            $.ajax({
                url: 'get_number_of_expired.php', // request the 'data'(no of customers) from 'get_number_of_customers.php' file
                type: 'GET',
                success: function (data) { //pass the 'data' to the function
                    $("#NumberOfExpired").html(data); // display the data in relevent id <h3 id="NumberOfOrders"></h3>
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }
        getNumberOfExpired();
//
        //check for no of orders periodically (eg :- every 5 seconds)
        setInterval(getNumberOfExpired, 5000);
    });

    //-------------------------------------------------------------------------
    function getNumberOfReorder() {
        $.ajax({
            url: 'get_number_of_reorder.php', // request the 'data'(no of Prescription) from 'get_number_of_customers.php' file
            type: 'GET',
            success: function (data) { //pass the 'data' to the function
                $("#NumberOfReorder").html(data); // display the data in relevent id <h3 id="NumberOfOrders"></h3>
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }
    getNumberOfReorder();



</script>

