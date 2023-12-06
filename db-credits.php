<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

//To redirect the general type user to dashboard to avoid using this page

//if ($user_details_row['user_type'] == "General") {
//    header("Location: dashboard");
//}

?>
<!-- START -->
<!--PRICING DETAILS-->
<section class="login-reg">
    <div class="container">
        <div class="row">
            <div class="login-main add-list posr">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['BUY_CREDITS'];?></span>
                <div class="log log-1">
                    <div class="login">
                        <h4><?php echo $BIZBOOK['PAY_BUY_CREDITS'];?> </h4>
                        <?php include "page_level_message.php"; ?>

                        <p>Hola <?php echo $user_details_row['first_name']; ?>, </br>
                            <?php echo $BIZBOOK['YOUR_CURRENT_POINT'];?> : <b><?php echo AddingZero_BeforeNumber($user_details_row['user_credit']);?></p>
                        <form name="credit_form" id="credit_form" method="post" enctype="multipart/form-data" action="credit_submit.php">
                            <div class="form-group">
                                <div class="form-group">
                                    <select name="credit_plan" required="required" id="credit_plan" class="form-control">
                                        <option value="" selected="selected"><?php echo $BIZBOOK['CHOOSE_YOUR_PLAN']; ?></option>
                                        <?php

                                        $credit = "SELECT *
										FROM " . TBL . "credits WHERE credit_status='Active' ORDER BY credit_id ASC";


                                        $rs_credit = mysqli_query($conn, $credit);

                                        $si = 1;
                                        while ($credit_row = mysqli_fetch_array($rs_credit)) {
                                            ?>
                                            <option
                                                value="<?php echo $credit_row['credit_id']; ?>"><?php echo $credit_row['credit_name'];
                                                if ($credit_row['credit_price'] != 0) {
                                                    echo ' - ' .$footer_row['currency_symbol'] . '' . $credit_row['credit_price'] . ' / ' . $credit_row['credit_points']. ' Points';
                                                } ?></option>
                                            <?php
                                        }
                                        ?>
                                        <?php /* <option value="Standard plan">Standard plan - $120/year</option>
                                        <option value="Premium plan">Premium plan - $250/year</option>
                                        <option>Premium plus plan - $350/year</option>*/?>
                                    </select>
                                    <?php /*<a href="pricing-details" class="frmtip" target="_blank">Plan details</a>*/?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php $row_f = getAllFooter();?>
                                <?php if($row_f['admin_cod_status'] == 'Active'){?>
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input ca-check-promote" value="1" id="p-m" name="p-m"><?php echo $BIZBOOK['CASH_ON_DELIVERY'];?>
                                      </label>
                                    </div>
                                <?php }?>
                                <?php  if($row_f['admin_paypal_status'] == 'Active'){?>
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input ca-check-promote" value="2" id="p-m" name="p-m">Paypal
                                      </label>
                                    </div>
                                <?php }?>
                                <?php if($row_f['admin_stripe_status'] == 'Active'){?>
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input ca-check-promote" value="3" id="p-m" name="p-m">Stripe
                                      </label>
                                    </div>
                                <?php }?>
                                <?php if($row_f['admin_tpv_status'] == 'Active'){?>
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input ca-check-promote" value="4" id="p-m" name="p-m">Pago con tarjeta
                                      </label>
                                    </div>
                                <?php }?>
                            </div>
                            <button type="submit" name="credit_submit" class="btn btn-primary"><?php echo $BIZBOOK['CONTINUE'];?></button>
                        </form>
                        <div class="col-md-12">
                            <a href="dashboard" class="skip"><?php echo $BIZBOOK['GO_TO_USER_DASHBOARD'];?> &gt;&gt;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END PRICING DETAILS-->


<section>
    <div class="pop-ups pop-quo">
        <!-- The Modal -->
        <div class="modal fade" id="quote">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="quote-pop">
                        <h4><?php echo $BIZBOOK['GET_QOUTE']; ?></h4>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_NAME']; ?>*" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_EMAIL']; ?>*"
                                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                       title="<?php echo $BIZBOOK['INVALID_EMAIL']; ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_MOBILE']; ?> *" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3"
                                          placeholder="<?php echo $BIZBOOK['ENQUIRY_MESSAGE'];?>"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include "footer.php";
?>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/select-opt.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>
</body>

</html>