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
                 <section class="login-reg">
		<div class="container">
			<div class="row">
                <div class="login-main add-list posr">
                     <div class="log-bor">&nbsp;</div>
                    <span class="udb-inst"><?php echo $BIZBOOK['EDIT_BLOG_POST'];?></span>
                    <div class="log log-1">
                        <div class="login">
                            <h4><?php echo $BIZBOOK['EDIT_THIS_BLOG_POST'];?></h4>
                            <?php include "../page_level_message.php"; ?>
                            <?php
                            $blog_codea = $_GET['row'];
                            $blogs_a_row = getBlog($blog_codea);

                            ?>
                            <form action="update_blog.php" class="blog_edit_form" id="blog_edit_form" name="blog_edit_form"
                                  method="post" enctype="multipart/form-data">
                                <input type="hidden" id="blog_id" value="<?php echo $blogs_a_row['blog_id']; ?>"
                                       name="blog_id" class="validate">
                                <input type="hidden" id="blog_image_old"
                                       value="<?php echo $blogs_a_row['blog_image']; ?>" name="blog_image_old"
                                       class="validate">
                                <ul>
                                    <li>
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="user_id" required="required" class="form-control" id="user_id">
                                                    <option value=""><?php echo $BIZBOOK['CHOOSE_USER'];?></option>
                                                    <?php
                                                    foreach (getAllAdmin() as $row) {
                                                        ?>
                                                        <option <?php if($blogs_a_row['user_id']== $row['admin_id']){ echo "selected"; } ?>
                                                            value="<?php echo $row['admin_id']; ?>"><?php echo $row['admin_name']; ?></option>
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
                                                <input type="text" name="blog_name"
                                                       value="<?php echo $blogs_a_row['blog_name']; ?>" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['POST_NAME'];?> *">                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                  <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="blog_description" required="required" id="blog_description" class="form-control" placeholder="<?php echo $BIZBOOK['POST_DETAILS'];?>"><?php echo $blogs_a_row['blog_description']?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
									<!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo $BIZBOOK['CHOOSE_BANNER_IMAGE'];?></label>
                                                <input type="file" name="blog_image" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <?php /*<!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <div class="chbox">
                                                    <input type="checkbox" name="isenquiry" id="evefmenab" <?php if($blogs_a_row['isenquiry'] == 1){ ?>checked="" <?php }?>>
                                                    <label for="evefmenab"><?php echo $BIZBOOK['ENQUIRY_BOX_ENABLE'];?></label>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->   */?> 
  
									</li>
									</ul>
									<!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" name="blog_submit" class="btn btn-primary"><?php echo $BIZBOOK['SAVE_CHANGES'];?></button>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                            </form>
                            <div class="col-md-12">
                                <a href="profile.php" class="skip"><?php echo $BIZBOOK['GO_TO_DASHBOARD'];?> >></a>
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
<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('blog_description');
</script>
</body>

</html>