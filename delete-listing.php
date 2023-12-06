<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

//To redirect the general type user to dashboard to avoid using this page

$user_details_row = getUser($_SESSION['user_id']);

if($user_details_row['user_type'] == "General") {
    header("Location: dashboard");
}

?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="login-reg">
                <div class="container">
                    <?php
                    $listing_codea = $_GET['row'];
                    $listings_a_row = getListing($listing_codea);

                    ?>
                    <form action="listing_trash.php" class="listing_form" id="listing_form"
                       name="listing_form" method="post" enctype="multipart/form-data">

                        <input type="hidden" id="listing_codea" value="<?php echo $listing_codea; ?>"
                               name="listing_codea" class="validate">
                        <input type="hidden" id="listing_id" value="<?php echo $listings_a_row['listing_id']; ?>"
                               name="listing_id" class="validate">
                        <input type="hidden" id="listing_code" value="<?php echo $listings_a_row['listing_code']; ?>"
                               name="listing_code" class="validate">
                        <input type="hidden" id="listing_is_delete" value="<?php echo $listings_a_row['listing_is_delete']; ?>"
                               name="listing_is_delete" class="validate">
                        <input type="hidden" id="profile_image_old"
                               value="<?php echo $listings_a_row['profile_image']; ?>" name="profile_image_old"
                               class="validate">
                        <input type="hidden" id="cover_image_old"
                               value="<?php echo $listings_a_row['cover_image']; ?>" name="cover_image_old"
                               class="validate">
                        <input type="hidden" id="gallery_image_old"
                               value="<?php echo $listings_a_row['gallery_image']; ?>" name="gallery_image_old"
                               class="validate">
                        <input type="hidden" id="service_image_old"
                               value="<?php echo $listings_a_row['service_image']; ?>" name="service_image_old"
                               class="validate">
                        <input type="hidden" id="service_1_image_old"
                               value="<?php echo $listings_a_row['service_1_image']; ?>" name="service_1_image_old"
                               class="validate">
                        <?php /*<input type="hidden" id="service_2_image_old"
                               value="<?php //echo $listings_a_row['service_2_image']; ?>" name="service_2_image_old"
                               class="validate">
                        <input type="hidden" id="service_3_image_old"
                               value="<?php //echo $listings_a_row['service_3_image']; ?>" name="service_3_image_old"
                               class="validate">
                        <input type="hidden" id="service_4_image_old"
                               value="<?php //echo $listings_a_row['service_4_image']; ?>" name="service_4_image_old"
                               class="validate">
                        <input type="hidden" id="service_5_image_old"
                               value="<?php //echo $listings_a_row['service_5_image']; ?>" name="service_5_image_old"
                               class="validate">
                        <input type="hidden" id="service_6_image_old"
                               value="<?php //echo $listings_a_row['service_6_image']; ?>" name="service_6_image_old"
                               class="validate">*/?>
                        <div class="row">
                            <div class="login-main add-list posr">
                                <div class="log-bor">&nbsp;</div>
                                <span class="udb-inst"><?php echo $BIZBOOK['DELETE_LISTING']; ?></span>
                                <div class="log log-1">
                                    <div class="login">
                                        <h4><?php
                                            if(isset($_GET['path'])){
                                                if($_GET['path']=="restore"){
                                                    echo "Restaurar";
                                                }elseif($_GET['path']=="trash"){
                                                    echo "Borrar Permanentemente";
                                                }

                                            }else{
                                                echo "Borrar";
                                            }
                                            ?> <?php echo $BIZBOOK['LISTING_DETAILS']; ?></h4>
                                        <?php include "page_level_message.php"; ?>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input readonly="readonly" id="listing_name" name="listing_name" type="text" required="required"
                                                           value="<?php echo $listings_a_row['listing_name']; ?>"
                                                           class="form-control" placeholder="<?php echo $BIZBOOK['LISTING_NAME_STAR']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input readonly="readonly" id="listing_mobile" name="listing_mobile" type="text"
                                                           value="<?php echo $listings_a_row['listing_mobile']; ?>" class="form-control" placeholder="<?php echo $BIZBOOK['PHONE_NUMBER']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input readonly="readonly" id="listing_email" name="listing_email" type="text"
                                                           value="<?php echo $listings_a_row['listing_email']; ?>" class="form-control" placeholder="<?php echo $BIZBOOK['EMAIL_ID']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input readonly="readonly" id="listing_website" name="listing_website" type="text"
                                                           value="<?php echo $listings_a_row['listing_website']; ?>" class="form-control"
                                                           placeholder="<?php echo $BIZBOOK['WEBSITE']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input readonly="readonly" type="text" id="listing_address" name="listing_address" required="required"
                                                           value="<?php echo $listings_a_row['listing_address']; ?>"
                                                           class="form-control" placeholder="<?php echo $BIZBOOK['SHOP_ADDRESS']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->

                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select disabled="disabled" name="state_id" required="required"
                                                            class="form-control">
                                                        <option value=""><?php echo $BIZBOOK['SELECT_YOUR_STATE']; ?></option>
                                                        <?php
                                                        //Countries Query
                                                        //$admin_countries = $footer_row['admin_countries'];
                                                        //$catArray = explode(',', $admin_countries);
                                                        //foreach ($catArray as $state_row) {?>
                                                            <?php foreach (getAllStates(1) as $state_row) { ?>
                                                                    <option <?php if ($listings_a_row['state_id'] == $state_row['state_id']) {
                                                                        echo "selected";
                                                                    } ?>
                                                                        value="<?php echo $state_row['state_id']; ?>"><?php echo $state_row['state_name']; ?></option>

                                                            <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <?php /*<select class="form-control">
                                                        <option>Select your City</option>
                                                        <option value="1">Kyoto</option>
                                                        <option value="2">Charleston</option>
                                                        <option value="3">Florence</option>
                                                        <option value="">Rome</option>
                                                        <option value="">Mexico City</option>
                                                        <option value="">Barcelona</option>
                                                        <option value="">San Francisco</option>
                                                        <option value="">Chicago</option>
                                                        <option value="">Paris</option>
                                                        <option value="">Tokyo</option>
                                                        <option value="">Beijing</option>
                                                        <option value="">Jerusalem</option>
                                                    </select>*/?>
                                                    <select data-placeholder="<?php echo $BIZBOOK['SELECT_YOUR_CITY']; ?>" name="city_id" id="city_id"
                                                            required="required" class="form-control" disabled="disabled">
                                                        <?php
                                                        foreach (getAllCitiesIdState($listings_a_row['state_id']) as $city_row) {
                                                            ?>
                                                            <option <?php if ($listings_a_row['city_id'] == $city_row['city_id']) {
                                                                    echo "selected";
                                                                } ?>
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
                                                    <select disabled="disabled" name="category_id" id="category_id" class="form-control">
                                                        <option value=""><?php echo $BIZBOOK['SELECT_CATEGORY']; ?></option>
                                                        <?php
                                                        foreach (getAllCategories() as $categories_row) {
                                                            ?>
                                                            <option <?php if ($listings_a_row['category_id'] == $categories_row['category_id']) {
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

                                        <?php /*<!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select disabled="disabled" name="sub_category_id" id="sub_category_id"
                                                            class="form-control">
                                                        <option value=""><?php echo $BIZBOOK['SELECT_SUB_CATEGORY']; ?></option>
                                                        <?php
                                                        foreach (getAllSubCategories() as $sub_categories_row) {
                                                            ?>
                                                            <option <?php if ($listings_a_row['sub_category_id'] == $sub_categories_row['sub_category_id']) {
                                                                echo "selected";
                                                            } ?>
                                                                value="<?php echo $sub_categories_row['sub_category_id']; ?>"><?php echo $sub_categories_row['sub_category_name']; ?></option>
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
                                                <textarea readonly="readonly" class="form-control" id="listing_description"
                                                          name="listing_description" placeholder="<?php echo $BIZBOOK['DETAILS_ABOUT_LISTING']; ?>"><?php echo $listings_a_row['listing_description']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <?php /*<!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Choose profile image</label>
                                                    <input type="file"  name="profile_image" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Choose cover image</label>
                                                    <input type="file"  name="cover_image" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->*/?>
                                    </div>
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
                                        <?php /*<span class="add-list-add-btn lis-ser-add-btn" title="add new offer">+</span>
                                                <span class="add-list-rem-btn lis-ser-rem-btn" title="remove offer">-</span>*/?>

                                        <ul>
                                            <?php
                                            $listings_a_row_service_id=$listings_a_row['service_id'];

                                            $serArray = explode(',', $listings_a_row_service_id);
                                            foreach($serArray as $service_Array){

                                                ?>
                                                <li>
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo $BIZBOOK['SERVICE_NAME']; ?>:</label>
                                                                <input type="text" readonly="readonly" name="service_id[]" value="<?php echo $service_Array; ?>" class="form-control"
                                                                       placeholder="<?php echo $BIZBOOK['SERVICE_NAME_PLACEHOLDER']; ?>">
                                                            </div>
                                                        </div>
                                                        <?php /*<div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Choose profile image</label>
                                                                        <input type="file" name="service_image[]" class="form-control">
                                                                    </div>
                                                                </div>*/?>
                                                    </div>
                                                    <!--FILED END-->
                                                </li>
                                                <?php
                                            }
                                            ?>
                                            <?php /*                                           
                                            <!--FILED START-->
                                             <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Service name:</label>
                                                            <input type="text" class="form-control"
                                                                   placeholder="Ex: bike service">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Choose profile image</label>
                                                            <input type="file" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!--FILED END-->*/?>
                                        </ul>

                                    </div>
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
                                        <?php /*<span class="add-list-add-btn lis-add-off" title="add new offer">+</span>
                                                <span class="add-list-rem-btn lis-add-rem" title="remove offer">-</span>*/?>

                                        <ul>
                                            <?php
                                            $listings_a_row_service_1_name=$listings_a_row['service_1_name'];
                                            $listings_a_row_service_1_price=$listings_a_row['service_1_price'];
                                            $listings_a_row_service_1_detail=$listings_a_row['service_1_detail'];

                                            $ser_1_name_Array = explode(',', $listings_a_row_service_1_name);
                                            $ser_1_price_Array = explode(',', $listings_a_row_service_1_price);
                                            $ser_1_detail_Array = explode(',', $listings_a_row_service_1_detail);

                                            $zipped = array_map(null, $ser_1_name_Array, $ser_1_price_Array, $ser_1_detail_Array);

                                            foreach($zipped as $tuple) {
                                                $tuple[0]; // offer name
                                                $tuple[1]; // offer Price
                                                $tuple[2]; // offer Detail

                                                ?>
                                                <li>
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input readonly="readonly" type="text" class="form-control"
                                                                       value="<?php echo $tuple[0]; ?>"  name="service_1_name[]" placeholder="<?php echo $BIZBOOK['OFFER_NAME']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input readonly="readonly" type="text" class="form-control"
                                                                       value="<?php echo $tuple[1]; ?>" name="service_1_price[]" placeholder="<?php echo $BIZBOOK['PRICE']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                            <textarea readonly="readonly" class="form-control" name="service_1_detail[]"
                                                                      placeholder="<?php echo $BIZBOOK['DETAILS_ABOUT_OFFER']; ?>"><?php echo $tuple[2]; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                    <?php /*<!--FILED START-->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Choose offer image</label>
                                                                    <input type="file" name="service_1_image[]" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!--FILED END-->*/?>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="login-main add-list">
                                <div class="log-bor">&nbsp;</div>
                                <span class="steps"><?php echo $BIZBOOK['STEP4']; ?></span>
                                <div class="log add-list-map">
                                    <div class="login add-list-map">

                                        <h4><?php echo $BIZBOOK['MAP_360_VIEW']; ?></h4>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea readonly="readonly" class="form-control" name="google_map"
                                                              placeholder="<?php echo $BIZBOOK['SHOP_LOCATION']; ?>"><?php echo $listings_a_row['google_map']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea readonly="readonly" class="form-control" name="360_view" placeholder="<?php echo $BIZBOOK['360_VIEW']; ?>"><?php echo $listings_a_row['360_view']; ?></textarea>
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
                                <span class="steps"><?php echo $BIZBOOK['STEP5']; ?></span>
                                <div class="log">
                                    <div class="login add-lis-oth">

                                        <h4><?php echo $BIZBOOK['OTHER_INFORMATIONS']; ?></h4>
                                        <?php /*<span class="add-list-add-btn lis-add-oad" title="add new offer">+</span>
                                                <span class="add-list-rem-btn lis-add-ore" title="remove offer">-</span>*/?>

                                        <ul>
                                            <?php
                                            $listings_a_row_listing_info_question = $listings_a_row['listing_info_question'];
                                            $listings_a_row_listing_info_answer = $listings_a_row['listing_info_answer'];

                                            $listings_a_row_listing_info_question_Array = explode(',', $listings_a_row_listing_info_question);
                                            $listings_a_row_listing_info_answer_Array = explode(',', $listings_a_row_listing_info_answer);

                                            $zipped = array_map(null, $listings_a_row_listing_info_question_Array, $listings_a_row_listing_info_answer_Array);

                                            foreach($zipped as $tuple) {
                                                $tuple[0]; // Info question
                                                $tuple[1]; // Info Answer

                                                ?>
                                                <li>
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input readonly="readonly" type="text" class="form-control"
                                                                       name="listing_info_question[]" value="<?php echo $tuple[0]; ?>"
                                                                       placeholder="<?php echo $BIZBOOK['OTHER_INFORMATIONS_PLACEHOLDER_LEFT']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <i class="material-icons">arrow_forward</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input readonly="readonly" type="text" class="form-control"
                                                                       name="listing_info_answer[]" value="<?php echo $tuple[1]; ?>"
                                                                       placeholder="<?php echo $BIZBOOK['OTHER_INFORMATIONS_PLACEHOLDER_RIGHT']; ?>">
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
                                            <?php /*<div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary">Previous</button>
                                                    </div>*/?>
                                            <div class="col-md-12">
                                                <button type="submit" name="listing_submit" class="btn btn-primary"><?php
                                                    if(isset($_GET['path'])){
                                                        if($_GET['path']=="restore"){
                                                            echo "Restaurar";
                                                        }elseif($_GET['path']=="trash"){
                                                            echo "Borrar permanentemente";
                                                        }

                                                    }else{
                                                        echo "Borrar";
                                                    }
                                                    ?> <?php echo $BIZBOOK['LISTING']; ?></button>
                                            </div>
                                            <div class="col-md-12">
                                                <a href="db-all-listing" class="skip"><?php echo $BIZBOOK['GO_TO_USER_DASHBOARD']; ?> >></a>
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
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/custom.js"></script>
</body>

</html>