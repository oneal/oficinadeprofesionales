<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

//To redirect the general type user to dashboard to avoid using this page

if($user_details_row['user_type'] == "General") {
    header("Location: dashboard");
}


//To check the listings count with current plan starts

$plan_type_listing_count = $user_plan_type['plan_type_listing_count'];
$listing_count_user = getCountUserListing($_SESSION['user_id']);

if($listing_count_user >= $plan_type_listing_count){

    $_SESSION['status_msg'] = "Your Listings Limit Exceeded!! Upgrade your plan and enjoy our services";

    header('Location: db-all-listing');
}
//To check the listings count with current plan ends

$listing_codea = $_GET['code'];
$listing_row = getListing($listing_codea);

?>
    <!-- START -->
    <!--PRICING DETAILS-->
	<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> login-reg">
		<div class="container">
            <div class="row">
            <div class="add-list-ste">
                    <div class="add-list-ste-inn">
                        <ul>
                            <li>
                                <a href="add-listing-step-1">
                                    <span><?php echo $BIZBOOK['STEP1']; ?></span>
                                    <b><?php echo $BIZBOOK['BASIC_INFO']; ?></b>
                                </a>
                            </li>
                            <li>
                                <a href="#!">
                                    <span><?php echo $BIZBOOK['STEP2']; ?></span>
                                    <b><?php echo $BIZBOOK['SERVICES']; ?></b>
                                </a>
                            </li>
                            <li>
                                <a href="#!">
                                    <span><?php echo $BIZBOOK['STEP3']; ?></span>
                                    <b><?php echo $BIZBOOK['OFFERS']; ?></b>
                                </a>
                            </li>
                            <li>
                                <a href="#!">
                                    <span><?php echo $BIZBOOK['STEP4']; ?></span>
                                    <b><?php echo $BIZBOOK['MAP']; ?></b>
                                </a>
                            </li>
                            <li>
                                <a href="#!">
                                    <span><?php echo $BIZBOOK['STEP5']; ?></span>
                                    <b><?php echo $BIZBOOK['OTHER']; ?></b>
                                </a>
                            </li>
                            <li>
                                <a href="#!" class="act">
                                    <span><?php echo $BIZBOOK['STEP6']; ?></span>
                                    <b><?php echo $BIZBOOK['DONE']; ?></b>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="login-main add-list">
                     <div class="log-bor">&nbsp;</div>
                   <span class="steps"><?php echo $BIZBOOK['STEP6']; ?></span>
                    <div class="log">
                        <div class="login add-lis-done">
                            <h4><?php echo $BIZBOOK['SUCCESS']; ?></h4>
							<p><?php echo $BIZBOOK['LISTING_INSERT_SUCCESS_MESSAGE']; ?></p>
                             <form>
                                    <?php /*<!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
											<i class="material-icons succ"><?php echo $BIZBOOK['DONE']; ?></i>
                                        </div>
                                    </div>
                                    <!--FILED END-->*/?>
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="dashboard" class="btn btn-primary"><?php echo $BIZBOOK['GO_TO_USER_DASHBOARD']; ?></a>
                                        </div>
                                        <div class="col-md-6">
                                            <a target="_blank" href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $listing_row['listing_slug']; ?>" class="btn btn-primary"><?php echo $BIZBOOK['LISTING_PREVIEW']; ?></a>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                            </form>
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
</body>

</html>