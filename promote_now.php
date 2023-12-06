<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

if ($_GET['code'] == NULL && empty($_GET['code'])) {

    header("Location: dashboard");
}

if ($_GET['type'] == NULL && empty($_GET['type'])) {

    header("Location: dashboard");
}else{
    if($_GET['type'] == "listing"){

        $type = "Listing";
        $type_value = 1;

        $listrow = getListing($_GET['code']); //To Fetch the listing

        $type_id = $listrow['listing_id'];
        $type_name = $listrow['listing_name'];

    }elseif($_GET['type'] == "event"){

        $type = "Event";
        $type_value = 2;

        $eventrow = getEvent($_GET['code']); //To Fetch the event

        $type_id = $eventrow['event_id'];
        $type_name = $eventrow['event_name'];

    }
    elseif($_GET['type'] == "blog"){

        $type = "Blog";
        $type_value = 3;

        $blogrow = getBlog($_GET['code']); //To Fetch the blog

        $type_id = $blogrow['blog_id'];
        $type_name = $blogrow['blog_name'];

    }elseif($_GET['type'] == "product"){

        $type = "Product";
        $type_value = 4;

        $productrow = getProduct($_GET['code']); //To Fetch the product

        $type_id = $productrow['product_id'];
        $type_name = $productrow['product_name'];

    }
}

?>
<!-- START -->
<!--PRICING DETAILS-->
<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> login-reg">
    <div class="container">
        <div class="row">
            <div class="login-main add-list">
                <div class="log-bor">&nbsp;</div>
                <span class="steps"><?php echo $BIZBOOK['PROMOTE_YOUR_LISTING'];?></span>
                <div class="log">
                    <?php include "page_level_message.php"; ?>
                    <div class="login">

                        <h4><?php echo $BIZBOOK['PROMOTE_YOUR_LISTING'];?></h4>
                        <form name="create_promote_form" id="create_promote_form" method="post" action="promote_update.php" enctype="multipart/form-data">
                            <input type="hidden" value="" name="ad_total_days" id="ad_total_days" class="validate">
                            <input type="hidden" value="" name="ad_cost_per_day" id="ad_cost_per_day" class="validate">
                            <input type="hidden" value="" name="ad_total_cost" id="ad_total_cost" class="validate">
                            <input type="hidden" value="<?php echo $type_id; ?>" name="type_id" id="type_id" class="validate">
                            <input type="hidden" value="<?php echo $user_details_row['user_credit']; ?>" name="type_value" id="type_value" class="validate">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p><?php echo $BIZBOOK['JUST_SPEND_1_CREDIT'];?></p>
                                    </div>
                                </div>
                                </div>
                            <ul>
                                <li>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <p><?php echo $type.' Name  : '; ?><b><?php echo $type_name; ?></b></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!--FILED START-->
                                </li>
                            </ul>
                            <!--FILED START-->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p><?php echo $BIZBOOK['YOUR_TOTAL_AVAILABLE_CREDITS'];?> :<b> <?php echo AddingZero_BeforeNumber($user_details_row['user_credit']); ?></b></p>
                                    </div>
                                </div>
                            </div>
                            <?php /*<div class="form-group">
                                <div class="frequency">Frequency *</div>
                                <div class="frequency">
                                    <input type="radio" class="ca-check-promote"
                                           value="1" id="frequency" checked="checked" name="frequency"> Once (Manual)
                                    <input type="radio" class="ca-check-promote"
                                           value="2" id="frequency" name="frequency"> Automatic
                                </div>
                            </div>-->*/?>
                            
                            <div class="form-group">
                                <h5 class="frequency"><?php echo $BIZBOOK['FREQUENCY'];?> *</h5>
                                <div class="form-check-inline">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input ca-check-promote" value="1" id="frequency" name="frequency"><?php echo $BIZBOOK['ONCE'];?> (Manual)
                                  </label>
                                </div>
                                <div class="form-check-inline">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input ca-check-promote" value="2" id="frequency" checked="checked"  name="frequency"><?php echo $BIZBOOK['AUTOMATIC'];?>
                                  </label>
                                </div>
                            </div>
                            
                            
                            
                            
                            <div style="display: block" class="row ca-sh-promote">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="frequency_time"><?php echo $BIZBOOK['FREQUENCY_TYPE'];?> *</div>
                                        <select name="frequency_time" class="form-control" id="frequency_time">
                                            <option value=""><?php echo $BIZBOOK['CHOOSE_FREQUENCY_TYPE'];?> *</option>
                                                <option value="1"><?php echo $BIZBOOK['EVERY_3_HOUR'];?></option>
                                                <option value="2"><?php echo $BIZBOOK['EVERY_6_HOUR'];?></option>
                                                <option value="3"><?php echo $BIZBOOK['EVERY_9_HOUR'];?></option>
                                                <option value="4"><?php echo $BIZBOOK['EVERY_12_HOUR'];?></option>
                                                <option value="5"><?php echo $BIZBOOK['ONCE_DAY'];?></option>
                                                <option value="6"><?php echo $BIZBOOK['ONCE_WEEK'];?></option>
                                                <option value="7"><?php echo $BIZBOOK['ONCE_MONTH'];?></option>
                                                
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" value="1" id="t-p" name="t-p" checked="true">Las 24 horas del día
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" value="2" id="t-p" name="t-p">Hasta las 00:00
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php if($user_details_row['user_credit'] != 0) { ?>
                                    <div class="col-md-12">
                                        <button type="submit" name="create_promote_submit" class="btn btn-primary">
                                            <?php echo $BIZBOOK['SUBMIT'];?>
                                        </button>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                    <a class="btn-buy-cre-poi" href="db-credits"><?php echo $BIZBOOK['BUY_CREDITS'];?></a>
                                    <?php
                                }
                                ?>
                                <div class="col-md-12">
                                    <a href="dashboard" class="skip"><?php echo $BIZBOOK['GO_TO_USER_DASHBOARD'];?> >></a>
                                </div>
                            </div>
                            
                            <!--FILED END-->
                        </form>
                        <div class="ud-notes">
                            <p><?php echo $BIZBOOK['NOTES_BUY_CREDITS'];?>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END PRICING DETAILS-->
<?php
include "footer.php";
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>
</body>

</html>