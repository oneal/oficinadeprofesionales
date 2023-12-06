<?php
include "header.php";
?>

<?php if($admin_row['admin_ads_options'] != 1){
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
                            <span class="udb-inst"><?php echo $BIZBOOK['ADD_NEW_IMAGES'];?></span>
                            <div class="log log-1">
                                <div class="login">
                                    <h4><?php echo $BIZBOOK['ADD_NEW_IMAGES'];?></h4>
                                    <?php include "../page_level_message.php"; ?>
                                    <form name="slider_form" id="slider_form" method="post" action="insert_new_slider.php" enctype="multipart/form-data">

                                        <ul>
                                            <li>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><?php echo $BIZBOOK['CHOOSE_SLIDER_IMAGE'];?></label>
                                                            <input type="file" name="slider_photo" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea  id="slider_link"  name="slider_link" class="form-control" placeholder="<?php echo $BIZBOOK['SLIDER_IMAGE_EXTERNAL_LINK'];?>" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                        </ul>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" name="slider_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>
                                            </div>
                                            <div class="col-md-12">
                                                <a href="profile.php" class="skip"><?php echo $BIZBOOK['GO_TO_DASHBOARD'];?> >></a>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                    </form>
                                    <?php /*<div class="ud-notes">
                                        <p><b>Notes:</b> Hi, Before submit your <b>Ads</b> please check the <b>available date</b> because previous Ads running in same date. Kindly check this manually</p>
                                    </div>*/?>
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