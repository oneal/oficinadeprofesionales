<?php
include "header.php";
?>

<?php if($admin_row['admin_event_options'] != 1){
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
                            <span class="udb-inst"><?php echo $BIZBOOK['ADD_NEW_YEAR'];?></span>
                            <div class="log log-1">
                                <div class="login">
                                    <h4><?php echo $BIZBOOK['ADD_NEW_YEAR'];?></h4>
                                    <?php include "../page_level_message.php"; ?>
                                    <form name="year_form" id="year_form" method="post" action="insert_year_event.php" class="cre-dup-form cre-dup-form-show" enctype="multipart/form-data">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" id="year_name" name="year_name[]" class="form-control" placeholder="<?php echo $BIZBOOK['YEAR_NAME'];?> *" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <button type="submit" name="year_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>
                                    </form>
                                    <div class="col-md-12">
                                        <a href="admin-year-event.php" class="skip"><?php echo $BIZBOOK['GO_TO_ALL_YEAR'];?> >></a>
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