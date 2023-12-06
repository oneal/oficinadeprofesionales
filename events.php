<?php
include "header.php";

if (isset($_GET['select_year'])) {
    $values = explode("/", $_GET['select_year']);
    if (count($values) == 1) {
        $select_year = $values[0];
    } else {
        $select_year = "";
    }

    $year_id = 0;
    if ($select_year != "") {
        $year_sql = "SELECT * FROM  " . TBL . "year_events where year_slug='" . $select_year . "'";
        $year_rs = mysqli_query($conn, $year_sql);
        $year_row = mysqli_fetch_array($year_rs);
        $year_search_name = $year_row['year_name'];
        $year_id = $year_row['year_id'];
    }
}
?>
    <!-- START -->
<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> blog-head eve-head">
    <div class="container">
        <div class="blog-head-inn">
            <h1><?php echo $BIZBOOK['EVENTS'];?></h1>
            <p><?php echo $BIZBOOK['HERE_POST_YOUR_EVENT'];?></p>
        </div>
        <div class="ban-search">
            <form>
                <ul>
                    <li class="sr-sea">
                        <input type="text" id="event-search" class="autocomplete" placeholder="<?php echo $BIZBOOK['SEARCH'];?>...">
                    </li>
                    <li class="sr-sea mt-3">
                        <select name="year_id" required="required" class="form-control" id="year_id">
                            <option value=""><?php echo $BIZBOOK['YEAR_NAME'];?></option>
                            <?php
                            foreach (getAllYearEvents() as $row) {
                                ?>
                                <option <?php if($year_search_name == $row['year_name']){ echo "selected"; } ?>
                                        value="<?php echo $row['year_slug']; ?>"><?php echo $row['year_name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</section>
	<!--END-->
    
    <!-- START -->
	<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> event-body">
		<div class="container">
			<div class="us-ppg-com">
                <ul id="intseres">
                    <?php
                    $si = 1;
                    foreach (getAllActiveEvents($year_id) as $eventrow) {

                        $user_id = $eventrow['user_id'];

                        $user_details_row = getAdmin($user_id);

                        ?>
                        <li>
                            <div class="eve-box">
                                <div>
                                    <a href="<?php echo $webpage_full_link; ?>evento/<?php echo $eventrow['event_slug']; ?>">
                                        <img src="<?php echo $webpage_full_link; ?>images/events/<?php echo $eventrow['event_image']; ?>" title="<?php echo $eventrow['event_name']; ?>" alt="<?php echo $eventrow['event_name']; ?>">
                                        <span><?php  echo dateMonthFormatconverter($eventrow['event_start_date']); ?> <b><?php  echo dateDayFormatconverter($eventrow['event_start_date']); ?></b></span>
                                    </a>
                                </div>
                                <div>
                                    <h4><a href="<?php echo $webpage_full_link; ?>evento/<?php echo $eventrow['event_slug']; ?>"><?php echo $eventrow['event_name']; ?></a></h4>
                                    <span
                                        class="addr"><?php echo $eventrow['event_address']; ?></span>
                                    <span class="pho"><?php echo $eventrow['event_mobile']; ?></span>
                                </div>
                                <div>
                                    <div class="auth">
                                        <img src="images/user/<?php if (($user_details_row['admin_photo'] == NULL) || empty($user_details_row['admin_photo'])) { echo "1.jpg"; } else { echo $user_details_row['admin_photo'];} ?>" title="<?php echo $user_details_row['first_name']; ?>" alt="<?php echo $user_details_row['first_name']; ?>">
                                        <b><?php echo $BIZBOOK['HOSTED_BY'];?></b><br>
                                        <h4><?php echo $user_details_row['admin_name']; ?></h4>
                                        <?php /*<a target="_blank" href="<?php echo $webpage_full_link; ?>profile.php/<?php echo $user_details_row['user_slug']; ?>" class="fclick"></a>*/?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>

		</div>
	</section>
	<!--END-->

    <section>
        <div class="pop-ups pop-quo">
        <!-- The Modal -->
          <div class="modal fade" id="quote">
            <div class="modal-dialog">
              <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- Modal Header -->
                <div class="quote-pop">
                    <h4><?php echo $BIZBOOK['GET_QOUTE'];?></h4>
                     <form>
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_NAME'];?>*" required>
                        </div>
                         <div class="form-group">
                          <input type="email" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_EMAIL'];?>*" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" title="<?php echo $BIZBOOK['INVALID_EMAIL'];?>" required>
                        </div>
                         <div class="form-group">
                          <input type="text" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_MOBILE'];?> *" required>
                        </div>
                        <div class="form-group">
                          <textarea class="form-control" rows="3" placeholder="<?php echo $BIZBOOK['ENQUIRY_MESSAGE'];?>"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>
                    </form>
                </div>
                  <div class="log-bor">&nbsp;</div>
              </div>
            </div>
          </div>
        </div>
    </section>
<?php
include "footer.php";
?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo $slash;?>js/jquery.min.js"></script>
    <script src="<?php echo $slash;?>js/popper.min.js"></script>
    <script src="<?php echo $slash;?>js/bootstrap.min.js"></script>
    <script src="<?php echo $slash;?>js/jquery-ui.js"></script>
    <script src="<?php echo $slash;?>js/custom.js"></script>
</body>

</html>