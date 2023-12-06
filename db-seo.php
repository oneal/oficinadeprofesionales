<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

include "dashboard_left_pane.php";

//To redirect the general type user to dashboard to avoid using this page

if ($user_details_row['user_type'] == "General") {
    header("Location: dashboard");
}
?>
    <!--CENTER SECTION-->
    <div class="ud-cen">
        <div class="log-bor">&nbsp;</div>
        <span class="udb-inst"><?php echo $BIZBOOK['SEO_DETAILS']; ?></span>
        <?php
        if ($user_details_row['user_status'] == 'Inactive') {
            ?>
            <div class="log-error use-act-err"><p><?php echo $BIZBOOK['IMPORTANT_PROFILE']; ?>.</p></div>
            <?php
        }
        ?>
        <div class="ud-cen-s2">
            <h2><?php echo $BIZBOOK['SEO_LABEL']; ?></h2>
            <?php include "page_level_message.php"; ?>
            <table class="responsive-table bordered">
                <thead>
                <tr>
                    <th><?php echo $BIZBOOK['S_NO']; ?></th>
                    <th><?php echo $BIZBOOK['NAME']; ?></th>
                    <th><?php echo $BIZBOOK['TYPE']; ?></th>
                    <th><?php echo $BIZBOOK['EDIT']; ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $k = 1;
                foreach (getAllListingUser($_SESSION['user_id']) as $seo_details_row) {
                    ?>
                    <tr>
                        <td><?php echo $k; ?></td>
                        <td><img
                                src="<?php if ($seo_details_row['profile_image'] != NULL || !empty($seo_details_row['profile_image'])) {
                                    echo "images/listings/" . $seo_details_row['profile_image'];
                                } else {
                                    echo "images/listings/hot4.jpg";
                                } ?>"><?php echo $seo_details_row['listing_name']; ?>
                            <span><?php echo dateFormatconverter($seo_details_row['listing_cdt']); ?></span>
                        </td>
                        <td><span class="db-list-ststus">Listing</span></td>
                        <td><a href="edit-seo?path=listing&&code=<?php echo $seo_details_row['listing_code']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT']; ?></a></td>
                    </tr>
                    <?php
                    $k++;
                }
                $s = $k;
                foreach (getAllUserEvents($_SESSION['user_id']) as $seo_details_row) {
                    ?>
                    <tr>
                        <td><?php echo $s; ?></td>
                        <td><img
                                src="images/events/<?php echo $seo_details_row['event_image']; ?>"><?php echo $seo_details_row['event_name']; ?>
                            <span><?php echo dateFormatconverter($seo_details_row['event_cdt']); ?></span>
                        </td>
                        <td><span class="db-list-ststus">Events</span></td>
                        <td><a href="edit-seo?path=event&&code=<?php echo $seo_details_row['event_id']; ?>" class="db-list-edit">Edit</a></td>
                    </tr>
                    <?php
                    $s++;
                }
                $p = $s;
                foreach (getAllUserBlogs($_SESSION['user_id']) as $seo_details_row) {
                    ?>
                    <tr>
                        <td><?php echo $p; ?></td>
                        <td><img
                                src="images/blogs/<?php echo $seo_details_row['blog_image']; ?>"><?php echo $seo_details_row['blog_name']; ?>
                            <span><?php echo dateFormatconverter($seo_details_row['blog_cdt']); ?></span>
                        </td>
                        <td><span class="db-list-ststus">Blogs</span></td>
                        <td><a href="edit-seo?path=blog&&code=<?php echo $seo_details_row['blog_id']; ?>" class="db-list-edit">Edit</a></td>
                    </tr>
                    <?php
                    $p++;
                }
                $q = $p;
                foreach (getAllProductUser($_SESSION['user_id']) as $seo_details_row) {
                    ?>
                    <tr>
                        <td><?php echo $q; ?></td>
                        <td>
                            <img
                                src="<?php if ($seo_details_row['gallery_image'] != NULL || !empty($seo_details_row['gallery_image'])) {
                                    echo "images/products/" . array_shift(explode(',', $seo_details_row['gallery_image']));
                                } else {
                                    echo "images/products/hot4.jpg";
                                } ?>"><?php echo $seo_details_row['product_name']; ?>
                            <span><?php echo dateFormatconverter($seo_details_row['product_cdt']); ?></span>
                        </td>
                        <td><span class="db-list-ststus">Products</span></td>
                        <td><a href="edit-seo?path=product&&code=<?php echo $seo_details_row['product_code']; ?>" class="db-list-edit">Edit</a></td>
                    </tr>
                    <?php
                    $q++;
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
    <!--RIGHT SECTION-->
<?php
include "dashboard_right_pane.php";
?>