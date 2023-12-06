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
                    <span class="udb-inst"><?php echo $BIZBOOK['AD_DETAILS'];?></span>
                    <div class="ud-cen-s2 ad-table-inn">
                    <h2><?php echo $BIZBOOK['AD_PRICING_AND_OTHER_DETAILS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <table class="responsive-table bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $BIZBOOK['NAME'];?></th>
                                <th><?php echo $BIZBOOK['PREVIEW'];?></th>
                                <th><?php echo $BIZBOOK['ADS_SIZE'];?></th>
                                <th><?php echo $BIZBOOK['COST_PER_DAYS'];?></th>
                                <th><?php echo $BIZBOOK['STATUS'];?></th>
                                <th><?php echo $BIZBOOK['EDIT'];?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $si =1;
                        foreach (getAllAdsPrice() as $row) {

                            $all_ads_price_id = $row['all_ads_price_id'];

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><?php echo $row['ad_price_name']; ?></td>
                                <td>
                                    <img src="../images/ads/<?php echo $row['ad_price_photo']; ?>" alt="">
                                </td>
                                <td><?php echo $row['ad_price_size']; ?></td>
                                <td><?php echo $row['ad_price_cost']; ?><?php echo $footer_row['currency_symbol']; ?></td>
                                <td><span class="db-list-rat"><?php echo $row['ad_price_status']; ?></span></td>
                                <td><a href="admin-ads-price-edit.php?row=<?php echo $row['all_ads_price_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                            </tr>
                            <?php
                            $si++;
                        }
                        ?>
                            <?php /*
                            <tr>
                                <td>2</td>
                                <td>All listing page<br>Top</td>
                                <td>
                                    <img src="../images/ads/ad-size.png" alt="">
                                </td>
                                <td>728 X 90 px</td>
                                <td>50$</td>
                                <td><span class="db-list-rat">Active</span></td>
                                <td><a href="admin-ads-price-edit.html" class="db-list-edit">Edit</a></td>
                            </tr> 
                            <tr>
                                <td>3</td>
                                <td>All listing page<br>Bottom</td>
                                <td>
                                    <img src="../images/ads/ad-size.png" alt="">
                                </td>
                                <td>728 X 90 px</td>
                                <td>40$</td>
                                <td><span class="db-list-rat">Active</span></td>
                                <td><a href="admin-ads-price-edit.html" class="db-list-edit">Edit</a></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>All listing page<br>Left</td>
                                <td>
                                    <img src="../images/ads/ad-size.png" alt="">
                                </td>
                                <td>300 X 300 px</td>
                                <td>45$</td>
                                <td><span class="db-list-rat">Active</span></td>
                                <td><a href="admin-ads-price-edit.html" class="db-list-edit">Edit</a></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Listing detail page<br>Right</td>
                                <td>
                                    <img src="../images/ads/ad-size.png" alt="">
                                </td>
                                <td>300 X 300 px</td>
                                <td>30$</td>
                                <td><span class="db-list-rat">Active</span></td>
                                <td><a href="admin-ads-price-edit.html" class="db-list-edit">Edit</a></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Listing detail page<br>Bottom</td>
                                <td>
                                    <img src="../images/ads/ad-size.png" alt="">
                                </td>
                                <td>728 X 90 px</td>
                                <td>30$</td>
                                <td><span class="db-list-rat">Active</span></td>
                                <td><a href="admin-ads-price-edit.html" class="db-list-edit">Edit</a></td>
                            </tr>*/?>
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