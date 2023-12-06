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
                <span class="udb-inst"><?php echo $BIZBOOK['ALL_USERS'];?></span>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['ALL_USERS'];?> - <?php echo AddingZero_BeforeNumber(getCountUser()); ?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="<?php echo $BIZBOOK['SEARCH'];?>...">
                    </div>
                    <a href="admin-add-new-user.php" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_USER'];?></a>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><?php echo $BIZBOOK['NAME'];?></th>
                            <th>Id <?php echo $BIZBOOK['USER'];?></th>
                            <?php /*
                            <th>Plan type</th>
                            <th>Expiry on</th>
                            <th>Amount</th>
                             * 
                             */?>
                            <th><?php echo $BIZBOOK['USER_TYPE'];?></th>
                            <th><?php echo $BIZBOOK['EDIT'];?></th>
                            <th><?php echo $BIZBOOK['DELETE'];?></th>
                            <th><?php echo $BIZBOOK['PREVIEW'];?></th>
                            <th><?php echo $BIZBOOK['MORE_INFO'];?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $si = 1;
                        foreach (getAllUser() as $row) {

                            $session_user_id = $row['user_id'];
                            $user_plan = $row['user_plan'];

                            $plan_type_row = getPlanType($user_plan);

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><img src="../images/user/<?php if(($row['profile_image'] == NULL) || empty($row['profile_image'])){  echo $footer_row['user_default_image'];}else{ echo $row['profile_image']; } ?>" alt="<?php echo $row['first_name'];?>"><?php echo $row['first_name']; ?><span><?php echo $BIZBOOK['JOINED_ON'];?>:<?php echo dateFormatconverter($row['user_cdt']); ?></span>
                                </td>
                                <td><?php echo $row['user_code']; ?> </td>

                                <?php
                                //To calculate the expiry date from user created date starts

                                $start_date_timestamp = strtotime($row['user_cdt']);
                                $plan_type_duration = $user_plan['plan_type_duration'];

                                $expiry_date_timestamp = strtotime("+$plan_type_duration months", $start_date_timestamp);

                                $expiry_date = date("d-m-Y h:i:s", $expiry_date_timestamp);

                                //To calculate the expiry date from user created date ends
                                ?>
                                <?php /*
                                <td><span class="db-list-rat">--><?php //if ($user_plan == 0) {
//                                            echo "Free";
//                                        } else {
//                                            echo $plan_type_row['plan_type_name'];
//                                        } ?></span></td>-->
                                <td><span class="db-list-ststus">--><?php //if ($user_plan == 0) {
//                                            echo "N/A";
//                                        } else {
//                                            echo dateFormatconverter($expiry_date);
//                                        } ?></span></td>-->
                                <td><span class="db-list-rat">$--><?php //if ($user_plan == 0) {
//                                            echo "0";
//                                        } else {
//                                            echo $plan_type_row['plan_type_price'];
//                                        } ?></span></td>-->
                                <td>--><?php //echo $row['user_type']; ?><!-- </td>-->*/?>
                                <td><?php echo $row['user_type']; ?> </td>
                                <td><a href="admin-my-profile-edit.php?row=<?php echo $session_user_id; ?>&path=2"
                                       class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                <td><a href="admin-my-profile-delete.php?row=<?php echo $session_user_id; ?>&path=2"
                                       class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
                                <td><a href="<?php echo $webpage_full_link; ?>profesional/<?php echo $row['user_slug']; ?>" class="db-list-edit"
                                       target="_blank"><?php echo $BIZBOOK['PREVIEW'];?></a></td>
                                <td><a href="admin-user-full-details.php?row=<?php echo $session_user_id; ?>"
                                       class="db-list-edit"><?php echo $BIZBOOK['MORE_INFO'];?></a></td>
                            </tr>
                            <?php
                            $si++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="ad-pgnat">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#"><?php echo $BIZBOOK['PREVIOUS'];?></a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#"><?php echo $BIZBOOK['NEXT'];?></a></li>
                </ul>
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
<script src="js/admin-custom.js"></script> 
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>