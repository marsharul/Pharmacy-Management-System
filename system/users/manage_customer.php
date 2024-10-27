<?php
ob_start();
include_once '../init.php';
?> 
<?php
$link = "User Management";
$breadcrumb_item1 = "Customer";
$breadcrumb_item2 = "Manage";
?>
<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>

<div class="row">
    <div class="col-12">
        
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">Customer Details</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0 bgcolorbody">
                <?php
                $db = dbConn();
                $sql = "SELECT UserName,TitleName,FirstName,LastName,Gender,AddressLine1,AddressLine2,AddressLine3,UserType FROM users u LEFT JOIN title t ON t.Id=u.TitleId WHERE UserType = 'customer'";
                $result = $db->query($sql);
                ?>
                <table class="table table-hover text-nowrap ">
                    <thead>
                        <tr>
                            <th>UserName</th>
                            <th>Title</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $Address= $row['AddressLine1'].','.$row['AddressLine2'].','.$row['AddressLine3'];
                                ?>
                                <tr>
                                    <td><?= $row['UserName'] ?>  </td>
                                    <td><?= $row['TitleName'] ?></td>
                                    <td><?= $row['FirstName'].'  '.$row['LastName'] ?></td>
                                    <td><?= $row['LastName'] ?></td>
                                    <td><?= $row['Gender'] ?></td>
                                    <td><?= $Address ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <script>
                function confirmDelete() {
                    return confirm("Are You Sure You Want to Delete this Record? ");
                }
            </script>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<?php
$content = ob_get_clean();
include '../layouts.php';
?>
