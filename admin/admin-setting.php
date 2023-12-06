<?php
include "header.php";
?>

<?php if($admin_row['admin_setting_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst"><?php echo $BIZBOOK['SETTINGS'];?></span>
                 <div class="ud-cen-s2 ud-pro-edit">
                    <h2><?php echo $BIZBOOK['DETAILS'];?></h2>
                     <?php include "../page_level_message.php"; ?>
                     <form name="setting_form" id="setting_form" method="post" enctype="multipart/form-data" action="update_setting.php">
                     <table class="responsive-table bordered">
                        <?php
                            $row_f = getAllFooter();
                            $admin_sql_row = getAllSuperAdmin();?>
                            <input type="hidden" autocomplete="off" name="footer_id"
                                value="<?php echo $row_f['footer_id'];?>" id="footer_id" class="validate">
                            <?php /*<input type="hidden" autocomplete="off" name="admin_password_old"
                                value="<?php echo $admin_sql_row['admin_password'];?>" id="admin_password_old" class="validate">*/?>
                            <input type="hidden" class="validate" id="header_logo_old" name="header_logo_old"
                                value="<?php echo $row_f['header_logo'];?>" required="required">
                            <input type="hidden" class="validate" id="admin_photo_old" name="admin_photo_old"
                                value="<?php echo $admin_sql_row['admin_photo'];?>" required="required">
                            <input type="hidden" class="validate" id="home_page_banner_old" name="home_page_banner_old"
                                value="<?php echo $row_f['home_page_banner'];?>" required="required">
                            <input type="hidden" class="validate" id="home_page_fav_icon_old" name="home_page_fav_icon_old"
                                value="<?php echo $row_f['home_page_fav_icon'];?>" required="required">

                            <tbody>
                            <tr>
                                <td><?php echo $BIZBOOK['WEBSITE_NAME'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="website_address" value="<?php echo $row_f['website_address']; ?>" required="required" class="form-control" placeholder="RN53 Themes">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['ADMIN_EMAIL'];?>:</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="admin_primary_email" class="form-control" placeholder="Email"
                                               value="<?php echo $row_f['admin_primary_email']; ?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['CURRENCY_SYMBOL'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="currency_symbol" required="required" value="<?php echo $row_f['currency_symbol']; ?>"
                                               placeholder="<?php echo $BIZBOOK['TEXT_CURRENCY_SYMBOL'];?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Logo</td>
                                <td>
                                    <div class="form-group">
                                        <input type="file" name="header_logo" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['NAME'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" name="admin_name" value="<?php echo $admin_sql_row['admin_name']; ?>" placeholder="<?php echo $BIZBOOK['NAME'];?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['USER_NAME'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" name="admin_email" value="<?php echo $admin_sql_row['admin_email']; ?>" placeholder="<?php echo $BIZBOOK['USER_NAME'];?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['NEW_PASSWORD'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="admin_password" value="" placeholder="<?php echo $BIZBOOK['ENTER_NEW_PASSWORD'];?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>FavIcon</td>
                                <td>
                                    <div class="form-group">
                                        <input type="file" name="home_page_fav_icon" class="form-control" >
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['SEO_TITLE'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" name="admin_seo_title" value="<?php echo $row_f['admin_seo_title']; ?>" placeholder="<?php echo $BIZBOOK['SEO_TITLE'];?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['SEO_DESCRIPTION'];?></td>
                                <td>
                                    <div class="form-group">
                                        <textarea class="form-control" required="required" name="admin_seo_description"><?php echo $row_f['admin_seo_description']; ?></textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>SEO Keywords</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" name="admin_seo_keywords" value="<?php echo $row_f['admin_seo_keywords']; ?>" placeholder="<?php echo $BIZBOOK['SEO_KEYWORDS'];?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['HOME_PAGE_BANNER'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="file" name="home_page_banner"  class="form-control" >
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['LOGIN_USING_GOOGLE'];?></td>
                                <td>
                                    <div class="form-group">
                                        <select name="admin_google_login" class="form-control" id="admin_google_login">

                                            <option <?php if($row_f['admin_google_login']== 1){ echo "selected"; } ?>
                                                value="1">Active</option>
                                            <option <?php if($row_f['admin_google_login']== 2){ echo "selected"; } ?>
                                                value="2">Inactive</option>

                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['LOGIN_USING_FACEBOOK'];?></td>
                                <td>
                                    <div class="form-group">
                                        <select name="admin_facebook_login" class="form-control" id="admin_facebook_login">

                                            <option <?php if($row_f['admin_facebook_login']== 1){ echo "selected"; } ?>
                                                value="1">Active</option>
                                            <option <?php if($row_f['admin_facebook_login']== 2){ echo "selected"; } ?>
                                                value="2">Inactive</option>

                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>ID Cliente [<?php echo $BIZBOOK['LOGIN_USING_GOOGLE'];?>] </br></br> <a target="_blank" href="https://developers.google.com/identity/sign-in/web/sign-in"><?php echo $BIZBOOK['TO_CREATE_NEW'];?></a></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" name="admin_google_client_id" value="<?php echo $row_f['admin_google_client_id']; ?>" placeholder="<?php echo $BIZBOOK['PASTE_GOOGLE_CLIENT_ID'];?>">
                                    </div>
                                </td>
                            </tr>
                            <?php /*
                            <tr>
                                <td>Client Secret [Login Using Google] </br></br> <a target="_blank" href="https://developers.google.com/identity/sign-in/web/sign-in">To Create New - Click Here</a></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control"  name="admin_google_client_secret" value="<?php //echo $row_f['admin_google_client_secret']; ?>" placeholder="Paste your Google Client Secret">
                                    </div>
                                </td>
                            </tr>*/?>
                            <tr>
                                <td>Id App [<?php echo $BIZBOOK['LOGIN_USING_FACEBOOK'];?>] </br></br> <a target="_blank" href="https://developers.facebook.com/apps/"><?php echo $BIZBOOK['TO_CREATE_NEW'];?></a></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" name="admin_facebook_app_id" value="<?php echo $row_f['admin_facebook_app_id']; ?>" placeholder="<?php echo $BIZBOOK['PASTE_FACEBOOK_APP_ID'];?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['GOOBLE_GEO_MAP_API_KEY'];?> </br></br> <a target="_blank" href="https://developers.google.com/maps/documentation/geocoding/get-api-key"><?php echo $BIZBOOK['TO_CREATE_NEW'];?></a></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" name="admin_geo_map_api" value="<?php echo $row_f['admin_geo_map_api']; ?>" placeholder="<?php echo $BIZBOOK['PASTE_GOOGLE_MAP_API_KEY'];?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['MAP_VIEW_DEFAULT_LATITUDE'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" name="admin_geo_default_latitude" value="<?php echo $row_f['admin_geo_default_latitude']; ?>" placeholder="<?php echo $BIZBOOK['PASTE_MAP_VIEW_DEFAULT_LATITUDE'];?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['MAP_VIEW_DEFAULT_LONGITUDE'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" name="admin_geo_default_longitude" value="<?php echo $row_f['admin_geo_default_longitude']; ?>" placeholder="<?php echo $BIZBOOK['PASTE_MAP_VIEW_DEFAULT_LONGITUDE'];?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['MAP_VIEW_DEFAULT_ZOOM_SIZE'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" name="admin_geo_default_zoom" value="<?php echo $row_f['admin_geo_default_zoom']; ?>" placeholder="<?php echo $BIZBOOK['PASTE_MAP_VIEW_DEFAULT_ZOOM_SIZE'];?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['LANGUAGE'];?></td>
                                <td>
                                    <div class="form-group">
                                        <select name="admin_language" class="form-control" id="admin_language">

                                                <option <?php if($row_f['admin_language']== 1){ echo "selected"; } ?>
                                                    value="1">English</option>
                                            <option <?php if($row_f['admin_language']== 2){ echo "selected"; } ?>
                                                value="2">Arabic</option>

                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['COUNTRIES'];?></td>
                                <td>
                                    <div class="form-group">
                                        <select name="admin_countries[]" multiple class="chosen-select form-control" id="admin_countries">

                                            <?php
                                            foreach (getAllCountries() as $countries_row) {
                                                ?>
                                                <option <?php $counArray = explode(',', $row_f['admin_countries']);
                                                foreach($counArray as $coun_Array){
                                                    if ($countries_row['country_id'] == $coun_Array) {
                                                        echo "selected";
                                                    }
                                                } ?>
                                                    value="<?php echo $countries_row['country_id']; ?>"><?php echo $countries_row['country_name']; ?></option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['PROFILE_PICTURE'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="file" name="admin_photo"  class="form-control" >
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button type="submit" name="setting_submit" class="db-pro-bot-btn"><?php echo $BIZBOOK['SUBMIT'];?></button>
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
<script src="../js/select-opt.js"></script>
    <script src="js/admin-custom.js"></script>

</body>

</html>