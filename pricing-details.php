<?php /*
include "header.php";

?>
<!-- START -->
<!--PRICING DETAILS-->
<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> pri">
    <div class="container">
        <div class="row">
            <div class="tit">
                <h2><?php echo $all_texts_row['price_title_1']; ?>
                    <span><?php echo $all_texts_row['price_title_2']; ?></span></h2>
                <p><?php echo $all_texts_row['price_sub_title']; ?></p>
            </div>
            <div>
                <ul>
                    <?php
                    $si = 1;
                    foreach (getAllPlanType() as $plan_type_row) {
                        ?>
                        <li>
                            <div class="pri-box">
                                <div class="c2">
                                    <h4><?php echo $plan_type_row['plan_type_name']; ?> plan</h4>

                                    <?php if ($plan_type_row['plan_type_id'] == 1) { ?>
                                        <p>For getting started</p>
                                    <?php } elseif ($plan_type_row['plan_type_id'] == 2) { ?>
                                        <p>Perfect for small teams</p>
                                    <?php } elseif ($plan_type_row['plan_type_id'] == 3) { ?>
                                        <p>Best value for large teams</p>
                                    <?php } else { ?>
                                        <p>Made for enterprises</p>
                                    <?php
                                    } ?>

                                </div>
                                <div class="c3">
                                    <h2><span></span><?php if ($plan_type_row['plan_type_price'] == 0) {
                                            echo "FREE";
                                        } else {
                                            echo $footer_row['currency_symbol'] . '' . $plan_type_row['plan_type_price'];
                                        } ?></h2>
                                    <?php if ($plan_type_row['plan_type_id'] == 1) { ?>
                                        <p>Single user</p>
                                    <?php } elseif ($plan_type_row['plan_type_id'] == 2) { ?>
                                        <p>Startup business</p>
                                    <?php } elseif ($plan_type_row['plan_type_id'] == 3) { ?>
                                        <p>Medium business</p>
                                    <?php } else { ?>
                                        <p>Global business</p>
                                        <?php
                                    } ?>

                                    <a href="<?php
                                    if (isset($_SESSION['user_id'])) { echo "db-plan-change"; }else{ echo "login"; }?>">Add listing</a>
                                </div>
                                <div class="c4">
                                    <ol>
                                        <li><?php if ($plan_type_row['plan_type_listing_count'] == 1000) {
                                                echo "Unlimited";
                                            } else {
                                                echo $plan_type_row['plan_type_listing_count'];
                                            } ?> listings
                                        </li>

                                        <li>
                                            <?php if ($plan_type_row['plan_type_duration'] >= 7) {
                                                echo $plan_type_row['plan_type_duration']/12 .' '."year(s)";
                                            } else {
                                                echo $plan_type_row['plan_type_duration'].' '."month(s)";
                                            } ?> (duration)</li>

                                        <li><?php if ($plan_type_row['plan_type_event_count'] == 1000) {
                                                echo "Unlimited";
                                            } else {
                                                echo $plan_type_row['plan_type_event_count'];
                                            } ?> events
                                        </li>

                                        <li><?php if ($plan_type_row['plan_type_blog_count'] == 1000) {
                                                echo "Unlimited";
                                            } else {
                                                echo $plan_type_row['plan_type_blog_count'];
                                            } ?> blog posts
                                        </li>

                                        <?php if ($plan_type_row['plan_type_direct_lead'] == 1) { ?>
                                            <li>Get direct leads</li>
                                        <?php } ?>

                                        <?php if ($plan_type_row['plan_type_email_notification'] == 1) { ?>
                                            <li>Email notification(leads)</li>
                                        <?php } ?>

                                        <?php if ($plan_type_row['plan_type_verified'] == 1) { ?>
                                            <li>Verified listing</li>
                                        <?php } ?>

                                        <?php if ($plan_type_row['plan_type_trusted'] == 1) { ?>
                                            <li>Trusted listing</li>
                                        <?php } ?>

                                        <?php if ($plan_type_row['plan_type_offers'] == 1) { ?>
                                            <li>Special offers</li>
                                        <?php } ?>

                                        <li>User dashboard</li>

                                        <li><?php if ($plan_type_row['plan_type_photos_count'] == 1000) {
                                                echo "Unlimited";
                                            } else {
                                                echo $plan_type_row['plan_type_photos_count'];
                                            } ?> photos
                                        </li>

                                        <li><?php if ($plan_type_row['plan_type_videos_count'] == 1000) {
                                                echo "Unlimited";
                                            } else {
                                                echo $plan_type_row['plan_type_videos_count'];
                                            } ?> videos
                                        </li>

                                        <li>Create duplicate listings</li>

                                        <?php if ($plan_type_row['plan_type_social'] == 1) { ?>
                                            <li>Social media share</li>
                                        <?php } ?>

                                        <?php if ($plan_type_row['plan_type_ratings'] == 1) { ?>
                                            <li>Review control</li>
                                        <?php } ?>

                                        <li>Admin tips</li>
                                    </ol>
                                </div>
                                <div class="c5">
                                    <a href="<?php
                                    if (isset($_SESSION['user_id'])) { echo "db-plan-change"; }else{ echo "login"; }?>">Get Start</a>
                                </div>
                            </div>
                        </li>
                        <?php
                        $si++;
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--END PRICING DETAILS-->


<section>
    <div class="pop-ups pop-quo">
        <!-- The Modal -->
        <div class="modal fade" id="quote">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="quote-pop">
                        <h4>Get quote</h4>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter name*" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter email*"
                                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                       title="Invalid email address" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter mobile number *"
                                       pattern="[7-9]{1}[0-9]{9}"
                                       title="Phone number starting with 7-9 and remaing 9 digit with 0-9" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3"
                                          placeholder="Enter your query or message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
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
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/custom.js"></script>
<?php
if (isset($_GET["page"])) {
    ?>
    <?php
    if (isset($_POST['SubmitButton'])) { // Check if form was submitted

        if (!empty($_FILES['inputText']['name'])) {
            $file = rand(1000, 100000) . $_FILES['inputText']['name'];
            $file_loc = $_FILES['inputText']['tmp_name'];
            $file_size = $_FILES['inputText']['size'];
            $file_type = $_FILES['inputText']['type'];
            $folder = "images/listings/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $event_image = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $event_image);
            $inputText1 = $event_image;
            $inputText = $inputText1;
        }
    }
    ?>
    <form action="#" enctype="multipart/form-data" method="post">
        <input type="file" name="inputText"/>
        <input type="submit" name="SubmitButton"/>
    </form>
    <?php
}
?>
</body>

</html>