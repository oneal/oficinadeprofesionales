<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

include "dashboard_left_pane.php";
?>
<!--CENTER SECTION-->
<div class="ud-cen">
    <div class="log-bor">&nbsp;</div>
    <span class="udb-inst"><?php echo $BIZBOOK['USER_PROFILE']; ?></span>
    <?php
    if ($user_details_row['user_status'] == 'Inactive') {
        ?>
        <div class="log-error use-act-err"><p><?php echo $BIZBOOK['IMPORTANT_PROFILE']; ?>.</p></div>
        <?php
    }
    ?>
    <div class="ud-cen-s2">
        <h2><?php echo $BIZBOOK['PROFILE_DETAILS']; ?></h2>
        <?php include "page_level_message.php"; ?>
        <a href="db-my-profile-edit" class="db-tit-btn"><?php echo $BIZBOOK['EDIT_MY_PROFILE']; ?></a>
        <?php /*<a href="db-payment" class="db-tit-btn db-tit-btn-1"><?php //echo $BIZBOOK['UPGRADE'];  ?></a>*/?>
        <?php
        $user_details_row = getUser($_SESSION['user_id']);
        ?>
        <table class="responsive-table bordered">
            <tbody>
                <?php /*
                                <tr>
                                    <td><?php //echo $BIZBOOK['PROFILE_EXPIRY_LISTING_EXP'];  ?></td>
									<td>8 June 2025</td>
                								</tr>
                 */?>
                <tr>
                    <td><?php echo $BIZBOOK['NAME_BUSSINESS']; ?></td>
                    <td><?php echo $user_details_row['first_name']; ?></td>
                </tr>
                <?php /*<tr>
                    <td><?php echo $BIZBOOK['LAST_NAME']; ?></td>
                    <td><?php echo $user_details_row['last_name']; ?></td>
                </tr>*/?>
                <tr>
                    <td><?php echo $BIZBOOK['CIF_NIF']; ?></td>
                    <td><?php echo $user_details_row['cif_nif']; ?></td>
                </tr>
                <tr>
                    <td><?php echo $BIZBOOK['EMAIL_ID']; ?></td>
                    <td><?php echo $user_details_row['email_id']; ?></td>
                </tr>
                <tr>
                    <td><?php echo $BIZBOOK['PROFILE_PASSWORD']; ?></td>
                    <td><?php echo "*********" ?></td>
                </tr>
                <tr>
                    <td><?php echo $BIZBOOK['MOBILE_NUMBER']; ?></td>
                    <td><?php echo $user_details_row['mobile_number']; ?></td>
                </tr>
                <tr>
                    <td><?php echo $BIZBOOK['PROFILE_PICTURE']; ?></td>
                    <td><img src="images/user/<?php if (($user_details_row['profile_image'] == NULL) || empty($user_details_row['profile_image'])) {
                            echo "1.jpg";
                        } else {
                            echo $user_details_row['profile_image'];
                        } ?>" title="<?php echo $user_details_row['first_name']; ?>" alt="<?php echo $user_details_row['first_name']; ?>">
                    </td>
                </tr>
                <tr>
                    <td><?php echo $BIZBOOK['ADDRESS']; ?></td>
                    <td><?php if ($user_details_row['user_address'] == NULL) {
                            echo "N/A";
                        } else {
                            echo $user_details_row['user_address'];
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $BIZBOOK['CITY']; ?></td>
                    <td><?php if ($user_details_row['user_state'] == NULL) {
                            echo "N/A";
                        } else {
                            echo $user_details_row['user_state'];
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td>Población</td>
                    <td><?php if ($user_details_row['user_city'] == NULL) {
                            echo "N/A";
                        } else {
                            echo $user_details_row['user_city'];
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $BIZBOOK['ZIP_CODE']; ?></td>
                    <td><?php if ($user_details_row['user_zip_code'] == NULL) {
                            echo "N/A";
                        } else {
                            echo $user_details_row['user_zip_code'];
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $BIZBOOK['JOIN_DATE']; ?></td>
                    <td><?php echo dateFormatconverter($user_details_row['user_cdt']); ?></td>
                </tr>
                <?php /*
                                <tr>
                                    <td><?php //echo $BIZBOOK['VERIFIED'];  ?></td>
									<td><?php //if($user_details_row['user_status']== "Active"){ echo "Yes";}else {echo "No";}  ?></td>
                								</tr>
                                                <tr>
                                                    <td><?php //echo $BIZBOOK['PREMIUM_SERVICE_PROVIDER'];  ?></td>
                									<td><?php //if($user_details_row['user_type']== "Service provider"){ echo "Yes";}else {echo "No";}  ?></td>
                								</tr>
                 */?>
                <tr>
                    <td><?php echo $BIZBOOK['PROFILE_LINK']; ?></td>
                    <td><a href="<?php echo $webpage_full_link; ?>profesional/<?php echo $user_details_row['user_slug']; ?>" target="_blank"><?php echo $webpage_full_link; ?>profesional/<?php echo $user_details_row['user_slug']; ?></a></td>
                </tr>
                <tr>
                    <td><?php echo $BIZBOOK['FACEBOOK']; ?></td>
                    <td><?php echo $user_details_row['user_facebook']; ?></td>
                </tr>
                <tr>
                    <td><?php echo $BIZBOOK['TWITTER']; ?></td>
                    <td><?php echo $user_details_row['user_twitter']; ?></td>
                </tr>
                <tr>
                    <td>Linkedin</td>
                    <td><?php echo $user_details_row['user_linkedin']; ?></td>
                </tr>
                <tr>
                    <td>Instagram</td>
                    <td><?php echo $user_details_row['user_instagram']; ?></td>
                </tr>
                <tr>
                    <td>Whatsapp</td>
                    <td><?php echo $user_details_row['user_whatsapp']; ?></td>
                </tr>
                <tr>
                    <td><?php echo $BIZBOOK['USER_WEBSITE']; ?></td>
                    <td><?php echo $user_details_row['user_website']; ?></td>
                </tr>
                <tr>
                    <td>
                        <a href="db-my-profile-edit" class="db-pro-bot-btn"><?php echo $BIZBOOK['EDIT_MY_PROFILE']; ?></a>
                        <?php /*<a href="db-payment" class="db-pro-bot-btn"><?php echo $BIZBOOK['UPGRADE']; ?></a>*/?>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
include "dashboard_right_pane.php";
?>
