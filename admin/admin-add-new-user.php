<?php
include "header.php";
?>

<?php if($admin_row['admin_user_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['ADD_NEW_USER'];?></span>
                 <div class="ud-cen-s2 ud-pro-edit">
                    <h2><?php echo $BIZBOOK['USER_DETAILS'];?></h2>
                     <?php include "../page_level_message.php"; ?>
                     <form name="register_form" id="register_form" method="post" action="../register_update.php" enctype="multipart/form-data" class="">
                         
                         <input type="hidden" autocomplete="off" name="trap_box" id="trap_box" class="validate">
                         <input type="hidden" autocomplete="off" name="mode_path" value="XeBaCk_MoDeX_PATHXHU" id="mode_path" class="validate">

                         <table class="responsive-table bordered">
                             <tbody>
                                 <tr>
                                     <td><?php echo $BIZBOOK['NAME_BUSSINESS']; ?></td>
                                     <td>
                                         <div class="form-group">
                                             <input type="text" required="required" autocomplete="off" name="first_name" id="first_name" class="form-control">
                                         </div>
                                     </td>
                                 </tr>
                                 <?php /*<tr>
                                    <td><?php echo $BIZBOOK['LAST_NAME']; ?></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="last_name" name="last_name" class="form-control" required="required">
                                        </div>
                                    </td>
                                </tr>*/?>
                                <tr>
                                    <td><?php echo $BIZBOOK['CIF_NIF']; ?></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="cif_nif" name="cif_nif" class="form-control">
                                        </div>
                                    </td>

                                </tr>
                                 <tr>
                                     <td><?php echo $BIZBOOK['EMAIL']; ?></td>
                                     <td>
                                         <div class="form-group">
                                             <input type="email" required="required" autocomplete="off" name="email_id" id="email_id" class="form-control" >
                                         </div>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td><?php echo $BIZBOOK['PROFILE_PASSWORD']; ?></td>
                                     <td>
                                         <div class="form-group">
                                             <input type="password" autocomplete="off" name="password" id="password" class="form-control" >
                                         </div>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td><?php echo $BIZBOOK['MOBILE_NUMBER']; ?></td>
                                     <td>
                                         <div class="form-group">
                                             <input type="number" required="required" autocomplete="off" name="mobile_number" id="mobile_number" class="form-control">
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
                                                 name="user_address" required="required">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['CITY'];?></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="user_state" required="required"
                                                    class="form-control" name="user_state">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Población</td>
                                    <td>
                                        <div class="form-group">
                                          <input type="text" id="user_city" class="form-control"
                                                 name="user_city" required="required">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['ZIP_CODE'];?></td>
                                    <td>
                                        <div class="form-group">
                                          <input type="text" id="user_zip_code" class="form-control"
                                                 name="user_zip_code" required="required">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                     <td>Tipo usuario</td>
                                     <td>
                                         <div class="form-group">
                                             <select name="user_type" required="required" id="user_type" class="form-control ca-check-plan">
                                                 <option value="">Tipo usuario</option>
                                                 <option value="General">Usuario general</option>
                                                 <option value="Service provider">Proveedor de servicios</option>
                                                 <option value="Prueba">Prueba</option>
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
//                                                foreach (getAllPlanType() as $plan_type_row) {
//                                                    ?>
                                                    <option value="<?php //echo $plan_type_row['plan_type_id']; ?>"><?php //echo $plan_type_row['plan_type_name']; if($plan_type_row['plan_type_price'] != 0){ echo ' - '.$plan_type_row['plan_type_price'].'/year';} ?></option>
                                                    <?php
//                                                }
//                                                ?>
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
                                    <td><?php echo $BIZBOOK['FACEBOOK']; ?></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="user_facebook" class="form-control" >
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['TWITTER']; ?></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="user_twitter" class="form-control" >
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Linkedin</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="user_linkedin" class="form-control" >
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Instagram</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="user_instagram" class="form-control" >
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Whatsapp</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="user_whatsapp" class="form-control" >
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $BIZBOOK['WEBSITE']; ?></td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text"  name="user_website" class="form-control" >
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" name="register_submit" class="db-pro-bot-btn"><?php echo $BIZBOOK['SUBMIT']; ?></button>
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