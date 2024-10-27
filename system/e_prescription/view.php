<?php
ob_start();
include_once '../init.php';

$link = "E-Precription Management";
$breadcrumb_item1 = "E-Precription";
$breadcrumb_item2 = "View";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    extract($_GET);
} else {
    extract($_POST);
}

$db = dbConn();
$sql = "SELECT p.*,ps.StatusName,pu.* FROM prescriptions p INNER JOIN prescription_status ps ON ps.Id=p.StatusId INNER JOIN prescription_upload pu ON pu.PrescriptionId = p.Id WHERE p.Id='$id'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
$PrescriptionId = $row['PrescriptionId'];
?> 
<!--Display Patient & Prescription details-->
<div class="row">
    <div class="col">        
        <div class="card">
            <div class="card-body">
                <h4>Patient Details</h4>
                <label>Patient Name: </label>
                <?= $row['PatientName'] ?><br>
                <label>Patient Age:</label>
                <?= $row['PatientAge'] ?><br>
                <label>Email:</label>
                <?= $row['Email'] ?><br>
                <label>Contact No:</label>
                <?= $row['ContactNo'] ?>

            </div>

        </div> 


    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Comments</h4>
                <?= $row['Comments'] ?>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Uploaded_at</h4>
                <?= $row['uploaded_at'] ?>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Status</h4>
                <?= $row['StatusName'] ?>
            </div>
        </div>
    </div>
</div> 
<!--End Details-->
<!--Display uploaded Prescription-->

<div class="row">
    <?php
    $db = dbConn();
    $sql = "SELECT * FROM `prescription_upload` WHERE PrescriptionId='$id'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        while ($uploadrow = $result->fetch_assoc()) {
//            if(!empty($uploadrow['UploadFile'])){
            ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        <img src="../../upload_images/<?= $uploadrow['UploadFile'] ?>" alt="" width="100%" height="100%">
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>

</div>
<!--End display prescription-->
<!--Add Stock Items from the prescription to issue-->
<div>
    <a href="<?= SYS_URL ?>e_prescription/manage.php" class="btn btn-dark mb-2"> <i class="fas fa-chevron-circle-left"></i> View</a>
    <div class="card">
        
        <div class="card-header">
            <h3 class="card-title">Add Stock Items</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                extract($_POST);
                $message = array();

                if (empty($message)) {
                    if (empty($quote_id)) { // If submit new quotation
                        $db = dbConn();
                         $sql = "INSERT INTO `quotation`(`PrescriptionId`) VALUES ('$id')";
                        $db->query($sql);
                        $QuotationId = $db->insert_id;
                        foreach ($ItemId as $key => $value) {
                            $I = dataClean($value);
                            $q = dataClean($Qty[$key]);
                            $price = dataClean($RetailPrice[$key]);
                            $sql = "INSERT INTO `quotation_items`(`QuotationId`,`ItemId`, `RetailPrice`, `Qty`) VALUES ('$QuotationId','$I','$price','$q')";
                            $db->query($sql);
                        }
//                     <------Update Status from 'Pending' to 'processed'----->
                        $db = dbConn();
                        $sql3 = "UPDATE `prescriptions` SET `StatusId`='2' WHERE Id='$id'";
                        $db->query($sql3);
//                      <------------ End Status ---------------------->
                        
                    } else {// if update quotation
                        $db = dbConn();
                        $sql = "DELETE FROM quotation_items WHERE QuotationId='$quote_id'";
                        $db->query($sql);
                        foreach ($ItemId as $key => $value) {
                            $I = dataClean($value);
                            $q = dataClean($Qty[$key]);
                            $price = dataClean($RetailPrice[$key]);
                            $sql = "INSERT INTO `quotation_items`(`QuotationId`,`ItemId`, `RetailPrice`, `Qty`) VALUES ('$quote_id','$I','$price','$q')";
                            $db->query($sql);
                        }
                    }
                }
//                <------create session-------->
                 
 //               <------ End session --------->
            }
            ?>
            <!-- Start Form-->
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <?php
                $db = dbConn();
                $sql_quotation = "SELECT * FROM quotation_items i INNER JOIN quotation q ON q.Id=i.QuotationId WHERE q.PrescriptionId='$id'";
                $result_quotation = $db->query($sql_quotation);
                ?>

                <table class="table table-striped" id="items">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_quotation->num_rows > 0) {

                            while ($row_quotation = $result_quotation->fetch_assoc()) {
                                ?>
                                <tr class="items-row">
                                    <td>
                                        <select name="ItemId[]" id="ItemId[]" class="form-control  " >
                                            <option value="">---</option>
                                            <?php
                                            $db = dbConn();
                                            $sql = "SELECT Id, ItemName FROM items";
                                            $result = $db->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $row['Id'] ?>" <?php
                                                    if ($row['Id'] == $row_quotation['ItemId']) {
                                                        echo 'selected';
                                                    }
                                                    ?>><?= $row['ItemName'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </select>
                                    </td>
                                    <td><input type="number" value="<?= $row_quotation['Qty'] ?>" name="Qty[]" id="Qty" class="form-control" ></td>
                                    <td><input type="text"  value="<?= $row_quotation['RetailPrice'] ?>" name="RetailPrice[]" id="RetailPrice" class="form-control" ></td>
                                    <td><button class="removeBtn" type="button">Remove </button></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr class="items-row">
                                <td>
                                    <select name="ItemId[]" id="ItemId[]" class="form-control  " >
                                        <option value="">--</option>
                                        <?php
                                        $db = dbConn();
                                        $sql = "SELECT Id, ItemName FROM items";
                                        $result = $db->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <option value="<?= $row['Id'] ?>"><?= $row['ItemName'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><input type="number" name="Qty[]" id="Qty" class="form-control" ></td>
                                <td><input type="text" name="RetailPrice[]" id="RetailPrice" class="form-control" ></td>
                                <td><button class="removeBtn" type="button">Remove </button></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <button type="button" id="addBtn" class="btn btn-warning"> Add Items</button>

                <br/> 
                <br/>

                <?php
                $db = dbConn();
                $sql2 = "SELECT * FROM quotation WHERE PrescriptionId ='$PrescriptionId'";
                $result2 = $db->query($sql2);
                $row2 = $result2->fetch_assoc();

                if ($result2->num_rows > 0) {
                    $QuoteId = $row2['Id']; //quotation id
                    echo '<input type="hidden" name="quote_id" value="' . $QuoteId . '">';
                }
                echo '<input type="hidden" name="id" value="' . $PrescriptionId . '">';
                ?>
                <button type="submit" name="operate" value="add_quotation_cart"  class="btn btn-primary"> Submit</button>


            </form>
            <!--End form-->
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include '../layouts.php';
?>
<script>
    $(document).ready(function () {
        function addItems() {
            var tableBody = $('#items tbody');
            var newRow = tableBody.find('.items-row').first().clone(true);

            //clear input values in the cloned row
            newRow.find('input').val('');

            //Append the cloned row to the table body
            tableBody.append(newRow);
            $('.select2').select2();
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

//            // Reinitialize select2 for the new select element
//            newRow.find('.select2').select2();
        }
        function removeItems(button) {
            var row = $(button).closest('tr');
            row.remove();
        }
        $('#addBtn').click(addItems);
        $('#items').on('click', '.removeBtn', function () {
            removeItems(this);
        });

//        // Initialize select2 on document ready
//        $('.select2').select2();
    });


</script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>
