<?php
Ob_start();
session_start();
include 'header.php';
include '../function.php';
include '../mail.php';
?>
<main id="main">
    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Customer</h2>
                <p>Register</p>
            </div>

            <div class="row justify-content-center">

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        extract($_POST);
                        $first_name = dataClean($first_name);
                        $last_name = dataClean($last_name);
                        $address_line1 = dataClean($address_line1);
                        $address_line2 = dataClean($address_line2);
                        $address_line3 = dataClean($address_line3);

                        $message = array();
                        //Required (Empty Field) validation-----------------------------------------------
                        if (empty($Title)) {
                            $message['Title'] = "The Title should not be blank...!";
                        }
                        if (empty($first_name)) {
                            $message['first_name'] = "The first name should not be blank...!";
                        }
                        if (empty($last_name)) {
                            $message['last_name'] = "The last name should not be blank...!";
                        }
                        if (empty($email)) {
                            $message['email'] = "The email should not be blank...!";
                        }
                        if (empty($address_line1)) {
                            $message['address_line1'] = "The Address Line 1 should not be blank...!";
                        }
                        if (empty($address_line2)) {
                            $message['address_line2'] = "The Address Line 2 should not be blank...!";
                        }
                        if (empty($mobile_no)) {
                            $message['mobile_no'] = "The mobile Number should not be blank...!";
                        }
                        if (!isset($gender)) {
                            $message['gender'] = "Gender is required";
                        }
                        if (empty($district)) {
                            $message['district'] = "District is required";
                        }
                        if (empty($user_name)) {
                            $message['user_name'] = "User Name is required";
                        }
                        if (empty($password)) {
                            $message['password'] = "Password is required";
                        }
                        if (empty($confirm_password)) {
                            $message['confirm_password'] = "Confirm Password is required";
                        }


                        //Advance validation------------------------------------------------
                        if (!empty($first_name)) {
                            if (ctype_alpha(str_replace(' ', '', $first_name)) === false) {
                                $message['first_name'] = "Only letters and white space allowed";
                            }
                        }
                        if (!empty($last_name)) {
                        if (ctype_alpha(str_replace(' ', '', $last_name)) === false) {
                            $message['last_name'] = "Only letters and white space allowed";
                        }
                        }
                        if (!empty($email)) {
                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $message['email'] = "Invalid Email Address...!";
                            } else {
                                $db = dbConn();
                                $sql = "SELECT * FROM customers WHERE Email='$email'";
                                $result = $db->query($sql);

                                if ($result->num_rows > 0) {
                                    $message['email'] = "This Email address already exsist...!";
                                }
                            }
                        }
                        //-------------------Start Contact Number Validation------------------------
                        if (!empty($telno)) {
                            $MobileNoLen = strlen($telno);
                            if ($MobileNoLen !== 10 || !ctype_digit($telno)) {
                                $message['telno'] = "Invalid Contact Number...!";
                            }
                        }

                        if (!empty($mobile_no)) {
                            // Check if the number starts with +94 followed by 9 digits
                            if (substr($mobile_no, 0, 3) === '+94' && strlen($mobile_no) === 12 && ctype_digit(substr($mobile_no, 3))) {
//                                $message['mobile_no'] = "valid Contact Number...!";
                            } elseif (strlen($mobile_no) === 10 && ctype_digit($mobile_no)) {
                                
                            } else {
                                $message['mobile_no'] = "Invalid Contact Number...!";
                            }
                        }
                        //------------------------------------------------------------------------// 
                        if (!empty($user_name)) {
                            $db = dbConn();
                            $sql = "SELECT * FROM users WHERE UserName='$user_name'";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                                $message['user_name'] = "This User Name already exsist...!";
                            }
                        }

                        if (!empty($password)) {
                            if (strlen($password) < 8) {
                                $message['password'] = "The password should be 8 characters more";
                            }
                        }
                        if (!empty($password && $confirm_password)) {
                            if ($password != $confirm_password) {
                                $message['confirm_password'] = "The password do not match";
                            }
                        }

                        if (empty($message)) {
                            //Use bcrypt hasing algorithem
                            $pw = password_hash($password, PASSWORD_DEFAULT);
                            $db = dbConn();
                            $token = bin2hex(random_bytes(16));
                            echo $sql = "INSERT INTO `users`(`UserName`,`Password`,`TitleId`,`FirstName`,`LastName`,`AddressLine1`,`AddressLine2`,`AddressLine3`,`Gender`,`UserType`,`Status`,`Token`,Is_VerifyMail) VALUES ('$user_name','$pw','$Title','$first_name','$last_name','$address_line1','$address_line2','$address_line3','$gender','customer','1','$token','0')";
                            $db->query($sql);

                            $user_id = $db->insert_id;

                            $reg_number = date('Y') . date('m') . date('d') . $user_id;
                            $_SESSION['RNO'] = $reg_number;
                            echo $sql = "INSERT INTO `customers`(`Email`,`TelNo`, `MobileNo`,`DistrictId`,`RegNo`,`UserId`) VALUES ('$email','$telno','$mobile_no','$district','$reg_number','$user_id')";
                            $db->query($sql);

                            $msg = "<h1>SUCCESS</h1>";
                            $msg .= "<h2>Congratulations</h2>";
                            $msg .= "<p>Your account has been successfully created</p>";
                            $msg .= "<a href='http://localhost/ceymedpms/web/verify.php?Token=$token'>Click here to verifiy your account</a>";

                            sendEmail($email, $first_name, "Account Verification", $msg);

                            header("Location:register_success.php");
                        }
                    }
                    ?>
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" class="php-email-form loginbgcolor" style="border-radius:10px" novalidate>
                        <div class="row">
                            <div class="form-group col-md-2">
                                <?php
                                $db = dbConn();
                                $sql = "SELECT * FROM  title";
                                $result = $db->query($sql);
                                ?>
                                <label for="Title">Title</label>
                                <select name="Title" id="Title" class="form-select border border-1 border-dark" aria-label="Large select example">
                                    <option value="" >--</option>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row['Id'] ?>"<?= @$Title == $row['Id'] ? 'selected' : '' ?>><?= $row['TitleName'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?= @$message['Title'] ?></span>
                            </div>  
                            <div class="form-group col-md-4">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control border border-1 border-dark" id="first_name" value="<?= @$first_name ?>" placeholder="First Name" required>
                                <span class="text-danger"><?= @$message['first_name'] ?></span>
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control border border-1 border-dark" name="last_name" id="last_name" value="<?= @$last_name ?>" placeholder="Last Name" required>
                                <span class="text-danger"><?= @$message['last_name'] ?></span>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="text" class="form-control border border-1 border-dark" name="email" id="email" value="<?= @$email ?>" placeholder="Email" required>
                            <span class="text-danger"><?= @$message['email'] ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="address_line1">Address Line 1</label>
                            <input type="text" class="form-control border border-1 border-dark" name="address_line1" id="address_line1" value="<?= @$address_line1 ?>" placeholder="House No:-" required>
                            <span class="text-danger"><?= @$message['address_line1'] ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="address_line2">Address Line 2</label>
                            <input type="text" class="form-control border border-1 border-dark" name="address_line2" id="address_line2" value="<?= @$address_line2 ?>" placeholder="Street / Road Name" required>
                            <span class="text-danger"><?= @$message['address_line2'] ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="address_line3">Address Line 3 (optional)</label>
                            <input type="text" class="form-control border border-1 border-dark" name="address_line3" id="address_line3" value="<?= @$address_line3 ?>" placeholder="Address Line 3" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="telno">Tel. No.(Home)</label>
                            <input type="text" class="form-control border border-1 border-dark" name="telno" id="telno" value="<?= @$telno ?>" placeholder="Tel. No." required>
                            <span class="text-danger"><?= @$message['telno'] ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="telno">Mobile No.</label>
                            <input type="text" class="form-control border border-1 border-dark" name="mobile_no" id="mobile_no" value="<?= @$mobile_no ?>" placeholder="Mobile No" required>
                            <span class="text-danger"><?= @$message['mobile_no'] ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <label>Select Gender</label>
                            <div class="form-check">
                                <input class="form-check-input border border-1 border-dark" type="radio" name="gender" id="male"  value="male"<?php
                                if (isset($gender) && $gender == 'male') {
                                    echo'checked';
                                }
                                ?>>
                                <label class="form-check-label" for="male">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input border border-1 border-dark" type="radio" name="gender" id="female" value="female" <?php
                                if (isset($gender) && $gender == 'female') {
                                    echo'checked';
                                }
                                ?> >
                                <label class="form-check-label" for="female">
                                    Female
                                </label>
                            </div>
                            <div class="text-danger mt-4"><?= @$message['gender'] ?></div>
                        </div> 
                        <div class="form-group mt-3">
                            <?php
                            $db = dbConn();
                            $sql = "SELECT * FROM  districts";
                            $result = $db->query($sql);
                            ?>
                            <label for="district">District</label>
                            <select name="district" id="district" class="form-select form-select-lg mb-3 border border-1 border-dark" aria-label="Large select example">
                                <option value="" >--</option>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option value="<?= $row['Id'] ?>"<?= @$district == $row['Id'] ? 'selected' : '' ?>><?= $row['Name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="text-danger"><?= @$message['district'] ?></span>
                        </div>  
                        <div class="form-group mt-3">
                            <label for="user_name">User Name</label>
                            <input type="text" class="form-control border border-1 border-dark" name="user_name" id="user_name" value="<?= @$user_name ?>" placeholder="Username" required>
                            <span class="text-danger"><?= @$message['user_name'] ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control border border-1 border-dark" name="password" id="password" placeholder="Password" required>
                            <span class="text-danger"><?= @$message['password'] ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Confirm Password</label>
                            <input type="password" class="form-control border border-1 border-dark" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                            <span class="text-danger"><?= @$message['confirm_password'] ?></span>
                        </div>

                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Submit</button></div>
                    </form>
                </div>

            </div>

        </div>

    </section><!-- End Contact Us Section -->
</main>
<?php
Ob_end_flush();
include 'footer.php';
?>