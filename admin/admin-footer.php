<?php
include "header.php";
?>

<?php if($admin_row['admin_footer_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst"><?php echo $BIZBOOK['FOOTER_CMS'];?></span>
                <div class="ud-cen-s2 ud-pro-edit ad-all-txt-chan">
                    <h2><?php echo $BIZBOOK['FOOTER_CMS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <form name="footer_form" id="footer_form" method="post" enctype="multipart/form-data" action="update_footer.php">

                    <table class="responsive-table bordered">
                        <thead>
                            <tr>
                                <th><?php echo $BIZBOOK['FOOTER_CMS'];?></th>
                                <th><?php echo $BIZBOOK['TEXT'];?></th>
                                <th><?php echo $BIZBOOK['CHANGE'];?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $row_f = getAllFooter();
                            $admin_sql_row = getAllSuperAdmin();
                                ?>
                                <input type="hidden" autocomplete="off" name="footer_id" value="<?php echo $row_f['footer_id']; ?>" id="footer_id" class="validate">
                            <input type="hidden" class="validate" id="header_logo_old" name="header_logo_old"
                                   value="<?php echo $row_f['header_logo']; ?>" required="required">
                            <input type="hidden" class="validate" id="admin_photo_old" name="admin_photo_old"
                                   value="<?php echo $admin_sql_row['admin_photo']; ?>" required="required">
                            <input type="hidden" class="validate" id="home_page_banner_old" name="home_page_banner_old"
                                   value="<?php echo $admin_sql_row['home_page_banner']; ?>" required="required">
                            <input type="hidden" class="validate" id="home_page_fav_icon_old" name="home_page_fav_icon_old"
                                   value="<?php echo $admin_sql_row['home_page_fav_icon']; ?>" required="required">
                                <tr>
                                    <td><?php echo $BIZBOOK['SUPORT'];?></td>
                                    <td><?php echo $BIZBOOK['PHONE'];?>:</td>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <input type="tel" class="form-control" name="footer_mobile" placeholder="<?php echo $BIZBOOK['PHONE'];?>"
                                                   value="<?php echo $row_f['footer_mobile']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['TOP_CATEGORY'];?></td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 1:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="top_category_1" class="form-control" id="top_category_1">
                                                <?php
                                                foreach (getAllCategories() as $row_1){
                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['top_category_1']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 2:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="top_category_2" class="form-control" id="top_category_2">
                                                <?php
                                                foreach (getAllCategories() as $row_1){

                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['top_category_2']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 3:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="top_category_3" class="form-control" id="top_category_3">
                                                <?php
                                                foreach (getAllCategories() as $row_1){

                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['top_category_3']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 4:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="top_category_4" class="form-control" id="top_category_4">
                                                <?php
                                                foreach (getAllCategories() as $row_1){
                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['top_category_4']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 5:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="top_category_5" class="form-control" id="top_category_5">
                                                <?php
                                                foreach (getAllCategories() as $row_1){
                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['top_category_5']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 6:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="top_category_6" class="form-control" id="top_category_6">
                                                <?php
                                                foreach (getAllCategories() as $row_1){
                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['top_category_6']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 7:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="top_category_7" class="form-control" id="top_category_7">
                                                <?php
                                                foreach (getAllCategories() as $row_1){
                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['top_category_7']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 8:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="top_category_8" class="form-control" id="top_category_8">
                                                <?php
                                                foreach (getAllCategories() as $row_1){
                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['top_category_8']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['TREDING_CATEGORY'];?></td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 1:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="trend_category_1" class="form-control" id="trend_category_1">
                                                <?php
                                                foreach (getAllCategories() as $row_1){

                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['trend_category_1']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 2:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="trend_category_2" class="form-control" id="trend_category_2">
                                                <?php
                                                foreach (getAllCategories() as $row_1){

                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['trend_category_2']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 3:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="trend_category_3" class="form-control" id="trend_category_3">
                                                <?php
                                                foreach (getAllCategories() as $row_1){

                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['trend_category_3']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 4:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="trend_category_4" class="form-control" id="trend_category_4">
                                                <?php
                                                foreach (getAllCategories() as $row_1){

                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['trend_category_4']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 5:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="trend_category_5" class="form-control" id="trend_category_5">
                                                <?php
                                                foreach (getAllCategories() as $row_1){

                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['trend_category_5']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 6:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="trend_category_6" class="form-control" id="trend_category_6">
                                                <?php
                                                foreach (getAllCategories() as $row_1){

                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['trend_category_6']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 7:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="trend_category_7" class="form-control" id="trend_category_7">
                                                <?php
                                                foreach (getAllCategories() as $row_1){

                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['trend_category_7']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['CATEGORY'];?> 8:</td>
                                    <td>
                                        <div class="form-group">
                                            <select name="trend_category_8" class="form-control" id="trend_category_8">
                                                <?php
                                                foreach (getAllCategories() as $row_1){

                                                    ?>
                                                    <option <?php if($row_1['category_id']== $row_f['trend_category_8']){ echo "selected"; } ?>
                                                        value="<?php echo $row_1['category_id']; ?>"><?php echo $row_1['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['GET_IN_TOUCH'];?></td>
                                    <td><?php echo $BIZBOOK['ADDRESS'];?>:</td>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="footer_address" value="<?php echo $row_f['footer_address']; ?>" required="required">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['MOBILE_APP'];?></td>
                                    <td>Android:</td>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <input type="text" name="mobile_app_andriod" value="<?php echo $row_f['mobile_app_andriod']; ?>" class="form-control"
                                                   placeholder="<?php echo $BIZBOOK['DOWNLOAD_LINK'];?> Playstore">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Apple:</td>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <input type="text" name="mobile_app_ios" value="<?php echo $row_f['mobile_app_ios']; ?>" class="form-control"
                                                   placeholder="<?php echo $BIZBOOK['DOWNLOAD_LINK'];?> App store">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['SOCIAL_MEDIA'];?></td>
                                    <td>Facebook:</td>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <input type="text" name="footer_fb" value="<?php echo $row_f['footer_fb']; ?>" class="form-control" placeholder="<?php echo $BIZBOOK['PROFILE_LINK'];?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Twitter:</td>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="footer_twitter" value="<?php echo $row_f['footer_twitter']; ?>" placeholder="<?php echo $BIZBOOK['PROFILE_LINK'];?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Linkedin:</td>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="footer_linked_in" value="<?php echo $row_f['footer_linked_in']; ?>" placeholder="<?php echo $BIZBOOK['PROFILE_LINK'];?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Instagram:</td>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="footer_instagram" value="<?php echo $row_f['footer_instagram']; ?>" placeholder="<?php echo $BIZBOOK['PROFILE_LINK'];?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Youtube:</td>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="footer_youtube" value="<?php echo $row_f['footer_youtube']; ?>" placeholder="<?php echo $BIZBOOK['PROFILE_LINK'];?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>WhatsApp:</td>
                                    <td colspan="3">
                                        <div class="form-group">
                                            <input type="text" name="footer_whatsapp" value="<?php echo $row_f['footer_whatsapp']; ?>" class="form-control"
                                                   placeholder="<?php echo $BIZBOOK['WHATSAPP_MOBILE_NUMBER'];?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['HELP_&_SUPORT'];?></td>
                                    <td><?php echo $BIZBOOK['PAGE_NAME'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" name="footer_page_name_1" placeholder="<?php echo $BIZBOOK['PAGE_NAME'];?>" value="<?php echo $row_f['footer_page_name_1']; ?>">
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['PAGE_LINK'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['PAGE_FULL_URL'];?>"
                                                   name="footer_page_url_1" value="<?php echo $row_f['footer_page_url_1']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['PAGE_NAME'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" name="footer_page_name_2" placeholder="<?php echo $BIZBOOK['PAGE_NAME'];?>" value="<?php echo $row_f['footer_page_name_2']; ?>">
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['PAGE_LINK'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['PAGE_FULL_URL'];?>"
                                                   name="footer_page_url_2" value="<?php echo $row_f['footer_page_url_2']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['PAGE_NAME'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" name="footer_page_name_3" placeholder="<?php echo $BIZBOOK['PAGE_NAME'];?>" value="<?php echo $row_f['footer_page_name_3']; ?>">
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['PAGE_LINK'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['PAGE_FULL_URL'];?>"
                                                   name="footer_page_url_3" value="<?php echo $row_f['footer_page_url_3']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['PAGE_NAME'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" name="footer_page_name_4" placeholder="<?php echo $BIZBOOK['PAGE_NAME'];?>" value="<?php echo $row_f['footer_page_name_4']; ?>">
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['PAGE_LINK'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['PAGE_FULL_URL'];?>"
                                                   name="footer_page_url_4" value="<?php echo $row_f['footer_page_url_4']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Other countries</td>
                                    <td><?php echo $BIZBOOK['COUNTRY_NAME'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['COUNTRY_NAME'];?>" name="footer_country_name_1" value="<?php echo $row_f['footer_country_name_1']; ?>">
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['COUNTRY_URL'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['COUNTRY_PAGE_FULL_URL'];?>"
                                                   name="footer_country_url_1" value="<?php echo $row_f['footer_country_url_1']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['COUNTRY_NAME'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['COUNTRY_NAME'];?>" name="footer_country_name_2" value="<?php echo $row_f['footer_country_name_2']; ?>">
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['COUNTRY_URL'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['COUNTRY_PAGE_FULL_URL'];?>"
                                                   name="footer_country_url_2" value="<?php echo $row_f['footer_country_url_2']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['COUNTRY_NAME'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['COUNTRY_NAME'];?>" name="footer_country_name_3" value="<?php echo $row_f['footer_country_name_3']; ?>">
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['COUNTRY_URL'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['COUNTRY_PAGE_FULL_URL'];?>"
                                                   name="footer_country_url_3" value="<?php echo $row_f['footer_country_url_3']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['COUNTRY_NAME'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['COUNTRY_NAME'];?>" name="footer_country_name_4" value="<?php echo $row_f['footer_country_name_4']; ?>">
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['COUNTRY_URL'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['COUNTRY_PAGE_FULL_URL'];?>"
                                                   name="footer_country_url_4" value="<?php echo $row_f['footer_country_url_4']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['COUNTRY_NAME'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['COUNTRY_NAME'];?>" name="footer_country_name_5" value="<?php echo $row_f['footer_country_name_5']; ?>">
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['COUNTRY_URL'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['COUNTRY_PAGE_FULL_URL'];?>"
                                                   name="footer_country_url_5" value="<?php echo $row_f['footer_country_url_5']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['COUNTRY_NAME'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['COUNTRY_NAME'];?>" name="footer_country_name_6" value="<?php echo $row_f['footer_country_name_6']; ?>">
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['COUNTRY_URL'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['COUNTRY_PAGE_FULL_URL'];?>"
                                                   name="footer_country_url_6" value="<?php echo $row_f['footer_country_url_6']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $BIZBOOK['COUNTRY_NAME'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['COUNTRY_NAME'];?>" name="footer_country_name_7" value="<?php echo $row_f['footer_country_name_7']; ?>">
                                        </div>
                                    </td>
                                    <td><?php echo $BIZBOOK['COUNTRY_URL'];?>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="<?php echo $BIZBOOK['COUNTRY_PAGE_FULL_URL'];?>"
                                                   name="footer_country_url_7" value="<?php echo $row_f['footer_country_url_7']; ?>">
                                        </div>
                                    </td>
                                </tr>
                            <tr>
                            <td><?php echo $BIZBOOK['COPYRIGHT'];?></td>
                                <td><?php echo $BIZBOOK['COPYRIGHT_YEAR'];?></td>
                                <td colspan="3">
                                    <div class="form-group">
                                        <input type="text" name="copyright_year" value="<?php echo $row_f['copyright_year']; ?>" class="form-control"
                                               placeholder="2017-2020">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><?php echo $BIZBOOK['COPYRIGHT_WEBSITE'];?></td>
                                <td colspan="3">
                                    <div class="form-group">
                                        <input type="text" name="copyright_website" value="<?php echo $row_f['copyright_website']; ?>" class="form-control"
                                               placeholder="RN53 Themes">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><?php echo $BIZBOOK['COPYRIGHT_WEBSITE_LINK'];?></td>
                                <td colspan="3">
                                    <div class="form-group">
                                        <input type="text" name="copyright_website_link" value="<?php echo $row_f['copyright_website_link']; ?>" class="form-control"
                                               placeholder="i.e https://google.com">
                                    </div>
                                </td>
                            </tr>

                                <tr>
                                    <td>
                                        <button type="submit" name="footer_submit" class="db-pro-bot-btn"><?php echo $BIZBOOK['SAVED'];?></button>
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