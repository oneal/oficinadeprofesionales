<?php
include "header.php";
?>

<?php if($admin_row['admin_product_options'] != 1){
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst">All Products</span>
                <div class="ud-cen-s2">
                    <h2>Product details</h2>
                    <?php include "../page_level_message.php"; ?>
                    <a href="admin-add-new-product.php" class="db-tit-btn">Add new product</a>
                    <table class="responsive-table bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <?php /*<th>product Date</th>*/?>>
                            <th>Created by</th>
                            <th>Views</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Preview</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $si = 1;
                        foreach (getAllProduct() as $productrow) {

                            $user_id = $productrow['user_id'];

                            $user_details_row = getUser($user_id);

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><img
                                        src="<?php if ($productrow['gallery_image'] != NULL || !empty($productrow['gallery_image'])) {
                                            echo "../images/products/" . array_shift(explode(',', $productrow['gallery_image']));
                                        } else {
                                            echo "../images/products/hot4.jpg";
                                        } ?>"><?php echo $productrow['product_name']; ?> <span><?php echo dateFormatconverter($productrow['product_cdt']); ?></span></td>
                                <?php /*<td> <?php //echo dateFormatconverter($productrow['product_start_date']); ?></td>*/?>
                                <td><a href="../profile.php?row=<?php echo $user_id; ?>" class="db-list-ststus" target="_blank"><?php echo $user_details_row['first_name']; ?></a></td>
                                <td><span class="db-list-rat"><?php  echo product_pageview_count($productrow['product_id']); ?></span></td>
                                <td><a href="admin-edit-product.php?code=<?php echo $productrow['product_code']; ?>" class="db-list-edit">Edit</a></td>
                                <td><a href="admin-delete-product.php?code=<?php echo $productrow['product_code']; ?>" class="db-list-edit">Delete</a></td>
                                <td><a href="<?php echo $webpage_full_link; ?>product/<?php echo $productrow['product_slug']; ?>" class="db-list-edit" target="_blank">Preview</a></td>
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
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
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