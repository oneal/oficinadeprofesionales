<?php
include "header.php";
?>

<?php if ($admin_row['admin_import_options'] != 1) {
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
                            <span class="udb-inst"><?php echo $BIZBOOK['IMPORT_DATA'];?></span>
                            <div class="log log-1">
                                <div class="login">
                                    <h4><?php echo $BIZBOOK['IMPORT_DATA'];?></h4>
                                    <?php include "../page_level_message.php"; ?>
                                    <form name="upload_bulk_form" id="upload_bulk_form" method="post"
                                          action="update_upload_bulk_listings.php" enctype="multipart/form-data">
                                        <?php /*
                                        <input type="hidden" class="validate" id="ad_id"
                                               name="ad_id"
                                               value="--><?php //echo $row['ad_id']; ?>" required="required">*/?>
                                        <ul>
                                            <li>

                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><?php echo $BIZBOOK['CHOOSE_IMPORT_FILE'];?></label>
                                                            <input type="file" name="file" id="file" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                            </li>
                                        </ul>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" name="upload_bulk_submit" class="btn btn-primary"><?php echo $BIZBOOK['IMPORT_NOW'];?></button>
                                            </div>
                                            <div class="col-md-12">
                                                <a href="profile.php" class="skip"><?php echo $BIZBOOK['GO_TO_DASHBOARD'];?> >></a>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                    </form>
                                    <div class="ud-notes">
                                        <p><b><?php echo $BIZBOOK['NOTES'];?>:</b> <?php echo $BIZBOOK['TEXT_IMPORT'];?>
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