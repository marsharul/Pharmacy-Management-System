<?php
ob_start();

include "header.php";
include'../function.php';
?>
<main id="main">
    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Customer</h2>
                <p>Login</p>
            </div>
            
             <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        extract($_POST);
                        $username = dataclean($username);
                        $message = array();

                        //Required Validation---------------------------------------------------------------------------
                        if (empty($username)) {
                            $message['username'] = "The username should not be empty...!";
                        }
                        if (empty($password)) {
                            $message['password'] = "The password should not be empty...!";
                        }
                        
                        if (empty($message)){
                            $db= dbConn();
                            $sql="SELECT * FROM users u INNER JOIN customers c ON c.UserId = u.UserId WHERE u.UserName='$username' AND Token IS NULL";
                            $result=$db->query($sql);
                            
                            if($result->num_rows==1){
                                $row= $result->fetch_assoc();
                                if(password_verify($password,$row['Password'])){
                                    
                                    $_SESSION['USERID']=$row['UserId'];
                                    $_SESSION['FIRSTNAME']=$row['FirstName'];
                                    header('location:dashboard.php');
                                }else{
                                    $message['password']= "Invalid Username or Password.....!";
                                }
                            } else {
                                $message['password']= "Invalid Username or Password.....!";
                            }
                        }
                    }
                    ?>


            <div class="row justify-content-center">

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                   

                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" role="form" class="php-email-form loginbgcolor" novalidate>

                        <div class="form-group mt-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                            <span class="text-danger"> <?= @$message['username'] ?></span>
                        </div>


                        <div class="form-group mt-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                            <span class="text-danger">  <?= @$message['password'] ?></span>
                        </div>


                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Login</button></div>
                        <a href="password_reset.php"> Forgot Password? </a>
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
