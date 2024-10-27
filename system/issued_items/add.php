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
                <h3 class="card-title">Issue New Item</h3>
            </div>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="card-body bgcolorbody">

                    <div class="form-group">
                        <label for="item_id">Item ID</label>
                        <input type="text" class="form-control" id="item_id" name="item_id" placeholder="Enter Item ID">
                    </div>

                    <div class="form-group">
                        <label for="order_id">Order ID</label>
                        <input type="text" class="form-control" id="order_id" name="order_id" placeholder="Enter Order ID">
                    </div>

                    <div class="form-group">
                        <label for="qty">Quantity</label>
                        <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter Quantity">
                    </div>

                    <div class="form-group">
                        <label for="unit_price">Unit Price</label>
                        <input type="text" class="form-control" id="unit_price" name="unit_price" placeholder="Enter Unit Price">
                    </div>

                    <div class="form-group">
                        <label for="issued_date">Issued Date</label>
                        <input type="date" class="form-control" id="issued_date" name="issued_date">
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