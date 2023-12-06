<?php
include "header.php";
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="login-reg">
                <div class="container">
                    <form action="update_store.php" class="store_form" id="store_form"
                          name="store_form" method="post" enctype="multipart/form-data">
                        <?php
                        $store_codea = $_GET['code'];
                        $store_a_row = getStore($store_codea);
                        ?>
                        <input type="hidden" id="store_codea" value="<?php echo $store_codea; ?>"
                               name="store_codea" class="validate">
                        <input type="hidden" id="store_id" value="<?php echo $store_a_row['store_id']; ?>"
                               name="store_id" class="validate">
                        <input type="hidden" id="store_code" value="<?php echo $store_a_row['store_code']; ?>"
                               name="store_code" class="validate">
                        <div class="row">
                            <div class="login-main add-list posr">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['ADD_EDIT_STORE'];?></span>
                                <div class="log log-1">
                                    <div class="login">
                                        <h4><?php echo $BIZBOOK['DETAILS'];?></h4>
                                        <?php include "../page_level_message.php"; ?>

                                        <?php /*<!--FILED START-->
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
                                                                value="<?php echo $ad_users_row['user_code']; ?>" <?php if($store_a_row['user_id'] == $ad_users_row['user_id']) { echo "selected"; }?>><?php echo $ad_users_row['first_name']; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->*/?>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input id="store_name" name="store_name" type="text"
                                                           required="required" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['NAME'];?> *" value="<?php echo $store_a_row['store_name'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="store_mobile" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['PHONE'];?>" value="<?php echo $store_a_row['store_mobile'];?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="store_email" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['EMAIL'];?>" value="<?php echo $store_a_row['store_email'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="store_website" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['WEBSITE'];?>" value="<?php echo $store_a_row['store_website'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
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
                                                            <option <?php if ($store_a_row['state_id'] == $state_row['state_id']) {
                                                                echo "selected";
                                                            }?>
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
                                                    <select data-placeholder="<?php echo $BIZBOOK['SELECT_YOUR_CITY'];?>" name="city_id" id="city_id"
                                                            required="required" class="form-control">
                                                        <option value=""><?php echo $BIZBOOK['SELECT_YOUR_CITY'];?></option>
                                                        <?php
                                                        foreach (getAllCitiesIdState($store_a_row['state_id']) as $city_row) {
                                                            ?>
                                                            <option <?php if ($store_a_row['city_id'] == $city_row['city_id']) {
                                                                echo "selected";
                                                            }?>
                                                                    value="<?php echo $city_row['city_id']; ?>"><?php echo $city_row['city_name']; ?></option>
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
                                                    <select <?php /*onChange="getSubCategory(this.value);"*/?> name="category_id" id="category_id" class="form-control">
                                                        <option value=""><?php echo $BIZBOOK['SELECT_CATEGORY'];?></option>
                                                        <?php
                                                        foreach (getAllCategoriesStores() as $categories_row) {
                                                            ?>
                                                            <option <?php if ($store_a_row['category_id'] == $categories_row['category_id']) {
                                                                echo "selected";
                                                            } ?>
                                                                    value="<?php echo $categories_row['category_id']; ?>"><?php echo $categories_row['category_name']; ?></option>
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
                                                    <label><?php echo $BIZBOOK['CHOOSE_IMAGE_FIRST'];?></label><br>
                                                    <?php if($store_a_row['profile_image']!=""){?>
                                                        <img src="../images/stores/<?php echo $store_a_row['profile_image'];?>" style="max-width: 120px"/>
                                                        <input type="hidden" id="profile_image_old"
                                                           value="<?php echo $store_a_row['profile_image']; ?>" name="profile_image_old"
                                                           class="validate">
                                                    <?php }?>
                                                    <input type="file" name="profile_image" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><?php echo $BIZBOOK['STORE_DESCRIPTION'];?></label>
                                                    <textarea name="store_description" id="store_description" required="required" class="form-control"><?php echo $store_a_row['store_description'];?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" name="store_submit" class="btn btn-primary">
                                                    <?php echo $BIZBOOK['SAVED'];?>
                                                </button>
                                            </div>
                                            <div class="col-md-12">
                                                <a href="profile.php" class="skip"><?php echo $BIZBOOK['GO_TO_DASHBOARD'];?> >></a>
                                            </div>
                                        </div>
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
<script src="ckeditor/ckeditor.js"></script>
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