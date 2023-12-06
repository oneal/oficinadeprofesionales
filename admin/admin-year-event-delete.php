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
                            <span class="udb-inst"><?php echo $BIZBOOK['DELETE_YEAR_EVENT'];?></span>
                            <div class="log log-1">
                                <div class="login">
                                    <h4><?php echo $BIZBOOK['DELETE_YEAR_EVENT'];?></h4>
                                    <?php include "../page_level_message.php"; ?>
                                    <?php
                                    $year_id=$_GET['row'];
                                    $row= getYearEvent($year_id) ;

                                    ?>
                                    <form name="year_form" id="year_form" method="post" action="trash_year_event.php" enctype="multipart/form-data" class="cre-dup-form cre-dup-form-show">
                                        <input type="hidden" class="validate" id="year_id" name="year_id" value="<?php echo $row['year_id']; ?>" required="required">

                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" readonly="readonly"  id="year_name" name="year_name" value="<?php echo $row['year_name']; ?>"  placeholder="<?php echo $BIZBOOK['YEAR_NAME'];?> *" required>
                                                        </div>
                                                    </div>
                                                </div>

                                            </li>
                                        </ul>
                                        <button type="submit" name="year_submit" class="btn btn-primary"><?php echo $BIZBOOK['DELETE'];?></button>
                                    </form>
                                    <div class="col-md-12">
                                        <a href="admin-category-store.php" class="skip"><?php echo $BIZBOOK['GO_TO_ALL_YEAR'];?> >></a>
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