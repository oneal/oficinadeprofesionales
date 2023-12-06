<?php
include "header.php";
?>
<?php if ($admin_row['admin_listing_filter_options'] != 1) {
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['FEATURE_FILTERS'];?></span>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['FEATURE_FILTERS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <form name="featured_filter_form" id="featured_filter_form" method="post"
                          action="update_feature_filters.php" enctype="multipart/form-data">
                        <table class="responsive-table bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $BIZBOOK['FEATURE_NAME'] ;?></th>
                                <th><?php echo $BIZBOOK['STATUS'] ;?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $si = 1;
                            foreach (getAllFeaturedFilter() as $row) {

                                ?>
                                <input type="hidden" class="form-control"
                                       name="all_featured_filter_id[]"
                                       value="<?php echo $row['all_featured_filter_id']; ?>">
                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $row['all_featured_filter_name']; ?></td>
                                    <td>
                                        <select name="all_featured_filter_status[]" class="chosen-select form-control filt-sele">
                                            <option <?php if ($row['all_featured_filter_status'] == 1) {
                                                echo "selected='selected'";
                                            } ?> value="1"><?php echo $BIZBOOK['ACTIVE'] ;?>
                                            </option>
                                            <option <?php if ($row['all_featured_filter_status'] == 0) {
                                                echo "selected='selected'";
                                            } ?> value="0"><?php echo $BIZBOOK['INACTIVE'] ;?>
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <?php
                                $si++;
                            }
                            ?>
                            <tr>
                                <td colspan="4">
                                    <button type="submit" name="featured_filter_submit" class="db-pro-bot-btn"><?php echo $BIZBOOK['SAVED'] ;?></button>
                                </td>
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