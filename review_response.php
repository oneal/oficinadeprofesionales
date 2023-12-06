<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}
include "dashboard_left_pane.php";

$review_id = $_GET['review'];

$review_row = getReview($review_id);
$review_response_row = getReviewResponse($review_id);
?>
    <!--CENTER SECTION-->
    <div class="ud-cen">
        <div class="log-bor">&nbsp;</div>
        <span class="udb-inst"><?php echo $BIZBOOK['REVIEW_RESPONSE'];?></span>
        <div class="ud-cen-s2">
            <h5><?php echo $BIZBOOK['REVIEW_RESPONSE'];?></h5>
            <hr/>
            <div class="db-fol-grid">
                <?php include "page_level_message.php"; ?>
                <h2><?php echo $BIZBOOK['REVIEW_MESSAGE'];?></h2>
                <p>
                    <?php echo $review_row['review_message'];?>
                </p>
                <form action="<?php if($review_response_row){?>review_response_edit.php<?php }else{?>review_response_add.php<?php }?>" id="review_response_form"
                      name="review_response_form" method="post" enctype="multipart/form-data">
                    <!--FILED START-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" id="review_response_message"
                                    name="review_response_message"
                                    placeholder="<?php echo $BIZBOOK['DETAILS_ABOUT_LISTING']; ?>"><?php if($review_response_row){ echo $review_response_row['response_message']; }?></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="review_id" name="review_id" value="<?php echo $review_row['review_id'];?>"/>
                    <button type="submit" name="review_response_submit" class="btn btn-primary"><?php echo $BIZBOOK['SAVED'];?></button>
                </form>
            </div>
        </div>
    </div>
    
    <!--END PRICING DETAILS-->
<?php
include "footer.php";
?>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/select-opt.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>

</body>

</html>

