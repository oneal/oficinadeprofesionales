<?php
include "header.php";
?>

<?php
if ($admin_row['admin_sub_admin_options'] != 1) {
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['ADD_NEW_SUB_ADMINS'];?></span>
                <div class="ud-cen-s2 ud-pro-edit">
                    <h2><?php echo $BIZBOOK['ADD_NEW_SUB_ADMINS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <form name="admin_sub_admin_form" action="insert_admin_sub_admin.php" method="post" enctype="multipart/form-data">
                        <table class="responsive-table bordered">
                            <tbody>
                        

                            <tr>
                                <td><?php echo $BIZBOOK['SUB_ADMIN_NAME'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="admin_name" required="required" class="form-control" placeholder="Name">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['USER_NAME'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="admin_email" required="required" class="form-control" placeholder="Enter user name">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>
                                    <div class="form-group">
                                        <input type="password" name="admin_password" required="required" class="form-control" placeholder="Enter password">
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
                                                    <input type="checkbox" name="admin_user_options" id="sac1" checked=""/>
                                                    <label for="sac1"><?php echo $BIZBOOK['USER_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_listing_options" id="sac2" checked=""/>
                                                    <label for="sac2"><?php echo $BIZBOOK['LISTING_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_event_options" id="sac3" checked=""/>
                                                    <label for="sac3"><?php echo $BIZBOOK['EVENT_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_blog_options" id="sac4" checked=""/>
                                                    <label for="sac4"><?php echo $BIZBOOK['BLOG_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_product_options" id="sac24" checked=""/>
                                                    <label for="sac24"><?php echo $BIZBOOK['PRODUCT_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_category_options" id="sac5" checked=""/>
                                                    <label for="sac5"><?php echo $BIZBOOK['LISTING_CATEGORY_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_product_category_options" id="sac25" checked=""/>
                                                    <label for="sac25"><?php echo $BIZBOOK['PRODUCT_CATEGORY_OPTIONS'] ;?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_enquiry_options" id="sac6"  checked=""/>
                                                    <label for="sac6"><?php echo $BIZBOOK['ENQUIRY_QUOTE_OPTIONS'] ;?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_review_options" id="sac7" checked=""/>
                                                    <label for="sac7"><?php echo $BIZBOOK['REVIEW_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_feedback_options" id="sac26" checked=""/>
                                                    <label for="sac26"><?php echo $BIZBOOK['FEEDBACK_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_notification_options" id="sac8" checked=""/>
                                                    <label for="sac8"><?php echo $BIZBOOK['NOTIFICATION_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_ads_options" id="sac9" checked=""/>
                                                    <label for="sac9"><?php echo $BIZBOOK['ADS_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_home_options" id="sac10" checked=""/>
                                                    <label for="sac10"><?php echo $BIZBOOK['HOME_PAGE_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_country_options" id="sac11" checked=""/>
                                                    <label for="sac11"><?php echo $BIZBOOK['COUNTRY_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_state_options" id="sac30" checked=""/>
                                                    <label for="sac30"><?php echo $BIZBOOK['STATE_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_city_options" id="sac12" checked=""/>
                                                    <label for="sac12"><?php echo $BIZBOOK['CITY_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_listing_filter_options" id="sac22" checked=""/>
                                                    <label for="sac22"><?php echo $BIZBOOK['LISTING_FILTER_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_invoice_options" id="sac13" checked=""/>
                                                    <label for="sac13"><?php echo $BIZBOOK['INVOICE_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_import_options" id="sac14" checked=""/>
                                                    <label for="sac14"><?php echo $BIZBOOK['IMPORT_EXPORT_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_sub_admin_options" id="sac15" checked=""/>
                                                    <label for="sac15"><?php echo $BIZBOOK['SUB_ADMIN_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_text_options" id="sac16" checked=""/>
                                                    <label for="sac16"><?php echo $BIZBOOK['TEXT_CHANGE_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_listing_price_options" id="sac17" checked=""/>
                                                    <label for="sac17"><?php echo $BIZBOOK['LISTING_PRICE_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_payment_options" id="sac18" checked=""/>
                                                    <label for="sac18"><?php echo $BIZBOOK['PAYMENT_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_setting_options" id="sac19" checked=""/>
                                                    <label for="sac19"><?php echo $BIZBOOK['SETTING_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_footer_options" id="sac20" checked=""/>
                                                    <label for="sac20"><?php echo $BIZBOOK['FOOTER_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_dummy_image_options" id="sac21" checked=""/>
                                                    <label for="sac21"><?php echo $BIZBOOK['DUMMY_IMAGE_OPTIONS'];?></label>
                                                </div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_mail_template_options" id="sac23" checked=""/>
                                                    <label for="sac23"><?php echo $BIZBOOK['MAIL_TEMPLATES_OPTIONS'];?></label>
                                                </div>

                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_work_offer_options" id="sac99" checked=""/>
                                                    <label for="sac99">Opciones <?php echo $BIZBOOK['WORK_OFFERS'];?></label>
                                                </div>

                                                <div class="chbox">
                                                    <input type="checkbox" name="admin_store_options" id="sac100" checked=""/>
                                                    <label for="sac100">Opciones <?php echo $BIZBOOK['STORES'];?></label>
                                                </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="submit" name="sub_admin_submit" class="db-pro-bot-btn"><?php echo $BIZBOOK['ADD_USER'];?></button>
                                </td>
                                <td></td>
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