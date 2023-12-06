<?php /*
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}
include "dashboard_left_pane.php";
?>
    <!--CENTER SECTION-->
    <div class="ud-cen">
        <div class="log-bor">&nbsp;</div>
        <span class="udb-inst">Payment</span>
        <?php
        if ($user_details_row['user_status'] == 'Inactive') {
            ?>
            <div class="log-error use-act-err"><p>Important: Your Profile has not been activated yet. You can create your Listings, Events, Blogs. But it will be posted after profile activation.</p></div>
            <?php
        }
        ?>
        <div class="ud-cen-s2">
            <h2>Payment Status</h2>
            <?php include "page_level_message.php"; ?>
            <a href="db-plan-change" class="db-tit-btn">Change My Plan</a>
            <div class="ud-payment">
                <div class="pay-lhs">
                    <img
                        src="images/user/<?php if (($user_details_row['profile_image'] == NULL) || empty($user_details_row['profile_image'])) {
                            echo $footer_row['user_default_image'];
                        } else {
                            echo $user_details_row['profile_image'];
                        } ?>" alt="">
                </div>
                <div class="pay-rhs">
                    <ul>
                        <li><b>Name : </b> <?php echo $user_details_row['first_name']; ?></li>
                        <li><b>Plan name : </b> <?php echo $user_plan_type['plan_type_name']; ?></li>
                        <li><b>Start date : </b> <?php echo dateFormatconverter($user_details_row['user_cdt']) ?></li>

                        <?php
                        //To calculate the expiry date from user created date starts

                        $start_date_timestamp = strtotime($user_details_row['user_cdt']);
                        $plan_type_duration = $user_plan_type['plan_type_duration'];

                        $expiry_date_timestamp = strtotime("+$plan_type_duration months", $start_date_timestamp);

                        $expiry_date = date("Y-m-d h:i:s", $expiry_date_timestamp);

                        //To calculate the expiry date from user created date ends
                        ?>

                        <li><b>Expiry date : </b> <?php echo dateFormatconverter($expiry_date) ?></li>
                        <li><b>Duration : </b> <?php if ($plan_type_duration >= 7) {
                                echo $plan_type_duration / 12 . ' ' . "year";
                            } else {
                                echo $plan_type_duration . ' ' . "month(s)";
                            } ?></li>

                        <?php
                        //To calculate the remaining days from expiry date to current date starts

                        $start = strtotime($curDate);
                        $end = strtotime($expiry_date);
                        $days_between = ceil(abs($end - $start) / 86400);

                        //To calculate the remaining days from expiry date to current date ends
                        ?>

                        <li><b>Remaining days : </b> <?php echo $days_between; ?></li>
                        <li><span
                                class="ud-stat-pay-btn">Checkout amount: <?php if ($user_plan_type['plan_type_price'] == 0) {
                                    echo "FREE";
                                } else {
                                    echo $footer_row['currency_symbol'] . '' . $user_plan_type['plan_type_price'];
                                } ?></span></li>
                        <li><span
                                class="ud-stat-pay-btn">Payment Status: <?php if ($user_details_row['payment_status'] == 'Paid') {
                                    echo "PAID";
                                }elseif ($user_details_row['payment_status'] == 'COD') {
                                    echo "COD Initiated / Pending";
                                } elseif ($user_plan_type['plan_type_price'] == 0) {
                                    echo "N/A";
                                } else {
                                    echo "PENDING";
                                } ?></span></li>
                    </ul>
                </div>
            </div>
            <?php if (empty($user_details_row['payment_status'])  || ($user_details_row['payment_status'] == NULL)) { //To check the payment status  ?>
                <?php if ($user_plan_type['plan_type_price'] != 0) {  //To check the plan payment amount ?>
                    <div class="ud-pay-op">
                        <h4>Select your payment option</h4>
                        <ul>
                            <?php if ($footer_row['admin_cod_status'] == "Active") { ?>
                                <li>
                                    <div class="pay-full">
                                        <div class="rbbox">
                                            <input type="radio" id="paymentcash" name="payment" checked="">
                                            <label for="paymentcash">Cash on delivery</label>
                                            <div class="pay-note">
                                                <span><i
                                                        class="material-icons">star</i>Pay with cash upon delivery.</span>
                                                <span><i class="material-icons">star</i>  Admin team will verify your listing and communication address</span>
                                        <span><i
                                                class="material-icons">star</i> Our collection team will meet you</span>
                                                <form name="cod_form" id="cod_form" method="post"
                                                      action="payment_cod_submit.php">
                                                    <h4>Billing details</h4>
                                                    <ul>
                                                        <li>
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                               readonly="readonly"
                                                                               value="<?php echo $user_details_row['first_name']; ?>"
                                                                               placeholder="Full name *" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_country"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_country']; ?>"
                                                                               placeholder="Country">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_state"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_state']; ?>"
                                                                               placeholder="State">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_city"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_city']; ?>"
                                                                               placeholder="City *"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_address"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_address']; ?>"
                                                                               placeholder="Village & Street name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_zip_code"
                                                                               onkeypress="return isNumber(event)"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_zip_code']; ?>"
                                                                               placeholder="Postcode/ZIP">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                               name="user_contact_name"
                                                                               value="<?php echo $user_details_row['user_contact_name']; ?>"
                                                                               placeholder="Contact person *" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                               name="user_contact_mobile"
                                                                               onkeypress="return isNumber(event)"
                                                                               value="<?php echo $user_details_row['user_contact_mobile']; ?>"
                                                                               placeholder="Contact number">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                               name="user_contact_email"
                                                                               value="<?php echo $user_details_row['user_contact_email']; ?>"
                                                                               placeholder="Contact email" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                        </li>
                                                    </ul>
                                                    <button type="submit" name="payment_submit" class="db-pro-bot-btn">
                                                        Submit COD
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </li>

                            <?php }
                            if ($footer_row['admin_paypal_status'] == "Active") { ?>
                                <li>
                                    <div class="pay-full">
                                        <div class="rbbox">
                                            <input type="radio" id="paymentpaypal"
                                                   name="payment" <?php if ($footer_row['admin_cod_status'] != "Active") {
                                                echo "checked='checked'";
                                            } ?>>
                                            <label for="paymentpaypal">PayPal payment gateway</label>
                                            <div class="pay-note">
                                                <span><i class="material-icons">star</i> You can pay with your credit card if you don’t have a PayPal account.</span>
                                                <span><i class="material-icons">star</i>What is PayPal?</span>
                                                <form name="paypal_form" id="paypal_form" method="post"
                                                      action="payment_paypal_submit.php">
                                                    <h4>Billing details</h4>
                                                    <ul>
                                                        <li>
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" readonly="readonly"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['first_name']; ?>"
                                                                               placeholder="Full name *" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_country"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_country']; ?>"
                                                                               placeholder="Country">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_state"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_state']; ?>"
                                                                               placeholder="State">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_city"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_city']; ?>"
                                                                               placeholder="City *"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_address"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_address']; ?>"
                                                                               placeholder="Village & Street name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_zip_code"
                                                                               onkeypress="return isNumber(event)"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_zip_code']; ?>"
                                                                               placeholder="Postcode/ZIP">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                               name="user_contact_name"
                                                                               value="<?php echo $user_details_row['user_contact_name']; ?>"
                                                                               placeholder="Contact person *" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                               name="user_contact_mobile"
                                                                               onkeypress="return isNumber(event)"
                                                                               value="<?php echo $user_details_row['user_contact_mobile']; ?>"
                                                                               placeholder="Contact number">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                               name="user_contact_email"
                                                                               value="<?php echo $user_details_row['user_contact_email']; ?>"
                                                                               placeholder="Contact email" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                        </li>
                                                    </ul>
                                                    <button type="submit" name="payment_submit" class="db-pro-bot-btn">
                                                        Start Payment
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php }
                            if ($footer_row['admin_stripe_status'] == "Active") { ?>
                                <li>
                                    <div class="pay-full">
                                        <div class="rbbox">
                                            <input type="radio" id="paymentstripe"
                                                   name="payment" <?php if ($footer_row['admin_cod_status'] != "Active" && $footer_row['admin_paypal_status'] != "Active") {
                                                echo "checked='checked'";
                                            } ?>>
                                            <label for="paymentstripe">Stripe payment gateway</label>
                                            <div class="pay-note">
                                                <span><i class="material-icons">star</i> You can pay with your credit card if you don’t have a Stripe account.</span>
                                                <span><i class="material-icons">star</i>What is Stripe?</span>
                                                <form name="paypal_form" id="paypal_form" method="post"
                                                      action="payment_paypal_submit.php">
                                                    <h4>Billing details</h4>
                                                    <ul>
                                                        <li>
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" readonly="readonly"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['first_name']; ?>"
                                                                               placeholder="Full name *" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_country"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_country']; ?>"
                                                                               placeholder="Country">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_state"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_state']; ?>"
                                                                               placeholder="State">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_city"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_city']; ?>"
                                                                               placeholder="City *"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_address"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_address']; ?>"
                                                                               placeholder="Village & Street name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user_zip_code"
                                                                               onkeypress="return isNumber(event)"
                                                                               class="form-control"
                                                                               value="<?php echo $user_details_row['user_zip_code']; ?>"
                                                                               placeholder="Postcode/ZIP">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                               name="user_contact_name"
                                                                               value="<?php echo $user_details_row['user_contact_name']; ?>"
                                                                               placeholder="Contact person *" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                            <!--FILED START-->
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                               name="user_contact_mobile"
                                                                               onkeypress="return isNumber(event)"
                                                                               value="<?php echo $user_details_row['user_contact_mobile']; ?>"
                                                                               placeholder="Contact number">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control"
                                                                               name="user_contact_email"
                                                                               value="<?php echo $user_details_row['user_contact_email']; ?>"
                                                                               placeholder="Contact email" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--FILED END-->
                                                        </li>
                                                    </ul>
                                                    <button type="submit" name="payment_submit" class="db-pro-bot-btn">
                                                        Start Payment
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php }
            } ?>
            <div class="ud-notes">
                <p><b>Notes:</b> Hi, Before start "Ads Payment" you must know the pricing details and positions and all.
                    You just click the "Pricing and other details" button in this same page and you know the all
                    details. If your payment done means your invoice automaticall received your "Payment invoice" page
                    and you never stop your Ads till the end date.</p>
            </div>
        </div>
    </div>
<?php
include "dashboard_right_pane.php";
?>