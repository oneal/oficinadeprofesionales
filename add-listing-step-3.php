<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

//To redirect the general type user to dashboard to avoid using this page

if($user_details_row['user_type'] == "General") {
    header("Location: dashboard.php");
}

//To check the listings count with current plan starts

$plan_type_listing_count = $user_plan_type['plan_type_listing_count'];
$listing_count_user = getCountUserListing($_SESSION['user_id']);

if($listing_count_user >= $plan_type_listing_count){

    $_SESSION['status_msg'] = "Your Listings Limit Exceeded!! Upgrade your plan and enjoy our services";

    header('Location: db-all-listing');
}
//To check the listings count with current plan ends

//Get & Process Listing Data
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    

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
                                <a href="add-listing-step-2">
                                    <span><?php echo $BIZBOOK['STEP2']; ?></span>
                                    <b><?php echo $BIZBOOK['SERVICES']; ?></b>
                                </a>
                            </li>
                            <li>
                                <a href="add-listing-step-3" class="act">
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
                                <a href="#!">
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
                   <span class="steps"><?php echo $BIZBOOK['STEP3']; ?></span>
                    <div class="log">
                        <div class="login add-list-off">
                            <h4><?php echo $BIZBOOK['SPECIAL_OFFERS']; ?></h4>
                            <span class="add-list-add-btn lis-add-off" title="add new offer">+</span>
                            <span class="add-list-rem-btn lis-add-rem" title="remove offer">-</span>
                             <form action="add_session_listing_step_3.php" class="listing_form_3" id="listing_form_3" name="listing_form_3" method="post" enctype="multipart/form-data">
                                <ul>
                                    <input type="hidden" id="service_1_image_old"
                                       value="<?php echo $_SESSION['service_1_image']; ?>" name="service_1_image_old"
                                       class="validate">
                                        <?php                                        
                                        $listings_a_row_service_1_name = $_SESSION['service_1_name'];
                                        $listings_a_row_service_1_price = $_SESSION['service_1_price'];
                                        $listings_a_row_service_1_detail = $_SESSION['service_1_detail'];
                                        $listings_a_row_service_1_view_more = $_SESSION['service_1_view_more'];
                                        $listings_a_row_service_1_image = $_SESSION['service_1_image'];

                                        $ser_1_name_Array = explode('|', $listings_a_row_service_1_name);
                                        $ser_1_price_Array = explode('|', $listings_a_row_service_1_price);
                                        $ser_1_detail_Array = explode('|', $listings_a_row_service_1_detail);
                                        $ser_1_view_more_Array = explode('|', $listings_a_row_service_1_view_more);
                                        $ser_1_img_Array = explode(',', $listings_a_row_service_1_image);
                                        
                                        $listings_a_row_service_1_name_count = count($listings_a_row_service_1_name); //Get count of array

                                        if($listings_a_row_service_1_name_count != 0) {
                                            $zipped = array_map(null, $ser_1_name_Array, $ser_1_price_Array, $ser_1_detail_Array, $ser_1_view_more_Array,$ser_1_img_Array);

                                            foreach($zipped as $k => $tuple) {
                                                $tuple[0]; // offer name
                                                $tuple[1]; // offer Price
                                                $tuple[2]; // offer Detail
                                                $tuple[3]; // offer View more
                                                $tuple[4]; // offer images

                                                ?>
                                                <li class="item-offer">
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" name="service_1_name[]"
                                                                       value="<?php echo $tuple[0]; ?>" class="form-control"
                                                                       placeholder="<?php echo $BIZBOOK['OFFER_NAME']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="number" name="service_1_price[]" min=0 step="0.01" 
                                                                       accept=""onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'inherit'"
                                                                       value="<?php echo $tuple[1]; ?>" class="form-control"
                                                                       placeholder="<?php echo $BIZBOOK['PRICE']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <textarea name="service_1_detail[]" class="form-control"
                                                                          placeholder="<?php echo $BIZBOOK['DETAILS_ABOUT_OFFER']; ?>"><?php echo $tuple[2]; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label><?php echo $BIZBOOK['CHOOSE_OFFER_IMAGE']; ?></label><br/>
                                                                <?php if(!empty($tuple[4])){?>
                                                                    <img src="images/services/<?php echo $tuple[4];?>" style="max-width: 120px"/>
                                                                    <input type="hidden" name="service_1_img_old_hidden[]" value="<?php echo $tuple[4];?>"/>
                                                                <?php }?>
                                                                <input type="file" name="service_1_image[]"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                    <!--FILED START-->
                                                    <?php /*<div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="text" name="service_1_view_more[]"
                                                                       value="<?php echo $tuple[3]; ?>" class="form-control"
                                                                       placeholder="<?php echo $BIZBOOK['VIEW_MORE_LINK']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>*/?>
                                                    <!--FILED END-->
                                                </li>
                                                <?php
                                            }
                                        
                                        }else{
                                            ?>
                                            <li class="item-offer">
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="service_1_name[]"  class="form-control" placeholder="<?php echo $BIZBOOK['OFFER_NAME']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="number" name="service_1_price[]" min=0 step="0.01" 
                                                                    accept=""onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'inherit'"
                                                                    class="form-control" placeholder="<?php echo $BIZBOOK['PRICE']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea name="service_1_detail[]" class="form-control"
                                                                      placeholder="<?php echo $BIZBOOK['DETAILS_ABOUT_OFFER']; ?>"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><?php echo $BIZBOOK['CHOOSE_OFFER_IMAGE']; ?></label>
                                                            <input type="file" name="service_1_image[]"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                               <?php /* <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" name="service_1_view_more[]"
                                                                   class="form-control" placeholder="<?php echo $BIZBOOK['VIEW_MORE_LINK']; ?>">
                                                        </div>
                                                    </div>
                                                </div>*/?>
                                                <!--FILED END-->
                                            </li>
                                            <?php
                                        }
                                        ?>
									</ul>
									<!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="add-listing-step-2">
                                                <button type="button" class="btn btn-primary"><?php echo $BIZBOOK['PREVIOUS']; ?></button>
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" name="listing_submit_step_3" class="btn btn-primary"><?php echo $BIZBOOK['NEXT']; ?></button>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="add-listing-step-4" class="skip"><?php echo $BIZBOOK['SKIP_THIS']; ?> >></a>
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