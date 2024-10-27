<?php
ob_start();
include_once 'init.php';

$link = "Dashboard";
$breadcrumb_item1 = "Dashboard";
$breadcrumb_item2 = "View";
?>     

<!------------- Store Keeper - DASHBOARD --------------------->
<!-- Small boxes (Stat box) -->
<div class="row">
    
    
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
 
        <a href="<?= SYS_URL ?>/report/expired_item.php" class="small-box-footer">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3 id="NumberOfExpired"> 
                        <?php
                        $db = dbConn();
                        $sql = "SELECT COUNT(*) AS NOOFEXPIRED FROM `stocks` WHERE ExpiryDate < CURDATE()";
                        $result = $db->query($sql);
                        $row = $result->fetch_assoc();

                        echo $row['NOOFEXPIRED'];
                        ?>
                    </h3>

                    <h5>Expired Items</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>

            </div>
        </a>
    </div>
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
    <!--            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
        </a>
    </div>
    <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <a href="<?= SYS_URL ?>/report/soon_to_be_expire.php" class="small-box-footer">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="NumberOfReorder">
                        <?php
                        $db = dbConn();
                        $sql = "SELECT COUNT(*) AS NOOFITEMS FROM stocks s LEFT JOIN distributor d ON s.DistributorId=d.Id LEFT JOIN locations l ON l.Id=s.LocationId LEFT JOIN items i ON i.Id=s.ItemId WHERE ExpiryDate <= DATE_ADD(CURDATE(), INTERVAL 3 MONTH)AND s.ExpiryDate > CURDATE()";
                        $result = $db->query($sql);
                        $row = $result->fetch_assoc();
                        
                        echo $row['NOOFITEMS'];
                        ?>
                    </h3>

                    <h5>Item Expire in 3 months</h5>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
    <!--            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
        </a>
    </div>
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
    
    
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

