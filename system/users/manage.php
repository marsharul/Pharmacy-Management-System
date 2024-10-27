<?php
ob_start();
include_once '../init.php';
?> 
<?php
$link = "User Management";
$breadcrumb_item1 = "User";
$breadcrumb_item2 = "Manage";
?>
<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>

<div class="row">
    <div class="col-12">
        <a href="add.php" class="btn btn-dark mb-2"> <i class="fas fa-plus-circle"></i> New</a>
        <div class="card">
            <div class="card-header bgcolor">
                <h3 class="card-title text-white">User Details</h3>

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
                $sql = "SELECT * FROM users u INNER JOIN employee e ON e.UserId=u.UserId LEFT JOIN designation p ON p.DesigId= e.DesigId LEFT JOIN title t ON t.Id=u.TitleId;";
                $result = $db->query($sql);
                ?>
                <table class="table table-hover text-nowrap ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Full Name</th>
                            <th>Gender</th>
                            <th>NIC</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th>Appoint Date</th>
                            <th>Designation</th>
                            <th>Profile Image</th>
                            <th> </th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $Address= $row['AddressLine1'].','.$row['AddressLine2'].','.$row['AddressLine3'];
                                ?>
                                <tr>
                                    <td><?= $row['UserId'] ?>  </td>
                                    <td><?= $row['TitleName'] ?></td>
                                    <td><?= $row['FirstName'].'  '.$row['LastName'] ?></td>
                                    <td><?= $row['Gender'] ?></td>
                                    <td><?= $row['NIC'] ?></td>
                                    <td><?= $row['Contact Number'] ?></td>
                                    <td><?= $Address ?></td>
                                    <td><?= $row['AppointDate'] ?></td>
                                    <td><?= $row['Designation'] ?></td>
                                    <td><img src="../../upload_images/<?= empty($row['ProfileImage'])?"profile.png":$row['ProfileImage'] ?>" width="50" height="50"></td>
                                    <td><a href="<?= SYS_URL ?>users/edit.php?userid=<?= $row['UserId'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a></td>
                                    <?php if($row['Designation']!= 'admin'){ ?>
                                    <td><a href="<?= SYS_URL ?>users/delete.php?userid=<?= $row['UserId'] ?>" class="btn btn-danger" onclick="return confirmDelete();"><i class="fas fa-trash"></i> Delete</a></td>
                                    <?php } ?>
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
<script>
  $(function () {
    $("#users").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#users_wrapper .col-md-6:eq(0)');
    $('#users2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>