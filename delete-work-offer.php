<?php 
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

//To redirect the general type user to dashboard to avoid using this page

if($user_details_row['user_type'] == "General") {
    header("Location: dashboard");
}

?>
<!-- START -->
<!--PRICING DETAILS-->
<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> login-reg">
    <div class="container">
        <div class="row">
            <div class="login-main add-list">
                <div class="log-bor">&nbsp;</div>
                <span class="steps"><?php echo $BIZBOOK['DELETE_WORK_OFFER']; ?></span>
                <div class="log">
                    <div class="login add-list-off">
                        <?php
                        $work_offer_codea = $_GET['code'];
                        $work_offer_a_row = getWorkOffer($work_offer_codea);

                        ?>
                        <h4><?php echo $BIZBOOK['DELETE_WORK_OFFER']; ?></h4>
                        <form action="work_offer_delete.php" class="blog_delete_form" id="blog_delete_form" name="blog_delete_form"
                              method="post" enctype="multipart/form-data">

                            <input type="hidden" id="work_offer_id" value="<?php echo $work_offer_a_row['work_offer_id']; ?>"
                                   name="work_offer_id" class="validate">
                            <input type="hidden" id="work_offer_image_old"
                                   value="<?php echo $work_offer_a_row['work_offer_image']; ?>" name="blog_image_old"
                                   class="validate">

                            <ul>
                                <li>
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name="blog_name"
                                                       value="<?php echo $work_offer_a_row['work_offer_name']; ?>" readonly="readonly" class="form-control" placeholder="<?php echo $BIZBOOK['WORK_OFFER_NAME']; ?>*">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="blog_description" readonly="readonly" class="form-control" placeholder="<?php echo $BIZBOOK['WORK_OFFER_DETAIL']; ?>"><?php echo $work_offer_a_row['work_offer_description']?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <div class="chbox">
                                                    <input type="checkbox" disabled="disabled" name="isenquiry" id="evefmenab" <?php if($work_offer_a_row['isenquiry'] == 1){ ?>checked="" <?php }?>>
                                                    <label for="evefmenab"><?php echo $BIZBOOK['ENQUIRY_BOX_ENABLE']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                </li>
                            </ul>
                            <!--FILED START-->
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="work_offer_submit" class="btn btn-primary"><?php echo $BIZBOOK['DELETE_WORK_OFFER']; ?></button>
                                </div>
                                <div class="col-md-12">
                                    <a href="dashboard" class="skip"><?php echo $BIZBOOK['GO_TO_USER_DASHBOARD']; ?> >></a>
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
<!--END PRICING DETAILS-->


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/custom.js"></script>
</body>

</html>