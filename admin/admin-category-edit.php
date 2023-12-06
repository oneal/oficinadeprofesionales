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
                 <section class="login-reg">
		<div class="container">
			<div class="row">
                <div class="login-main add-list add-ncate">
                     <div class="log-bor">&nbsp;</div>
                    <span class="udb-inst"><?php echo $BIZBOOK['EDIT'];?> <?php echo $BIZBOOK['CATEGORY'];?></span>
                    <div class="log log-1">
                        <div class="login">
                            <h4><?php echo $BIZBOOK['EDIT'];?> <?php echo $BIZBOOK['CATEGORY'];?></h4>
                            <?php include "../page_level_message.php"; ?>
                            <?php
                            $category_id=$_GET['row'];
                            $row= getCategory($category_id);
                            ?>
                             <form name="category_form" id="category_form" method="post" action="update_category.php" enctype="multipart/form-data" class="cre-dup-form cre-dup-form-show">
                                 <input type="hidden" class="validate" id="category_id" name="category_id" value="<?php echo $row['category_id']; ?>" required="required">
                                 	<input type="hidden" class="validate" id="category_image_old" name="category_image_old" value="<?php echo $row['category_image']; ?>" required="required">

                                 <ul>
                                     <li>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                  <input type="text" class="form-control"  id="category_name" name="category_name" value="<?php echo $row['category_name']; ?>"  placeholder="<?php echo $BIZBOOK['CATEGORY_NAME'];?> *" required>
                                                </div>
                                            </div>
                                        </div>
                                          <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><?php echo $BIZBOOK['CHOOSE_CATEGORY_IMAGE'];?></label>
                                                  <input type="file" class="form-control" name="category_image" id="category_image">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                     </li>
                                 </ul>
                                <button type="submit" name="category_submit" class="btn btn-primary"><?php echo $BIZBOOK['SAVED'];?></button>
                            </form>
                            <div class="col-md-12">
                                    <a href="admin-all-category.php" class="skip"><?php echo $BIZBOOK['GO_TO_ALL_CATEGORY'];?> >></a>
                                </div>
                            <div class="ud-notes">
                                <p><b><?php echo $BIZBOOK['NOTES'];?>:</b> <?php echo $BIZBOOK['IMG_COMPRESOR_CATEGORY'];?>. <br><?php echo $BIZBOOK['IMG_COMPRESSING'];?>: <a href="https://tinypng.com" target="_blank">tinypng.com</a></p>
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