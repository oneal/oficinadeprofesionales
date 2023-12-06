<?php
include "header.php";
?>
<?php if($admin_row['admin_sub_admin_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst"><?php echo $BIZBOOK['EDIT_SUB_ADMIN'];?></span>
                <div class="ud-cen-s2 ud-pro-edit">
                    <h2><?php echo $BIZBOOK['EDIT_SUB_ADMIN'];?></h2>
                     <?php include "../page_level_message.php"; ?>
                     <?php
                     $admin_id = $_GET['row'];
                     $row = getAdmin($admin_id);
                     ?>
                    <form name="admin_sub_admin_form" action="update_admin_sub_admin.php" method="post" enctype="multipart/form-data" >
                        <table class="responsive-table bordered">

                            <input type="hidden" class="validate" id="admin_id" name="admin_id" value="<?php echo $row['admin_id']; ?>" required="required"/>
                            <input type="hidden" class="validate" id="admin_photo_old" name="admin_photo_old" value="<?php echo $row['admin_photo']; ?>" required="required"/>
                            <?php /*<input type="hidden" class="validate" id="admin_password_old" name="admin_password_old" value="<?php echo $row['admin_password']; ?>" required="required"/>*/?>

                            <tbody>
                            <tr>
                                <td><?php echo $BIZBOOK['SUB_ADMIN_NAME'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="admin_name" value="<?php echo $row['admin_name']; ?>" required="required" class="form-control" placeholder="Name">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['USER_NAME'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="admin_email" value="<?php echo $row['admin_email']; ?>" required="required" class="form-control" placeholder="Enter user name">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>
                                    <div class="form-group">
                                        <input type="password" name="admin_password" value="" class="form-control" placeholder="Enter password">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['PROFILE_PICTURE'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="file" name="admin_photo" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['CREDENTIALS'];?></td>
                                <td>
                                    <div class="ad-sub-cre">
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_user_options" id="sac1" <?php if($row['admin_user_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac1"><?php echo $BIZBOOK['USER_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_listing_options" id="sac2" <?php if($row['admin_listing_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac2"><?php echo $BIZBOOK['LISTING_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_event_options" id="sac3" <?php if($row['admin_event_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac3"><?php echo $BIZBOOK['EVENT_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_blog_options" id="sac4" <?php if($row['admin_blog_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac4"><?php echo $BIZBOOK['BLOG_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_product_options" id="sac24" <?php if($row['admin_product_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac24"><?php echo $BIZBOOK['PRODUCT_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_category_options" id="sac5" <?php if($row['admin_category_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac5"><?php echo $BIZBOOK['LISTING_CATEGORY_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_product_category_options" id="sac25" <?php if($row['admin_product_category_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac25"><?php echo $BIZBOOK['PRODUCT_CATEGORY_OPTIONS'] ;?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_enquiry_options" id="sac6"  <?php if($row['admin_enquiry_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac6"><?php echo $BIZBOOK['ENQUIRY_QUOTE_OPTIONS'] ;?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_review_options" id="sac7" <?php if($row['admin_review_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac7"><?php echo $BIZBOOK['REVIEW_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_feedback_options" id="sac26" <?php if($row['admin_feedback_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac26"><?php echo $BIZBOOK['FEEDBACK_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_notification_options" id="sac8" <?php if($row['admin_notification_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac8"><?php echo $BIZBOOK['NOTIFICATION_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_ads_options" id="sac9" <?php if($row['admin_ads_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac9"><?php echo $BIZBOOK['ADS_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_home_options" id="sac10" <?php if($row['admin_home_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac10"><?php echo $BIZBOOK['HOME_PAGE_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_country_options" id="sac11" <?php if($row['admin_country_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac11"><?php echo $BIZBOOK['COUNTRY_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_state_options" id="sac30" <?php if($row['admin_state_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac30"><?php echo $BIZBOOK['STATE_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_city_options" id="sac12" <?php if($row['admin_city_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac12"><?php echo $BIZBOOK['CITY_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_listing_filter_options" id="sac22" <?php if($row['admin_listing_filter_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac22"><?php echo $BIZBOOK['LISTING_FILTER_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_invoice_options" id="sac13" <?php if($row['admin_invoice_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac13"><?php echo $BIZBOOK['INVOICE_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_import_options" id="sac14" <?php if($row['admin_import_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac14"><?php echo $BIZBOOK['IMPORT_EXPORT_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_sub_admin_options" id="sac15" <?php if($row['admin_sub_admin_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac15"><?php echo $BIZBOOK['SUB_ADMIN_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_text_options" id="sac16" <?php if($row['admin_text_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac16"><?php echo $BIZBOOK['TEXT_CHANGE_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_listing_price_options" id="sac17" <?php if($row['admin_listing_price_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac17"><?php echo $BIZBOOK['LISTING_PRICE_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_payment_options" id="sac18" <?php if($row['admin_payment_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac18"><?php echo $BIZBOOK['PAYMENT_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_setting_options" id="sac19" <?php if($row['admin_setting_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac19"><?php echo $BIZBOOK['SETTING_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_footer_options" id="sac20" <?php if($row['admin_footer_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac20"><?php echo $BIZBOOK['FOOTER_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_dummy_image_options" id="sac21" <?php if($row['admin_dummy_image_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac21"><?php echo $BIZBOOK['DUMMY_IMAGE_OPTIONS'];?></label>
                                        </div>
                                        <div class="chbox">
                                            <input type="checkbox" name="admin_mail_template_options" id="sac23" <?php if($row['admin_mail_template_options'] == 1){ ?> checked="" <?php }?>>
                                            <label for="sac23"><?php echo $BIZBOOK['MAIL_TEMPLATES_OPTIONS'];?></label>
                                        </div>

                                        <div class="chbox">
                                            <input type="checkbox" name="admin_work_offer_options" id="sac99"  <?php if($row['admin_work_offer_options'] == 1){ ?> checked="" <?php }?>/>
                                            <label for="sac99">Opciones <?php echo $BIZBOOK['WORK_OFFERS'];?></label>
                                        </div>

                                        <div class="chbox">
                                            <input type="checkbox" name="admin_store_options" id="sac100" <?php if($row['admin_store_options'] == 1){ ?> checked="" <?php }?>/>
                                            <label for="sac100">Opciones <?php echo $BIZBOOK['STORES'];?></label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="submit" name="sub_admin_submit" class="db-pro-bot-btn"><?php echo $BIZBOOK['SAVED'];?></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
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
    <script src="js/admin-custom.js"></script> <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>