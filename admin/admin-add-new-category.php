<?phpinclude "header.php";?><?php if($admin_row['admin_category_options'] != 1){    header("Location: profile.php");}?>    <!-- START -->    <section>        <div class="ad-com">            <div class="ad-dash leftpadd">                 <section class="login-reg">		<div class="container">			<div class="row">                <div class="login-main add-list add-ncate">                     <div class="log-bor">&nbsp;</div>                    <span class="udb-inst"><?php echo $BIZBOOK['NEW_CATEGORY'];?></span>                    <div class="log log-1">                        <div class="login">                            <h4><?php echo $BIZBOOK['ADD_NEW_CATEGORY'];?></h4>                            <?php include "../page_level_message.php"; ?>                            <span class="add-list-add-btn cate-add-btn" data-toggle="tooltip" title="<?php echo $BIZBOOK['ADD_FIELD_CATEGORY'];?>">+</span>							<span class="add-list-rem-btn cate-rem-btn" data-toggle="tooltip" title="<?php echo $BIZBOOK['DELL_FIELD_CATEGORY'];?>">-</span>                             <form name="category_form" id="category_form" method="post" action="insert_category.php" class="cre-dup-form cre-dup-form-show" enctype="multipart/form-data">                                 <ul>                                     <li>                                        <div class="row">                                            <div class="col-md-12">                                                <div class="form-group">                                                  <input type="text" id="category_name" name="category_name[]" class="form-control" placeholder="<?php echo $BIZBOOK['CATEGORY_NAME'];?> *" required>                                                </div>                                            </div>                                            <div class="col-md-12">                                                <div class="form-group">                                                    <label><?php echo $BIZBOOK['CHOOSE_CATEGORY_IMAGE'];?></label>                                                  <input type="file" name="category_image[]" id="category_image" class="form-control" required>                                                </div>                                            </div>                                        </div>                                     </li>                                 </ul>                                <button type="submit" name="category_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>                            </form>                            <div class="col-md-12">                                    <a href="admin-all-category.php" class="skip"><?php echo $BIZBOOK['GO_TO_ALL_CATEGORY'];?> >></a>                                </div>                        </div>                    </div>                </div>			</div>		</div>	</section>            </div>        </div>    </section>    <!-- END -->        <!-- Optional JavaScript -->    <!-- jQuery first, then Popper.js, then Bootstrap JS -->    <script src="../js/jquery.min.js"></script>    <script src="../js/popper.min.js"></script>    <script src="../js/bootstrap.min.js"></script>    <script src="../js/jquery-ui.min.js"></script>    <script src="js/admin-custom.min.js"></script> <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script></body></html>