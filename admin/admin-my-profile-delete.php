<?php
include "header.php";
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['DELETE_USER_DETAILS'];?></span>
                <div class="ud-cen-s2 ud-pro-edit">
                    <h2><?php echo $BIZBOOK['DELETE_USER_DETAILS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <?php
                    $path_id = $_GET['path'];
                    $user_id = $_GET['row'];

                    $user_details_row = getUser($user_id);

                    ?>
                    <form name="register_form" id="register_form" method="post" action="trash_user_profile.php" enctype="multipart/form-data" class="">

                        <input type="hidden" autocomplete="off" name="trap_box" id="trap_box" class="validate">
                        <input type="hidden" autocomplete="off" name="user_id" value="<?php echo $user_details_row['user_id']; ?>" id="user_id" class="validate">
                        <input type="hidden" autocomplete="off" name="path_id" value="<?php echo $path_id; ?>" id="path_id" class="validate">

                        <input type="hidden" autocomplete="off" name="mode_path" value="XeBaCk_MoDeX_PATHXHU" id="mode_path" class="validate">
                        <input type="hidden" value="<?php echo $user_details_row['profile_image']; ?>" autocomplete="off" name="profile_image_old" id="profile_image_old" required class="validate">

                        <table class="responsive-table bordered">
                            <tbody>
                            <tr>
                                <td><?php echo $BIZBOOK['NAME'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" readonly="readonly" value="<?php echo $user_details_row['first_name']; ?>" required="required" autocomplete="off" name="first_name" id="first_name" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <?php /*<tr>
                                <td><?php echo $BIZBOOK['LAST_NAME']; ?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" id="last_name" readonly="readonly" name="last_name" class="form-control" value="<?php echo $user_details_row['last_name']; ?>" required="required">
                                    </div>
                                </td>
                            </tr>*/?>
                            <tr>
                                <td><?php echo $BIZBOOK['CIF_NIF']; ?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" id="cif_nif" name="cif_nif" readonly="readonly" class="form-control" value="<?php echo $user_details_row['cif_nif']; ?>" required="required">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['EMAIL'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="email" readonly="readonly" value="<?php echo $user_details_row['email_id']; ?>"  required="required" autocomplete="off" name="email_id" id="email_id" class="form-control" >
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['MOBILE_NUMBER'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" readonly="readonly" value="<?php echo $user_details_row['mobile_number']; ?>" required="required" autocomplete="off" name="mobile_number" id="mobile_number" class="form-control">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['ADDRESS'];?></td>
                                <td>
                                    <div class="form-group">
                                      <input type="text" readonly="readonly" id="user_address" class="form-control"
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
                                      <input type="text" readonly="readonly" id="user_city" class="form-control"
                                             name="user_city" value="<?php echo $user_details_row['user_city']; ?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['ZIP_CODE'];?></td>
                                <td>
                                    <div class="form-group">
                                      <input type="text" readonly="readonly" id="user_zip_code" class="form-control"
                                             name="user_zip_code" value="<?php echo $user_details_row['user_zip_code'];?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                 <td>Tipo usuario</td>
                                 <td>
                                     <div class="form-group">
                                         <select name="user_type" readonly="readonly" required="required" id="user_type" class="form-control ca-check-plan">
                                             <option value="">User type</option>
                                             <option value="General" <?php if($user_details_row['user_type'] == 'General'){?>selected<?php }?>>Usuario general</option>
                                             <option value="Service provider" <?php if($user_details_row['user_type'] == 'Service provider'){?>selected<?php }?>>Proveedor de servicios</option>
                                         </select>
                                     </div>
                                 </td>
                             </tr>
                             <?php /*
                                                         <tr>
                                                             <td>User Plan</td>
                                                             <td>
                                                                 <div class="form-group">
                                                                     <select name="user_plan" id="user_plan" class="form-control">
                                                                         <option value="" disabled="disabled" selected="selected">Choose your plan</option>
                                                                         <?php
                            //                                             $plan_type = "SELECT *
                            //										FROM " . TBL . "plan_type WHERE plan_type_status='Active'
                            //
                            //										ORDER BY plan_type_id ASC";
                            //
                            //
                            //                                             $rs_plan_type = mysqli_query($conn,$plan_type);
                            //
                            //                                             $si = 1;
                            //                                             while ($plan_type_row = mysqli_fetch_array($rs_plan_type)) {
                            //                                                 ?>
                                                                             <option value="<?php //echo $plan_type_row['plan_type_id']; ?>"><?php //echo $plan_type_row['plan_type_name']; if($plan_type_row['plan_type_price'] != 0){ echo ' - '.$plan_type_row['plan_type_price'].'/year';} ?></option>
                                                                             <?php
                            //                                             }
                            //                                             ?>
                                                                     </select>
                                                                 </div>
                                                             </td>
                                                         </tr>
                                                            <tr>
                                                                <td>Plan start date</td>
                            									<td>
                                                                    <div class="form-group">
                                                                        <input type="text" id="stdate" value="12 Jan 2018" class="form-control">
                                                                    </div>
                                                                </td>
                            								</tr>
                                                            <tr>
                                                                <td>Plan expiry date</td>
                            									<td>
                                                                    <div class="form-group">
                                                                      <input type="text" id="endate" value="12 Jan 2018" class="form-control">
                                                                    </div>
                                                                </td>
                            								</tr>
                                                            <tr>
                                                                <td>Amount paid</td>
                            									<td>
                                                                    <div class="form-group">
                                                                      <input type="text" class="form-control" value="$250">
                                                                    </div>
                                                                </td>
                            								</tr>
                                                            <tr>
                                                                <td>Join date</td>
                            									<td>
                                                                    <div class="form-group">
                                                                      <input type="text" class="form-control" value="12 April 2018">
                                                                    </div>
                                                                </td>
                            								</tr>
                                                            <tr>
                                                                <td>Verified</td>
                            									<td>
                                                                    <div class="form-group">
                                                                      <select class="form-control">
                                                                        <option>Yes</option>
                                                                        <option>No</option>
                                                                      </select>
                                                                    </div>
                                                                </td>
                            								</tr>
                                                            <tr>
                                                                <td>Rating</td>
                            									<td>
                                                                    <div class="form-group">
                                                                      <select class="form-control">
                                                                          <option>1</option>
                                                                          <option>1.5</option>
                                                                          <option>2.0</option>
                                                                          <option>2.5</option>
                                                                          <option>3.0</option>
                                                                          <option>3.5</option>
                                                                          <option>4.0</option>
                                                                          <option>4.5</option>
                                                                          <option>5.0</option>
                                                                      </select>
                                                                    </div>
                                                                </td>
                            								</tr>
                                                            <tr>
                                                                <td>Premium service provider</td>
                            									<td>
                                                                    <div class="form-group">
                                                                      <select class="form-control">
                                                                        <option>Yes</option>
                                                                        <option>No</option>
                                                                      </select>
                                                                    </div>
                                                                </td>
                            								</tr>*/?>
                            <tr>
                                <td><?php echo $BIZBOOK['FACEBOOK'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" readonly="readonly" value="<?php echo $user_details_row['user_facebook']; ?>" name="user_facebook" class="form-control" >
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['TWITTER'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" readonly="readonly" value="<?php echo $user_details_row['user_twitter']; ?>" name="user_twitter" class="form-control" >
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Linkedin</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" readonly="readonly" value="<?php echo $user_details_row['user_linkedin']; ?>" name="user_youtube" class="form-control" >
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Whatsapp</td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" readonly="readonly" value="<?php echo $user_details_row['user_whatsapp']; ?>" name="user_youtube" class="form-control" >
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $BIZBOOK['WEBSITE'];?></td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" readonly="readonly"  value="<?php echo $user_details_row['user_website']; ?>" name="user_website" class="form-control" >
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="submit" name="register_submit" class="db-pro-bot-btn"><?php echo $BIZBOOK['DELETE'];?></button>
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