<?php
include "header.php";
?>
    <!-- START -->
	<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> abou-pg">
        <div class="about-ban comunity-ban">
            <h1><?php echo $BIZBOOK['BUSINESS_COMMUNITY'];?></h1>
            <p><?php echo $BIZBOOK['BUILD_YOUR_COMMUNITY'];?>.</p>
        </div>
        <div class="container">
            <div class="row">
                <div class="comity-all-user">
                    <ul>
                    <?php
    
                    foreach (getUserServiceProvider($_SESSION['user_id']) as $all_user_details_row) {

                        $all_user_id = $all_user_details_row['user_id'];

                        $all_list_count = getCountUserListing($all_user_id);

                        /*$all_event_count = getCountUserEvent($all_user_id);

                        $all_blog_count = getCountUserBlog($all_user_id);*/

                        ?>
                        <li>
                            <div class="pro-fol-gr">
                                <a href="<?php echo $webpage_full_link; ?>profesional/<?php echo $all_user_details_row['user_slug']; ?>" target="_blank">
                                    <img src="images/user/<?php if (($all_user_details_row['profile_image'] == NULL) || empty($all_user_details_row['profile_image'])) {
                                        echo $footer_row['user_default_image'];
                                    } else {
                                        echo $all_user_details_row['profile_image'];
                                    } ?>" title="<?php echo $all_user_details_row['first_name']; ?>" alt="<?php echo $all_user_details_row['first_name']; ?>">
                                    <h4><b><?php echo $all_user_details_row['first_name']; ?></b> </h4>
                                </a>
                                <ol>
                                    <li><b><?php echo $all_list_count; ?></b> <?php echo $BIZBOOK['LISTINGS'];?></li>
                                    <?php /*<li><b><?php echo $all_event_count; ?></b> Events</li>
                                    <li><b><?php echo $all_blog_count; ?></b> Blogs</li>*/?>
                                </ol>
                                <a href="<?php echo $webpage_full_link; ?>profesional/<?php echo $all_user_details_row['user_slug']; ?>" class="comm-viw-pro-btn" target="_blank"><?php echo $BIZBOOK['VIEW_PROFILE'];?></a>
                            </div>
                        </li>
                        <?php
                    }
                    ?>


                </ul>
                </div>
            </div>
        </div>
	</section>
	<!--END-->

   
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
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>
</body>

</html>

