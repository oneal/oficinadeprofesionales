<?php /*
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}
include "dashboard_left_pane.php";

//To redirect the general type user to dashboard to avoid using this page

if($user_details_row['user_type'] == "General") {
    header("Location: dashboard");
}

?>
    <!--CENTER SECTION-->
    <div class="ud-cen">
        <div class="log-bor">&nbsp;</div>
        <span class="udb-inst"><?php echo $BIZBOOK['BLOG_POSTS']; ?></span>
        <?php
        if ($user_details_row['user_status'] == 'Inactive') {
            ?>
            <div class="log-error use-act-err"><p>Important: Your Profile has not been activated yet. You can create your Listings, Events, Blogs. But it will be posted after profile activation.</p></div>
            <?php
        }
        ?>
        <div class="ud-cen-s2">
            <h2><?php echo $BIZBOOK['BLOG_DETAILS']; ?></h2>
            <?php include "page_level_message.php"; ?>
            <a href="create-new-blog-post" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_POST']; ?></a>
            <table class="responsive-table bordered">
                <thead>
                <tr>
                    <th><?php echo $BIZBOOK['S_NO']; ?></th>
                    <th><?php echo $BIZBOOK['POST_NAME']; ?></th>
                    <th><?php echo $BIZBOOK['VIEWS']; ?></th>
                    <th><?php echo $BIZBOOK['EDIT']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>
                    <th><?php echo $BIZBOOK['PREVIEW']; ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $si = 1;
                foreach (getAllUserBlogs($_SESSION['user_id']) as $blogrow) {
                    
                    ?>
                    <tr>
                        <td><?php echo $si; ?></td>
                        <td><?php echo $blogrow['blog_name']; ?> <span><?php echo dateFormatconverter($blogrow['blog_cdt']); ?></span></td>
                        <td><span class="db-list-rat"><?php  echo blog_pageview_count($blogrow['blog_id']); ?></span></td>
                        <td><a href="edit-blog-post?code=<?php echo $blogrow['blog_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT']; ?></a></td>
                        <td><a href="delete-blog-post?code=<?php echo $blogrow['blog_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE']; ?></a></td>
                        <td><a href="<?php echo $webpage_full_link; ?>blog/<?php echo preg_replace('/\s+/', '-', strtolower($blogrow['blog_slug'])); ?>" class="db-list-edit" target="_blank"><?php echo $BIZBOOK['PREVIEW']; ?></a></td>
                    </tr>
                    <?php
                    $si++;
                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
<?php
include "dashboard_right_pane.php";
?>