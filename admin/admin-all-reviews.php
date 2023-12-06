<?php
include "header.php";
?>

<?php if($admin_row['admin_review_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst"><?php echo $BIZBOOK['REVIEWS'];?></span>
                <div class="ud-cen-s2">
                     <h2><?php echo $BIZBOOK['ALL_REVIEWS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="<?php echo $BIZBOOK['SEARCH'];?>...">
                    </div>
                    <table class="responsive-table bordered tb-bold-dis" id="pg-resu">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $BIZBOOK['NAME'];?></th>
                                <th><?php echo $BIZBOOK['EMAIL'];?></th>
                                <th><?php echo $BIZBOOK['PHONE'];?></th>
                                <th><?php echo $BIZBOOK['CITY'];?></th>
                                <th><?php echo $BIZBOOK['MESSAGE'];?></th>
                                <th><?php echo $BIZBOOK['RATING'];?></th>
                                <th><?php echo $BIZBOOK['LISTING_NAME'];?></th>
                                <th><?php echo $BIZBOOK['INFO_IP'];?></th>
                                <?php /*<th><?php echo $BIZBOOK['URL'];?></th>*/?>
                                <th><?php echo $BIZBOOK['DELETE'];?></th>
                                <?php /*<th><?php echo $BIZBOOK['SAVE'];?></th>*/?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $si = 1;
                            foreach (getAllReviews() as $reviewrow) {

                            $review_list_id = $reviewrow['listing_id'];
                            $listing_user_id = $reviewrow['listing_user_id'];
                            $rrating = $reviewrow['price_rating'];

                            $rev_listrs = getAllListingUserListing($listing_user_id,$review_list_id);

                            ?>
                            <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $reviewrow['review_name']; ?> <span><?php echo dateFormatconverter($reviewrow['review_cdt']); ?></span></td>
                                    <td><?php echo $reviewrow['review_email']; ?></td>
                                    <td><?php echo $reviewrow['review_mobile']; ?></td>
                                    <td><?php echo $reviewrow['review_city']; ?></td>
                                    <td><?php echo $reviewrow['review_message']; ?></td>

                                    <td>
                                        <label class="rat">
                                            <?php
                                            for ($i = 1; $i <= $rrating; $i++) {
                                                ?>
                                                <i class="material-icons">star</i>
                                                <?php
                                            }
                                            ?>
                                            <?php /*<i class="material-icons">star</i>
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star</i>
                                            <i class="material-icons">star_half</i>*/?>
                                        </label>
                                    </td>
                                    <td><?php echo $rev_listrs['listing_name']; ?></td>
                                    <td><?php echo $reviewrow['ip']; ?></td>
                                    <?php /*<td><?php echo $rev_listrs['review_url']; ?></td>*/?>
                                    <td><a href="../review_trash.php?reviewreviewreviewreviewreviewreview=<?php echo $reviewrow['review_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE']; ?></a></td>
                                    <?php /*<td><span class="enq-sav" data-toggle="tooltip" title="<?php echo $BIZBOOK['CLICK_SAVE_REVIEW'];?>"><i class="material-icons">favorite</i></span></td>*/?>
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