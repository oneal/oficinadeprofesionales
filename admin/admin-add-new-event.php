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
                <div class="login-main add-list posr">
                     <div class="log-bor">&nbsp;</div>
                    <span class="udb-inst"><?php echo $BIZBOOK['CREATE_EVENT'];?></span>
                    <div class="log log-1">
                        <div class="login">
                            <h4><?php echo $BIZBOOK['CREATE_EVENT'];?></h4>
                            <?php include "../page_level_message.php"; ?>
                             <form  name="event_form" id="event_form" method="post" action="insert_event.php" enctype="multipart/form-data">
									<ul>
										<li>
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <select name="user_id" required="required" class="form-control" id="user_id">
                                                    <option value=""><?php echo $BIZBOOK['CHOOSE_USER'];?></option>
                                                    <?php
                                                    foreach (getAllAdmin() as $row) {
                                                        ?>
                                                        <option value="<?php echo $row['admin_id']; ?>"><?php echo $row['admin_name']; ?></option>
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
                                              <input type="text" name="event_name" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['EVENT_NAME'];?> *">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                              <input type="text" name="event_address" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['ADDRESS'];?> *">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <select name="year_id" required="required" class="form-control" id="user_id">
                                                    <option value=""><?php echo $BIZBOOK['YEAR_NAME'];?></option>
                                                    <?php
                                                    foreach (getAllYearEvents() as $row) {
                                                        ?>
                                                        <option value="<?php echo $row['year_id']; ?>"><?php echo $row['year_name']; ?></option>
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <input type="text" id="event_start_date" name="event_start_date" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['DATE'];?> *">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <input type="text" name="event_time" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['TIME'];?> *">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                  <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" required="required" id="event_description" name="event_description" placeholder="<?php echo $BIZBOOK['EVENT_DETAILS'];?>"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" name="event_map" placeholder="<?php echo $BIZBOOK['GOOGLE_MAP_LOCATION'];?>"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
									<!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo $BIZBOOK['CHOOSE_BANNER_IMAGE'];?></label>
                                              <input type="file" name="event_image" required="required" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <input type="text" name="event_contact_name" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['CONTACT_PERSON'];?> *">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <input type="tel" name="event_mobile" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['CONTACT_PHONE_NUMBER'];?> *">
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                            <!--FILED START-->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input  type="email" name="event_email" required="required" class="form-control"
                                                                placeholder="<?php echo $BIZBOOK['CONTACT_EMAIL_ID'];?> *">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" name="event_website" class="form-control"
                                                               placeholder="<?php echo $BIZBOOK['EVENT_WEBSITE'];?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--FILED END-->
                                    <?php /*<!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <div class="chbox">
                                                    <input type="checkbox" id="isenquiry" name="isenquiry" checked="">
                                                    <label for="isenquiry"><?php echo $BIZBOOK['ENQUIRY_BOX_ENABLE'];?></label>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->   */?> 
									</li>
									</ul>
									<!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" name="event_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                            </form>
                            <div class="col-md-12">
                                <a href="profile.php" class="skip"><?php echo $BIZBOOK['GO_TO_DASHBOARD'];?> >></a>
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
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('event_description');
</script>
</body>

</html>