<?php
include "header.php";
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
                    <span class="udb-inst"><?php echo $BIZBOOK['NEW_MARCA'];?></span>
                    <div class="log log-1">
                        <div class="login">
                            <h4><?php echo $BIZBOOK['NEW_MARCA'];?></h4>
                            <?php include "../page_level_message.php"; ?>
                            <form name="marca_form" id="marca_form" method="post" action="insert_home_marca.php" enctype="multipart/form-data">

                                <ul>
                                    <li>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="marca_name"
                                                           class="form-control" value=""
                                                           placeholder="<?php echo $BIZBOOK['NAME'];?> *">
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                        <textarea class="form-control" name="marca_descripcion"
                                                                  placeholder="<?php echo $BIZBOOK['SEO_DESCRIPTION'];?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><?php echo $BIZBOOK['CHOOSE_IMAGE'];?></label>
                                                    <input type="file" name="marca_image" class="form-control">
                                                </div>
                                            </div>
                                        </div>
									</li>
                                </ul>
                                <!--FILED START-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="home_marca_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>
                                    </div>
                                    <div class="col-md-12">
                                        <a href="admin-home-marcas-sector.php" class="skip"><?php echo $BIZBOOK['GO_TO_ALL_MARCAS'];?> >></a>
                                    </div>
                                </div>
                                <!--FILED END-->
                            </form>

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