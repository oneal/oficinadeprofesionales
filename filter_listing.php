<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

/*
if (file_exists('config/info.php')) {
    include('config/info.php');
}
if (isset($_SESSION['user_id'])) {
    $session_user_id = $_SESSION['user_id'];
}
$user_details_row = getUser($session_user_id); //Fetch User data

//Pagination Code Starts Here
$numberOfPages = 8;
$limit = 15;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;

//Pagination Code Ends Here


$scheck = $_REQUEST['scheck'];
$cat_check = $_REQUEST['cat_check'];
$sub_cat_check = $_REQUEST['sub_cat_check'];
$feature_check = $_REQUEST['feature_check'];
$city_check = $_REQUEST['city_check'];
$rating_check = $_REQUEST['rating_check'];


$WHERE = array();
$inner = $w = '';

// Category Check starts
if (!empty($cat_check)) {
    if (strstr($cat_check, ',')) {
        $data2 = explode(',', $cat_check);
        $cat_array = array();
        foreach ($data2 as $c) {
//            $cat_array[] = "t1.category_id = $c";
            $cat_array[] = "FIND_IN_SET($c,t1.category_id)";

        }
        $WHERE[] = '(' . implode(' OR ', $cat_array) . ')';
    } else {
//        $WHERE[] = '(t1.category_id = ' . $cat_check . ')';
        $WHERE[] = '(FIND_IN_SET(' . $cat_check . ',t1.category_id))';

    }
}

// Category Check Ends


//Sub Category Check starts
if (!empty($sub_cat_check)) {
    if (strstr($sub_cat_check, ',')) {
        $data2 = explode(',', $sub_cat_check);
        $sub_cat_array = array();
        foreach ($data2 as $c) {
//            $sub_cat_array[] = "t1.sub_category_id = $c";
            $sub_cat_array[] = "FIND_IN_SET($c,t1.sub_category_id)";

        }
        $WHERE[] = '(' . implode(' OR ', $sub_cat_array) . ')';
    } else {
//        $WHERE[] = '(t1.category_id = ' . $sub_cat_check . ')';
        $WHERE[] = '(FIND_IN_SET(' . $sub_cat_check . ',t1.sub_category_id))';

    }
}

//Sub Category Check Ends

//City Check starts
if (!empty($city_check)) {

    if (strstr($city_check, ',')) {
        $data8 = explode(',', $city_check);
        $cityarray = array();
        foreach ($data8 as $ci) {
            $cityarray[] = "FIND_IN_SET($ci,t1.city_id)";

        }
        $WHERE[] = '(' . implode(' OR ', $cityarray) . ')';
    } else {
//        $WHERE[] = '(t1.category_id = ' . $cat_check . ')';
        $WHERE[] = '(FIND_IN_SET(' . $city_check . ',t1.city_id))';

    }

}

//City Check Ends


//Rating Check Starts

if (!empty($rating_check)) {
    if (strstr($rating_check, ',')) {
        $data3 = explode(',', $rating_check);
        $rate_array = array();
        foreach ($data3 as $c) {
            $rate_array[] = "t2.price_rating = $c";
        }
        $WHERE[] = '(' . implode(' OR ', $rate_array) . ')';
    } else {
        $WHERE[] = '(t2.price_rating = ' . $rating_check . ')';
    }

    $inner = "INNER JOIN `" . TBL . "reviews` AS t2 ON t1.listing_id = t2.listing_id";

}

//Rating Check Ends

if (!empty($price_range)) {
    $data3 = explode('-', $price_range);
    $WHERE[] = "(t1.product_rate between $data3[0] and $data3[1])";
}

//if(!empty($bcheck)) {
//    if(strstr($bcheck,',')) {
//        $data1 = explode(',',$bcheck);
//        $barray = array();
//        foreach($data1 as $c) {
//            $barray[] = "t1.Brand = $c";
//        }
//        $WHERE[] = '('.implode(' OR ',$barray).')';
//    } else {
//        $WHERE[] = '(t1.Brand = '.$bcheck.')';
//    }
//}


if (!empty($scheck)) {
    if (strstr($scheck, ',')) {
        $data3 = explode(',', $scheck);
        $sarray = array();
        foreach ($data3 as $c) {
            $sarray[] = "t2.size_id = $c";
        }
        $WHERE[] = '(' . implode(' OR ', $sarray) . ')';
    } else {
        $WHERE[] = '(t2.size_id = ' . $scheck . ')';
    }

    $inner = 'INNER JOIN `product_size_quantity` AS t2 ON t1.product_id = t2.product_id';

}

if (!empty($category_id)) {
    if (strstr($category_id, ',')) {
        $data4 = explode(',', $category_id);
        $ctarray = array();
        foreach ($data4 as $ct) {
            $ctarray[] = "t1.product_category_id = $ct";
        }
        $WHERE[] = '(' . implode(' OR ', $ctarray) . ')';
    } else {
        $WHERE[] = '(t1.product_category_id = ' . $category_id . ')';
    }
}

$w = implode(' AND ', $WHERE);
if (!empty($w)) {
    $w = 'WHERE ' . $w;
    $q = 'AND ';
} else {
    $q = 'WHERE ';
}

//echo "SELECT DISTINCT  t1 . * FROM  `tbl_products` AS t1 $inner $w";
//$query = mysqli_query($conn, "SELECT DISTINCT  t1 . * FROM  " . TBL . "listings  AS t1 $inner $w $q listing_status= 'Active' AND listing_is_delete != '2' ORDER BY listing_id DESC ");

$query = mysqli_query($conn, "SELECT DISTINCT  t1 . * , t4.user_plan FROM " . TBL . "listings AS t1 LEFT JOIN " . TBL . "users AS t4 ON t1.user_id = t4.user_id $inner $w $q listing_status= 'Active' AND listing_is_delete != '2' ORDER BY t1.listing_cdt DESC ");
//echo "SELECT DISTINCT  t1 . * FROM  " . TBL . "listings  AS t1 $inner $w AND listing_status= 'Active' AND listing_is_delete != '2' ORDER BY listing_id DESC LIMIT $start_from, $limit"
//echo "SELECT DISTINCT  t1 . * FROM  " . TBL . "listings  AS t1 $inner $w AND listing_status= 'Active' AND listing_is_delete != '2' ORDER BY listing_id DESC";
?>

<div class="all-list-sh all-listing-total">
    <ul>
        <?php
        if (mysqli_num_rows($query) > 0) {

            while ($listrow = mysqli_fetch_array($query)) {

                $listing_id = $listrow['listing_id'];
                $list_user_id = $listrow['user_id'];

                $usersqlrow = getUser($list_user_id); // To Fetch particular User Data

//                $star_rating_row = getListingReview($listing_id); // List Rating. for Rating of Star
                foreach (getListingReview($listing_id) as $star_rating_row) {
                    if ($star_rating_row["rate_cnt"] > 0) {
                        $star_rate_times = $star_rating_row["rate_cnt"];
                        $star_sum_rates = $star_rating_row["total_rate"];
                        $star_rate_one = $star_sum_rates / $star_rate_times;
                        //$star_rate_one = (($Star_rate_value)/5)*100;
                        $star_rate_two = number_format($star_rate_one, 1);
                        $star_rate = floatval($star_rate_two);

                    } else {
                        $rate_times = 0;
                        $rate_value = 0;
                        $star_rate = 0;
                    }
                }

                $listing_likes_total = getCountUserLikedListing($listing_id, $session_user_id); // To get count of likes

                if ($listing_likes_total >= 1) {
                    $check_listing_likes_total = 0;
                    $active_listing_likes = 'sav-act';
                } else {
                    $check_listing_likes_total = 1;
                    $active_listing_likes = '';
                }


                //Likes Query Ends
                ?>

                <li>
                    <div class="eve-box">
                        <!---LISTING IMAGE--->
                        <div class="al-img">
                            <a href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $listrow['listing_slug']; ?>">
                                <img
                                    src="<?php if ($listrow['profile_image'] != NULL || !empty($listrow['profile_image'])) {
                                        echo $slash."images/listings/" . $listrow['profile_image'];
                                    } else {
                                        echo $slash."images/listings/hot4.jpg";
                                    } ?>">
                            </a>
                            <div class="auth">
                                <?php
                                //To Check whether listing owner made profile is visible

                                $setting_profile_show = $usersqlrow['setting_profile_show'];
                                if ($setting_profile_show == 0) {

                                    ?>
                                    <img
                                        src="images/user/<?php if (($usersqlrow['profile_image'] == NULL) || empty($usersqlrow['profile_image'])) {
                                            echo $footer_row['user_default_image'];
                                        } else {
                                            echo $usersqlrow['profile_image'];
                                        } ?>" alt="">
                                    <b>Created by</b><br>
                                    <h4><?php echo $usersqlrow['first_name']; ?></h4>
                                    <a href="profile" class="fclick"></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!---END LISTING IMAGE--->

                        <!---LISTING NAME--->
                        <div>
                            <h4>
                                <a href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $listrow['listing_slug']; ?>"><?php echo $listrow['listing_name']; ?></a>
                            </h4>
                            <?php
                            if ($star_rate != 0) {
                                ?>
                                <label class="rat">
                                    <?php
                                    for ($i = 1; $i <= ceil($star_rate); $i++) {
                                        ?>
                                        <i class="material-icons">star</i>
                                        <?php
                                    }

                                    $bal_star_rate = abs(ceil($star_rate) - 5);

                                    for ($i = 1; $i <= $bal_star_rate; $i++) {
                                        ?>
                                        <i class="material-icons ratstar">star</i>
                                        <?php
                                    }
                                    ?>
                                    <?php /*<i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>?>
                                </label>
                                <?php
                            }
                            ?>
                            <span
                                class="addr"><?php echo $listrow['listing_address']; ?></span>
                                        <span class="pho"><?php
                                            if ($listrow['listing_mobile'] != NULL || $usersqlrow['mobile_number'] != NULL) {

                                                if ($list_user_id == 1) {
                                                    echo $listrow['listing_mobile'];
                                                } else {
                                                    echo $usersqlrow['mobile_number'];
                                                } ?>
                                                <?php
                                            }
                                            ?></span>
                                        <span class="mail"><?php
                                            if ($usersqlrow['email_id'] != NULL) {

                                                echo $usersqlrow['email_id'];
                                                ?>
                                                <?php
                                            }
                                            ?></span>
                            <div class="links">
                                <?php if ($session_user_id != NULL || !empty($session_user_id)) {
                                    ?>
                                    <a href="#" data-toggle="modal"
                                        <?php
                                        if ($list_user_id != 1) { ?>
                                            data-target="#quote<?php echo $listing_id ?>"
                                            <?php
                                        }
                                        ?>><?php echo $BIZBOOK['GET_QOUTE'];?></a>
                                    <?php
                                } else { ?>
                                    <a href="login"><?php echo $BIZBOOK['GET_QOUTE'];?></a>
                                    <?php
                                }
                                ?>
                                <a href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $listrow['listing_slug']; ?>"><?php echo $BIZBOOK['VIEW_MORE'];?></a>
                                <a href="Tel:<?php
                                if ($listrow['listing_mobile'] != NULL || $usersqlrow['mobile_number'] != NULL) {

                                    if ($list_user_id == 1) {
                                        echo $listrow['listing_mobile'];
                                    } else {
                                        echo $usersqlrow['mobile_number'];
                                    } ?>
                                                <?php
                                }
                                ?>">Call Now</a>
                                <span id="qvv<?php echo $listrow['listing_code']; ?>"
                                      class="qvv qvv<?php echo $listrow['listing_code']; ?>"><?php echo $BIZBOOK['QUICK_VIEW'];?></span>
                            </div>
                        </div>
                        <!---END LISTING NAME--->

                        <!---USER AND GET QUOTE--->

                        <!---END USER AND GET QUOTE--->

                        <!---SAVE--->
                                    <span class="enq-sav" data-toggle="tooltip"
                                          title="<?php if ($active_listing_likes == '') { ?><?php echo $BIZBOOK['CLICK_TO_LIKE'];?><?php } else { ?> <?php echo $BIZBOOK['CLICK_TO_UNLIKE'];?> <?php } ?>">
                                        <i class="material-icons Animatedheartfunc<?php echo $listing_id ?> <?php echo $active_listing_likes; ?>"
                                           data-for="<?php echo listing_total_like_count($listing_id); ?>"
                                           data-section="<?php echo $check_listing_likes_total; ?>"
                                           data-num="<?php echo $list_user_id; ?>"
                                           data-item="<?php echo $session_user_id; ?>"
                                           data-id='<?php echo $listing_id ?>'>favorite</i></span>
                        <!---END SAVE--->
                    </div>
                    <div id="list-qview<?php echo $listrow['listing_code']; ?>"
                         class="list-qview list-qview<?php echo $listrow['listing_code']; ?>">
                        <div class="eve-box">
                            <div>
                                <span class="clo-list"><i class="material-icons">close</i></span>
                                <a href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $listrow['listing_slug']; ?>">
                                    <?php /*                                                       <img src="images/listings/-->
                                    <?php
                                    //                                                        $gallery_image_array = $listrow['gallery_image'];
                                    //
                                    //                                                        if ($listrow['gallery_image'] == NULL || empty($listrow['gallery_image'])) {
                                    //                                                            echo "no-images.png";
                                    //                                                        } else {
                                    //                                                            echo $gallery_image = array_shift(explode(',', $gallery_image_array));
                                    //                                                        }
                                    //                                                        ?><!--" alt="">-->?>
                                    <img
                                        src="<?php if ($listrow['profile_image'] != NULL || !empty($listrow['profile_image'])) {
                                            echo $slash."images/listings/" . $listrow['profile_image'];
                                        } else {
                                            echo $slash."images/listings/hot4.jpg";
                                        } ?>">
                                </a>
                            </div>
                            <div>
                                <h4>
                                    <a href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $listrow['listing_slug']; ?>"><?php echo $listrow['listing_name']; ?></a>
                                </h4>
                                <span class="addr"><?php echo $listrow['listing_address']; ?></span>
                                                    <span class="pho"><?php
                                                        if ($listrow['listing_mobile'] != NULL || $usersqlrow['mobile_number'] != NULL) {

                                                            if ($list_user_id == 1) {
                                                                echo $listrow['listing_mobile'];
                                                            } else {
                                                                echo $usersqlrow['mobile_number'];
                                                            } ?>
                                                            <?php
                                                        }
                                                        ?></span>
                                                    <span class="mail"><?php
                                                        if ($usersqlrow['email_id'] != NULL) {

                                                            echo $usersqlrow['email_id'];
                                                            ?>
                                                            <?php
                                                        }
                                                        ?></span>
                            </div>
                            <div>
                                <div class="auth">
                                    <?php
                                    //To Check whether listing owner made profile is visible

                                    $setting_profile_show = $usersqlrow['setting_profile_show'];
                                    if ($setting_profile_show == 0) {

                                        ?>
                                        <img
                                            src="images/user/<?php if (($usersqlrow['profile_image'] == NULL) || empty($usersqlrow['profile_image'])) {
                                                echo $footer_row['user_default_image'];
                                            } else {
                                                echo $usersqlrow['profile_image'];
                                            } ?>" alt="">
                                        <b>Hosted by</b><br>
                                        <h4><?php echo $usersqlrow['first_name']; ?></h4>
                                        <a target="_blank"
                                           href="<?php echo $webpage_full_link; ?>profile/<?php echo $usersqlrow['user_slug']; ?>"
                                           class="fclick"></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="com abo">
                            <h4>About <b><?php echo $listrow['listing_name']; ?></b></h4>
                            <p><?php echo stripslashes($listrow['listing_description']); ?></p>
                        </div>
                        <div class="com share">

                            <?php

                            $fb_url = $webpage_full_link . "listing-details?src=facebook&&code=" . $listrow['listing_code'];  //URL Listing Detail  Facebook Link
                            $fb_link = urlencode($fb_url);

                            $twitter_url = $webpage_full_link . "listing-details?src=twitter&&code=" . $listrow['listing_code'];  //URL Listing Detail Twitter Link
                            $twitter_link = urlencode($twitter_url);

                            $linkedin_url = $webpage_full_link . "listing-details?src=linkedin&&code=" . $listrow['listing_code'];  //URL Listing Detail Linkedin Link
                            $linkedin_link = urlencode($linkedin_url);

                            $whatsapp_url = $webpage_full_link . "listing-details?src=whatsapp&&code=" . $listrow['listing_code'];  //URL Listing Detail Whatsapp Link
                            $whatsapp_link = urlencode($whatsapp_url);

                            ?>

                            <h4><?php echo $BIZBOOK['SHARE_THIS_SERVICE'];?></h4>
                            <ul>
                                <li>
                                    <a target="_blank"
                                       href="http://www.facebook.com/sharer/sharer.php?href=<?php echo $fb_link; ?>"><img
                                            src="images/social/3.png" alt=""></a>
                                </li>
                                <li>
                                    <a target="_blank"
                                       href="http://twitter.com/share?text=<?php echo $listrow['listing_name']; ?>&url=<?php echo $twitter_link; ?>"><img
                                            src="images/social/2.png" alt=""></a>
                                </li>
                                <li>
                                    <a target="_blank"
                                       href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $linkedin_link; ?>"><img
                                            src="images/social/1.png" alt=""></a>
                                </li>
                                <li>
                                    <a target="_blank"
                                       href="whatsapp://send?text=<?php echo $whatsapp_link; ?>"><img
                                            src="images/social/6.png" alt=""></a>
                                </li>
                            </ul>
                        </div>
                        <div class="com more">

                            <?php if ($session_user_id != NULL || !empty($session_user_id)) {
                                ?>
                                <a href="#" data-toggle="modal"
                                    <?php
                                    if ($list_user_id != 1) { ?>
                                        data-target="#quote<?php echo $listing_id ?>"
                                        <?php
                                    }
                                    ?>><?php echo $BIZBOOK['GET_QOUTE'];?></a>
                                <?php
                            } else { ?>
                                <a href="login"><?php echo $BIZBOOK['GET_QOUTE'];?></a>
                                <?php
                            }
                            ?>

                            <?php /* <a href="#" data-toggle="modal" data-target="#quote">Get quote</a>?>
                        </div>
                    </div>
                </li>


                <!--  Get Quote Pop up box starts  -->
                <section>
                    <div class="pop-ups pop-quo">
                        <!-- The Modal -->
                        <div class="modal fade" id="quote<?php echo $listing_id ?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="log-bor">&nbsp;</div>
                                    <span class="udb-inst"><?php echo $BIZBOOK['SEND_ENQUIRY'];?></span>
                                    <button type="button" class="close"
                                            data-dismiss="modal">&times;</button>
                                    <!-- Modal Header -->
                                    <div class="quote-pop">
                                        <h4><?php echo $BIZBOOK['GET_QOUTE'];?></h4>
                                        <div id="enq_success" style="display: none;color: #000;"><?php echo $BIZBOOK['YOUT_ENQUIRY_SEND_SUCCESS'];?>
                                        </div>
                                        <div id="enq_fail" style="display: none;color: #000;"><?php echo $BIZBOOK['SOMETHING_WENT_WRONG'];?>
                                        </div>
                                        <form method="post" name="enquiry_form" id="enquiry_form">
                                            <input type="hidden" class="form-control" name="listing_id"
                                                   value="<?php echo $listing_id ?>"
                                                   placeholder=""
                                                   required>
                                            <input type="hidden" class="form-control"
                                                   name="listing_user_id"
                                                   value="<?php echo $list_user_id; ?>" placeholder=""
                                                   required>
                                            <input type="hidden" class="form-control"
                                                   name="enquiry_sender_id"
                                                   value="<?php echo $session_user_id; ?>"
                                                   placeholder=""
                                                   required>
                                            <div class="form-group">
                                                <input type="text" readonly name="enquiry_name"
                                                       value="<?php echo $user_details_row['first_name'] ?>"
                                                       required="required" class="form-control"
                                                       placeholder="<?php echo $BIZBOOK['ENTER_NAME'];?>*">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control"
                                                       placeholder="<?php echo $BIZBOOK['ENTER_EMAIL'];?>*" readonly="readonly"
                                                       value="<?php echo $user_details_row['email_id'] ?>"
                                                       name="enquiry_email"
                                                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                                       title="<?php echo $BIZBOOK['INVALID_EMAIL'];?>" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="tel" class="form-control"
                                                       readonly="readonly"
                                                       value="<?php echo $user_details_row['mobile_number'] ?>"
                                                       name="enquiry_mobile"
                                                       placeholder="<?php echo $BIZBOOK['ENTER_MOBILE'];?> *"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="enquiry_message"
                                          placeholder="<?php echo $BIZBOOK['ENQUIRY_MESSAGE'];?>"></textarea>
                                            </div>
                                            <input type="hidden" id="source">
                                            <button type="submit" name="enquiry_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--  Get Quote Pop up box ends  -->


                <?php
            }
        } else {
            ?>
            <span style="    font-size: 21px;
    color: #bfbfbf;
    letter-spacing: 1px;
    /* background: #525252; 
    text-shadow: 0px 0px 2px #fff;
    text-transform: uppercase;
    margin-top: 5%;"><?php echo $BIZBOOK['OOPS_NO_LISTING'];?></span>
            <?php
        }
        ?>

    </ul>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/custom.js"></script>
<script src="js/listing_filter.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>

<script>
    <?php foreach (getAllListing() as $rowq){ ?>
    $('.qvv<?php echo $rowq['listing_code'] ?>').on('click', function () {
        $('.list-qview<?php echo $rowq['listing_code'] ?>').addClass('qview-show');
    });
    $('.list-qview<?php echo $rowq['listing_code'] ?>').on('mouseleave', function () {
        $('.list-qview<?php echo $rowq['listing_code'] ?>').removeClass('qview-show');
    });
    <?php
    }
    ?>
</script>