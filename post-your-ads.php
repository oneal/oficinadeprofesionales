<?php /*
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

?>
    <!-- START -->
    <!--PRICING DETAILS-->
	<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> login-reg">
		<div class="container">
			<div class="row">
                <div class="login-main add-list">
                     <div class="log-bor">&nbsp;</div>
                   <span class="steps">Create new Ads</span>
                    <div class="log">
                        <div class="login">
                            
                            <h4>Submit your Ads</h4>
                            <form name="create_ads_form" id="create_ads_form" method="post" action="new_ads_insert.php" enctype="multipart/form-data">
                                <input type="hidden" value="" name="ad_total_days" id="ad_total_days" class="validate">
                                <input type="hidden" value="" name="ad_cost_per_day" id="ad_cost_per_day" class="validate">
                                <input type="hidden" value="" name="ad_total_cost" id="ad_total_cost" class="validate">
                                <ul>
                                    <li>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group ca-sh-user">
                                                    <select name="all_ads_price_id" required="required" class="form-control" id="adposi">
                                                        <option value="">Choose Ads Position *</option>
                                                        <?php
                                                        foreach (getAllActiveAdsPrice() as $row) {
                                                            ?>
                                                            <option myTag = "<?php echo $row['ad_price_cost']; ?>"
                                                                    value="<?php echo $row['all_ads_price_id']; ?>"><?php echo $row['ad_price_name']; ?> (<?php echo $row['ad_price_cost']; ?><?php echo $footer_row['currency_symbol']; ?>/per day)</option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <a href="ad-details" class="frmtip" target="_blank">Pricing details</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" id="stdate" autocomplete="off" name="ad_start_date" class="form-control" placeholder="Ad start date (MM/DD/YYYY)" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" id="endate" autocomplete="off" name="ad_end_date" class="form-control" placeholder="Ad end date (MM/DD/YYYY)" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Choose Ad image</label>
                                                    <input type="file" name="ad_enquiry_photo" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea  id="ad_link"  name="ad_link" class="form-control" placeholder="Advertisement External link" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="ad-pri-cal">
                                                    <ul>
                                                        <li>
                                                            <div>
                                                                <span>Total days</span>
                                                                <h5 class="ad-tdays">0</h5>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div>
                                                                <span>Cost Per Day</span>
                                                                <h5><?php echo $footer_row['currency_symbol']; ?><b class="ad-pocost">0</b></h5>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div>
                                                                <span>Tax</span>
                                                                <h5><?php echo $footer_row['currency_symbol']; ?>4</h5>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div>
                                                                <span>Total Cost</span>
                                                                <h5><?php echo $footer_row['currency_symbol']; ?><b class="ad-tcost">0</b></h5>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                    </li>
                                </ul>
                                <!--FILED START-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="create_ad_submit" class="btn btn-primary">Publish this Ad</button>
                                    </div>
                                    <div class="col-md-12">
                                        <a href="dashboard" class="skip">Go to User Dashboard >></a>
                                    </div>
                                </div>
                                <!--FILED END-->
                            </form>
                            <div class="ud-notes">
                        <p><b>Notes:</b> Once you submit your Ad then Admin or support team will contact you shortly.</p>
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