<?php

include "header.php";
?>

<?php if($admin_row['admin_listing_options'] != 1){
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="login-reg">
                <div class="container">
                    <?php
                    $listing_codea = $_GET['code'];
                    $listings_a_row = getListing($listing_codea);

                    ?>
                    <form action="update_listing.php" class="listing_form" id="listing_form"
                          name="listing_form" method="post" enctype="multipart/form-data">
                        
                        <input type="hidden" id="listing_codea" value="<?php echo $listing_codea; ?>"
                               name="listing_codea" class="validate">
                        <input type="hidden" id="listing_id" value="<?php echo $listings_a_row['listing_id']; ?>"
                               name="listing_id" class="validate">
                        <input type="hidden" id="listing_code" value="<?php echo $listings_a_row['listing_code']; ?>"
                               name="listing_code" class="validate">
                        
                        <input type="hidden" id="gallery_image_old"
                               value="<?php echo $listings_a_row['gallery_image']; ?>" name="gallery_image_old"
                               class="validate">
                        <input type="hidden" id="service_image_old"
                               value="<?php echo $listings_a_row['service_image']; ?>" name="service_image_old"
                               class="validate">
                        <input type="hidden" id="service_1_image_old"
                               value="<?php echo $listings_a_row['service_1_image']; ?>" name="service_1_image_old"
                               class="validate">
                        <?php /*
                        <input type="hidden" id="service_2_image_old"
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
                                                    <option value="" disabled ><?php echo $BIZBOOK['USER_NAME'];?></option>
                                                    <?php
                                                    foreach (getAllUserListingAdmin() as $ad_users_row) {
                                                        ?>
                                                        <option <?php if ($listings_a_row['user_id'] == $ad_users_row['user_id']) {
                                                            echo "selected";
                                                        } ?>
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
                                                <input id="listing_name" name="listing_name" type="text" required="required"
                                                       value="<?php echo $listings_a_row['listing_name']; ?>"
                                                       class="form-control" placeholder="<?php echo $BIZBOOK['LISTING_NAME_STAR'];?> *">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <?php /*<!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input id="listing_mobile" name="listing_mobile" type="text"
                                                       value="<?php echo $listings_a_row['listing_mobile']; ?>" class="form-control" placeholder="<?php echo $BIZBOOK['PHONE'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input id="listing_email" name="listing_email" type="text"
                                                       value="<?php echo $listings_a_row['listing_email']; ?>" class="form-control" placeholder="<?php echo $BIZBOOK['EMAIL'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->*/?>
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input id="listing_website" name="listing_website" type="text"
                                                       value="<?php echo $listings_a_row['listing_website']; ?>" class="form-control"
                                                       placeholder="<?php echo $BIZBOOK['WEBSITE'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" id="listing_address" name="listing_address" required="required"
                                                       value="<?php echo $listings_a_row['listing_address']; ?>"
                                                       class="form-control" placeholder="<?php echo $BIZBOOK['ADDRESS'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->

                                    <?php /*<!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="listing_lat" class="form-control"
                                                       value="<?php echo $listings_a_row['listing_lat']; ?>"
                                                       placeholder="<?php echo $BIZBOOK['LATITUDE_PLACEHOLDER'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="listing_lng" class="form-control"
                                                       value="<?php echo $listings_a_row['listing_lng']; ?>"
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
                                                    //States 
                                                    foreach (getAllStates(1) as $state_row) { ?>
                                                            <option <?php if ($listings_a_row['state_id'] == $state_row['state_id']) {
                                                                echo "selected";
                                                            } ?>
                                                                value="<?php echo $state_row['state_id']; ?>"><?php echo $state_row['state_name']; ?></option>
                                                            <?php
                                                    }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select data-placeholder="<?php echo $BIZBOOK['SELECT_YOUR_CITY'];?>" name="city_id" id="city_id"
                                                        required="required" class="form-control">
                                                    <option value=""><?php echo $BIZBOOK['SELECT_YOUR_CITY'];?></option>
                                                    <?php
                                                    foreach (getAllCitiesIdState($listings_a_row['state_id']) as $city_row) {
                                                        ?>
                                                        <option <?php if ($listings_a_row['city_id'] == $city_row['city_id']) {
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
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select <?php /*onChange="getSubCategory(this.value);"*/?> name="category_id" id="category_id" class="form-control">
                                                    <option value=""><?php echo $BIZBOOK['SELECT_YOUR_CATEGORY'];?></option>
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

                                    <!--FILED START-->
                                    <?php /*<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="sub_category_id[]" id="sub_category_id" multiple class="chosen-select form-control">
                                                    <?php /*<option <?php //if($listings_a_row['sub_category_id'] == NULL){ echo "selected";} ?> value="">Select Sub Category</option>
                                                    <?php
                                                    //                                            $sub_categories_row =  getCategorySubCategories($listings_a_row['category_id']);
                                                    foreach (getCategorySubCategories($listings_a_row['category_id']) as $sub_categories_row) {
                                                        ?>
                                                        <option  <?php $catArray = explode(',', $listings_a_row['sub_category_id']);
                                                        foreach($catArray as $cat_Array){
                                                            if ($sub_categories_row['sub_category_id'] == $cat_Array) {
                                                                echo "selected";

                                                            }

                                                        } ?>
                                                            value="<?php echo $sub_categories_row['sub_category_id']; ?>"><?php echo $sub_categories_row['sub_category_name']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>*/?>
                                    <!--FILED END-->
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
                                                          name="listing_description" placeholder="<?php echo $BIZBOOK['DETAILS'];?>"><?php echo $listings_a_row['listing_description']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    
                        
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $BIZBOOK['CHOOSE_IMAGE_FIRST'];?></label>
                                                <?php if($listings_a_row['profile_image']!=""){?>
                                                    <img src="../images/listings/<?php echo $listings_a_row['profile_image'];?>" style="max-width: 120px"/>
                                                    <input type="hidden" id="profile_image_old"
                                                        value="<?php echo $listings_a_row['profile_image']; ?>" name="profile_image_old"
                                                        class="validate">
                                                <?php }?>
                                                <input type="file"  name="profile_image" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $BIZBOOK['CHOOSE_BACKGROUND_IMAGE']; ?></label>
                                                <?php if($listings_a_row['cover_image']!=""){?>
                                                    <img src="../images/listing-ban/<?php echo $listings_a_row['cover_image'];?>" style="max-width: 120px"/>
                                                    <input type="hidden" id="cover_image_old"
                                                           value="<?php echo $listings_a_row['cover_image']; ?>" name="cover_image_old"
                                                           class="validate">
                                                <?php }?>
                                                <input type="file"  name="cover_image" class="form-control">
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

                                    <h4><?php echo $BIZBOOK['SERVICE_PROVIDE'];?></h4>
                                    <span class="add-list-add-btn lis-ser-add-btn" title="<?php echo $BIZBOOK['ADD_NEW_SERVICE'];?>">+</span>
                                    <span class="add-list-rem-btn lis-ser-rem-btn" title="<?php echo $BIZBOOK['DEL_SERVICE'];?>">-</span>
                                    
                                        <ul>
                                            <?php
                                            $listings_a_row_service_id=$listings_a_row['service_id'];
                                            
                                            $serArray = explode('|', $listings_a_row_service_id);
                                            $img = explode(',', $listings_a_row['service_image']);
                                            
                                            foreach($serArray as $k => $service_Array){
                                                
                                             ?>
                                            <li class="item-service">
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $BIZBOOK['SERVICE_NAME'];?>:</label>
                                                            <input type="text" name="service_id[]" value="<?php echo $service_Array; ?>" class="form-control"
                                                                   placeholder="<?php echo $BIZBOOK['SERVICE_NAME_PLACEHOLDER'];?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $BIZBOOK['IMAGE'];?></label><br/>
                                                            <?php if(!empty($img[$k])){?>
                                                                <img src="../images/services/<?php echo $img[$k];?>" style="max-width: 120px"/>
                                                                <input type="hidden" name="service_img_old_hidden[]" value="<?php echo $img[$k];?>"/>
                                                            <?php }?>
                                                            <input type="file" name="service_image[]" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                            </li>
                                            <?php
                                            }
                                            ?>
                                            <?php /*
                                            <li>
                                                <!--FILED START-->
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
                                                <!--FILED END-->
                                            </li>
                                             * 
                                             */?>
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
                                            <?php
                                            $listings_a_row_service_1_name = $listings_a_row['service_1_name'];
                                            $listings_a_row_service_1_price = $listings_a_row['service_1_price'];
                                            $listings_a_row_service_1_detail = $listings_a_row['service_1_detail'];
                                            $listings_a_row_service_1_view_more = $listings_a_row['service_1_view_more'];
                                            $listings_a_row_service_1_image = $listings_a_row['service_1_image'];

                                            $ser_1_name_Array = explode('|', $listings_a_row_service_1_name);
                                            $ser_1_price_Array = explode('|', $listings_a_row_service_1_price);
                                            $ser_1_detail_Array = explode('|', $listings_a_row_service_1_detail);
                                            $ser_1_view_more_Array = explode('|', $listings_a_row_service_1_view_more);
                                            $ser_1_img_Array = explode(',', $listings_a_row_service_1_image);

                                            $zipped = array_map(null, $ser_1_name_Array, $ser_1_price_Array, $ser_1_detail_Array, $ser_1_view_more_Array,$ser_1_img_Array);
                                            //die(var_dump($zipped));
                                            foreach($zipped as $tuple) {
                                                 $tuple[0]; // offer name
                                                 $tuple[1]; // offer Price
                                                 $tuple[2]; // offer Detail
                                                 $tuple[3]; // offer View more
                                                 $tuple[4]; // offer image

                                                ?>
                                                <li class="item-offer">
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control"
                                                                     value="<?php echo $tuple[0]; ?>"  name="service_1_name[]" placeholder="<?php echo $BIZBOOK['OFFER_NAME'];?> *">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="number" class="form-control"
                                                                       value="<?php echo $tuple[1]; ?>" name="service_1_price[]" 
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
                                                                       placeholder="<?php echo $BIZBOOK['DETAILS'];?>"><?php echo $tuple[2]; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                    <!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label><?php echo $BIZBOOK['CHOOSE_OFFER_IMAGE'];?></label><br/>
                                                                <?php if(!empty($tuple[4])){?>
                                                                    <img src="../images/services/<?php echo $tuple[4];?>" style="max-width: 120px"/>
                                                                    <input type="hidden" name="service_1_img_old_hidden[]" value="<?php echo $tuple[4];?>"/>
                                                                <?php }?>
                                                                <input type="file" name="service_1_image[]" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FILED END-->
                                                    <?php /*<!--FILED START-->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control"
                                                                       value="<?php echo $tuple[3]; ?>" name="service_1_view_more[]"  placeholder="<?php echo $BIZBOOK['VIEW_MORE_LINK'];?>">
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
                            <span class="steps"><?php echo $BIZBOOK['STEP4'];?></span>
                            <div class="log add-list-map">
                                <div class="login add-list-map">
                                    <h4><?php echo $BIZBOOK['VIDEO_GALLERY'];?></h4>
                                    <ul>
                                        <span class="add-list-add-btn lis-add-oadvideo" title="<?php echo $BIZBOOK['ADD_NEW_VIDEO'];?>">+</span>
                                        <span class="add-list-rem-btn lis-add-orevideo" title="<?php echo $BIZBOOK['DEL_VIDEO'];?>">-</span>
                                        <?php
                                        $listings_a_row_listing_video = $listings_a_row['listing_video'];

                                        $listings_a_row_listing_videoArray = explode('|', $listings_a_row_listing_video);

                                        foreach ($listings_a_row_listing_videoArray as $tuple) {
                                            ?>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                        <textarea id="listing_video" name="listing_video[]"
                                                                  class="form-control"
                                                                  placeholder="<?php echo $BIZBOOK['PASTE_IFRAME_CODE'];?>"><?php echo $tuple; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                        ?>

                                    </ul>
                                        <h4><?php echo $BIZBOOK['MAP_360_VIEW'];?></h4>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="google_map"
                                                              placeholder="<?php echo $BIZBOOK['IFRAME_GOOGLE_MAP'];?>"><?php echo $listings_a_row['google_map']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="360_view" placeholder="<?php echo $BIZBOOK['360_VIEW'];?>"><?php echo $listings_a_row['360_view']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->

                                        <h4 class="pt30"><?php echo $BIZBOOK['PHOTO_GALLERY'];?></h4>
                                        <!--FILED START-->
                                        <div class="row">
                                            <?php $gallery_image = explode(',',$listings_a_row['gallery_image']);?>
                                            <?php for($i=0; $i<6; $i++){?>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php if(!empty($gallery_image[$i])){?>
                                                            <img src="../images/listings/<?php echo $gallery_image[$i];?>" style="max-width: 120px"/>
                                                            <input type="hidden" name="gallery_image_old_hidden[]" value="<?php echo $gallery_image[$i];?>"/>
                                                        <?php }?>
                                                        <input type="file" name="gallery_image[]" class="form-control">
                                                    </div>
                                                </div>
                                            <?php }?>
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
                                            <?php
                                            $listings_a_row_listing_info_question = $listings_a_row['listing_info_question'];
                                            $listings_a_row_listing_info_answer = $listings_a_row['listing_info_answer'];

                                            $listings_a_row_listing_info_question_Array = explode('|', $listings_a_row_listing_info_question);
                                            $listings_a_row_listing_info_answer_Array = explode('|', $listings_a_row_listing_info_answer);

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
                                                                <input type="text" class="form-control"
                                                                       name="listing_info_question[]" value="<?php echo $tuple[0]; ?>"
                                                                       placeholder="<?php echo $BIZBOOK['OTHER_INFORMATIONS_PLACEHOLDER_LEFT'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <i class="material-icons">arrow_forward</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control"
                                                                       name="listing_info_answer[]" value="<?php echo $tuple[1]; ?>"
                                                                       placeholder="<?php echo $BIZBOOK['OTHER_INFORMATIONS_PLACEHOLDER_RIGHT'];?>">
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
                                            <?php /*
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary">Previous</button>
                                            </div>*/?>
                                            <div class="col-md-12">
                                                <button type="submit" name="listing_submit" class="btn btn-primary"><?php echo $BIZBOOK['UPDATE_AND_SUBMIT'];?></button>
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
<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('listing_description');
</script>
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