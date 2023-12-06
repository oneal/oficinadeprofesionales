<?php
include "header.php";
?>

<?php if($admin_row['admin_blog_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
				<div class="log-bor">&nbsp;</div>
				<span class="udb-inst"><?php echo $BIZBOOK['BLOGS'];?></span>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['BLOGS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="<?php echo $BIZBOOK['SEARCH']?>...">
                    </div>
                    <a href="admin-add-new-blogs.php" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_POST'];?></a>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $BIZBOOK['POST_NAME'];?></th>
                                <th><?php echo $BIZBOOK['CREATED_BY'];?></th>
                                <th><?php echo $BIZBOOK['VIEWS'];?></th>
                                <th><?php echo $BIZBOOK['EDIT'];?></th>
                                <th><?php echo $BIZBOOK['DELETE'];?></th>
                                <th><?php echo $BIZBOOK['PREVIEW'];?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $si =1;
                            foreach (getAllBlogs() as $blogrow) {
                                $user_id = $blogrow['user_id'];

                                $user_details_row = getAdmin($user_id);

                            ?>
                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $blogrow['blog_name']; ?> <span><?php  echo dateFormatconverter($blogrow['blog_cdt'])?></span></td>
                                    <td><a href="#" class="db-list-ststus"><?php echo $user_details_row['admin_name']; ?></a></td>
                                    <td><span class="db-list-rat"><?php  echo blog_pageview_count($blogrow['blog_id']); ?></span></td>
                                    <td><a href="admin-edit-blogs.php?row=<?php echo $blogrow['blog_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                    <td><a href="admin-delete-blogs.php?row=<?php echo $blogrow['blog_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
                                    <td><a href="<?php echo $webpage_full_link; ?>blog/<?php echo $blogrow['blog_slug']; ?>" class="db-list-edit" target="_blank"><?php echo $BIZBOOK['PREVIEW'];?></a></td>
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