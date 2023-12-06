<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

include "dashboard_left_pane.php";

$session_user_id = $user_details_row['user_id'];


?>
    <!--CENTER SECTION-->
    <div class="ud-cen">
        <div class="log-bor">&nbsp;</div>
        <span class="udb-inst"><?php echo $BIZBOOK['USER_DASHBOARD']; ?></span>
        <?php
        if ($user_details_row['user_status'] == 'Inactive') {
            ?>
            <div class="log-error use-act-err"><p><?php echo $BIZBOOK['IMPORTANT_PROFILE'];?>.</p></div>
            <?php
        }
        ?>
        <div class="ud-cen-s1">
            <ul>
                <?php
                if ($user_details_row['user_type'] == "General") { ?>
                    <li>
                        <div>
                            <h4><?php echo $BIZBOOK['ALL_REVIEWS']; ?></h4>
                            <p><?php echo $BIZBOOK['TOTAL_NO_OF_REVIEWS']; ?></p>
                            <b><?php echo AddingZero_BeforeNumber(getCountSentReview($session_user_id)); ?></b>
                            <?php /*<a href="db-notifications">&nbsp;</a>*/?>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h4><?php echo $BIZBOOK['LIKED_LISTINGS']; ?></h4>
                            <p><?php echo $BIZBOOK['NO_OF_LIKED_LISTINGS']; ?></p>
                            <b><?php echo AddingZero_BeforeNumber(getCountLikedListing($session_user_id)); ?></b>
                            <a href="db-like-listings">&nbsp;</a>
                        </div>
                    </li>
                <?php } else { ?>
                    <li>
                        <div>
                            <h4><?php echo $BIZBOOK['ALL_LISTING']; ?></h4>
                            <p><?php echo $BIZBOOK['TOTAL_NO_LISTINGS']; ?></p>
                            <b><?php echo AddingZero_BeforeNumber(getCountUserListing($session_user_id)); ?></b>
                            <a href="db-all-listing">&nbsp;</a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h4><?php echo $BIZBOOK['ENQUIRIES']; ?></h4>
                            <p><?php echo $BIZBOOK['TOTAL_NO_ENQUIRY']; ?></p>
                            <b><?php echo AddingZero_BeforeNumber(getCountUserEnquiries($session_user_id)); ?></b>
                            <a href="db-enquiry">&nbsp;</a>
                        </div>
                    </li>
                <?php } ?>
                <li>
                    <div>
                        <h4><?php echo $BIZBOOK['PROFESSIONALS_FOLLOWS']; ?></h4>
                        <p><?php echo $BIZBOOK['TOTAL_NO_PROFESSIONALS_WE_FOLLOWS']; ?></p>
                        <b><?php echo AddingZero_BeforeNumber(getCountUserFollowing($session_user_id)); ?></b>
                        <a href="db-followings">&nbsp;</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="ud-cen-s3 ud-cen-s4">
            <h2><?php echo $BIZBOOK['PROFILE_PAGE']; ?></h2>
            <a href="db-my-profile-edit" class="db-tit-btn"><?php echo $BIZBOOK['EDIT_MY_PROFILE']; ?></a>
            <div class="ud-payment ud-pro-link">
                <div class="pay-lhs">
                    <img
                        src="images/user/<?php if (($user_details_row['profile_image'] == NULL) || empty($user_details_row['profile_image'])) {
                            echo $footer_row['user_default_image'];
                        } else {
                            echo $user_details_row['profile_image'];
                            } ?>" title="<?php echo $user_details_row['first_name']; ?>" alt="<?php echo $user_details_row['first_name']; ?>">
                </div>
                <div class="pay-rhs">
                    <ul>
                        <li><b><?php echo $BIZBOOK['NAME']; ?> : </b> <?php echo $user_details_row['first_name']; ?></li>
                        <li><b><?php echo $BIZBOOK['FOLLOWERS']; ?> : </b> <span><?php $user = getUser($session_user_id);
                                if ($user['user_followers'] == NULL) {
                                    echo "00";
                                } else {
                                    echo AddingZero_BeforeNumber(count(explode(",", $user['user_followers'])));
                                } ?></span></li>
                        <li><b><?php echo $BIZBOOK['CITY']; ?> : </b> <?php if($user_details_row['user_city']== NULL){ echo "N/A"; } else{ echo $user_details_row['user_city']; } ?></li>
                        <li><b><?php echo $BIZBOOK['EMAIL']; ?> : </b> <?php echo $user_details_row['email_id']; ?></li>
                        <li class="pro"><input type="text"
                                               value="<?php echo $webpage_full_link; ?>profesional/<?php echo $user_details_row['user_slug']; ?>"
                                               readonly></li>
                        <li class="pre"><a target="_blank" href="<?php echo $webpage_full_link; ?>profesional/<?php echo $user_details_row['user_slug']; ?>"><?php echo $BIZBOOK['VIEW_MY_PROFILE_PAGE']; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="ud-cen-s2">
            <h2><?php echo $BIZBOOK['LISTING_DETAILS']; ?></h2>
            <a href="add-listing-start" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_LISTING']; ?></a>
            <table class="responsive-table bordered">
                <thead>
                <tr>
                    <th><?php echo $BIZBOOK['S_NO']; ?></th>
                    <th><?php echo $BIZBOOK['LISTING_NAME']; ?></th>
                    <th><?php echo $BIZBOOK['RATING']; ?></th>
                    <th><?php echo $BIZBOOK['VIEWS']; ?></th>
<!--                    <th>Expiry on</th>-->
                    <th><?php echo $BIZBOOK['STATUS']; ?></th>
                    <th><?php echo $BIZBOOK['EDIT']; ?></th>
                    <th><?php echo $BIZBOOK['DELETE']; ?></th>
                    <th><?php echo $BIZBOOK['PREVIEW']; ?></th>
                </tr>
                </thead>
                <tbody>

                <?php

                $si = 1;
                foreach (getAllListingUser($_SESSION['user_id']) as $listrow) {

                    $reviewlisting_id = $listrow['listing_id'];

                    //  List Rating. for Rating of Star starts

                    foreach (getListingReview($reviewlisting_id) as $Star_rateRow) {
//                            $Star_rateRow = getListingReview($reviewlisting_id);

                        if ($Star_rateRow["rate_cnt"] > 0) {
                            $Star_rate_times = $Star_rateRow["rate_cnt"];
                            $Star_sum_rates = $Star_rateRow["total_rate"];
                            $star_rate_one = $Star_sum_rates / $Star_rate_times;
                            //$star_rate_one = (($Star_rate_value)/5)*100;
                            $star_rate_two = number_format($star_rate_one, 1);
                            $star_rate = floatval($star_rate_two);

                        } else {
                            $rate_times = 0;
                            $rate_value = 0;
                            $star_rate = 0;
                        }
                    }
                    //  List Rating. for Rating of Star Ends

                    ?>

                    <tr>
                        <td><?php echo $si; ?></td>
                        <td><img
                                src="<?php if ($listrow['profile_image'] != NULL || !empty($listrow['profile_image'])) {
                                    echo $slash."images/listings/" . $listrow['profile_image'];
                                } else {
                                    echo $slash."images/listings/hot4.jpg";
                                } ?>"><?php echo $listrow['listing_name']; ?>
                            <span><?php echo dateFormatconverter($listrow['listing_cdt']); ?></span></td>
                        <td><span class="db-list-rat"><?php echo $star_rate; ?></span></td>
                        <td><span class="db-list-rat"><?php echo pageview_count($listrow['listing_id']); ?></span></td>
<!--                        <td><span class="db-list-ststus">8 June 2020</span></td>-->
                        <td><span class="db-list-ststus"><?php echo $listrow['listing_status']; ?></span></td>
                        <td><a href="edit-listing-step-1?row=<?php echo $listrow['listing_code']; ?>"
                               class="db-list-edit"><?php echo $BIZBOOK['EDIT']; ?></a></td>
                        <td><a href="delete-listing?row=<?php echo $listrow['listing_code']; ?>"
                               class="db-list-edit"><?php echo $BIZBOOK['DELETE']; ?></a></td>
                        <td><a href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $listrow['listing_slug']; ?>" class="db-list-edit" target="_blank"><?php echo $BIZBOOK['PREVIEW']; ?></a></td>
                    </tr>
                    <?php
                    $si++;
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php /*<div class="ud-cen-s3">
            <h2><?php echo $BIZBOOK['EVENTS']; ?></h2>
            <a href="create-new-event" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_EVENT']; ?></a>
            <ul>
                <?php foreach (getAllUserEvents($_SESSION['user_id']) as $eventrow) { ?>
                    <li>
                        <div class="db-eve">
                            <a href="<?php echo $webpage_full_link; ?>event/<?php echo preg_replace('/\s+/', '-', strtolower($eventrow['event_slug'])); ?>">
                                <img src="images/events/<?php echo $eventrow['event_image']; ?>" alt="">
                                <h5><?php echo $eventrow['event_name']; ?></h5>
                                <span><?php echo $BIZBOOK['CREATED']; ?>: <?php echo dateFormatconverter($eventrow['event_cdt']); ?></span>
                            </a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="ud-cen-s3 ud-cen-s4">
            <h2><?php echo $BIZBOOK['BLOG_POSTS']; ?></h2>
            <a href="create-new-blog-post" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_POST']; ?></a>
            <ul>
                <?php foreach (getAllUserBlogs($_SESSION['user_id']) as $blogrow) { ?>
                    <li>
                        <div class="db-eve">
                            <a href="<?php echo $webpage_full_link; ?>blog/<?php echo preg_replace('/\s+/', '-', strtolower($blogrow['blog_slug'])); ?>">
                                <img src="images/blogs/<?php echo $blogrow['blog_image']; ?>" alt="">
                                <h5><?php echo $blogrow['blog_name']; ?></h5>
                                <span><?php echo $BIZBOOK['CREATED']; ?>: <?php echo dateFormatconverter($blogrow['blog_cdt']); ?></span>
                            </a>
                        </div>
                    </li>
                    <?php } ?>
            </ul>
        </div>*/?>

    </div>
<?php
include "dashboard_right_pane.php";
?>