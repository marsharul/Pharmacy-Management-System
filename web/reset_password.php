<?php
ob_start();

include "header.php";
include'../function.php';
include '../mail.php';
?>
<main id="main">
    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2 class="text text-secondary">Reset Password</h2>

            </div>
            <?php
            extract($_GET);
            extract($_POST);
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                

                if (empty($password)) {
                    $message['password'] = "Password is required";
                }
                if (empty($confirm_password)) {
                    $message['confirm_password'] = "Confirm Password is required";
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
                    $db = dbConn();
                    $pw = password_hash($password, PASSWORD_DEFAULT);
                    // Verify the reset token and check if it's still valid
                   $sql = "SELECT c.Email FROM users u
                   INNER JOIN customers c ON c.UserId=u.UserId
                   WHERE u.Token='$token' AND u.reset_expiration > NOW()"; // NOW()- returns current Date & Time
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $email = $row['Email'];
                        $sql_update_password = "UPDATE users u
                                INNER JOIN customers c ON c.UserId=u.UserId
                                SET u.password='$pw', u.Token=null, u.reset_expiration=NULL
                                WHERE c.Email='$email'";

                        if ($db->query($sql_update_password) === TRUE) {
                            $message['email']= "Your password has been reset successfully.";
                            header("Location:login.php"); // redirect to login (pwd reset success)
                        } else {
                            echo "Error updating record: " . $conn->error;
                        }
                    }

                   
                }
            }
            ?>

            <div class="row justify-content-center">

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">


                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" class="php-email-form loginbgcolor" novalidate>

                        <div class="form-group mt-3">
                            <label for="password">New Password :</label>
                            <input type="password" class="form-control border border-1 border-dark" name="password" id="password" placeholder="Password" required>
                            <span class="text-danger"><?= @$message['password'] ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Confirm Password :</label>
                            <input type="password" class="form-control border border-1 border-dark" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                            <span class="text-danger"><?= @$message['confirm_password'] ?></span>
                        </div>

                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <input type="hidden" name="token" value="<?php echo @$token; ?>">
                        <div class="text-center"><button type="submit">Send</button></div>

                    </form>
                    <div><?= @$message['email'] ?></div>
                </div>

            </div>

        </div>
    </section><!-- End Contact Us Section -->

</main>


<?php
include "footer.php";
ob_end_flush();
?>
