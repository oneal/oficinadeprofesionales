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
                 <section class="login-reg">
		<div class="container">
			<div class="row">
                <div class="login-main add-list posr">
                     <div class="log-bor">&nbsp;</div>
                    <span class="udb-inst"><?php echo $BIZBOOK['EDIT_CATEGORY'];?></span>
                    <div class="log log-1">
                        <div class="login">
                            <h4><?php echo $BIZBOOK['EDIT_CATEGORY'];?></h4>
                            <?php include "../page_level_message.php"; ?>
                            <?php
                            $category_id=$_GET['row'];
                            $row=getTrendCategory($category_id);

                            ?>
                            <form name="category_form" id="category_form" method="post" action="update_trending_category.php" enctype="multipart/form-data">

                                <input type="hidden" class="validate" id="category_id" name="category_id" value="<?php echo $row['category_id']; ?>" required="required">
                                <input type="hidden" class="validate" id="category_name_old" name="category_name_old" value="<?php echo $row['category_name']; ?>" required="required">
                                <input type="hidden" class="validate" id="category_image_old" name="category_image_old" value="<?php echo $row['category_image']; ?>" required="required">
                                <input type="hidden" class="validate" id="category_bg_image_old" name="category_bg_image_old" value="<?php echo $row['category_bg_image']; ?>" required="required">
                                <ul>
										<li>
                                     <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="category_name" class="form-control" id="category_name">

                                                    <?php
                                                    foreach (getAllCategories() as $li_row){
                                                        ?>
                                                        <option
                                                            value="<?php echo $li_row['category_id']; ?>" <?php if ($li_row['category_id'] == $row['category_name']) {
                                                            echo "selected";
                                                        } ?> ><?php echo $li_row['category_name']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo $BIZBOOK['BACKGROUND_IMAGE'];?></label>
                                                <input type="file" name="category_bg_image" class="form-control" id="category_bg_image">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                     <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo $BIZBOOK['THUMBNAIL_IMAGE'];?></label>
                                                <input type="file" name="category_image" class="form-control" id="category_image">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
									</li>
									</ul>
									<!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" name="trending_category_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="admin-home-category.php" class="skip"><?php echo $BIZBOOK['GO_TO_ALL_CATEGORY'];?> >></a>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                            </form>
                            <div class="ud-notes">
                                <p><b><?php echo $BIZBOOK['NOTES'];?>: </b><?php echo $BIZBOOK['IMG_COMPRESOR_CATEGORY'];?> </p>
                    </div>
                        </div>
                        
                    </div>
                </div>
			</div>
		</div>
	</section>

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