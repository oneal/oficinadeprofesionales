<?php
include "header.php";
?>

<?php if($admin_row['admin_ads_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst">Fichas destacadas</span>
                <div class="ud-cen-s2">
                     <h2>Fichas destacadas</h2>
                    <?php include "../page_level_message.php"; ?>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="<?php echo $BIZBOOK['SEARCH'];?>...">
                    </div>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $BIZBOOK['NAME_BUSSINESS'];?></th>
                                <th><?php echo $BIZBOOK['AD_POSITION'];?></th>
                                <th>Id. ficha</th>
                                <th>Id. Usuario</th>
                                <th><?php echo $BIZBOOK['STAR_DATE'];?></th>
                                <th><?php echo $BIZBOOK['END_DATE'];?></th>
                                <th><?php echo $BIZBOOK['EDIT'];?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $si = 1;
                            foreach (getAllFeaturedListingWithInvoice() as $row) {

                                $featured_listing_price_id = $row['featured_listing_price_id'];
                                
                                $id_listing = $row['listing_id'];
                                
                                $listing_row = getIdListing($id_listing);

                                $user_id = $listing_row['user_id'];

                                $user_details_row = getUser($user_id);

                                $sql = "SELECT * FROM  " . TBL . "featured_listing_price where featured_listing_prices_id = ".$featured_listing_price_id;
                                $featured_listing_price_rs = mysqli_query($conn, $sql);
                                $featured_listing_price_row = mysqli_fetch_array($featured_listing_price_rs);
                                
                                ?>
                                    <tr>
                                        <td><?php echo $si; ?></td>
                                        <td><?php echo $listing_row['listing_name']; ?></td>
                                        <td><?php echo $featured_listing_price_row['description']; ?></td>
                                        <td><span class="db-list-rat"><?php echo $listing_row['listing_code']; ?></span></td>
                                        <td><span class="db-list-rat"><?php echo $user_details_row['user_code']; ?></span></td>
                                        <td><?php echo date('d-m-Y',$row['date_start']);?></td>
                                        <td><?php echo date('d-m-Y',$row['date_end']);?></td>
                                        <td><a href="admin-add-featured-listing.php?code=<?php echo $listing_row['listing_code']; ?>&path=1" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                    </tr>
                                <?php
                                    $si++;
                            }?>
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