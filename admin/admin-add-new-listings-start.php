<?php
include "header.php";
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="login-reg">
                <div class="container">
                    <form action="insert_listing.php" class="listing_form" id="listing_form"
                          name="listing_form" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="login-main add-list posr">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['STEP1'];?></span>
                                <div class="log log-1">
                                    <div class="login">
                                        <h4><?php echo $BIZBOOK['DETAILS'];?></h4>
                                        <?php include "../page_level_message.php"; ?>

                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select name="user_code" id="user_code" class="form-control"
                                                            required="required">
                                                        <option value="" disabled selected><?php echo $BIZBOOK['USER_NAME'];?></option>
                                                        <?php
                                                        foreach (getAllUserListingAdmin() as $ad_users_row) {
                                                            ?>
                                                            <option
                                                                value="<?php echo $ad_users_row['user_code']; ?>"><?php echo $ad_users_row['first_name']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input id="listing_name" name="listing_name" type="text"
                                                           required="required" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['LISTING_NAME_STAR'];?> *">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <?php /*<!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="listing_mobile" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['PHONE'];?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="listing_email" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['EMAIL'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->*/?>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="listing_website" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['WEBSITE'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="listing_address" required="required" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['ADDRESS'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->

                                        <?php /*<!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="listing_lat" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['LATITUDE_PLACEHOLDER'];?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="listing_lng" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['LONGITUDE_PLACEHOLDER'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->*/?>

                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    
                                                    <select onChange="getCities(this.value);" name="state_id" required="required"
                                                            class="form-control">
                                                        <option value=""><?php echo $BIZBOOK['SELECT_YOUR_STATE'];?></option>
                                                        <?php
                                                        //Countries Query
                                                        /*$admin_countries = $footer_row['admin_countries'];
                                                        $catArray = explode(',', $admin_countries);*/

                                                        foreach (getAllStates(1) as $state_row) {?>
                                                            <option <?php if ($_SESSION['state_id'] == $state_row['state_id']) {
                                                                echo "selected";
                                                            } ?>
                                                                value="<?php echo $state_row['state_id']; ?>"><?php echo $state_row['state_name']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select data-placeholder="<?php echo $BIZBOOK['SELECT_YOUR_CITY'];?>" name="city_id" id="city_id" required="required"
                                                            class="form-control">
                                                        <option value=""><?php echo $BIZBOOK['SELECT_YOUR_CITY'];?></option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select <?php /*onChange="getSubCategory(this.value);"*/?> name="category_id" id="category_id" class="form-control">
                                                        <option value=""><?php echo $BIZBOOK['SELECT_CATEGORY'];?></option>
                                                        <?php
                                                        foreach (getAllCategories() as $categories_row) {
                                                            ?>
                                                            <option
                                                                value="<?php echo $categories_row['category_id']; ?>"><?php echo $categories_row['category_name']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->

                                        <?php /*<!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select  data-placeholder="Select Sub Category" name="sub_category_id[]" id="sub_category_id" multiple class="chosen-select form-control">
                                                        <option value="">Subcategoría</option>
                                                        
                                                            foreach (getAllSubCategories() as $sub_categories_row) {?>
                                                                <option <?php if ($_SESSION['sub_category_id'] == $sub_categories_row['sub_category_id']) {
                                                                    echo "selected";
                                                            } ?>
                                                         value="<?php echo $sub_categories_row['sub_category_id']; ?>"><?php echo $sub_categories_row['sub_category_name']; ?></option>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        */?>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p><?php echo $BIZBOOK['DESCRIPTION_BUSSINES'];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" id="listing_description"
                                                              name="listing_description"
                                                              placeholder="<?php echo $BIZBOOK['DETAILS'];?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo $BIZBOOK['CHOOSE_IMAGE_FIRST'];?></label>
                                                    <input type="file" name="profile_image" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><?php echo $BIZBOOK['CHOOSE_BACKGROUND_IMAGE'];?></label>
                                                    <input type="file" name="cover_image" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->

                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                        <textarea class="form-control" id="service_locations"
                                                  name="service_locations"
                                                  placeholder="<?php echo $BIZBOOK['ENTER_SERVICE_LOCATION'];?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="login-main add-list add-list-ser">
                                <div class="log-bor">&nbsp;</div>
                                <span class="steps"><?php echo $BIZBOOK['STEP2'];?></span>
                                <div class="log">
                                    <div class="login">

                                        <h4><?php echo $BIZBOOK['SERVICES_PROVIDE'];?></h4>
                                        <span class="add-list-add-btn lis-ser-add-btn" title="<?php echo $BIZBOOK['ADD_NEW_SERVICE'];?>">+</span>
                                        <span class="add-list-rem-btn lis-ser-rem-btn" title="<?php echo $BIZBOOK['DELL_SERVICE'];?>">-</span>
                                            <ul>
                                                <li class="item-service">
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo $BIZBOOK['SERVICE_NAME'];?>:</label>
                                                                <input type="text" name="service_id[]"
                                                                       class="form-control"
                                                                       placeholder="<?php echo $BIZBOOK['SERVICE_NAME_PLACEHOLDER'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo $BIZBOOK['IMAGE'];?></label>
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
                                                                <label><?php echo $BIZBOOK['SERVICE_NAME'];?>:</label>
                                                                <input type="text" name="service_id[]"
                                                                       class="form-control"
                                                                       placeholder="<?php echo $BIZBOOK['SERVICE_NAME_PLACEHOLDER'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo $BIZBOOK['IMAGE'];?></label>
                                                                <input type="file" name="service_image[]"
                                                                       class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                </li>
                                            </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="login-main add-list">
                                <div class="log-bor">&nbsp;</div>
                                <span class="steps"><?php echo $BIZBOOK['STEP3'];?></span>
                                <div class="log">
                                    <div class="login add-list-off">

                                        <h4><?php echo $BIZBOOK['SPECIAL_OFFERS'];?></h4>
                                        <span class="add-list-add-btn lis-add-off" title="<?php echo $BIZBOOK['ADD_NEW_OFFER'];?>">+</span>
                                        <span class="add-list-rem-btn lis-add-rem" title="<?php echo $BIZBOOK['DEL_OFFER'];?>">-</span>

                                        <ul>
                                            <li class="item-offer">
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="service_1_name[]"
                                                                   class="form-control"
                                                                   placeholder="<?php echo $BIZBOOK['OFFER_NAME'];?> *">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="number" name="service_1_price[]"
                                                                   class="form-control" 
                                                                   min=0 step="0.01" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'inherit'" placeholder="<?php echo $BIZBOOK['PRICE'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                        <textarea class="form-control" name="service_1_detail[]"
                                                                  placeholder="<?php echo $BIZBOOK['DETAILS_ABOUT_OFFER'];?>"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><?php echo $BIZBOOK['CHOOSE_OFFER_IMAGE'];?></label>
                                                            <input type="file" name="service_1_image[]"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <?php /*<!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" name="service_1_view_more[]"
                                                                   class="form-control"  placeholder="<?php echo $BIZBOOK['VIEW_MORE_LINK'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->*/?>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="login-main add-list">
                                <div class="log-bor">&nbsp;</div>
                                <span class="steps"><?php echo $BIZBOOK['STEP4'];?></span>
                                <div class="log add-list-map">
                                    <div class="login add-list-map">
                                        <h4><?php echo $BIZBOOK['VIDEO_GALLERY'];?></h4>
                                        <ul>
                                            <span class="add-list-add-btn lis-add-oadvideo" title="<?php echo $BIZBOOK['ADD_NEW_VIDEO'];?>">+</span>
                                            <span class="add-list-rem-btn lis-add-orevideo" title="<?php echo $BIZBOOK['DEL_VIDEO'];?>">-</span>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                 <textarea id="listing_video" name="listing_video[]"
                                                           class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['PASTE_IFRAME_CODE'];?>"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                        </ul>
                                        <h4><?php echo $BIZBOOK['MAP_360_VIEW'];?></h4>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                <textarea class="form-control" name="google_map"
                                                          placeholder="<?php echo $BIZBOOK['IFRAME_GOOGLE_MAP'];?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                <textarea class="form-control" name="360_view"
                                                          placeholder="<?php echo $BIZBOOK['360_VIEW'];?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->

                                        <h4 class="pt30"><?php echo $BIZBOOK['PHOTO_GALLERY'];?></h4>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="file" name="gallery_image[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="file" name="gallery_image[]" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="file" name="gallery_image[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="file" name="gallery_image[]" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="file" name="gallery_image[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="file" name="gallery_image[]" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="login-main add-list">
                                <div class="log-bor">&nbsp;</div>
                                <span class="steps"><?php echo $BIZBOOK['STEP5'];?></span>
                                <div class="log">
                                    <div class="login add-lis-oth">

                                        <h4><?php echo $BIZBOOK['OTHER_INFORMATIONS'];?></h4>
                                        <span class="add-list-add-btn lis-add-oad" title="<?php echo $BIZBOOK['ADD_NEW_INFORMATION'];?>">+</span>
                                        <span class="add-list-rem-btn lis-add-ore" title="<?php echo $BIZBOOK['DEL_INFORMATION'];?>">-</span>

                                        <ul>
                                            <li>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <input type="text" name="listing_info_question[]"
                                                                   class="form-control" placeholder="<?php echo $BIZBOOK['OTHER_INFORMATIONS_PLACEHOLDER_LEFT'];?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <i class="material-icons">arrow_forward</i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <input type="text" name="listing_info_answer[]"
                                                                   class="form-control" placeholder="<?php echo $BIZBOOK['OTHER_INFORMATIONS_PLACEHOLDER_RIGHT'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                            </li>
                                        </ul>
                                        <!--FILED START-->
                                        <div class="row">
                                            <?php /*
                                            <div class="col-md-6">
                                                 <button type="submit" class="btn btn-primary">Previous</button>
                                             </div>
                                             */?>
                                            <div class="col-md-12">
                                                <button type="submit" name="listing_submit" class="btn btn-primary">
                                                    <?php echo $BIZBOOK['SAVED'];?>
                                                </button>
                                            </div>
                                            <div class="col-md-12">
                                                <a href="profile.php" class="skip"><?php echo $BIZBOOK['GO_TO_DASHBOARD'];?> >></a>
                                            </div>
                                        </div>
                                        <!--FILED END-->

                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/select-opt.js"></script>
<script src="js/admin-custom.js"></script>
<?php /*<script>
    function getSubCategory(val) {
        $.ajax({
            type: "POST",
            url: "../sub_category_process.php",
            data: 'category_id=' + val,
            success: function (data) {
                $("#sub_category_id").html(data);
                $('#sub_category_id').trigger("chosen:updated");
            }
        });
    }
</script>*/?>
<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('listing_description');
</script>
<script>
    function getCities(val) {
        $.ajax({
            type: "POST",
            url: "../city_process.php",
            data: 'state_id=' + val,
            success: function (data) {
                $("#city_id").html(data);
                $('#city_id').trigger("chosen:updated");
            }
        });
    }
</script>
</body>

</html>