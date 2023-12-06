<?php /*
include "header.php";
?>

<?php if ($admin_row['admin_home_options'] != 1) {
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">

            <?php
            $si = 1;
            foreach (getAllTopServiceProviders() as $row) {

                $category_id = $row['top_service_provider_category_id'];

                $listing_id = $row['top_service_provider_listings'];

                $category_sql_row = getCategory($category_id);

                ?>

                <div class="ud-cen">
                    <div class="log-bor">&nbsp;</div>
                    <span class="udb-inst"><?php echo $BIZBOOK['TOP_SERVICES_PROVIDERS'];?> <?php echo $si; ?></span>
                    <div class="ud-cen-s2 hcat-cho">
                        <?php include "../page_level_message.php"; ?>
                        <h2><?php echo $BIZBOOK['CATEGORY'];?>: <?php echo $category_sql_row['category_name']; ?> </h2>
                        <a href="admin-home-top-services-change.php?row=<?php echo $category_sql_row['category_id']; ?>&&col=<?php echo $row['top_service_provider_id']; ?>" class="db-tit-btn"><?php echo $BIZBOOK['CHANGE_CATEGORY'];?></a>
                        <table class="responsive-table bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $BIZBOOK['SERVICE_PROVIDE'];?></th>
                                <th>Clicks</th>
                                <th><?php echo $BIZBOOK['EDIT'];?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $lisArray = explode(',', $listing_id);
                            $vi = 1;
                            foreach($lisArray as $Listing_Array) {
                                $listing_row = getIdListing($Listing_Array);

                                ?>
                                <tr>
                                    <td><?php echo $vi; ?></td>
                                    <td><?php echo $listing_row['listing_name']; ?></td>
                                    <td><span class="db-list-rat"><?php echo(rand(0,600)); ?></span></td>
                                    <td><a href="admin-home-top-services-edit.php?row=<?php echo $listing_row['listing_id']; ?>&&cat=<?php echo $category_id; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a>
                                    </td>
                                </tr>
                                <?php
                                $vi++;
                            }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                $si++;
            }
            ?>


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
<?php
if (isset($_GET['ername_1']) && isset($_GET['ername_2'])) {
    res_RenameFunction($_GET['ername_1'],$_GET['ername_2']);
}
?>
</body>

</html>