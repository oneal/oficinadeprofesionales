<?php
include "header.php";
?>

<?php if($admin_row['admin_home_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['HOME_PAGE_CATEGORY'];?></span>
                <div class="ud-cen-s2 hcat-cho">
                    <h2><?php echo $BIZBOOK['HOME_PAGE_CATEGORY'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <table class="responsive-table bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $BIZBOOK['TRENDING_CATEGORY'];?></th>
                                <th><?php echo $BIZBOOK['BACKGROUND_IMAGE'];?></th>
                                <th><?php echo $BIZBOOK['THUMBNAIL_IMAGE'];?></th>
                                <th><?php echo $BIZBOOK['EDIT'];?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $si = 1;

                            foreach (getAllTrendCategories() as $row) {

                                $category_name= $row['category_name'];

                                $category_sql_row = getCategory($category_name);

                                ?>
                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $category_sql_row['category_name']; ?></td>
                                    <td>
                                        <img src="../images/services/<?php echo $row['category_bg_image']; ?>" title="<?php echo $category_sql_row['category_name']; ?>" alt="<?php echo $category_sql_row['category_name']; ?>">
                                    </td>
                                    <td>
                                        <img src="../images/services/<?php echo $row['category_image']; ?>" title="<?php echo $category_sql_row['category_name']; ?>" alt="<?php echo $category_sql_row['category_name']; ?>">
                                    </td>
                                    <td><a href="admin-trending-category-edit.php?row=<?php echo $row['category_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                </tr>
                                <?php
                                $si++;
                            }
                            ?>
                                <?php /*
                                <tr>
                                    <td>2</td>
                                    <td>Guym and fitness</td>
                                    <td>
                                       <img src="../images/services/2.jpg" alt=""> 
                                    </td>
                                    <td>
                                       <img src="../images/services/1.jpg" alt=""> 
                                    </td>
                                    <td><a href="admin-home-tren-category-edit.html" class="db-list-edit">Edit</a></td>
								</tr>
                                <tr>
                                    <td>3</td>
                                    <td>Hospital and midicals</td>
                                    <td>
                                       <img src="../images/services/3.jpg" alt=""> 
                                    </td>
                                    <td>
                                       <img src="../images/services/1.jpg" alt=""> 
                                    </td>
                                    <td><a href="admin-home-tren-category-edit.html" class="db-list-edit">Edit</a></td>
								</tr>
                                <tr>
                                    <td>4</td>
                                    <td>Car and bike</td>
                                    <td>
                                       <img src="../images/services/4.jpg" alt=""> 
                                    </td>
                                    <td>
                                       <img src="../images/services/1.jpg" alt=""> 
                                    </td>
                                    <td><a href="admin-home-tren-category-edit.html" class="db-list-edit">Edit</a></td>
								</tr>
                                 * 
                                 */?>
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