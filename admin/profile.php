<?php
include "header.php";
?>

<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash adda-oly leftpadd">

<!--            User Welcome Div starts -->

            <div class="ad-dash-s1">
              <span><?php echo $BIZBOOK['USERS'];?> <?php echo $admin_row['admin_name']; ?></span>
            </div>

<!--            User Welcome Div ends -->


            <div class="ad-dash-s2">
                <ul>
                    <li>
                        <div>
                            <img src="../images/icon/ic-1.png" title="<?php echo $BIZBOOK['USERS'];?>" alt="<?php echo $BIZBOOK['USERS'];?>">
                            <h2><?php echo AddingZero_BeforeNumber(getCountUser()); ?></h2>
                            <h4><?php echo $BIZBOOK['USERS'];?></h4>
                            <a href="admin-all-users.php" class="fclick"></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <img src="../images/icon/ic-2.png" title="<?php echo $BIZBOOK['ALL_LISTING'];?>" alt="<?php echo $BIZBOOK['ALL_LISTING'];?>">
                            <h2><?php echo AddingZero_BeforeNumber(getCountListing()); ?></h2>
                            <h4><?php echo $BIZBOOK['ALL_LISTING'];?></h4>
                            <a href="admin-all-listings.php" class="fclick"></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <img src="../images/icon/ic-3.png" title="<?php echo $BIZBOOK['ALL_EVENTS'];?>" alt="<?php echo $BIZBOOK['ALL_EVENTS'];?>">
                            <h2><?php echo AddingZero_BeforeNumber(getCountEvent()); ?></h2>
                            <h4><?php echo $BIZBOOK['ALL_EVENTS'];?></h4>
                            <a href="admin-event.php" class="fclick"></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <img src="../images/icon/ic-4.png" title="<?php echo $BIZBOOK['ALL_BLOG_POST'];?>" alt="<?php echo $BIZBOOK['ALL_BLOG_POST'];?>">
                            <h2><?php echo AddingZero_BeforeNumber(getCountBlog()); ?></h2>
                            <h4><?php echo $BIZBOOK['ALL_BLOG_POST'];?></h4>
                            <a href="admin-all-blogs.php" class="fclick"></a>
                        </div>
                    </li>
                </ul>
            </div>
            <?php /*
            <div class="ad-dash-s3">
                <ul>
                    <li>
                        <div class="ad-cou">
                            <div>
                                <span><?php //echo $name[3]['name']; ?> Users</span>
                                <h4><?php //echo AddingZero_BeforeNumber(getCountServiceUser(4)); ?></h4>
                            </div>
                            <div>
                                <img src="../images/icon/ic-9.png" alt="">
                            </div>
                            <a href="admin-premium-plus-users.php" class="fclick"></a>
                        </div>
                    </li>
                    <li>
                        <div class="ad-cou">
                            <div>
                                <span><?php //echo $name[2]['name']; ?> Users</span>
                                <h4><?php //echo AddingZero_BeforeNumber(getCountServiceUser(3)); ?></h4>
                            </div>
                            <div>
                                <img src="../images/icon/ic-8.png" alt="">
                            </div>
                            <a href="admin-premium-users.php" class="fclick"></a>
                        </div>
                    </li>
                    <li>
                        <div class="ad-cou">
                            <div>
                                <span><?php //echo $name[1]['name']; ?> Users</span>
                                <h4><?php //echo AddingZero_BeforeNumber(getCountServiceUser(2)); ?></h4>
                            </div>
                            <div>
                                <img src="../images/icon/ic-10.png" alt="">
                            </div>
                            <a href="admin-standard-users.php" class="fclick"></a>
                        </div>
                    </li>
                    <li>
                        <div class="ad-cou">
                            <div>
                                <span><?php //echo $name[0]['name']; ?> Users</span>
                                <h4><?php //echo AddingZero_BeforeNumber(getCountServiceUser(1)); ?></h4>
                            </div>
                            <div>
                                <img src="../images/icon/ic-11.png" alt="">
                            </div>
                            <a href="admin-free-users.php" class="fclick"></a>
                        </div>
                    </li>
                </ul>
            </div>*/?>
            <div class="ad-dash-s4">
                <ul>
                    <li>
                        <div>
                            <h4><?php echo $BIZBOOK['NEW_USERS'];?></h4>
                            <h2><?php echo $BIZBOOK['NEW_USER_REQUESTS'];?></h2>
                            <span><?php echo AddingZero_BeforeNumber(getCountInactiveUser()); ?></span>
                            <a href="admin-new-user-requests.php" class="fclick"></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h4><?php echo $BIZBOOK['ENQUERY_&_QUOTE'];?></h4>
                            <h2><?php echo $BIZBOOK['GET_QOUTE'];?></h2>
                            <span><?php echo AddingZero_BeforeNumber(getCountEnquiries()); ?></span>
                            <a href="admin-all-enquiry.php" class="fclick"></a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h4><?php echo $BIZBOOK['LEAD_ENQUIRY'];?></h4>
                            <h2><?php echo $BIZBOOK['AD_REQUEST'];?></h2>
                            <span><?php echo AddingZero_BeforeNumber(getCountAds()); ?></span>
                            <a href="admin-ads-request.php" class="fclick"></a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="ad-dash-s3 ad-dash-s5">
                <ul>
                    <li>
                        <div class="ad-cou">
                            <div>
                                <img src="../images/icon/ic-14.png" title="<?php echo $BIZBOOK['CATEGORIES'];?>" alt="<?php echo $BIZBOOK['CATEGORIES'];?>">
                            </div>
                            <div>
                                <span><?php echo $BIZBOOK['CATEGORIES'];?></span>
                                <h4><?php echo AddingZero_BeforeNumber(getCountCategory()); ?></h4>
                            </div>
                            <a href="admin-all-category.php" class="fclick"></a>
                        </div>
                    </li>
                    <li>
                        <div class="ad-cou">
                            <div>
                                <img src="../images/icon/ic-12.png" title="<?php echo $BIZBOOK['STATES'];?>" alt="<?php echo $BIZBOOK['STATES'];?>">
                            </div>
                            <div>
                                <span><?php echo $BIZBOOK['STATES'];?></span>
                                <h4><?php echo AddingZero_BeforeNumber(mysqli_num_rows(getAllStates(1))); ?></h4>
                            </div>
                            <a href="admin-all-state.php" class="fclick"></a>
                        </div>
                    </li>
                    <li>
                        <div class="ad-cou">
                            <div>
                                <img src="../images/icon/ic-13.png" title="<?php echo $BIZBOOK['SUB_REGIONS'];?>" alt="<?php echo $BIZBOOK['SUB_REGIONS'];?>">
                            </div>
                            <div>
                                <span><?php echo $BIZBOOK['SUB_REGIONS'];?></span>
                                <h4><?php echo AddingZero_BeforeNumber(getCountCity()); ?></h4>
                            </div>
                            <a href="admin-all-city.php" class="fclick"></a>
                        </div>
                    </li>
                    <li>
                        <div class="ad-cou">
                            <div>
                                <img src="../images/icon/ic-15.png" title="<?php echo $BIZBOOK['NOTIFICATIONS'];?>" alt="<?php echo $BIZBOOK['NOTIFICATIONS'];?>">
                            </div>
                            <div>
                                <span><?php echo $BIZBOOK['NOTIFICATIONS'];?></span>
                                <h4><?php echo AddingZero_BeforeNumber(getCountNotification()); ?></h4>
                            </div>
                            <a href="admin-notification-all.php" class="fclick"></a>
                        </div>
                    </li>
                </ul>
            </div>
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
<?php httpPost("http://directoryfinder.net/updation/updation_wizard.php",$data_array); ?>
</body>

</html>