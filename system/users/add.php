<?php
ob_start();
include_once '../init.php';
?> 
<link href="../assets/dist/css/mystylecss.css" rel="stylesheet" type="text/css"/>
<?php
$link = "User Management";
$breadcrumb_item1 = "User";
$breadcrumb_item2 = "Add User";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    extract($_POST);
// Start Data Clean
    $FirstName = dataClean($FirstName);
    $LastName = dataClean($LastName);
    $NIC = dataClean($NIC);
    $ContactNumber = dataClean($ContactNumber);
    $AddressLine1 = dataClean($AddressLine1);
    $AddressLine2 = dataClean($AddressLine2);
    $AddressLine3 = dataClean($AddressLine3);
    $DesignationId = dataClean($DesignationId);
    $AppointDate = dataClean($AppointDate);
    $UserName = dataClean($UserName);
// End Data Clean

    $message = array();

// <-------------------------------------------Required Validation Start------------------------------------------------>
    if (empty($Title)) {
        $message['Title'] = "Title is not Selected...!";
    }
    if (empty($FirstName)) {
        $message['FirstName'] = "The First Name should not be blank...!";
    }
    if (empty($LastName)) {
        $message['LastName'] = "The Last Name should not be blank...!";
    }
    if (empty($NIC)) {
        $message['NIC'] = "The NIC should not be blank...!";
    }
    if (empty($ContactNumber)) {
        $message['Contact_Number'] = "The Contact Number should not be blank...!";
    }
    if (!isset($gender)) {
        $message['gender'] = "Gender is required......!";
    }

    if (empty($AddressLine1)) {
        $message['AddressLine1'] = "The AddressLine1 should not be blank...!";
    }

    if (empty($AddressLine2)) {
        $message['AddressLine2'] = "The AddressLine2 should not be blank...!";
    }

    if (empty($AppointDate)) {
        $message['AppointDate'] = "The Appoint Date should not be blank...!";
    }
    if (empty($DesignationId)) {
        $message['Designation'] = "The Designation should not be blank...!";
    }
    if (empty($UserName)) {
        $message['UserName'] = "The User Name is required...!";
    }
    if (empty($Password)) {
        $message['Password'] = "The Password is required...!";
    }

    if (empty($ConfirmPassword)) {
        $message ['ConfirmPassword'] = "Confirm Password is required...!";
    }
//<----------------------------------------Required Validation END------------------------------------------------------->
//<------------------------------------Advanced Validation START-------------------------------------------------------->

    if (!empty($UserName)) {
        $db = dbConn();
        $sql = "SELECT * FROM users WHERE UserName='$UserName'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $message['UserName'] = "This User Name already exist...!";
        }
    }
//----------------Start NIC Validation------------------
    $niclength = strlen($NIC);
    if (!empty($NIC)) {
        if ($niclength != 10 && $niclength != 12) {
            $message['NIC'] = "Invalid NIC...!";
        } else {
            if ($niclength == 10) {
                if (strtoupper(substr($NIC, -1)) != 'V') {
                    $message['NIC'] = "Invalid NIC...!";
                }
            }
        }
    }

    if (!empty($NIC)) {
        $db = dbConn();
        $sql = "SELECT * FROM employee WHERE NIC='$NIC'";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $message['NIC'] = "This NIC already exist...!";
        }
    }

//-----------------------------------------------------------------------//
//-------------------Start Contact Number Validation------------------------
    if (!empty($ContactNumber)) {
        $MobileNoLen = strlen($ContactNumber);
        if ($MobileNoLen !== 10 || !ctype_digit($ContactNumber)) {
            $message['Contact_Number'] = "Invalid Contact Number...!";
        }
    }
//------------------------------------------------------------------------// 
    //password validation
    if (!empty($Password)) {
        $uppercase = preg_match('@[A-Z]@', $Password);
        $lowercase = preg_match('@[a-z]@', $Password);
        $number = preg_match('@[0-9]@', $Password);
        $specialChars = preg_match('@[^\w]@', $Password);

        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($Password) < 8) {
            $message['Password'] = 'Password should be at least 8 characters in length and should include at least '
                    . 'one uppercase letter, one lowercase letter, one number, and one special character.';
        }
    }
//-------------------------File Upload-------------------------------------
    if (empty($message)) {
        $files = $_FILES['file']; //get the file
        if (!empty($_FILES['file']['name'])) { // with or without upload files
            $file_name = $files['name'];
            $file_tmp = $files['tmp_name'];
            $file_size = $files['size'];
            $file_error = $files['error'];

//The file extension
            $ext = explode('.', $file_name);  //explode-convert string into arrays
            $ext = strtolower(end($ext)); //end- get end array,thats file type(png/jpg)
//allowed file type
            $allowed = array('png', 'jpg', 'jpeg');
            if (in_array($ext, $allowed)) {
                if ($file_error === 0) {
                    if ($file_size <= 2097152) {  // 2MB file size limit
                        $file_name = uniqid('', true) . '.' . $ext;
                        $file_destination = '../../upload_images/' . $file_name;
                        move_uploaded_file($file_tmp, $file_destination);
                    } else {
                        $message['file_error'] = "The file is too large...!";
                    }
                } else {
                    $message['file_error'] = "The upload file has error..!";
                }
            } else {
                $message['file_error'] = "Invalid file type..!";
            }
        }
    }
//---------------------------------------------------------------------------------//
    if (!empty($Password && $ConfirmPassword)) {
        if ($Password != $ConfirmPassword) {
            $message['ConfirmPassword'] = "The Password Do Not Match...!";
        }
        if (empty($message)) {
//Use bcrypt hasing algorithem
            $pw = password_hash($Password, PASSWORD_DEFAULT);
            $db = dbConn();
            $sql = "INSERT INTO users(UserName,Password,TitleId,FirstName,LastName,Gender,AddressLine1,AddressLine2,AddressLine3,UserType,Status)"
                    . " VALUES ('$UserName','$pw','$Title','$FirstName','$LastName','$gender','$AddressLine1','$AddressLine2','$AddressLine3','employee','1')";
            $db->query($sql);
            $UserId = $db->insert_id;

            $sql = "INSERT INTO employee(NIC,`Contact Number`,AppointDate,ProfileImage,DesigId,UserId) "
                    . "VALUES ('$NIC','$ContactNumber','$AppointDate','$file_name','$DesignationId','$UserId')";
            $db->query($sql);

            header("Location:manage.php");
        }
    }
}
?>

<div class="row">
    <div class="col-12">
        <a href="<?= SYS_URL ?>users/manage.php" class="btn btn-dark mb-2"> <i class="fas fa-chevron-circle-left"></i> View</a>
        <div class="card card-primary ">
            <div class="card-header bgcolor">
                <h3 class="card-title">Add New User </h3>


            </div>

            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body bgcolorbody">
                    <div class="text-secondary"> <h4> <b>Personal Detail</b></h4></div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>Title</label>
                            <select class="form-control" id="Title" name="Title">
                                <option value="">-- select --</option>
                                <?php
                                $db = dbConn();
                                $sql = "SELECT * FROM title";
                                $result = $db->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row['Id'] ?>"<?= @$Title == $row['Id'] ? 'selected' : '' ?>><?= $row['TitleName'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="text-danger"> <?= @$message['Title'] ?> </span>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="inputFirstName">First Name</label>
                            <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Enter First Name" value="<?= @$FirstName ?>">
                            <span class="text-danger"> <?= @$message['FirstName'] ?> </span>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="inputLastName">Last Name</label>
                            <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Enter Last Name" value="<?= @$LastName ?>">
                            <span class="text-danger"> <?= @$message['LastName'] ?> </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="inputNIC">NIC</label>
                            <input type="text" class="form-control" id="NIC" name="NIC" placeholder="Enter NIC" value="<?= @$NIC ?>">
                            <span class="text-danger"> <?= @$message['NIC'] ?> </span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputContactNumber">Contact Number</label>
                            <input type="text" class="form-control" id="ContactNumber" name="ContactNumber" placeholder="+947XXXXXXXX" value="<?= @$ContactNumber ?>">
                            <span class="text-danger"> <?= @$message['Contact_Number'] ?> </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-1">

                            <label> Gender</label><br/>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="gender" value="male" <?php
                                if (isset($gender) && $gender == 'male') {
                                    echo'checked';
                                }
                                ?>>
                                <label class="form-check-label" for="male">Male</label><br/>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="female" name="gender" value="female" <?php
                                if (isset($gender) && $gender == 'female') {
                                    echo'checked';
                                }
                                ?>>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <span class="text-danger"> <?= @$message['gender'] ?> </span>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="inputContactNumber"> Address Line 1</label>
                            <input type="text" class="form-control" id="AddressLine1" name="AddressLine1" placeholder="House No" value="<?= @$AddressLine1 ?>">
                            <span class="text-danger"> <?= @$message['AddressLine1'] ?> </span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputContactNumber">Address Line 2</label>
                            <input type="text" class="form-control" id="AddressLine2" name="AddressLine2" placeholder="Street/Road Name" value="<?= @$AddressLine2 ?>">
                            <span class="text-danger"> <?= @$message['AddressLine2'] ?> </span>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="inputContactNumber">Address Line 3</label>
                            <input type="text" class="form-control" id="AddressLine3" name="AddressLine3" placeholder="Town/City" value="<?= @$AddressLine3 ?>">
                            <span class="text-danger"> <?= @$message['AddressLine3'] ?> </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="inputAppointDate">Appoint Date</label>
                            <input type="date" class="form-control" id="AppointDate" name="AppointDate" max="<?= date('Y-m-d') ?>" placeholder="Enter Appointed Date" value="<?= @$AppointDate ?>">
                            <span class="text-danger"> <?= @$message['AppointDate'] ?> </span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="DesignationId">Designation</label>
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM designation";
                            $result = $db->query($sql);
                            ?>
                            <select class="form-control" id="DesignationId" name="DesignationId">
                                <option value="">-- select --</option>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <option value="<?= $row['DesigId'] ?>"<?= @$DesignationId == $row['DesigId'] ? 'selected' : '' ?>><?= $row['Designation'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="text-danger"> <?= @$message['Designation'] ?> </span>
                        </div>
                    </div>
                    <div class="text-secondary"> <h4> <b>Account Detail</b></h4> </div>
                    <div class="form-group">
                        <label for="UserName">User Name</label>
                        <input type="text" class="form-control" id="UserName" name="UserName" placeholder="Enter User Name" value="<?= @$UserName ?>">
                        <span class="text-danger"> <?= @$message['UserName'] ?> </span>
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" >
                        <span class="text-danger"> <?= @$message['Password'] ?> </span>
                    </div>
                    <div class="form-group">
                        <label for="ConfirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" placeholder="Confirm Password" >
                        <span class="text-danger"> <?= @$message['ConfirmPassword'] ?> </span>
                    </div>
                    <div>
                        <label> Upload Profile Image :</label>
                        <input type="file" class="form-control" name="file" id="file">
                        <span class="text-danger"> <?= @$message['file_error'] ?> </span>
                    </div>


                </div>
                <div class="card-footer bgcolorbody">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>


        </div>
        <!-- /.card -->
    </div>
</div>
<?php
$content = ob_get_clean();
include '../layouts.php';
?>