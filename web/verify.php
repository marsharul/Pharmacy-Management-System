<?php
include 'header.php';
include '../function.php';
?>

<?php
if($_SERVER['REQUEST_METHOD']=='GET'){
    extract($_GET);
    
    $db= dbConn();
    $sql="SELECT * FROM `users` WHERE Token='$Token' AND IS_VerifyMail = 0 ";
    $result = $db->query($sql);
    
    if($result->num_rows>0){
        $row = $result->fetch_assoc();
        $UserId = $row['UserId'];
        
        $sql="UPDATE `users` SET `Token`=null,`Is_VerifyMail`='1' WHERE UserId=$UserId";
        $db->query($sql);
     ?>   

        
<main id="main">
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2 class="text-success">Verified-SUCCESS</h2>

            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 border border-3  border-success" data-aos="fade-up" data-aos-delay="200">
                    <h1 class="text-center">Congratulations</h1>

                    <h2 class="text-center">Your account has been successfully Verified. You can now access the dashbord.</h2>

                    <h1 class="text-center"><a href='http://localhost/ceymedpms/web/login.php'>Login</a></h1>
                </div>
            </div>
        </div>
    </section>
</main>
 <?php   }else {  ?>
        
<!--        echo "Invalid or expired token.";-->
<main id="main">
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2 class="text-danger">Verified-Failure</h2>

            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 border border-3  border-danger" data-aos="fade-up" data-aos-delay="200">


                    <h2 class="text-center">Invalid or expired token.</h2>

                    
                </div>
            </div>
        </div>
    </section>
</main>
        <?php
    }
}
?>
<?php
include 'footer.php';

?>