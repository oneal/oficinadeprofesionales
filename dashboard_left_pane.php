<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */
?>

<!-- START -->
<!--PRICING DETAILS-->
<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> ud">
    <div class="ud-inn">
        <!--LEFT SECTION-->
        <div class="ud-lhs">
            <div class="ud-lhs-s1">
                <img src="images/user/<?php if(($user_details_row['profile_image'] == NULL) || empty($user_details_row['profile_image'])){  echo $footer_row['user_default_image'];}else{ echo $user_details_row['profile_image']; } ?>" title="<?php echo $user_details_row['first_name']; ?>" alt="<?php echo $user_details_row['first_name']; ?>">
                <h4><?php echo $user_details_row['first_name']; ?></h4>
                <b><?php echo $BIZBOOK['JOIN_ON'];?> <?php echo dateFormatconverter($user_details_row['user_cdt'])?></b>
            </div>
            <div class="ud-lhs-s2">
                <ul>
                    <li>
                        <a href="dashboard" class="<?php if ($current_page == "dashboard.php"){ echo "db-lact"; }?>"><img src="images/icon/dbl1.png" title="<?php echo $BIZBOOK['MY_DASHBOARD']; ?>" alt="<?php echo $BIZBOOK['MY_DASHBOARD']; ?>" /> <?php echo $BIZBOOK['MY_DASHBOARD']; ?></a>
                    </li>
                    <?php if($user_details_row['user_type']== "Service provider") {  //To Check User type is Service provider ?>
                          <li>
                              <a href="db-all-listing" class="<?php if ($current_page == "db-all-listing.php") {
                                  echo "db-lact";
                                  } ?>"><img src="images/icon/dbl7.png" title="<?php echo $BIZBOOK['ALL_LISTING']; ?>" alt="<?php echo $BIZBOOK['ALL_LISTING']; ?>"/> <?php echo $BIZBOOK['ALL_LISTING']; ?></a>
                          </li>
                          <li>
                              <a href="add-listing-start"><img src="images/icon/dbl3.png" title="<?php echo $BIZBOOK['ADD_NEW_LISTING']; ?>" alt="<?php echo $BIZBOOK['ADD_NEW_LISTING']; ?>"/> <?php echo $BIZBOOK['ADD_NEW_LISTING']; ?></a>
                          </li>
                          <li>
                              <a href="db-claims" class="<?php if ($current_page == "db-claims.php") {
                                  echo "db-lact";
                                  } ?>"><img src="images/icon/dbl14.png" title="<?php echo $BIZBOOK['LEAD_CLAIMS']; ?>" alt="<?php echo $BIZBOOK['LEAD_CLAIMS']; ?>"/> <?php echo $BIZBOOK['LEAD_CLAIMS']; ?></a>
                          </li>
                          <li>
                              <a href="db-enquiry" class="<?php if ($current_page == "db-enquiry.php") {
                                  echo "db-lact";
                                  } ?>"><img src="images/icon/dbl14.png" title="<?php echo $BIZBOOK['LEAD_ENQUIRY']; ?>" alt="<?php echo $BIZBOOK['LEAD_ENQUIRY']; ?>"/> <?php echo $BIZBOOK['LEAD_ENQUIRY']; ?></a>
                          </li>
                          <li>
                                <a href="db-work-offers" class="<?php if ($current_page == "db-work-offers.php") {
                                    echo "db-lact";
                                } ?>"><img src="images/icon/dbl7.png" title="<?php echo $BIZBOOK['ALL_WORK_OFFERS']; ?>" alt="<?php echo $BIZBOOK['ALL_WORK_OFFERS']; ?>"/> <?php echo $BIZBOOK['ALL_WORK_OFFERS']; ?></a>
                          </li>

                          <li>
                                <a href="db-enquiry-work-offers" class="<?php if ($current_page == "db-enquiry-work-offers.php") {
                                    echo "db-lact";
                                } ?>"><img src="images/icon/dbl14.png" title="<?php echo $BIZBOOK['ALL_ENQUERIES_WORK_OFFERS']; ?>" alt="<?php echo $BIZBOOK['ALL_ENQUERIES_WORK_OFFERS']; ?>"/> <?php echo $BIZBOOK['ALL_ENQUERIES_WORK_OFFERS']; ?></a>
                          </li>
                          <?php /*<li>
                              <a href="db-products" class="<?php if ($current_page == "db-products.php") {
                                  echo "db-lact";
                              } ?>"><img src="images/icon/dbl7.png" alt=""/> <?php echo $BIZBOOK['ALL_PRODUCTS']; ?></a>
                          </li>*/?>
                          <?php /*<li>
                              <a href="db-events" class="<?php if ($current_page == "db-events.php") {
                                  echo "db-lact";
                              } ?>"><img src="images/icon/dbl4.png" alt=""/> <?php echo $BIZBOOK['EVENTS']; ?></a>
                          </li>*/?>
                          <?php /*<li>
                              <a href="db-blog-posts" class="<?php if ($current_page == "db-blog-posts.php") {
                                  echo "db-lact";
                              } ?>"><img src="images/icon/dbl10.png" alt=""/> <?php echo $BIZBOOK['BLOG_POSTS']; ?></a>
                          </li>*/?>
                          <li>
                              <a href="db-seo" class="<?php if ($current_page == "db-seo.php") {
                                  echo "db-lact";
                                  } ?>"><img src="images/icon/seo.png" title="<?php echo $BIZBOOK['SEO']; ?>" alt="<?php echo $BIZBOOK['SEO']; ?>"/> <?php echo $BIZBOOK['SEO']; ?></a>
                          </li>
                          <?php
                      }
                    ?>
                    <li>
                        <a href="db-review" class="<?php if ($current_page == "db-review.php"){ echo "db-lact"; }?>"><img src="images/icon/dbl13.png" title="<?php echo $BIZBOOK['REVIEWS']; ?>" alt="<?php echo $BIZBOOK['REVIEWS']; ?>" /> <?php echo $BIZBOOK['REVIEWS']; ?></a>
                    </li>
                    <li>
                        <a href="db-my-profile" class="<?php if ($current_page == "db-my-profile.php" || $current_page == "db-my-profile-edit"){ echo "db-lact"; }?>"><img src="images/icon/dbl6.png" title="<?php echo $BIZBOOK['MY_PROFILE']; ?>" alt="<?php echo $BIZBOOK['MY_PROFILE']; ?>" /> <?php echo $BIZBOOK['MY_PROFILE']; ?></a>
                    </li>
                    <li>
                        <a href="db-like-listings" class="<?php if ($current_page == "db-like-listings.php"){ echo "db-lact"; }?>"><img src="images/icon/dbl15.png" title="<?php echo $BIZBOOK['LIKED_LISTINGS']; ?>" alt="<?php echo $BIZBOOK['LIKED_LISTINGS']; ?>" /> <?php echo $BIZBOOK['LIKED_LISTINGS']; ?></a>
                    </li>
                    <li>
                        <a href="db-followings" class="<?php if ($current_page == "db-followings.php"){ echo "db-lact"; }?>"><img src="images/icon/dbl18.png" title="<?php echo $BIZBOOK['PROFESSIONALS_FOLLOWS']; ?>" alt="<?php echo $BIZBOOK['PROFESSIONALS_FOLLOWS']; ?>" /> <?php echo $BIZBOOK['PROFESSIONALS_FOLLOWS']; ?></a>
                    </li>
                    <?php
                    if($user_details_row['user_type']== "Service provider") {  //To Check User type is Service provider
                        ?>
                        <?php /*<li>
                            <a href="db-post-ads" class="<?php if ($current_page == "db-post-ads.php") {
                                echo "db-lact";
                            } ?>"><img src="images/icon/dbl11.png" alt=""/> <?php echo $BIZBOOK['AD_SUMMARY']; ?></a>
                        </li>*/?>
                        <?php /*<li>
                            <a href="db-payment" class=" <?php if ($current_page == "db-payment.php") {
                                echo "db-lact";
                           } ?>"><img src="images/icon/dbl9.png" alt=""><?php //echo $BIZBOOK['CHECK_OUT']; ?></a>
                        </li>*/?>
                        <li>
                            <a href="db-invoice-all" class="<?php if ($current_page == "db-invoice-all.php") {
                                echo "db-lact";
                            } ?>"><img src="images/icon/dbl16.png" title="<?php echo $BIZBOOK['PAYMENT_INVOICE']; ?>" alt="<?php echo $BIZBOOK['PAYMENT_INVOICE']; ?>"/><?php echo $BIZBOOK['PAYMENT_INVOICE']; ?></a>
                        </li>
                        <?php
                    }
                    ?>
                    <?php /*<li>
                        <a href="db-notifications" class="<?php if ($current_page == "db-notifications.php"){ echo "db-lact"; }?>"><img src="images/icon/dbl19.png" title="<?php echo $BIZBOOK['NOTIFICATIONS']; ?>" alt="<?php echo $BIZBOOK['NOTIFICATIONS']; ?>" /> <?php echo $BIZBOOK['NOTIFICATIONS']; ?></a>
                    </li>*/?>
                    <li>
                        <a href="how-to" class="<?php if ($current_page == "how-to.php"){ echo "db-lact"; }?>" target="_blank"><img src="images/icon/dbl17.png" title="<?php echo $BIZBOOK['HOW_TOS']; ?>" alt="<?php echo $BIZBOOK['HOW_TOS']; ?>" /> <?php echo $BIZBOOK['HOW_TOS']; ?></a>
                    </li>
                    <li>
                        <a href="db-setting" class="<?php if ($current_page == "db-setting.php"){ echo "db-lact"; }?>"><img src="images/icon/dbl210.png" title="<?php echo $BIZBOOK['SETTING']; ?>" alt="<?php echo $BIZBOOK['SETTING']; ?>" /> <?php echo $BIZBOOK['SETTING']; ?></a>
                    </li>
                    <li>
                        <a href="logout"><img src="images/icon/dbl12.png" title="<?php echo $BIZBOOK['LOG_OUT']; ?>" alt="<?php echo $BIZBOOK['LOG_OUT']; ?>" /> <?php echo $BIZBOOK['LOG_OUT']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
