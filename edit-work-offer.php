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
                   <span class="steps"><?php echo $BIZBOOK['EDIT_WORK_OFFER']; ?></span>
                    <div class="log">
                        <div class="login add-list-off">
                            <?php
                            $work_offer_codea = $_GET['code'];
                            $work_offers_row = getWorkOffer($work_offer_codea);

                            ?>
                                <h4><?php echo $BIZBOOK['EDIT_THIS_WORK_OFFER']; ?></h4>
                             <form action="work_offer_update.php" class="work_offer_edit_form" id="work_offer_edit_form" name="work_offer_edit_form"
                                   method="post" enctype="multipart/form-data">

                                 <input type="hidden" id="work_offer_id" value="<?php echo $work_offers_row['work_offer_id']; ?>"
                                        name="work_offer_id" class="validate">
                                 <input type="hidden" id="work_offer_image_old"
                                        value="<?php echo $work_offers_row['work_offer_image']; ?>" name="work_offer_image_old"
                                        class="validate">
                                 
									<ul>
										<li>
                                            <!--FILED START-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="work_offer_name" 
                                                               value="<?php echo $work_offers_row['work_offer_name']; ?>" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['TITLE']; ?>*">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--FILED END-->
                                            <!--FILED START-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea name="work_offer_description" id="work_offer_description" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['WORK_OFFER_DETAIL']; ?>"><?php echo $work_offers_row['work_offer_description']?></textarea>
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
                                                                <option <?php if ($work_offers_row['category_id'] == $categories_row['category_id']) {
                                                                    echo 'selected';
                                                                } ?> value="<?php echo $categories_row['category_id']; ?>"><?php echo $categories_row['category_name']; ?></option>
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
                                                                <option <?php if ($work_offers_row['state_id'] == $state_row['state_id']) {
                                                                    echo 'selected';
                                                                } ?> value="<?php echo $state_row['state_id']; ?>"><?php echo $state_row['state_name']; ?></option>
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
                                                            <?php foreach (getAllCitiesIdState($work_offers_row['state_id']) as $city_row) {?>
                                                                <option <?php if ($work_offers_row['city_id'] == $city_row['city_id']) {
                                                                    echo 'selected';
                                                                } ?> value="<?php echo $city_row['city_id']; ?>"><?php echo $city_row['city_name']; ?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--FILED START-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div>
                                                        <div class="chbox">
                                                            <input type="checkbox" name="isenquiry" id="evefmenab" <?php if($work_offers_row['isenquiry'] == 1){ ?>checked="" <?php }?>>
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
                                            <button type="submit" name="work_offer_submit" class="btn btn-primary"><?php echo $BIZBOOK['SAVE_CHANGES']; ?></button>
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
<script src="admin/ckeditor/ckeditor.js"></script>
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