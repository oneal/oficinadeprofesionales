<?php
include "header.php";
?>
<?php if($admin_row['admin_city_options'] != 1){
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
                    <span class="udb-inst"><?php echo $BIZBOOK['NEW_SUB_REGION'];?></span>
                    <div class="log log-1">
                        <div class="login">
                            <h4><?php echo $BIZBOOK['ADD_NEW_SUB_REGION'];?></h4>
                            <?php include "../page_level_message.php"; ?>
                            <span class="add-list-add-btn city-add-btn" data-toggle="tooltip" title="<?php echo $BIZBOOK['ADD_FIELD_SUB_REGION'];?>">+</span>
                            <span class="add-list-rem-btn city-rem-btn" data-toggle="tooltip" title="<?php echo $BIZBOOK['DELL_FIELD_SUB_REGION'];?>">-</span>
                            <form name="city_form" id="city_form" method="post" action="insert_city.php" enctype="multipart/form-data" class="cre-dup-form cre-dup-form-show">
                                <ul>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select name="country_id" required="required" id="country_id"
                                                            class="form-control">
                                                        <option value=""><?php echo $BIZBOOK['ADD_NEW_SUB_REGION'];?></option>
                                                        <?php
                                                        //Countries Query
                                                            foreach (getAllStates(1) as $state_row) {
                                                                ?>
                                                                <option <?php if ($_SESSION['state_id'] == $state_row['state_id']) {
                                                                    echo "selected";
                                                                } ?>
                                                                    value="<?php echo $state_row['state_id']; ?>"><?php echo $state_row['state_name']; ?></option>
                                                                <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="city_name[]" class="form-control" placeholder="<?php echo $BIZBOOK['SUB_REGION_NAME'];?> *" required>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <button type="submit" name="city_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>
                            </form>
                            <div class="col-md-12">
                                    <a href="admin-all-city.php" class="skip"><?php echo $BIZBOOK['GO_TO_ALL_SUB_REGION'];?> >></a>
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
    <script src="js/admin-custom.js"></script>
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>