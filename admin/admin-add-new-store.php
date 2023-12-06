<?php
include "header.php";
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="login-reg">
                <div class="container">
                    <form action="insert_store.php" class="store_form" id="store_form"
                          name="store_form" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="login-main add-list posr">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['ADD_NEW_STORE'];?></span>
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
                                                                value="<?php echo $ad_users_row['user_code']; ?>"><?php echo $ad_users_row['first_name']; ?></option>
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
                                                           placeholder="<?php echo $BIZBOOK['NAME'];?> *">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="store_mobile" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['PHONE'];?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="store_email" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['EMAIL'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="store_website" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['WEBSITE'];?>">
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
                                                        foreach (getAllCategoriesStores() as $categories_row) {
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
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><?php echo $BIZBOOK['CHOOSE_IMAGE_FIRST'];?></label>
                                                    <input type="file" name="profile_image" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><?php echo $BIZBOOK['STORE_DESCRIPTION'];?></label>
                                                    <textarea name="store_description" id="store_description" required="required" class="form-control"></textarea>
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
                                                <a href="admin-all-stores.php" class="skip"><?php echo $BIZBOOK['GO_TO_STORES'];?> >></a>
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