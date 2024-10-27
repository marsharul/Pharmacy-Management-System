<?php
include 'header.php';
session_start();
//unset($_SESSION['cart']);
include '../function.php';
?>
<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Your order has been placed",
        showConfirmButton: false,
        timer: 1500
    });
</script>
<main id="main">
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2 class="text-success">SUCCESS</h2>

            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7 border border-3  border-success" data-aos="fade-up" data-aos-delay="200">
                    <h1 class="text-center">Congratulations</h1>

                    <h2 class="text-center">Your order has been successfully placed</h2>

                    <h1 class="text-center">Your Order ID is <?= $_SESSION['OrderNumber'] ?> </h1>
                </div>
            </div>
        </div>
        <br/><!-- break between success msg -->
        <div class="row">
            <div class="col-md-6">
                
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <table class="table" border="1" width="100%" style="border: 1px solid #055160">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    foreach ($_SESSION['cart'] as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><img src="../upload_images/<?= $value['UploadPicture']; ?>" width="50" height="50" alt=""></td>
                                            <td><?= $value['ItemName'] ?></td>
                                            <td><?= $value['RetailPrice'] ?></td>
                                            <td class="text-center">x <?= $value['Qty'] ?></td>
                                            <td><?php
                                                $amt = $value['RetailPrice'] * $value['Qty'];
                                                $total += $amt;
                                                echo number_format($amt, 2);
                                                ?></td>

                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td>Total</td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: right"><?= number_format($total, 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Discount(Coupon)</td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: right"><?= number_format($total *  @$_SESSION['discount'], 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Net</td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: right"><?= number_format(($total - $total *  @$_SESSION['discount']), 2) ?></td>
                                    </tr>

                                </tfoot>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <diV class="container col-md-6">
                <h2>Bank Payment Details</h2> 
                <div class="card mx-2">

                    <div class="card-body">
                        <p>If you select Direct Bank Transfer as Method of Payment.Make your payment directly into our bank account. 
                            Please use your Order ID as the payment reference. Your order will not be deliver until the funds have cleared in our account.</p>
                        <p> <label>Bank : Commercial Bank of Ceylon</label><br/><!-- comment -->
                            <label>Branch : Wellawatte</label><br>
                            <label>Account Name : Ceylon Medical Pharmacy</label><br>
                            <label>Account Number : 8051002538</label>
                        </p>
                    </div>
                </div>

            </diV>
        </div>
    </section>
</main>
<?php
unset($_SESSION['cart']);
include 'footer.php';
?>