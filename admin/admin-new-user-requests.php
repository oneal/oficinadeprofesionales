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
				<span class="udb-inst"><?php echo $BIZBOOK['NEW_USER_REQUESTS'];?></span>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['USER_REQUESTS'];?> - <?php echo AddingZero_BeforeNumber(getCountInactiveUser()); ?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <a href="admin-add-new-user.php" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_USER'];?></a>
                    <table class="responsive-table bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $BIZBOOK['NAME'];?></th>
                                <?php /*<th>Plan type</th>*/?>
                                <th><?php echo $BIZBOOK['PHONE'];?></th>
                                <?php /*<th>Payment type</th>*/?>
                                <th><?php echo $BIZBOOK['EDIT'];?></th>
                                <th><?php echo $BIZBOOK['DELETE'];?></th>
                                <?php /*<th>Bill info</th>*/?>
                                <?php /*<th><?php echo $BIZBOOK['MORE_INFO'];?></th>*/?>
                                <th><?php echo $BIZBOOK['APPROVE'];?></th>
                                <?php /*
                                  <th>Create Invoice</th>
                                  <th>Send Invoice</th> */ ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $si = 1;
                            foreach (getAllInactiveUser() as $row) {

                                $session_user_id = $row['user_id'];
                                $user_plan = $row['user_plan'];

                                $plan_type_row = getPlanType($user_plan);
                                ?>
                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><img src="../images/user/<?php if(($row['profile_image'] == NULL) || empty($row['profile_image'])){  echo "1.jpg";}else{ echo $row['profile_image']; } ?>" title="<?php echo $row['first_name']; ?>" alt="<?php echo $row['first_name']; ?>"><?php echo $row['first_name']; ?> <span>Join: <?php  echo dateFormatconverter($row['user_cdt']); ?></span>
                                    </td>
                                    <?php /*<td><span class="db-list-rat"><?php //echo $row['user_type']; ?></span></td>*/?>
                                    <td><span class="db-list-rat"><?php echo $row['mobile_number']; ?></span></td>
                                    <?php /*<td><span class="db-list-ststus"><?php //if($user_plan == 0){ echo "N/A"; }else{echo $plan_type_row['plan_type_name'];} ?></span></td>*/?>
                                    <td><a href="admin-my-profile-edit.php?row=<?php echo $session_user_id; ?>&path=1" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                    <td><a href="admin-my-profile-delete.php?row=<?php echo $session_user_id; ?>&path=1" class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
                                    <?php /*<td><a href="admin-user-billing-details.php?row=<?php echo $session_user_id; ?>" class="db-list-edit"><?php echo $BIZBOOK['MORE_INFO'];?></a></td>*/?>
                                    <?php /*<td><a href="admin-user-full-details.php?row=<?php //echo $session_user_id; ?>" class="db-list-edit">View</a></td>*/?>
                                    <td><a href="admin-user-approve.php?userstatususerstatususerstatususerstatususerstatus=<?php echo $session_user_id; ?>" class="db-list-appro"><?php echo $BIZBOOK['APPROVE'];?></a></td>
                                    <?php /*
                                    <td><a href="admin-invoice-create.php?row=<?php //echo $session_user_id; ?>" class="db-list-ststus">Create</a></td>
                                    <td><a href="admin-send-invoice.php" class="db-list-ststus">Send</a></td>*/?>
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
    <script src="js/admin-custom.js"></script> <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>