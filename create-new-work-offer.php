<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

//To redirect the general type user to dashboard to avoid using this page

if($user_details_row['user_type'] == "General") {
    header("Location: dashboard");
}

//To check the blogs count with current plan starts



?>
    <!-- START -->
    <!--PRICING DETAILS-->
	<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> login-reg">
		<div class="container">
			<div class="row">
                <div class="login-main add-list">
                     <div class="log-bor">&nbsp;</div>
                   <span class="steps"><?php echo $BIZBOOK['ADD_WORK_OFFER']; ?></span>
                    <div class="log">
                        <div class="login add-list-off">
                            
                            <h4><?php echo $BIZBOOK['CREATE_WORK_OFFER']; ?></h4>
                             <form action="work_offer_insert.php" class="work_offers_form" id="work_offers_form" name="work_offers_form"
                                   method="post" enctype="multipart/form-data">
									<ul>
										<li>
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                              <input type="text" name="work_offers_name" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['TITLE']; ?>*">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                  <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="work_offers_description" id="work_offers_description" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['WORK_OFFER_DETAIL']; ?>"></textarea>
                                            </div>
                                        </div>
                                    </div>
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
                                    <!--FILED END-->    
									</li>
									</ul>
									<!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" name="work_offers_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT']; ?></button>
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
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>
<script src="admin/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('work_offers_description');
</script>
<script>
    function getCities(val) {
        $.ajax({
            type: "POST",
            url: "city_process.php",
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