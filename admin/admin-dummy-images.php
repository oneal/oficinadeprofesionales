<?php
include "header.php";
?>

<?php if($admin_row['admin_dummy_image_options'] != 1){
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['DUMMY_IMAGES'] ;?></span>
                <div class="ud-cen-s2 ad-dum-ima hcat-cho">
                    <h2><?php echo $BIZBOOK['DUMMY_IMAGES'] ;?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <table class="responsive-table bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><?php echo $BIZBOOK['IMAGE_POSITION'] ;?></th>
                            <th><?php echo $BIZBOOK['IMAGE'];?></th>
                            <th><?php echo $BIZBOOK['CHANGE_IMAGE'];?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $row_f = getAllFooter();

                        ?>
                        <form name="user_dummy_image_form" action="update_user_dummy_image.php" method="post"
                              enctype="multipart/form-data">
                            <input type="hidden" autocomplete="off" name="footer_id"
                                   value="<?php echo $row_f['footer_id']; ?>" id="footer_id" class="validate">
                            <input type="hidden" autocomplete="off" name="user_default_image_old"
                                   value="<?php echo $row_f['user_default_image']; ?>" id="user_default_image_old"
                                   class="validate">
                            <tr>
                                <td>1</td>
                                <td><b class="db-list-rat"><?php echo $BIZBOOK['USER_PROFILE'];?></b></td>
                                <td><img src="../images/user/<?php echo $row_f['user_default_image']; ?>" title="<?php echo $BIZBOOK['USER_PROFILE'];?>" alt="<?php echo $BIZBOOK['USER_PROFILE'];?>"></td>
                                <td>
                                    <div class="form-group">
                                        <input type="file" name="user_default_image" class="form-control">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4">
                                    <button name="user_dummy_image_submit" type="submit" class="db-pro-bot-btn"><?php echo $BIZBOOK['SUBMIT'];?></button>
                                </td>
                            </tr>
                        </form>

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