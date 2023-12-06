<?php /*
include "header.php";
?>

<?php if($admin_row['admin_enquiry_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst"><?php echo $BIZBOOK['SAVED_ENQUERY'];?></span>
                <div class="ud-cen-s2">
                     <h2><?php echo $BIZBOOK['SAVED_ENQUERY'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="Search this page..">
                    </div>
                    <table class="responsive-table bordered tb-bold-dis" id="pg-resu">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $BIZBOOK['NAME'];?></th>
                                <th><?php echo $BIZBOOK['EMAIL'];?></th>
                                <th><?php echo $BIZBOOK['PHONE'];?></th>
                                <th><?php echo $BIZBOOK['MESSAGE'];?></th>
                                <th><?php echo $BIZBOOK['LISTING'];?></th>
                                <th>Tracking-id</th>
                                <?php /*<th>URL</th>?>
                                <th><?php echo $BIZBOOK['DELETE'];?></th>
                                <th><?php echo $BIZBOOK['SAVED'];?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $si = 1;
                            foreach (getAllSavedEnquiries() as $enquiries_row) {

                            $enquiry_listing_id = $enquiries_row['listing_id'];

                            $listing_enquiry_row = getAllListingListing($enquiry_listing_id);

                            ?>
								<tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_name']; ?>
                                        <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                                    </td>
                                    <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                                    <td><?php echo $listing_enquiry_row['listing_name']; ?></td>
                                    <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                                    <?php /*<td>www.rn53themes.net/listings/fresh-fruits.html</td>?>
                                    <td><a href="trash_enquiry.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
                                    <td><span class="enq-sav" data-toggle="tooltip" title="<?php echo $BIZBOOK['UNSAVED_THIS_ENQUERY'];?>"><i class="material-icons sav-act">favorite</i></span></td>
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