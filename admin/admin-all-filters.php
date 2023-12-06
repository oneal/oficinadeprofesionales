<?php
include "header.php";
?>
<?php if($admin_row['admin_listing_filter_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst"><?php echo $BIZBOOK['LISTING_FILTERS'];?></span>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['LISTING_FILTERS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <form name="all_filter_form" id="all_filter_form" method="post" action="update_all_filters.php" enctype="multipart/form-data">
                    <table class="responsive-table bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $BIZBOOK['FILTER_NAME'];?></th>
                                <th colspan="2"><?php echo $BIZBOOK['STATUS'];?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $si = 1;
                            foreach (getAllListingFilter() as $row) {

                                ?>
                                <?php /*<tr>
                                    <td>1</td>
                                    <td><?php echo $BIZBOOK['SEARCH_THE_SERVICE'];?></td>
                                    <td colspan="2">
                                        <select name="service_filter" class=" form-control filt-sele">
                                            <option <?php if ($row['service_filter'] == "Active") {
                                                echo "selected";
                                            } ?> value="Active"><?php echo $BIZBOOK['ACTIVE'];?>
                                            </option>
                                            <option <?php if ($row['service_filter'] == "Inactive") {
                                                echo "selected";
                                            } ?> value="Inactive"><?php echo $BIZBOOK['INACTIVE'];?>
                                            </option>
                                        </select>
                                    </td>

                                </tr>*/?>

                                <tr>
                                    <td>2</td>
                                    <td><?php echo $BIZBOOK['CATEGORIES_FILTER'];?></td>
                                    <td>
                                        <select name="category_filter" class=" form-control filt-sele">
                                            <option <?php if ($row['category_filter'] == "Active") {
                                                echo "selected";
                                            } ?> value="Active"><?php echo $BIZBOOK['ACTIVE'];?>
                                            </option>
                                            <option <?php if ($row['category_filter'] == "Inactive") {
                                                echo "selected";
                                            } ?> value="Inactive"><?php echo $BIZBOOK['INACTIVE'];?>
                                            </option>
                                        </select>
                                    </td>
                                    <td><a href="admin-filter-category.php" class="db-list-edit">Go to filter</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><?php echo $BIZBOOK['FILTER_FEATURES'];?></td>
                                    <td>
                                        <select name="feature_filter" class=" form-control filt-sele">
                                            <option <?php if ($row['feature_filter'] == "Active") {
                                                echo "selected";
                                            } ?> value="Active"><?php echo $BIZBOOK['ACTIVE'];?>
                                            </option>
                                            <option <?php if ($row['feature_filter'] == "Inactive") {
                                                echo "selected";
                                            } ?> value="Inactive"><?php echo $BIZBOOK['INACTIVE'];?>
                                            </option>
                                        </select>
                                    </td>
                                    <td><a href="admin-filter-features.php" class="db-list-edit">Go to filter</a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><?php echo $BIZBOOK['RATING_FILTER'];?></td>
                                    <td colspan="2">
                                        <select name="rating_filter" class=" form-control filt-sele">
                                            <option <?php if ($row['rating_filter'] == "Active") {
                                                echo "selected";
                                            } ?> value="Active"><?php echo $BIZBOOK['ACTIVE'];?>
                                            </option>
                                            <option <?php if ($row['rating_filter'] == "Inactive") {
                                                echo "selected";
                                            } ?> value="Inactive"><?php echo $BIZBOOK['INACTIVE'];?>
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <?php /*
                                <tr>
                                    <td>5</td>
                                    <td>City filter</td>
                                    <td colspan="2">
                                        <select name="city_filter" class=" form-control filt-sele">
                                            <option <?php //if ($row['city_filter'] == "Active") {
//                                                echo "selected";
//                                            } ?> value="Active">Active
                                            </option>
                                            <option <?php //if ($row['city_filter'] == "Inactive") {
//                                                echo "selected";
//                                            } ?> value="Inactive">Inactive
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Country filter</td>
                                    <td colspan="2">
                                        <select name="country_filter" class=" form-control filt-sele">
                                            <option <?php //if ($row['country_filter'] == "Active") {
//                                                echo "selected";
//                                            } ?> value="Active">Active
                                            </option>
                                            <option <?php //if ($row['country_filter'] == "Inactive") {
//                                                echo "selected";
//                                            } ?> value="Inactive">Inactive
                                            </option>
                                        </select>
                                    </td>
                                </tr>*/?>
                                <tr>
                                    <td colspan="4">
                                        <button type="submit" name="all_filter_submit" class="db-pro-bot-btn"><?php echo $BIZBOOK['SAVED'];?></button>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
							</tbody>
						</table>
                    </form>
                    <div class="ud-notes">
                        <p><b><?php echo $BIZBOOK['NOTES'];?>:</b> <?php echo $BIZBOOK['TEXT_FILTER'];?></p>
                    </div>
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