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
                    <a href="admin-add-new-category.php" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_CATEGORY'];?></a>
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
                            foreach (getAllCategories() as $row) {

                                $category_id = $row['category_id'];

                                $category_listing_count = getCountCategoryListing($category_id);

                                $category_sub_category_count = getCountSubCategoryCategory($category_id);

                                ?>
                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><b class="db-list-rat"><?php echo $row['category_name']; ?></b></td>
                                    <td><img src="../images/services/<?php echo $row['category_image']; ?>" alt=""></td>
                                    <td><?php echo dateFormatconverter($row['category_cdt']); ?></td>
                                    <td><span class="db-list-ststus" data-toggle="tooltip"
                                              title="<?php echo $BIZBOOK['TOTAL_LISTINGS_CATEGORY'];?>"><?php echo $category_listing_count; ?></span></td>
                                    <?php /*<td><span class="db-list-ststus"><?php echo $category_sub_category_count; ?></span></td>*/?>
                                    <td><a href="admin-category-edit.php?row=<?php echo $row['category_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                    <?php /*<td><a href="admin-all-sub-category.php?cat=<?php echo $row['category_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['VIEW'];?></a></td>*/?>
                                    <td><a href="admin-category-delete.php?row=<?php echo $row['category_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
                                </tr>
                                <?php
                                $si++;
                            }
                            ?>
                                <?php /*
                                <tr>
                                    <td>2</td>
                                    <td><b class="db-list-rat">Car service centers</b></td>
                                    <td><img src="../images/services/1.jpg" alt=""></td>
									<td>8 June 2025</td>
                                    <td><span class="db-list-ststus" data-toggle="tooltip" title="Total listings in this category">576</span></td>
                                    <td><span class="db-list-ststus">12</span></td>
									<td><a href="admin-category-edit.html" class="db-list-edit">Edit</a></td>
                                    <td><a href="admin-view-sub-category.html" class="db-list-edit">View</a></td>
									<td><span class="db-list-edit">Delete</span></td>
								</tr>
                                <tr>
                                    <td>3</td>
                                    <td><b class="db-list-rat">Schools</b></td>
                                    <td><img src="../images/services/2.jpg" alt=""></td>
									<td>8 June 2025</td>
                                    <td><span class="db-list-ststus" data-toggle="tooltip" title="Total listings in this category">759</span></td>
                                    <td><span class="db-list-ststus">12</span></td>
									<td><a href="admin-category-edit.html" class="db-list-edit">Edit</a></td>
                                    <td><a href="admin-view-sub-category.html" class="db-list-edit">View</a></td>
									<td><span class="db-list-edit">Delete</span></td>
								</tr>
                                <tr>
                                    <td>4</td>
                                    <td><b class="db-list-rat">Hotels and Restrants</b></td>
                                    <td><img src="../images/services/4.jpg" alt=""></td>
									<td>8 June 2025</td>
                                    <td><span class="db-list-ststus" data-toggle="tooltip" title="Total listings in this category">864</span></td>
                                    <td><span class="db-list-ststus">12</span></td>
									<td><a href="admin-category-edit.html" class="db-list-edit">Edit</a></td>
                                    <td><a href="admin-view-sub-category.html" class="db-list-edit">View</a></td>
									<td><span class="db-list-edit">Delete</span></td>
								</tr>
                                <tr>
                                    <td>5</td>
                                    <td><b class="db-list-rat">Web design company</b></td>
                                    <td><img src="../images/services/5.jpg" alt=""></td>
									<td>8 June 2025</td>
                                    <td><span class="db-list-ststus" data-toggle="tooltip" title="Total listings in this category">45</span></td>
                                    <td><span class="db-list-ststus">12</span></td>
									<td><a href="admin-category-edit.html" class="db-list-edit">Edit</a></td>
                                    <td><a href="admin-view-sub-category.html" class="db-list-edit">View</a></td>
									<td><span class="db-list-edit">Delete</span></td>
								</tr>
                                <tr>
                                    <td>6</td>
                                    <td><b class="db-list-rat">Play schools</b></td>
                                    <td><img src="../images/services/6.jpg" alt=""></td>
									<td>8 June 2025</td>
                                    <td><span class="db-list-ststus" data-toggle="tooltip" title="Total listings in this category">54</span></td>
                                    <td><span class="db-list-ststus">12</span></td>
									<td><a href="admin-category-edit.html" class="db-list-edit">Edit</a></td>
                                    <td><a href="admin-view-sub-category.html" class="db-list-edit">View</a></td>
									<td><span class="db-list-edit">Delete</span></td>
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