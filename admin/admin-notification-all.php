<?php
include "header.php";
?>

<?php if($admin_row['admin_notification_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['ALL_NOTIFICATIONS'];?></span>
                <div class="ud-cen-s2">
                     <h2><?php echo $BIZBOOK['NOTIFICATIONS_YOUR_SEND'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <a href="admin-create-notification.php" class="db-tit-btn"><?php echo $BIZBOOK['SEND_NEW_NOTIFICATION'];?></a>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="<?php echo $BIZBOOK['SEARCH'];?>...">
                    </div>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $BIZBOOK['TITLE'];?></th>
                                <th><?php echo $BIZBOOK['SEND_TO'] ;?></th>
                                <th><?php echo $BIZBOOK['EDIT'] ;?></th>
                                <th><?php echo $BIZBOOK['DELETE'] ;?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //Notification Query
                            $si = 1;
                            foreach (getAllNotification() as $notificationsrow) {

                                if($notificationsrow['notification_user'] == 100){
                                    
                                    $notification_user = $BIZBOOK['ALL_USERS'];
                                    
                                }elseif ($notificationsrow['notification_user'] == 101){
                                    
                                    $notification_user = $BIZBOOK['ALL_SERVICES_PROVIDERS'];
                                    
                                }elseif ($notificationsrow['notification_user'] == 102){
                                    
                                    $notification_user = $BIZBOOK['ALL_GENERAL_PROVIDERS'];
                                    
                                }else{
                                    
                                    $notifications_user = $notificationsrow['notification_user'];
                                    
                                   $plan_type_row = getPlanType($notifications_user);

                                   $notification_user = "Todos ".$plan_type_row['plan_type_name']." Usuarios";
                               }

                            ?>
								<tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $notificationsrow['notification_title']; ?> <span><?php echo dateFormatconverter($notificationsrow['notification_cdt']); ?></span></td>
									<td><?php echo $notification_user; ?></td>
									<td><a href="admin-notification-edit.php?id=<?php echo $notificationsrow['notification_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                    <td><a href="admin-notification-delete.php?id=<?php echo $notificationsrow['notification_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
								</tr>
                                <?php
                                $si++;
                            }
                                ?>
                            </tbody>
                    </table>

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