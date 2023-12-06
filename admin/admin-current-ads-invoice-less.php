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
				<span class="udb-inst"><?php echo $BIZBOOK['CURRENT_RUNNING_ADS_INVOICELESS'];?></span>
                <div class="ud-cen-s2">
                     <h2><?php echo $BIZBOOK['CURRENT_RUNNING_ADS_INVOICELESS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="<?php echo $BIZBOOK['SEARCH'];?>...">
                    </div>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $BIZBOOK['AD_POSITION'];?></th>
                                <th>Sección</th>
                                <th>Categoría</th>
                                <th><?php echo $BIZBOOK['STAR_DATE'];?></th>
                                <th><?php echo $BIZBOOK['END_DATE'];?></th>
                                <th><?php echo $BIZBOOK['DATE'];?> creación</th>
                                <th><?php echo $BIZBOOK['EDIT'];?></th>
                                <th><?php echo $BIZBOOK['DELETE'];?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $si = 1;
                            foreach (getAllActiveAdsLessEnquiry() as $row) {

                                $all_ads_price_id = $row['all_ads_price_id'];

                                $user_id = $row['user_id'];

                                $user_details_row = getUser($user_id);

                                $ads_price_details_row = getAdsPrice($all_ads_price_id);
                                
                                ?>
                                    <tr>
                                        <td><?php echo $si; ?></td>
                                        <td><?php echo $ads_price_details_row['ad_price_name']; ?></td>
                                        <?php
                                        if($row['type'] == 1) {
                                            $type = "Ficha de profesionales";
                                            $category = getCategory($row['category_id']);
                                            $category_name = $category['category_name'];
                                        } else if($row['type'] == 2) {
                                            $type = "Ofertas de trabajo";
                                            $category = getCategoryWokrOffer($row['category_id']);
                                            $category_name = $category['category_name'];
                                        } else if($row['type'] == 3) {
                                            $type = "Almacenes";
                                            $category = getCategoryStore($row['category_id']);
                                            $category_name = $category['category_name'];
                                        } else if($row['type'] == 4) {
                                            $type = "Home";
                                            $category_name = "";
                                        }
                                        ?>
                                        <td><?php echo $type;?></td>
                                        <td><?php echo $category_name;?></td>
                                        <td><?php echo date('d-m-Y',$row['ad_start_date']);?></td>
                                        <td><?php echo date('d-m-Y',$row['ad_end_date']);?></td>
                                        <td><?php echo dateFormatconverter($row['ad_enquiry_cdt']);?></td>
                                        <?php /*<td><a href="admin-invoice-create.php" class="db-list-rat"><?php echo $BIZBOOK['SEND'];?></a></td>*/?>
                                        <td><a href="admin-ads-edit.php?row=<?php echo $row['all_ads_enquiry_id']; ?>&path=1" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                        <td><a href="admin-ads-delete.php?row=<?php echo $row['all_ads_enquiry_id']; ?>&path=1" class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
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