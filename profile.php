<?php
include "header.php";

//if (file_exists('config/user_authentication.php')) {
//    include('config/user_authentication.php');
//}
$uri = $_SERVER['REQUEST_URI'];
$array_uri = explode('/', $uri);
$user_slug = $array_uri[count($array_uri)-1];

$session_user_id = NULL;
if (isset($_SESSION['user_id'])) {
    $session_user_id = $_SESSION['user_id'];
}
//}else{
//    header("Location: $webpage_full_link");
//}
//$uri =  $_SERVER["REQUEST_URI"]; //it will print full url
//$uriArray = explode('/', $uri); //convert string into array with explode
//$code = array_slice($uriArray, -1)[0];

$user_details_row = getActiveUser($user_slug);

//$redirect_url = $webpage_full_link.'dashboard';  //Redirect Url

//if ($_GET['code'] == NULL && empty($_GET['code'])) {
//
//    header("Location: $redirect_url");  //Redirect When code parameter is empty
//}

//$user_codea = $_GET['code'];
//$user_codea1 = str_replace('-', ' ', $_GET['code']);
//$user_codea = str_replace('.php', '', $user_codea1);

//$usersqlrow = getActiveUser($user_codea); // To Fetch particular User Data
//
//if ($usersqlrow['user_id'] == NULL && empty($usersqlrow['user_id'])) {
//
//
//    header("Location: $redirect_url");  //Redirect When No User Found in Table
//}
//
//$setting_user_status = $usersqlrow['setting_user_status'];
//
//if ($setting_user_status == 1){
//    
//    header("Location: $redirect_url");  //To Check whether listing owner made profile account Inactive
//}

$profile_user_id = $user_details_row['user_id'];

?>
<!-- START -->
<!--PRICING DETAILS-->
<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> login-reg us-pro-main">
    <div class="container">
        <div class="row">
            <div class="us-pro">
                <div class="us-pro-sec-1">
                    <div class="us-pro-sec-1-lhs">
                        <img
                            src="<?php echo $slash; ?>images/user/<?php if (($user_details_row['profile_image'] == NULL) || empty($user_details_row['profile_image'])) {
                                echo $footer_row['user_default_image'];
                            } else {
                                echo $user_details_row['profile_image'];
                            } ?>" title="<?php echo $user_details_row['first_name']; ?>" alt="<?php echo $user_details_row['first_name']; ?>">
                    </div>
                    <div class="us-pro-sec-1-rhs">
                        <h1><?php echo $user_details_row['first_name']; ?></h1><br/><br/>
                        <?php if (!empty($session_user_id)) {?>
                            <button 
                                class="userfollow follow-content<?php echo $profile_user_id ?>"
                                data-item="<?php echo $profile_user_id; ?>"
                                data-num="<?php echo $session_user_id; ?>">
                                <?php if (getCountUserProfileFollowing($session_user_id, $profile_user_id) == 0) {
                                    echo $BIZBOOK['FOLLOW'];
                                } else {
                                    echo $BIZBOOK['UNFOLLOW'];
                                } ?>
                            </button>
                        <?php }else{?>
                            <button class="follow-content<?php echo $profile_user_id ?>" data-toggle="modal" data-target="#savedproffessionalModal">
                                <?php echo $BIZBOOK['SAVED']; ?>
                            </button>
                            <div class="modal fade" id="savedproffessionalModal" tabindex="-1" aria-labelledby="savedproffessionalModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Guardar profesional</h5>
                                            <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Ingrese su cuenta de
                                                    correo y se le mandará un email con el enlace de este profesional a modo de recordatorio</strong>
                                            </p>
                                            <!--FILED START-->
                                            <div class="form-group">
                                                <input id="email" name="email" type="text" required="required"
                                                 class="form-control" value=""
                                                 placeholder="Introduce un email *">
                                            </div>
                                            <a href="javascript:void(0)" type="button" name="save_proffessional_submit" class="btn btn-primary btn-block" onclick="savedproffesional()"><?php echo $BIZBOOK['SAVED']; ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                        <ul class="lis-cou">
                            <li><b><?php echo getCountUserListing($profile_user_id); ?></b> <?php echo $BIZBOOK['LISTINGS'];?></li>
                            <?php /*<li><b><?php echo getCountUserBlog($profile_user_id); ?></b> Blogs</li>
                            <li><b><?php echo getCountUserEvent($profile_user_id); ?></b> Events</li>*/?>
                            <li><b><?php echo getCountUserFollowing($profile_user_id); ?></b> <?php echo $BIZBOOK['FOLLOWINGS'];?></li>
                        </ul>
                        <p><b><?php echo $BIZBOOK['CITY'];?>:</b> <?php echo $user_details_row['user_state']; ?>
                            &nbsp;&nbsp;<b><?php echo $BIZBOOK['JOIN_ON'];?>:</b> <?php echo dateFormatconverter($user_details_row['user_cdt']) ?></p>
                        <?php if($user_details_row['user_website']!=""){?>
                            <p>
                                Sitio web: <a href="<?php echo $user_details_row['user_website'];?>" target="_blank" title="<?php echo $user_details_row['first_name'];?>"><?php echo $user_details_row['user_website'];?></a>
                            </p>
                        <?php }?>
                        <ul class="pro-soci">
                            <?php if($user_details_row['user_facebook']!=""){?>
                                <li>
                                    <a href="<?php echo $user_details_row['user_facebook'];?>" target="_blank"><img src="<?php echo $slash; ?>images/social/3.png" title="Facebook <?php echo $user_details_row['first_name'];?>" alt="Facebook <?php echo $user_details_row['first_name'];?>"></a>
                                </li>
                            <?php }?>
                            <?php if($user_details_row['user_twitter']!=""){?>
                                <li>
                                    <a href="<?php echo $user_details_row['user_twitter'];?>" target="_blank"><img src="<?php echo $slash; ?>images/social/2.png" title="Twitter <?php echo $user_details_row['first_name'];?>" alt="Twitter <?php echo $user_details_row['first_name'];?>"></a>
                                </li>
                            <?php }?>
                            <?php if($user_details_row['user_linkedin']!=""){?>
                                <li>
                                    <a href="<?php echo $user_details_row['user_linkedin'];?>" target="_blank"><img src="<?php echo $slash; ?>images/social/1.png" title="Linkedin <?php echo $user_details_row['first_name'];?>" alt="Linkedin <?php echo $user_details_row['first_name'];?>"></a>
                                </li>
                            <?php }?>
                            <?php if($user_details_row['user_instagram']!=""){?>
                                <li>
                                    <a href="<?php echo $user_details_row['user_instagram'];?>" target="_blank"><img src="<?php echo $slash; ?>images/social/8.png" title="Instagram <?php echo $user_details_row['first_name'];?>" alt="Instagram <?php echo $user_details_row['first_name'];?>"></a>
                                </li>
                            <?php }?>
                            <?php if($user_details_row['user_whatsapp']!=""){?>
                                <li>
                                    <a href="https://wa.me/34<?php echo $user_details_row['user_whatsapp'];?>" target="_blank"><img src="<?php echo $slash; ?>images/social/6.png" title="Whatsapp <?php echo $user_details_row['first_name'];?>" alt="Whatsapp <?php echo $user_details_row['first_name'];?>"></a>
                                </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
                <div class="us-pro-sec-2">
                    <div class="us-pro-nav">
                        <ul>
                            <li><span class="act"><?php echo $BIZBOOK['LISTINGS'];?></span></li>
                            <?php /*<li><span><?php echo $BIZBOOK['LISTINGS'];?></span></li>*/?>
                            <?php /*<li><span>Blog posts</span></li>
                            <li><span>Events</span></li>*/?>
                            <li><span><?php echo $BIZBOOK['FOLLOWERS'];?></span></li>
                        </ul>
                    </div>
                    <div class="us-propg-main">
                        <div class="us-ppg-com us-ppg-listings">
                            <h2><?php echo $BIZBOOK['ALL_LISTINGS'];?></h2>
                            <ul>
                                <?php
                                if (getCountUserListing($profile_user_id) == 0) {
                                    ?>
                                    <div class="log"><p><?php echo $BIZBOOK['NO_LISTING_TO_SHOW'];?></p></div>
                                <?php } else {

                                    foreach (getAllListingUser($profile_user_id) as $listrow) {

                                        $listing_id = $listrow['listing_id'];

                                        //  List Rating. for Rating of Star starts
                                        foreach (getListingReview($listing_id) as $Star_rateRow) {
//                                            $Star_rateRow = getListingReview($listing_id);

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
                                        <li>
                                            <div class="pro-listing-box">
                                                <div>
                                                    <img
                                                        src="<?php if ($listrow['profile_image'] != NULL || !empty($listrow['profile_image'])) {
                                                            echo $slash."images/listings/" . $listrow['profile_image'];
                                                        } else {
                                                            echo $slash."images/listings/hot4.jpg";
                                                        } ?>">
                                                    <h2><?php echo $listrow['listing_name']; ?> </h2>
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
                                                            $bal_star_rate = abs(ceil($star_rate)-5);

                                                            for ($i = 1; $i <= $bal_star_rate; $i++) {
                                                                ?>
                                                                <i class="material-icons ratstar">star</i>
                                                                <?php
                                                            }
                                                            ?>
                                                            <?php /*<i class="material-icons">star</i>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star</i>
                                                                <i class="material-icons">star</i>*/?>
                                                        </label>
                                                        <?php
                                                    }
                                                    ?>
                                                    <p><?php echo $listrow['listing_address']; ?></p>
                                                    <a href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $listrow['listing_slug']; ?>"
                                                       class="fclick">&nbsp;</a>
                                                </div>
                                                <div>
                                                    <span data-toggle="modal" data-target="#quote"><?php echo $BIZBOOK['GET_QOUTE'];?></span>
                                                </div>
                                            </div>
                                        </li>

                                        <section>
                                            <div class="pop-ups pop-quo">
                                                <!-- The Modal -->
                                                <div class="modal fade" id="quote">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            <!-- Modal Header -->
                                                            <div class="quote-pop">
                                                                <h4><?php echo $BIZBOOK['GET_QOUTE'];?></h4>
                                                                <div id="profile_enq_success" class="log" style="display: none;">
                                                                    <p style="color: green; font-weight: bold"><?php echo $BIZBOOK['YOUT_ENQUIRY_SEND_SUCCESS'];?></p>
                                                                </div>
                                                                <div id="profile_enq_same" class="log" style="display: none;">
                                                                    <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['YOU_CANNOT_MAKE_ENQUIRY'];?></p>
                                                                </div>
                                                                <div id="profile_enq_fail" class="log" style="display: none;">
                                                                    <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['SOMETHING_WENT_WRONG'];?></p>
                                                                </div>
                                                                <div id="profile_enq_name" class="log" style="display: none;">
                                                                    <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['ENTER_NAME'];?></p>
                                                                </div>
                                                                <div id="profile_enq_phone" class="log" style="display: none;">
                                                                    <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['PHONE_NO_VALID'];?></p>
                                                                </div>
                                                                <div id="profile_enq_email" class="log" style="display: none;">
                                                                    <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['EMAIL_NO_VALID'];?></p>
                                                                </div>
                                                                <div id="profile_enq_message" class="log" style="display: none;">
                                                                    <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['ENTER_MESSAGE'];?></p>
                                                                </div>
                                                                <form method="post" name="profile_enquiry_form"
                                                                      id="profile_enquiry_form">
                                                                    <input type="hidden" class="form-control"
                                                                           name="listing_id"
                                                                           value="<?php echo $listing_id ?>"
                                                                           placeholder=""
                                                                           required>
                                                                    <input type="hidden" class="form-control"
                                                                           name="listing_user_id"
                                                                           value="<?php echo $profile_user_id; ?>"
                                                                           placeholder=""
                                                                           required>
                                                                    <input type="hidden" class="form-control"
                                                                           name="enquiry_sender_id"
                                                                           value="<?php echo $session_user_id; ?>"
                                                                           placeholder=""
                                                                           required>
                                                                    <div class="form-group">
                                                                        <input type="text"
                                                                               name="enquiry_name"
                                                                               value=""
                                                                               required="required"
                                                                               class="form-control"
                                                                               placeholder="<?php echo $BIZBOOK['ENTER_NAME'];?>*">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="email" class="form-control"
                                                                               placeholder="<?php echo $BIZBOOK['ENTER_EMAIL'];?>*"
                                                                               value=""
                                                                               name="enquiry_email"
                                                                               pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                                                               title="<?php echo $BIZBOOK['INVALID_EMAIL'];?>"
                                                                               required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="tel" class="form-control"
                                                                               value=""
                                                                               name="enquiry_mobile"
                                                                               placeholder="<?php echo $BIZBOOK['ENTER_MOBILE'];?>*"
                                                                               pattern="[0-9]{9}"
                                                                               title="<?php echo $BIZBOOK['PHONE_NUMBER_STARTING'];?>"
                                                                               required>
                                                                    </div>
                                                                    <div class="form-group">
                                <textarea class="form-control" rows="3" name="enquiry_message"
                                          placeholder="<?php echo $BIZBOOK['ENQUIRY_MESSAGE'];?>"></textarea>
                                                                    </div>
                                                                    <input type="hidden" id="source">
                                                                    <button type="submit" name="enquiry_submit"
                                                                            class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div class="log-bor">&nbsp;</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                        <?php
                                    }
                                }
                                ?>

                            </ul>
                        </div>
                        <?php /*<div class="us-ppg-com us-ppg-blog">
                            <h2>Blog posts</h2>
                            <ul>
                                <?php
                                if (getCountUserBlog($profile_user_id) == 0) {
                                    ?>
                                    <div class="log"><p>No Blogs To Show</p></div>
                                <?php } else {
                                    foreach (getAllUserBlogs($profile_user_id) as $blogrow) { ?>
                                        <li>
                                            <div class="pro-eve-box">
                                                <div>
                                                    <img src="<?php echo $slash; ?>images/blogs/<?php echo $blogrow['blog_image']; ?>"
                                                         alt="">
                                                </div>
                                                <div>
                                                    <span><?php echo dateFormatconverter($blogrow['blog_cdt']); ?></span>
                                                    <h2><?php echo $blogrow['blog_name']; ?></h2>
                                                    <!--                                                <p>28800 Orchard Lake Road, Suite 180 Farmington Hills, Los Angeles, USA.</p>-->
                                                </div>
                                                <a href="<?php echo $webpage_full_link; ?>blog/<?php echo preg_replace('/\s+/', '-', strtolower($blogrow['blog_slug'])); ?>" class="fclick">
                                                    &nbsp;</a>
                                            </div>
                                        </li>
                                    <?php }
                                } ?>
                            </ul>
                        </div>
                        <div class="us-ppg-com us-ppg-event">
                            <h2>Events</h2>
                            <ul>
                                <?php
                                if (getCountUserEvent($profile_user_id) == 0) {
                                    ?>
                                    <div class="log"><p>No Events To Show</p></div>
                                <?php } else {

                                    foreach (getAllUserEvents($profile_user_id) as $eventrow) { ?>
                                        <li>
                                            <div class="pro-eve-box">
                                                <div>
                                                    <img
                                                        src="<?php echo $slash; ?>images/events/<?php echo $eventrow['event_image']; ?>"
                                                        alt="">
                                                </div>
                                                <div>
                                                    <span><?php echo dateDayFormatconverter($eventrow['event_start_date']); ?>
                                                        <b><?php echo dateMonthFormatconverter($eventrow['event_start_date']); ?></span>
                                                    <h2><?php echo $eventrow['event_name']; ?></h2>
                                                    <p><?php echo $eventrow['event_address']; ?></p>
                                                </div>
                                                <a href="<?php echo $webpage_full_link; ?>event/<?php echo preg_replace('/\s+/', '-', strtolower($eventrow['event_slug'])); ?>"
                                                   class="fclick">&nbsp;</a>
                                            </div>
                                        </li>
                                    <?php }
                                } ?>
                            </ul>
                        </div>*/?>
                        <div class="us-ppg-com us-ppg-follow">
                            <h2><?php echo $BIZBOOK['FOLLOWERS'];?></h2>
                            <div class="ud-rhs-sec-2">
                                <ul>
                                    <?php
                                    if (getCountUserFollowing($profile_user_id) == 0) {
                                        ?>
                                        <div class="log"><p><?php echo $BIZBOOK['NO_FOLLOWERS_TO_SHOW'];?></p></div>
                                    <?php } else {

                                        $user_followers_array = explode(",", $user_details_row['user_followers']);
                                        foreach ($user_followers_array as $user_followers) {
                                            $user_followers_row = getUser($user_followers); // To Fetch particular User Data
                                            ?>
                                            <li>
                                                <div class="pro-sm-box">
                                                    <img
                                                        src="<?php echo $slash; ?>images/user/<?php if (($user_followers_row['profile_image'] == NULL) || empty($user_followers_row['profile_image'])) {
                                                            echo $footer_row['user_default_image'];
                                                        } else {
                                                            echo $user_followers_row['profile_image'];
                                                        } ?>" title="<?php echo $user_followers_row['first_name']; ?>" alt="<?php echo $user_followers_row['first_name']; ?>">
                                                    <h5><?php echo $user_followers_row['first_name']; ?></h5>
                                                    <p><?php echo $BIZBOOK['CITY'];?>: <b> <?php if ($user_followers_row['user_city'] == NULL) {
                                                                echo "N/A";
                                                            } else {
                                                                echo $user_followers_row['user_city'];
                                                            } ?></b></p>
                                                    <a href="<?php echo $webpage_full_link; ?>profesional/<?php echo $user_followers_row['user_slug']; ?>"></a>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="pro-bot-shar">
                        <h4><?php echo $BIZBOOK['SHARE_THIS_PROFILE'];?></h4>

                        <?php
                        $profile_name_url = $user_details_row['user_slug'];

                        $fb_url = $webpage_full_link . "profesional/".$profile_name_url.'?src=facebook';  //URL Profile Detail  Facebook Link
                        $fb_link = urlencode($fb_url);

                        $twitter_url = $webpage_full_link ."profesional/".$profile_name_url.'?src=twitter';  //URL Profile Detail Twitter Link
                        $twitter_link = urlencode($twitter_url);

                        $linkedin_url = $webpage_full_link . "profesional/".$profile_name_url.'?src=linkedin';  //URL Profile Detail Linkedin Link
                        $linkedin_link = urlencode($linkedin_url);

                        $whatsapp_url = $webpage_full_link . "profesional/".$profile_name_url.'?src=whatsapp';  //URL Profile Detail Whatsapp Link
                        $whatsapp_link = urlencode($whatsapp_url);

                        ?>

                        <ul>
                            <li>
                                <div class="sh-pro-shar sh-pro-face">
                                    <a target="_blank"
                                       href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $fb_url; ?>&quote=<?php echo $user_details_row['first_name']; ?>"><img
                                            src="<?php echo $slash; ?>images/social/3.png" title="Facebook <?php echo $user_followers_row['first_name']; ?>" alt="Facebook <?php echo $user_followers_row['first_name']; ?>"> Facebook</a>
                                </div>
                            </li>
                            <li>
                                <div class="sh-pro-shar sh-pro-twi">
                                    <a target="_blank"
                                       href="http://twitter.com/share?text=<?php echo $blogs_a_row['blog_name']; ?>&url=<?php echo $twitter_link; ?>"><img
                                            src="<?php echo $slash; ?>images/social/2.png" title="Twitter <?php echo $user_followers_row['first_name']; ?>" alt="Twitter <?php echo $user_followers_row['first_name']; ?>"> Twitter</a>
                                </div>
                            </li>
                            <li>
                                <div class="sh-pro-shar sh-pro-link">
                                    <a target="_blank"
                                       href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $linkedin_link; ?>"><img
                                            src="<?php echo $slash; ?>images/social/1.png" title="Linkedin <?php echo $user_followers_row['first_name']; ?>" alt="Linkedin <?php echo $user_followers_row['first_name']; ?>"> Linkedin</a>
                                </div>
                            </li>
                            <li>
                                <div class="sh-pro-shar sh-pro-what">
                                    <a target="_blank" href="https://api.whatsapp.com/send?text=<?php echo $whatsapp_link; ?>"
                                       data-action="share/whatsapp/share"><img src="<?php echo $slash; ?>images/social/6.png" title="Whatsapp <?php echo $user_followers_row['first_name']; ?>" alt="Whatsapp <?php echo $user_followers_row['first_name']; ?>">
                                        WhatsApp</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="us-pro-sec-3">
                </div>
            </div>
        </div>
    </div>
</section>
<!--END PRICING DETAILS-->


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo $slash; ?>js/jquery.min.js"></script>
<script src="<?php echo $slash; ?>js/popper.min.js"></script>
<script src="<?php echo $slash; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $slash; ?>js/jquery-ui.js"></script>
<script src="<?php echo $slash; ?>js/custom.js"></script>
<script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo $slash; ?>js/custom_validation.js"></script>
<script>

//    <!-- Profile page Enquiry Form Ajax Call And Validation starts-->
    $(document).ready(function () {
        $("#profile_enquiry_form").validate({
            rules: {
                enquiry_name: {required: true},
                enquiry_email: {required: true, email: true},
                enquiry_mobile: {required: true},
                enquiry_message: {required: true}

            },
            messages: {

                enquiry_name: {required: "<?php echo $BIZBOOK['NAME_IS_REQUIRED'];?>"},
                enquiry_email: {required: "<?php echo $BIZBOOK['EMAIL_IS_REQUIRED'];?>"},
                enquiry_mobile: {required: "<?php echo $BIZBOOK['MOBILE_IS_REQUIRED'];?>"},
                enquiry_message: {required: "<?php echo $BIZBOOK['MESSAGE_IS_REQUIRED'];?>"}
            },

            submitHandler: function (form) { // for demo
                //form.submit();
                $.ajax({
                    type: "POST",
                    data: $("#profile_enquiry_form").serialize(),
                    url: "<?php echo $slash; ?>enquiry_submit.php",
                    cache: true,
                    success: function (html) {
                        // alert(html);
                        if (html == 1) {
                            $("#profile_enq_success").show();
                            $("#profile_enquiry_form")[0].reset();
                        } else {
                            if (html == 3) {
                                $("#profile_enq_same").show();
                                $("#profile_enquiry_form")[0].reset();
                            } else {
                                if (html == -4) {
                                    $("#profile_enq_name").show();
                                    $("#profile_enquiry_form")[0].reset();
                                }else{
                                    if (html == -5) {
                                        $("#profile_enq_email").show();
                                        $("#profile_enquiry_form")[0].reset();
                                    }else{
                                        if (html == -6) {
                                            $("#profile_enq_phone").show();
                                            $("#profile_enquiry_form")[0].reset();
                                        }else{
                                            if (html == -7) {
                                                $("#profile_enq_message").show();
                                                $("#profile_enquiry_form")[0].reset();
                                            }else{
                                                $("#profile_enq_fail").show();
                                                $("#profile_enquiry_form")[0].reset();
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                })
            }
        });
    });
    <!--Profile page Enquiry Form Ajax Call And Validation ends-->

</script>
<script>
    //Auto complete For Listing Name and Category Name Starts Top Header Page particularly for All details page

    jQuery(document).ready(function ($) {

        $(function () {
            $.ajax({
                url: '<?php echo $slash; ?>list_category_search.php',
                success: function (response) {

                    var categoryArray = JSON.parse(response);

                    // var dataCountry = {};
                    // for (var i = 0; i < categoryArray.length; i++) {
                    //     dataCountry[categoryArray[i]] = undefined; //categoryArray[i].flag or null
                    // }
                    $('#top-select-search-new.autocomplete').autocomplete({  //Home Page City Search Box
                        source: categoryArray,
                        limit: 10 // The max amount of results that can be shown at once. Default: Infinity.
                    });
                }
            });
        });
    });
</script>
<?php /*<script>

    //FOLLOW & UN FOLLOW Logic Starts

    $(".userfollow").click(function () {

        var user_id = $(this).attr('data-item'); //User Id
        var sender_user_id = $(this).attr('data-num'); //Sender User Id
        var like_status = $(this).attr('data-section');

        var status_msg_old = $(".follow-content" + user_id).html();
        if (status_msg_old == "Un-follow") {
            var status_msg = "Follow";
        } else {
            var status_msg = "Un-follow";
        }
        if (user_id) {  //Check Current User is Null Means redirect to login page
            if (sender_user_id == user_id) {  //Check send User and Current User is Same
                // alert("same user");
            } else {
                // alert("other user");
                $.ajax({
                    type: 'POST',
                    url: '<?php echo $slash; ?>follow_users.php',
                    cache: false,
                    data: {sender: sender_user_id, user: user_id, status: like_status},
                    success: function (response) {
                        // alert(response);
                        if (response == 1) {

                            $(".follow-content" + user_id).html(status_msg);

                        } else {

                            $(".follow-content" + user_id).html(status_msg);
                        }
                    }
                });
            }
        } else {
            window.location.href = "login.php";
        }

    });

    //FOLLOW & UN FOLLOW Logic ends
</script>*/?>
</body>

</html>