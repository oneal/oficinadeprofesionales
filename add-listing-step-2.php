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
                                <a href="add-listing-step-2" class="act">
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
                <div class="login-main add-list add-list-ser">
                     <div class="log-bor">&nbsp;</div>
                   <span class="steps"><?php echo $BIZBOOK['STEP2']; ?></span>
                    <div class="log">
                        <div class="login">
                            <h4><?php echo $BIZBOOK['SERVICES_PROVIDE']; ?></h4>
                            <?php include "page_level_message.php"; ?>
                            <span class="add-list-add-btn lis-ser-add-btn" title="add new offer">+</span>
							<span class="add-list-rem-btn lis-ser-rem-btn" title="remove offer">-</span>
                             <form action="add_session_listing_step_2.php" class="listing_form_2" id="listing_form_2" name="listing_form_2" method="post" enctype="multipart/form-data">

                                 <input type="hidden" id="service_image_old"
                                   value="<?php echo $_SESSION['service_image']; ?>" name="service_image_old"
                                   class="validate">

                                 <ul>
                                     <?php
                                     $service_id_1 = $_SESSION['service_id'];
                                     $service_id_count = count($service_id_1);

                                    $img = explode(',', $_SESSION['service_image']);
                                    if($service_id_count != 0) {
                                         foreach ($service_id_1 as $k => $service_Array) {
                                             ?>
                                            <li class="item-service">
                                                 <!--FILED START-->
                                                 <div class="row">
                                                     <div class="col-md-6">
                                                         <div class="form-group">
                                                             <label><?php echo $BIZBOOK['SERVICE_NAME']; ?>:</label>
                                                             <input type="text" name="service_id[]" class="form-control"
                                                                    value="<?php echo $service_Array; ?>"
                                                                    placeholder="<?php echo $BIZBOOK['SERVICE_NAME_PLACEHOLDER']; ?>">
                                                         </div>
                                                     </div>
                                                     <div class="col-md-6">
                                                         <div class="form-group">
                                                             <label><?php echo $BIZBOOK['CHOOSE_PROFILE_IMAGE']; ?></label><br/>
                                                             <?php if(!empty($img[$k])){?>
                                                                <img src="images/services/<?php echo $img[$k];?>" style="max-width: 120px"/>
                                                                <input type="hidden" name="service_img_old_hidden[]" value="<?php echo $img[$k];?>"/>
                                                            <?php }?>
                                                             <input type="file" name="service_image[]"
                                                                    class="form-control">
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <!--FILED END-->
                                             </li>
                                             <?php
                                         }
                                     }else {
                                         ?>
                                         <li class="item-service">
                                             <!--FILED START-->
                                             <div class="row">
                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                         <label><?php echo $BIZBOOK['SERVICE_NAME']; ?>:</label>
                                                         <input type="text" name="service_id[]" class="form-control"
                                                                placeholder="<?php echo $BIZBOOK['SERVICE_NAME_PLACEHOLDER']; ?>">
                                                     </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                         <label><?php echo $BIZBOOK['IMAGE']; ?></label>
                                                         <input type="file" name="service_image[]"
                                                                class="form-control">
                                                     </div>
                                                 </div>
                                             </div>
                                             <!--FILED END-->
                                         </li>
                                         <li class="item-service">
                                             <!--FILED START-->
                                             <div class="row">
                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                         <label><?php echo $BIZBOOK['SERVICE_NAME']; ?></label>
                                                         <input type="text" name="service_id[]" class="form-control"
                                                                placeholder="<?php echo $BIZBOOK['SERVICE_NAME_PLACEHOLDER']; ?>">
                                                     </div>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                         <label><?php echo $BIZBOOK['IMAGE']; ?></label>
                                                         <input type="file" name="service_image[]" class="form-control">
                                                     </div>
                                                 </div>
                                             </div>
                                             <!--FILED END-->
                                         </li>
                                         <?php
                                     }
                                     ?>
                                 </ul>
                                 <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="add-listing-step-1"><button type="button" class="btn btn-primary"><?php echo $BIZBOOK['PREVIOUS']; ?></button></a>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" name="listing_submit" class="btn btn-primary"><?php echo $BIZBOOK['NEXT']; ?></button>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="add-listing-step-3" class="skip"><?php echo $BIZBOOK['SKIP_THIS']; ?> >></a>
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