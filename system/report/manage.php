<?php
ob_start();
include_once '../init.php';


$link = "Report Management";
$breadcrumb_item1 = "Reports";
$breadcrumb_item2 = "Manage";



?> 


   <div class="col-lg-3 col-6">
        <!-- small box -->
        <a href="soon_to_be_expire.php" class="small-box-footer">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 id="NumberOfCustomers"></h3>

                    <h5>Items to be Expire In 3 Months</h5>
                </div>
            </div>
        </a>
    </div>
<div class="col-lg-3 col-6">
        <!-- small box -->
        <a href="reorder_items.php" class="small-box-footer">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="NumberOfCustomers"></h3>

                    <h5>Reorder Items</h5>
                </div>
            </div>
        </a>
    </div>
<div class="col-lg-3 col-6">
        <!-- small box -->
        <a href="sales.php" class="small-box-footer">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 id="NumberOfCustomers"></h3>

                    <h5>Sales</h5>
                </div>
            </div>
        </a>
    </div>

<?php
$content = ob_get_clean();
include '../layouts.php';
?>