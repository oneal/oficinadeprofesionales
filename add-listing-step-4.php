<?phpinclude "header.php";if (file_exists('config/user_authentication.php')) {    include('config/user_authentication.php');}//To redirect the general type user to dashboard to avoid using this pageif ($user_details_row['user_type'] == "General") {    header("Location: dashboard.php");}//To check the listings count with current plan starts$plan_type_listing_count = $user_plan_type['plan_type_listing_count'];$listing_count_user = getCountUserListing($_SESSION['user_id']);if($listing_count_user >= $plan_type_listing_count){    $_SESSION['status_msg'] = "Your Listings Limit Exceeded!! Upgrade your plan and enjoy our services";    header('Location: db-all-listing');}?><!-- START --><!--PRICING DETAILS--><section class="<?php if ($footer_row['admin_language'] == 2) {    echo "lg-arb";} ?> login-reg">    <div class="container">        <div class="row">            <div class="add-list-ste">                <div class="add-list-ste-inn">                    <ul>                        <li>                            <a href="add-listing-step-1">                                <span><?php echo $BIZBOOK['STEP1']; ?></span>                                <b><?php echo $BIZBOOK['BASIC_INFO']; ?></b>                            </a>                        </li>                        <li>                            <a href="add-listing-step-2">                                <span><?php echo $BIZBOOK['STEP2']; ?></span>                                <b><?php echo $BIZBOOK['SERVICES']; ?></b>                            </a>                        </li>                        <li>                            <a href="add-listing-step-3">                                <span><?php echo $BIZBOOK['STEP3']; ?></span>                                <b><?php echo $BIZBOOK['OFFERS']; ?></b>                            </a>                        </li>                        <li>                            <a href="add-listing-step-4" class="act">                                <span><?php echo $BIZBOOK['STEP4']; ?></span>                                <b><?php echo $BIZBOOK['MAP']; ?></b>                            </a>                        </li>                        <li>                            <a href="#!">                                <span><?php echo $BIZBOOK['STEP5']; ?></span>                                <b><?php echo $BIZBOOK['OTHER']; ?></b>                            </a>                        </li>                        <li>                            <a href="#!">                                <span><?php echo $BIZBOOK['STEP6']; ?></span>                                <b><?php echo $BIZBOOK['DONE']; ?></b>                            </a>                        </li>                    </ul>                </div>            </div>        </div>        <div class="row">            <div class="login-main add-list">                <div class="log-bor">&nbsp;</div>                <span class="steps"><?php echo $BIZBOOK['STEP4']; ?></span>                <div class="log add-list-map">                    <div class="login add-list-map">                        <form action="add_session_listing_step_4.php" class="listing_form_4" id="listing_form_4"                              name="listing_form_4" method="post" enctype="multipart/form-data">                            <input type="hidden" id="gallery_image_old"                                       value="<?php echo $_SESSION['gallery_image']; ?>" name="gallery_image_old"                                       class="validate">                            <h4><?php echo $BIZBOOK['VIDEO_GALLERY']; ?></h4>                            <ul>                                <span class="add-list-add-btn lis-add-oadvideo" title="add new video">+</span>                                <span class="add-list-rem-btn lis-add-orevideo" title="remove video">-</span>                                <?php                                $listings_a_row_listing_video = $_SESSION['listing_video'];                                $listings_a_row_listing_video_count = count($listings_a_row_listing_video); //Get count of array                                if ($listings_a_row_listing_video_count != 0) {                                    foreach ($listings_a_row_listing_video as $tuple) {                                        ?>                                        <li>                                            <div class="row">                                                <div class="col-md-12">                                                    <div class="form-group">                                                        <textarea id="listing_video" name="listing_video[]"                                                                  class="form-control"                                                                  placeholder="<?php echo $BIZBOOK['PASTE_IFRAME_CODE']; ?>"><?php echo $tuple; ?></textarea>                                                    </div>                                                </div>                                            </div>                                        </li>                                        <?php                                    }                                } else {                                    ?>                                    <li>                                        <div class="row">                                            <div class="col-md-12">                                                <div class="form-group">                                                 <textarea id="listing_video" name="listing_video[]"                                                           class="form-control"                                                           placeholder="<?php echo $BIZBOOK['PASTE_IFRAME_CODE']; ?>"></textarea>                                                </div>                                            </div>                                        </div>                                    </li>                                    <?php                                }                                ?>                            </ul>                            <h4><?php echo $BIZBOOK['MAP_360_VIEW']; ?></h4>                            <!--FILED START-->                            <div class="row">                                <div class="col-md-12">                                    <div class="form-group">                                        <textarea id="google_map" name="google_map" class="form-control"                                                  placeholder="<?php echo $BIZBOOK['IFRAME_GOOGLE_MAP']; ?>"><?php echo $_SESSION['google_map'] ?></textarea>                                    </div>                                </div>                            </div>                            <!--FILED END-->                            <!--FILED START-->                            <div class="row">                                <div class="col-md-12">                                    <div class="form-group">                                        <textarea id="360_view" name="360_view" class="form-control"                                                  placeholder="<?php echo $BIZBOOK['360_VIEW']; ?>"><?php echo $_SESSION['360_view'] ?></textarea>                                    </div>                                </div>                            </div>                            <!--FILED END-->                            <h4 class="pt30"><?php echo $BIZBOOK['PHOTO_GALLERY']; ?></h4>                            <?php                            //To check the photos count with current plan starts                            //$plan_type_photos_count = $user_plan_type['plan_type_photos_count'];                            ?>                            <?php /*<!--FILED START-->                            <div class="row">                                <?php                                for($p=1;$p<= $plan_type_photos_count;$p++) {                                    ?>                                    <div class="col-md-6">                                        <div class="form-group">                                            <input type="file" name="gallery_image[]" class="form-control">                                        </div>                                    </div>                                    <?php                                }                                ?>                                <div class="col-md-6">                                    <div class="form-group">                                    </div>                                </div>                            </div>                            <!--FILED END-->*/?>                            <!--FILED START-->                            <div class="row">                                <?php $gallery_image = explode(',',$_SESSION['gallery_image']);?>                                <?php for($i=0; $i<6; $i++){?>                                    <div class="col-md-6">                                        <div class="form-group">                                            <?php if(!empty($gallery_image[$i])){?>                                                <img src="images/listings/<?php echo $gallery_image[$i];?>" style="max-width: 120px"/>                                                <input type="hidden" name="gallery_image_old_hidden[]" value="<?php echo $gallery_image[$i];?>"/>                                            <?php }?>                                            <input type="file" name="gallery_image[]" class="form-control">                                        </div>                                    </div>                                <?php }?>                            </div>                            <!--FILED END-->                            <!--FILED START-->                            <div class="row">                                <div class="col-md-6">                                    <a href="add-listing-step-3">                                        <button type="button" class="btn btn-primary"><?php echo $BIZBOOK['PREVIOUS']; ?></button>                                    </a>                                </div>                                <div class="col-md-6">                                    <button type="submit" name="listing_submit_step_4" class="btn btn-primary"><?php echo $BIZBOOK['NEXT']; ?></button>                                </div>                                <div class="col-md-12">                                    <a href="add-listing-step-5" class="skip"><?php echo $BIZBOOK['SKIP_THIS']; ?> >></a>                                </div>                            </div>                            <!--FILED END-->                        </form>                    </div>                </div>            </div>        </div>    </div></section><!--END PRICING DETAILS--><?phpinclude "footer.php";?><!-- Optional JavaScript --><!-- jQuery first, then Popper.js, then Bootstrap JS --><script src="js/jquery.min.js"></script><script src="js/popper.min.js"></script><script src="js/bootstrap.min.js"></script><script src="js/jquery-ui.min.js"></script><script src="js/custom.min.js"></script></body></html>