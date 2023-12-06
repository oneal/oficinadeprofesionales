<?php
include "header.php";
?>

<?php if($admin_row['admin_listing_options'] != 1){
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['ADMIN_CLAIM_REQUEST'];?></span>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['ADMIN_CLAIM_REQUEST'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <a href="admin-add-new-listings.php" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_LISTING'];?></a>
                    <table class="responsive-table bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><?php echo $BIZBOOK['NAME'];?></th>
                            <th><?php echo $BIZBOOK['ENQUIRY_NAME'];?></th>
                            <th><?php echo $BIZBOOK['ENQUIRY_MOBILE'];?></th>
                            <th><?php echo $BIZBOOK['ENQUIRY_EMAIL'];?></th>
                            <th><?php echo $BIZBOOK['ENQUIRY_MESSAGE'];?></th>
                            <th><?php echo $BIZBOOK['ENQUIRY_DATE'];?></th>
                            <th><?php echo $BIZBOOK['DELETE'];?></th>
                            <th><?php echo $BIZBOOK['PREVIEW'];?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $si = 1;
                        foreach (getAllClaimListings() as $claimrow) {

                            $user_id = $claimrow['user_id'];
                            $listing_id = $claimrow['listing_id'];

                            $listrow = getIdListing($listing_id);
                            $user_details_row = getUser($user_id);

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><img
                                        src="<?php if ($listrow['profile_image'] != NULL || !empty($listrow['profile_image'])) {
                                            echo "../images/listings/" . $listrow['profile_image'];
                                        } else {
                                            echo "../images/listings/hot4.jpg";
                                        } ?>"><?php echo $listrow['listing_name']; ?> <span><?php echo dateFormatconverter($listrow['listing_cdt']); ?></span></td>

                                <td><?php echo $claimrow['enquiry_name']; ?></td>
                                <td><?php echo $claimrow['enquiry_mobile']; ?></td>
                                <td><?php echo $claimrow['enquiry_email']; ?></td>
                                <td><?php echo $claimrow['enquiry_message']; ?></td>
                                <td><span class="db-list-rat"><?php  echo dateFormatconverter($claimrow['claim_cdt']); ?></span></td>
                                <td><a href="trash-claim.php?trashclaimrequesttrashclaimrequesttrashclaimrequesttrashclaimrequesttrashclaimrequest=<?php echo $claimrow['claim_listing_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
                                <td><a href="<?php echo $webpage_full_link; ?>listing/<?php echo $listrow['listing_slug']; ?>" class="db-list-edit" target="_blank"><?php echo $BIZBOOK['PREVIEW'];?></a></td>
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