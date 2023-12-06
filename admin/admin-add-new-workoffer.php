<?php
include "header.php";
?>

<?php if($admin_row['admin_work_offer_options'] != 1){
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
                            <span class="udb-inst"><?php echo $BIZBOOK['ADD_NEW_OFFER'];?></span>
                            <div class="log log-1">
                                <div class="login">
                                    <h4><?php echo $BIZBOOK['ADD_NEW_OFFER'];?></h4>
                                    <?php include "../page_level_message.php"; ?>
                                    <form name="work_offer_form" id="work_offer_form" method="post" action="insert_work_offer.php" enctype="multipart/form-data">
                                        <ul>
                                            <li>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <select name="user_id" required="required" class="form-control" id="user_id">
                                                                <option value=""><?php echo $BIZBOOK['CHOOSE_USER'];?></option>
                                                                <?php
                                                                foreach (getAllUser() as $row) {
                                                                    ?>
                                                                    <option value="<?php echo $row['user_id']; ?>"><?php echo $row['first_name']; ?></option>
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
                                                            <input type="text" name="work_offer_name" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['TITLE'];?> *">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea name="work_offer_description" id="work_offer_description" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['STORE_DETAILS'];?>"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="select-cate"><?php echo $BIZBOOK['CATEGORIES'];?></label>
                                                            <select name="select-cate" id="select-cate" class="form-control" required="true">
                                                                <option value=""><?php echo $BIZBOOK['SELECT_CATEGORY']; ?></option>
                                                                <?php
                                                                foreach (getAllCategoriesWorkOffer() as $categories_row) {?>
                                                                    <option value="<?php echo $categories_row['category_id']; ?>"><?php echo $categories_row['category_name']; ?></option>
                                                                    <?php
                                                                }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="select-cate"><?php echo $BIZBOOK['STATES'];?></label>
                                                            <select onChange="getCities(this.value);" name="select-state" id="select-state" class="form-control" required="true">
                                                                <option value=""><?php echo $BIZBOOK['SELECT_YOUR_STATE']; ?></option>
                                                                <?php
                                                                foreach (getAllStates(1) as $state_row) { ?>
                                                                    <option value="<?php echo $state_row['state_id']; ?>"><?php echo $state_row['state_name']; ?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="select-cate"><?php echo $BIZBOOK['SUB_REGIONS'];?></label>
                                                            <select  class="form-control" name="select-city" id="select-city" required="true">
                                                                <option value=""><?php echo $BIZBOOK['SELECT_YOUR_CITY']; ?></option>
                                                                <?php foreach (getAllCitiesIdState(0) as $city_row) {?>
                                                                    <option value="<?php echo $city_row['city_id']; ?>"><?php echo $city_row['city_name']; ?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div>
                                                            <div class="chbox">
                                                                <input type="checkbox" name="isenquiry" id="evefmenab" checked="">
                                                                <label for="evefmenab"><?php echo $BIZBOOK['ENQUIRY_BOX_ENABLE']; ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" name="work_offer_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                    </form>
                                    <div class="col-md-12">
                                        <a href="admin-all-workoffer.php" class="skip"><?php echo $BIZBOOK['GO_TO_WORKOFFERT'];?> >></a>
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
    CKEDITOR.replace('work_offer_description');
</script>
<script>
    function getCities(val) {
        $.ajax({
            type: "POST",
            url: "<?php echo $webpage_full_link; ?>city_process.php",
            data: 'state_id=' + val,
            success: function (data) {
                $("#select-city").html(data);
                $('#select-city').trigger("chosen:updated");
            }
        });
    }
</script>
</body>

</html>