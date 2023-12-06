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
                            <span class="udb-inst"><?php echo $BIZBOOK['EDIT_EVENT'];?></span>
                            <div class="log log-1">
                                <div class="login">
                                    <h4><?php echo $BIZBOOK['EDIT_EVENT'];?></h4>
                                    <?php include "../page_level_message.php"; ?>
                                    <?php
                                    $event_codea = $_GET['row'];
                                    $events_a_row = getEvent($event_codea);

                                    ?>
                                    <form action="update_event.php" class="event_edit_form" id="event_edit_form" name="event_edit_form"
                                          method="post" enctype="multipart/form-data">
                                        <input type="hidden" id="event_id" value="<?php echo $events_a_row['event_id']; ?>"
                                               name="event_id" class="validate">
                                        <input type="hidden" id="event_image_old"
                                               value="<?php echo $events_a_row['event_image']; ?>" name="event_image_old"
                                               class="validate">
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
                                                                    <option <?php if($events_a_row['user_id']== $row['admin_id']){ echo "selected"; } ?>
                                                                        value="<?php echo $row['admin_id']; ?>"><?php echo $row['admin_name']; ?></option>
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
                                                            <input type="text" name="event_name" required="required" class="form-control"
                                                                   value="<?php echo $events_a_row['event_name']; ?>" placeholder="<?php echo $BIZBOOK['EVENT_NAME'];?> *">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" name="event_address" required="required" class="form-control"
                                                                   value="<?php echo $events_a_row['event_address']; ?>"  placeholder="<?php echo $BIZBOOK['ADDRESS'];?> *">
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
                                                                    <option <?php if($events_a_row['year_id'] == $row['year_id']){ echo "selected"; } ?>
                                                                            value="<?php echo $row['year_id']; ?>"><?php echo $row['year_name']; ?></option>
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
                                                            <?php
                                                            $timestamp = strtotime($events_a_row['event_start_date']);
                                                            $event_start_date = date('d-m-Y', $timestamp);
                                                            ?>
                                                            <input type="text" id="event_start_date" name="event_start_date" required="required" class="form-control"
                                                                   value="<?php echo $event_start_date; ?>" placeholder="<?php echo $BIZBOOK['DATE'];?> *">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="event_time" required="required" class="form-control"
                                                                   value="<?php echo $events_a_row['event_time']; ?>" placeholder="<?php echo $BIZBOOK['TIME'];?> *">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea class="form-control" required="required" id="event_description" name="event_description"
                                                                      placeholder="<?php echo $BIZBOOK['EVENT_DETAILS'];?>"><?php echo $events_a_row['event_description']?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea class="form-control" name="event_map"
                                                                      placeholder="<?php echo $BIZBOOK['GOOGLE_MAP_LOCATION'];?>"><?php echo $events_a_row['event_map']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label><?php echo $BIZBOOK['CHOOSE_BANNER_IMAGE'];?></label>
                                                            <input type="file" name="event_image" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="event_contact_name" required="required" class="form-control"
                                                                   value="<?php echo $events_a_row['event_contact_name']; ?>" placeholder="<?php echo $BIZBOOK['CONTACT_PERSON'];?> *">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="tel" name="event_mobile" required="required" class="form-control"
                                                                   value="<?php echo $events_a_row['event_mobile']; ?>" placeholder="<?php echo $BIZBOOK['CONTACT_PHONE_NUMBER'];?> *">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->

                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="email" name="event_email" required="required" class="form-control"
                                                                   value="<?php echo $events_a_row['event_email']; ?>" placeholder="<?php echo $BIZBOOK['CONTACT_EMAIL_ID'];?> *">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="event_website" class="form-control"
                                                                   value="<?php echo $events_a_row['event_website']; ?>" placeholder="<?php echo $BIZBOOK['EVENT_WEBSITE'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->

                                                <?php /*<!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div>
                                                            <div class="chbox">
                                                                <input type="checkbox" id="isenquiry" name="isenquiry" <?php if($events_a_row['isenquiry'] == 1){ ?> checked="" <?php }?>>
                                                                <label for="isenquiry"><?php echo $BIZBOOK['ENQUIRY_BOX_ENABLE'];?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->*/?>
                                            </li>
                                        </ul>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" name="event_submit" class="btn btn-primary"><?php echo $BIZBOOK['SAVE_CHANGES'];?></button>
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
<script src="js/admin-custom.js"></script> 
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('event_description');
</script>
</body>

</html>