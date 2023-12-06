<?php
include "header.php";
?>

<?php if($admin_row['admin_category_options'] != 1){
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['CATEGORIES'];?></span>
                <div class="ud-cen-s2 hcat-cho">
                    <h2><?php echo $BIZBOOK['CATEGORIES'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="<?php echo $BIZBOOK['SEARCH'];?>..">
                    </div>
                    <a href="admin-add-new-category-workoffer.php" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_CATEGORY'];?></a>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><?php echo $BIZBOOK['CATEGORY_NAME'];?></th>
                            <th><?php echo $BIZBOOK['CATEGORY_IMAGE'];?></th>
                            <th><?php echo $BIZBOOK['CREATED_DATE'];?></th>
                            <th><?php echo $BIZBOOK['LISTINGS'];?></th>
                            <?php /*<th>Sub Cate</th>*/?>
                            <th><?php echo $BIZBOOK['EDIT'];?></th>
                            <?php /*<th>View Sub Cate</th>*/?>
                            <th><?php echo $BIZBOOK['DELETE'];?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $si=1;
                        foreach (getAllCategoriesWorkOffer() as $row) {

                            $category_id = $row['category_id'];

                            $category_listing_count = getCountCategoryWokrOffer($category_id);

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><b class="db-list-rat"><?php echo $row['category_name']; ?></b></td>
                                <td><img src="../images/services/<?php echo $row['category_image']; ?>" alt=""></td>
                                <td><?php echo dateFormatconverter($row['category_cdt']); ?></td>
                                <td><span class="db-list-ststus" data-toggle="tooltip" title="<?php echo $BIZBOOK['TOTAL_LISTINGS_CATEGORY'];?>"><?php echo $category_listing_count; ?></span></td>
                                <td><a href="admin-category-workoffer-edit.php?row=<?php echo $row['category_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                <td><a href="admin-category-workoffer-delete.php?row=<?php echo $row['category_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
                            </tr>
                            <?php
                            $si++;
                        }
                        ?>
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