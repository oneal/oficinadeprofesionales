<?php /*
include "header.php";
?>

<?php if ($admin_row['admin_home_options'] != 1) {
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
                    <span class="udb-inst"><?php echo $BIZBOOK['TOP_SERVICE_CATEGORY'];?></span>
                    <div class="log log-1">
                        <div class="login">
                            <h4><?php echo $BIZBOOK['CHOOSE_TOP_SERVICE_CATEGORY'];?></h4>
                            <?php include "../page_level_message.php"; ?>
                            <?php
                            $category_id = $_GET['row'];
                            $top_service_provider_id = $_GET['col'];
                            ?>

                            <form name="home_top_service_category_form" id="home_top_service_category_form" method="post" action="update_top_service_category.php" class="cre-dup-form cre-dup-form-show">
                                <input type="hidden" class="validate" id="category_id_old" name="category_id_old" value="<?php echo $category_id; ?>" required="required">
                                <input type="hidden" class="validate" id="top_service_provider_id" name="top_service_provider_id" value="<?php echo $top_service_provider_id; ?>" required="required">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="category_id" class="form-control" id="category_id">
                                                <?php
                                                foreach (getAllCategories() as $cat_row) {

                                                    ?>
                                                    <option <?php if($cat_row['category_id']== $category_id){ echo "selected"; } ?>
                                                        value="<?php echo $cat_row['category_id']; ?>"><?php echo $cat_row['category_name']; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                </br>
                                <button type="submit" name="home_top_service_category_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>
                            </form>
                            <div class="col-md-12">
                                    <a href="admin-home-top-services.php" class="skip"><?php echo $BIZBOOK['GO_TO_TOP_SERVICE'];?> >></a>
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