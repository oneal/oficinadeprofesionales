<?phpinclude "header.php";?><?php if($admin_row['admin_sub_admin_options'] != 1){    header("Location: profile.php");}?><!-- START --><section>    <div class="ad-com">        <div class="ad-dash leftpadd">            <div class="ud-cen">                <div class="log-bor">&nbsp;</div>                <span class="udb-inst"><?php echo $BIZBOOK['SUB_ADMINS'];?></span>                <div class="ud-cen-s2">                    <h2><?php echo $BIZBOOK['ALL_SUB_ADMINS'];?></h2>                    <?php include "../page_level_message.php"; ?>                    <a href="admin-sub-admin-create.php" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_SUB_ADMINS'];?></a>                    <table class="responsive-table bordered">                        <thead>                        <tr>                            <th>No</th>                            <th><?php echo $BIZBOOK['USER'];?></th>                            <th><?php echo $BIZBOOK['USER_NAME'];?></th>                            <th>Password</th>                            <th><?php echo $BIZBOOK['EDIT'];?></th>                            <th><?php echo $BIZBOOK['DELETE'];?></th>                            <?php /*<th>View log</th>*/?>                        </tr>                        </thead>                        <tbody>                        <?php                        $si = 1;                        foreach (getAllSubAdmin() as $admin_sql_row) {                            ?>                            <tr>                                <td><?php echo $si; ?></td>                                <td><img src="../images/user/6.jpg" title="<?php echo $admin_sql_row['admin_name']; ?>" alt="<?php echo $admin_sql_row['admin_name']; ?>"><?php echo $admin_sql_row['admin_name']; ?>                                    <span><?php echo dateFormatconverter($admin_sql_row['admin_cdt']); ?></span></td>                                <td><?php echo $admin_sql_row['admin_email']; ?></td>                                <td><?php echo "**********"; ?></td>                                <td><a href="admin-sub-admin-edit.php?row=<?php echo $admin_sql_row['admin_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>                                <td><a href="admin-sub-admin-delete.php?row=<?php echo $admin_sql_row['admin_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>                                <?php /*<td><a href="admin-sub-admin-log.html?row=<?php echo $admin_sql_row['admin_id']; ?>" class="db-list-edit">View log</a></td>*/?>                            </tr>                            <?php                            $si++;                        }                        ?>                        </tbody>                    </table>                </div>            </div>        </div>    </div></section><!-- END --><!-- Optional JavaScript --><!-- jQuery first, then Popper.js, then Bootstrap JS --><script src="../js/jquery.min.js"></script><script src="../js/popper.min.js"></script><script src="../js/bootstrap.min.js"></script><script src="../js/jquery-ui.min.js"></script><script src="js/admin-custom.min.js"></script> <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script></body></html>