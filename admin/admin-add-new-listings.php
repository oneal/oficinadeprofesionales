<?php
include "header.php";
?>

<?php if($admin_row['admin_listing_options'] != 1){
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
                    <span class="udb-inst"><?php echo $BIZBOOK['ADD_NEW_LISTING'];?></span>
                    <div class="log log-1">
                        <div class="login">
                            <h4><?php echo $BIZBOOK['ADD_NEW_LISTING'];?></h4>
                            <div class="row cre-dup">
                                <div class="col-md-6">
                                    <a href="admin-add-new-listings-start.php"><?php echo $BIZBOOK['CREATE_SCRATCH_LISTING_LABEL'];?></a>
                                </div>
                                <div class="col-md-6">
                                    <a href="admin-create-duplicate-listing.php"><?php echo $BIZBOOK['CREATE_DUPLICATE_LISTING_LABEL'];?></a>
<!--                                    <span class="cre-dup-btn">Create duplicate listing</span>-->
                                </div>
                            </div>
                             <form class="cre-dup-form">
                                  <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                              <select class="form-control">
                                                <option>Elija qué lista va a copiar</option>
                                                    <option>The Real Finness for Womens</option>
                                                  <option>Lux Facial and Spa</option>
                                                  <option>3BHK flat for sale</option>
                                                  <option>All in one mechanic shop</option>
                                              </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                 <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                              <input type="text" class="form-control" placeholder="Nombre ficha*">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                <button type="submit" class="btn btn-primary"><?php echo $BIZBOOK['NEXT'];?></button>
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
</body>

</html>