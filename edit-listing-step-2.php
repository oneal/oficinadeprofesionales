<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

//To redirect the general type user to dashboard to avoid using this page

if($user_details_row['user_type'] == "General") {
    header("Location: dashboard");
}

//Get & Process Listing Data

if ($_GET['row'] == NULL && empty($_GET['row'])) {
    header("Location: db-all-listing");
}

session_start();
if(!isset($_SESSION['listing_codea']) || empty($_SESSION['listing_codea'] )){
    $listing_codea = $_GET['row'];
}else {
    $listing_codea = $_SESSION['listing_codea'];
}

if (isset($_POST['listing_submit'])) {
//    $_SESSION['listing_codea'] = $_POST['listing_codea'];
//    $_SESSION['listing_id'] = $_POST['listing_id'];
//    $_SESSION['listing_code'] = $_POST['listing_code'];
//    $_SESSION['profile_image_old'] = $_POST['profile_image_old'];
//    $_SESSION['cover_image_old'] = $_POST['cover_image_old'];
//    $_SESSION['gallery_image_old'] = $_POST['gallery_image_old'];
//    $_SESSION['service_image_old'] = $_POST['service_image_old'];
//    $_SESSION['service_1_image_old'] = $_POST['service_1_image_old'];

        //// Basic Personal Details
//        $_SESSION['first_name'] = $_POST["first_name"];
//        $_SESSION['last_name'] = $_POST["last_name"];
//        $_SESSION['mobile_number'] = $_POST["mobile_number"];
//        $_SESSION['email_id'] = $_POST["email_id"];
//
//        $_SESSION['register_mode'] = "Direct";
//        $_SESSION['user_status'] = "Inactive";

    //// Common Listing Details
//    $_SESSION['listing_name'] = $_POST["listing_name"];
//    $_SESSION['listing_mobile'] = $_POST["listing_mobile"];
//    $_SESSION['listing_email'] = $_POST["listing_email"];
//    $_SESSION['listing_website'] = $_POST["listing_website"];
//    $_SESSION['listing_address'] = $_POST["listing_address"];
//    $_SESSION['listing_description'] = $_POST["listing_description"];
//    $_SESSION['category_id'] = $_POST["category_id"];
    //$_SESSION['sub_category_id'] = $_POST["sub_category_id"];

//    $_SESSION['state_id'] = $_POST["state_id"];
//
//    $_SESSION['city_id'] = $_POST["city_id"];

    ////************************  Profile Image Upload starts  **************************

//    if (!empty($_FILES['profile_image']['name'])) {
//        $file = rand(1000, 100000) . $_FILES['profile_image']['name'];
//        $file_loc = $_FILES['profile_image']['tmp_name'];
//        $file_size = $_FILES['profile_image']['size'];
//        $file_type = $_FILES['profile_image']['type'];
//        $folder = "images/listings/";
//        $new_size = $file_size / 1024;
//        $new_file_name = strtolower($file);
//        $event_image = str_replace(' ', '-', $new_file_name);
//        move_uploaded_file($file_loc, $folder . $event_image);
//        $profile_image = $event_image;
//        $_SESSION['profile_image'] = $profile_image;
//    } else {
//        $_SESSION['profile_image'] = $_SESSION['profile_image_old'];
//    }
    ////************************  Profile Image Upload Ends  **************************
    //
    //************************  Cover Image Upload starts  **************************

//    if (!empty($_FILES['cover_image']['name'])) {
//        $file = rand(1000, 100000) . $_FILES['cover_image']['name'];
//        $file_loc = $_FILES['cover_image']['tmp_name'];
//        $file_size = $_FILES['cover_image']['size'];
//        $file_type = $_FILES['cover_image']['type'];
//        $folder = "images/listing-ban/";
//        $new_size = $file_size / 1024;
//        $new_file_name = strtolower($file);
//        $event_image = str_replace(' ', '-', $new_file_name);
//        move_uploaded_file($file_loc, $folder . $event_image);
//        $cover_image = $event_image;
//        $_SESSION['cover_image'] = $cover_image;
//    }else {
//        $_SESSION['cover_image'] = $_SESSION['cover_image_old'];
//    }
    //************************  Cover Image Upload ends  **************************

    if ($listing_type_id == NULL || empty($listing_type_id)) {
        header('Location: edit-listing-step-1');
    }
}
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
                            <a href="edit-listing-step-1?row=<?php echo $listing_codea; ?>">
                                <span><?php echo $BIZBOOK['STEP1']; ?></span>
                                <b><?php echo $BIZBOOK['BASIC_INFO']; ?></b>
                            </a>
                        </li>
                        <li>
                            <a href="edit-listing-step-2?row=<?php echo $listing_codea; ?>" class="act">
                                <span><?php echo $BIZBOOK['STEP2']; ?></span>
                                <b><?php echo $BIZBOOK['SERVICES']; ?></b>
                            </a>
                        </li>
                        <li>
                            <a href="edit-listing-step-3?row=<?php echo $listing_codea; ?>">
                                <span><?php echo $BIZBOOK['STEP3']; ?></span>
                                <b><?php echo $BIZBOOK['OFFERS']; ?></b>
                            </a>
                        </li>
                        <li>
                            <a href="edit-listing-step-4?row=<?php echo $listing_codea; ?>">
                                <span><?php echo $BIZBOOK['STEP4']; ?></span>
                                <b><?php echo $BIZBOOK['MAP']; ?></b>
                            </a>
                        </li>
                        <li>
                            <a href="edit-listing-step-5?row=<?php echo $listing_codea; ?>">
                                <span><?php echo $BIZBOOK['STEP5']; ?></span>
                                <b><?php echo $BIZBOOK['OTHER']; ?></b>
                            </a>
                        </li>
                        <li>
                            <a href="edit-listing-step-6?row=<?php echo $listing_codea; ?>">
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
                        <?php
                        $listings_a_row = getListing($listing_codea);
                        ?>
                        <h4><?php echo $BIZBOOK['SERVICES_PROVIDE']; ?></h4>
                        <span class="add-list-add-btn lis-ser-add-btn" title="add new offer">+</span>
                        <span class="add-list-rem-btn lis-ser-rem-btn" title="remove offer">-</span>
                        <form action="listing_update.php" class="listing_form_2" id="listing_form_2"
                              name="listing_form_2" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="src_path" value="edit-2"
                                   name="src_path" class="validate">
                            <input type="hidden" id="listing_codea" value="<?php echo $listing_codea; ?>"
                                   name="listing_codea" class="validate">
                            <input type="hidden" id="listing_code"
                                   value="<?php echo $listings_a_row['listing_code']; ?>"
                                   name="listing_code" class="validate">
                            <input type="hidden" id="listing_id" value="<?php echo $listings_a_row['listing_id']; ?>"
                                   name="listing_id" class="validate">
                            <input type="hidden" id="service_image_old"
                                   value="<?php echo $listings_a_row['service_image']; ?>" name="service_image_old"
                                   class="validate">
                            <ul>
                                <?php
                                $listings_a_row_service_id = $listings_a_row['service_id'];

                                $serArray = explode('|', $listings_a_row_service_id);
                                $img = explode(',', $listings_a_row['service_image']);
                                foreach($serArray as $k => $service_Array) {?>
                                    <li class="item-service">
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo $BIZBOOK['SERVICE_NAME']; ?>:</label>
                                                    <input type="text" name="service_id[]" value="<?php echo $service_Array; ?>" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['SERVICE_NAME_PLACEHOLDER']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo $BIZBOOK['IMAGE']; ?></label><br/>
                                                    <?php if(!empty($img[$k])){?>
                                                        <img src="images/services/<?php echo $img[$k];?>" style="max-width: 120px"/>
                                                        <input type="hidden" name="service_img_old_hidden[]" value="<?php echo $img[$k];?>"/>
                                                    <?php }?>
                                                    <input type="file" name="service_image[]" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                    </li>
                                <?php }?>
                                <?php /*
                                <li>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Service name 2:</label>
                                                <input type="text" class="form-control" placeholder="Ex: bike service">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Choose profile image</label>
                                                <input type="file" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </li>*/?>
                            </ul>
                            <!--FILED START-->
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="edit-listing-step-1?row=<?php echo $listing_codea; ?>">
                                        <button type="button" class="btn btn-primary"><?php echo $BIZBOOK['PREVIOUS']; ?></button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="listing_submit" class="btn btn-primary"><?php echo $BIZBOOK['SAVED']; ?></button>
                                </div>
                                <div class="col-md-12">
                                    <a href="edit-listing-step-3?row=<?php echo $listing_codea; ?>" class="skip"><?php echo $BIZBOOK['SKIP_THIS']; ?> >></a>
                                </div>
                                <div class="col-md-12">
                                    <a href="dashboard" class="skip"><?php echo $BIZBOOK['GO_TO_USER_DASHBOARD']; ?> >></a>
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