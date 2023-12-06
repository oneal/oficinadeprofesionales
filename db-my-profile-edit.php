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
				<span class="udb-inst"><?php echo $BIZBOOK['EDIT_USER_PROFILE']; ?></span>
                <?php
                if ($user_details_row['user_status'] == 'Inactive') {
                    ?>
                    <div class="log-error"><p><?php echo $BIZBOOK['IMPORTANT_PROFILE'];?>.</p></div>
                    <?php
                }
                ?>
                <div class="ud-cen-s2 ud-pro-edit">
                    <h2><?php echo $BIZBOOK['PROFILE_DETAILS']; ?></h2>
                    <?php include "page_level_message.php"; ?>
                    <?php
                    $user_details_row = getUser($_SESSION['user_id']);
                    ?>
                    <form id="profile_update" name="profile_update" action="profile_update.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo $user_details_row['profile_image']; ?>" autocomplete="off" name="profile_image_old" id="profile_image_old" required class="validate">
                        <?php /*<input type="hidden" value="<?php echo $user_details_row['password']; ?>" autocomplete="off" name="password_old" id="password_old" required class="validate">*/?>
                        <table class="responsive-table bordered">
							<tbody>
                                <?php /*
                                    <tr>
                                        <td><?php //echo $BIZBOOK['PROFILE_EXPIRY_LISTING_EXP']; ?></td>
                                        <td>8 June 2025</td>
                                    </tr>*/?>
                                <tr>
                                    <td><?php echo $BIZBOOK['NAME_BUSSINESS']; ?></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $user_details_row['first_name']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <?php /*<tr>
                                <td><?php echo $BIZBOOK['LAST_NAME']; ?></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $user_details_row['last_name']; ?>">
                                        </div>
                                    </td>
                                </tr>*/?>
                                <tr>
                                    <td><?php echo $BIZBOOK['CIF_NIF']; ?></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="cif_nif" name="cif_nif" class="form-control" value="<?php echo $user_details_row['cif_nif']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['EMAIL_ID']; ?></td>
                                    <td>
                                        <div class="form-group">
                                          <input type="email" class="form-control" name="email_id" placeholder="<?php echo $BIZBOOK['EMAIL']; ?>" value="<?php echo $user_details_row['email_id']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['PROFILE_PASSWORD']; ?></td>
                                    <td>
                                        <div class="form-group">
                                          <input type="text" class="form-control" name="password" placeholder="<?php echo $BIZBOOK['CHANGE_PASSWORD']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['MOBILE_NUMBER']; ?></td>
                                    <td>
                                        <div class="form-group">
                                          <input type="number" name="mobile_number" class="form-control" value="<?php echo $user_details_row['mobile_number']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['PROFILE_PICTURE']; ?></td>
                                    <td>
                                        <div class="form-group">
                                          <input type="file" name="profile_image" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['ADDRESS'];?></td>
                                    <td>
                                        <div class="form-group">
                                          <input type="text" id="user_address" class="form-control"
                                                 name="user_address" value="<?php echo $user_details_row['user_address'];?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['CITY'];?></td>
                                    <td>
                                        <div class="form-group">
                                          <input type="text" id="user_state" class="form-control"
                                                 name="user_state" value="<?php echo $user_details_row['user_state'];?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Población</td>
                                    <td>
                                        <div class="form-group">
                                          <input type="text" id="user_city" class="form-control"
                                                 name="user_city" value="<?php echo $user_details_row['user_city']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['ZIP_CODE'];?></td>
                                    <td>
                                        <div class="form-group">
                                          <input type="text" id="user_zip_code" class="form-control"
                                                 name="user_zip_code" value="<?php echo $user_details_row['user_zip_code'];?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['JOIN_DATE']; ?></td>
                                    <td><?php  echo dateFormatconverter($user_details_row['user_cdt']); ?></td>
                                </tr>
                                <?php /*<tr>
                                    <td><?php //echo $BIZBOOK['VERIFIED']; ?></td>
									<td><?php //if($user_details_row['user_status']== "Active"){ echo "Yes";}else {echo "No";} ?></td>
								</tr>
                                <tr>
                                    <td><?php //echo $BIZBOOK['PREMIUM_SERVICE_PROVIDER']; ?></td>
									<td><?php //if($user_details_row['user_type']== "Service provider"){ echo "Yes";}else {echo "No";} ?></td>
								</tr>*/?>
                                <tr>
                                    <td><?php echo $BIZBOOK['FACEBOOK']; ?></td>
									<td>
                                        <div class="form-group">
                                          <input type="text" class="form-control" name="user_facebook" value="<?php echo $user_details_row['user_facebook']; ?>">
                                        </div>
                                    </td>
								</tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['TWITTER']; ?></td>
                                    <td>
                                        <div class="form-group">
                                          <input type="text" class="form-control" name="user_twitter" value="<?php echo $user_details_row['user_twitter']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Linkedin</td>
                                    <td>
                                        <div class="form-group">
                                          <input type="text" class="form-control" name="user_linkedin" value="<?php echo $user_details_row['user_linkedin']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Instagram</td>
                                    <td>
                                        <div class="form-group">
                                          <input type="text" class="form-control" name="user_instagram" value="<?php echo $user_details_row['user_instagram']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Whatsapp</td>
                                    <td>
                                        <div class="form-group">
                                          <input type="text" class="form-control" name="user_whatsapp" value="<?php echo $user_details_row['user_whatsapp']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['USER_WEBSITE']; ?></td>
                                    <td>
                                        <div class="form-group">
                                          <input type="text" class="form-control" name="user_website" value="<?php echo $user_details_row['user_website']; ?>">
                                        </div>
                                    </td>
								</tr>
                                <tr>
                                    <td>
                                        <button type="submit" name="profile_update_submit" class="db-pro-bot-btn"><?php echo $BIZBOOK['SAVE_CHANGES']; ?></button>
                                        <?php /*<a href="db-payment" class="db-pro-bot-btn"><?php echo $BIZBOOK['UPGRADE']; ?></a>*/?>
                                    </td>
									<td></td>
								</tr>
							</tbody>
						</table>
                    </form>
                </div>
            </div>
<?php
include "dashboard_right_pane.php";
?>
