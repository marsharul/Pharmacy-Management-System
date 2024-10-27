<?php
session_start();
include '../function.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page"style="background-color: #eae5d4">
<div class="login-box">
  <div class="login-logo">
      <img src="assets/dist/img/pms logo (1).png"class="image-fluid" width="200" alt=""/><br/>
    <a href="../../index2.html"><b>Ceylon Medical Pharmacy</a>
  </div>
  <!-- /.login-logo -->
  
             <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        extract($_POST);
                        $username = dataclean($username);
                        $message = array();

                        //Required Validation---------------------------------------------------------------------------
                        if (empty($username)) {
                            $message['username'] = "The username should not be empty...!";
                        }
                        if (empty($Password)) {
                            $message['password'] = "The password should not be empty...!";
                        }
                        
                        if (empty($message)){
                            $db= dbConn();
                            $sql="SELECT * FROM users u INNER JOIN employee e ON e.UserId = u.UserId LEFT JOIN designation d ON d.DesigId=e.DesigId WHERE u.UserName='$username'";
                            $result=$db->query($sql);
                            if($result->num_rows==1){
                                $row= $result->fetch_assoc();
                                if(password_verify($Password,$row['Password'])){
                                    
                                    $_SESSION['USERID']=$row['UserId'];
                                    $_SESSION['FIRSTNAME']=$row['FirstName'];
                                    $_SESSION['LASTNAME']=$row['LastName'];
                                    $_SESSION['DESIGNATION']= $row['Designation'];
                                    
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

  <div class="card">
    <div class="card-body login-card-body" style="border-radius: 200px">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" id="username" placeholder="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" name="Password" id="Password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">

          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
          <div class="text-danger"> <?= @$message['username'] ?></div>
          <div class="text-danger">  <?= @$message['password'] ?></div>
      </form>

      
      
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
