<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}
include "dashboard_left_pane.php";
?>
    <!--CENTER SECTION-->
    <div class="ud-cen">
        <div class="log-bor">&nbsp;</div>
        <span class="udb-inst"><?php echo $BIZBOOK['PROFESSIONALS_FOLLOWS'];?></span>
        <?php
        if ($user_details_row['user_status'] == 'Inactive') {
            ?>
            <div class="log-error use-act-err"><p><?php echo $BIZBOOK['IMPORTANT_PROFILE'];?>.</p></div>
            <?php
        }
        ?>
        <div class="ud-cen-s2">
            <h2><?php echo $BIZBOOK['PROFESSIONALS_FOLLOWS'];?></h2>
            <?php include "page_level_message.php"; ?>
            <a href="db-all-users" class="db-tit-btn"><?php echo $BIZBOOK['VIEW_ALL_USERS'];?></a>
            <div class="db-fol-grid">
                <ul>
                    <?php

                     foreach (getUserFollowing($_SESSION['user_id']) as $all_user_details_row) {

                     $all_user_id = $all_user_details_row['user_id'];

                     $all_list_count = getCountUserListing($all_user_id);

                     //$all_event_count = getCountUserEvent($all_user_id);

                     //$all_blog_count = getCountUserBlog($all_user_id);

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
                             <span class="userfollow follow-content<?php echo $all_user_id ?>"
                                   data-item="<?php echo $all_user_id; ?>"
                                   data-num="<?php echo $_SESSION['user_id']; ?>"><?php echo $BIZBOOK['FOLLOWING'];?></span>
                         </div>
                     </li>
                     <?php
                 }
                     ?>

                </ul>
            </div>
        </div>
    </div>
<?php
include "dashboard_right_pane.php";
?>