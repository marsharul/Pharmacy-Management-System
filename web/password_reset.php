<?php
ob_start();
date_default_timezone_set('Asia/Colombo');
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
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                extract($_POST);
                $reset_token = bin2hex(random_bytes(16));
                // Calculate the token expiration time (e.g., 1 hour from now)
                $expiration_time = date("Y-m-d H:i:s", strtotime("+1 hour"));
                $Email = dataclean($Email);

                $message = array();

                // Required Validation---------------------------------------------------------------------------
                if (empty($Email)) {
                    $message['Email'] = "The email should not be empty...!";
                } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                    $message['Email'] = "Invalid email format...!";
                }

                if (empty($message)) {
                    $db = dbConn();

                    $sql = "UPDATE users u INNER JOIN customers c ON c.UserId=u.UserId
                   SET u.Token='$reset_token', u.reset_expiration='$expiration_time'
                   WHERE c.Email='$Email'";
                    if ($db->query($sql) === TRUE) {
                        $sql_select = "SELECT * FROM users u
                       INNER JOIN customers c ON c.UserId=u.UserId
                       WHERE c.email='$Email'";
                        $result = $db->query($sql_select);
                        $row = $result->fetch_assoc();
                        $first_name = $row['FirstName'];
                        if ($result->num_rows > 0) {
                            $reset_link = "http://localhost/ceymedpms/web/reset_password.php?token=$reset_token";

                            $msg = "<h1>Reset Password</h1>";
                            $msg .= "<h2> </h2>";
                            $msg .= "<p>Hi, click the link below to reset your password</p>";
                            $msg .= "<a href='$reset_link'> Reset your Password</a>";

                            sendEmail($Email, $first_name, "Password Reset Request", $msg);

                            $message['Email']= "A password reset link has been sent to your email.";
                        }
                    }

                    
                }
            }
            ?>

            <div class="row justify-content-center">

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">


                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" class="php-email-form loginbgcolor" novalidate>

                        <div class="form-group mt-3">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="Email" id="Email" placeholder="Enter Email Address" required>
                            <span class="text-danger"> <?= @$message['Email'] ?></span>
                        </div>

                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send</button></div>

                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Us Section -->

</main>


<?php
include "footer.php";
ob_end_flush();
?>
