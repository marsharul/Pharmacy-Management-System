<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>
<?php
ob_start();
include_once '../init.php';
?>
<div class="row">
    <div class="col-12">
        <a href="" class="btn btn-dark mb-2"> <i class="fas fa-plus-circle"></i> New</a>
        <div class="card card-primary ">
            <div class="card-header bgcolor">
                <h3 class="card-title">Add New Order</h3>
            </div>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="card-body bgcolorbody">

                    <div class="form-group">
                        <label for="order_date">Order Date</label>
                        <input type="date" class="form-control" id="order_date" name="order_date">
                    </div>

                    <div class="form-group">
                        <label for="customer_id">Customer ID</label>
                        <input type="text" class="form-control" id="customer_id" name="customer_id" placeholder="Enter Customer ID">
                    </div>

                    <div class="form-group">
                        <label for="shipping_address">Shipping Address</label>
                        <textarea class="form-control" id="shipping_address" name="shipping_address" rows="3" placeholder="Enter Shipping Address"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="billing_address">Billing Address</label>
                        <textarea class="form-control" id="billing_address" name="billing_address" rows="3" placeholder="Enter Billing Address"></textarea>
                    </div>

                </div>
                <div class="card-footer bgcolorbody">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>


<?php
$content = ob_get_clean();
include '../layouts.php';
?>