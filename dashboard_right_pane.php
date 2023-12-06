<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */
$session_user_id = $_SESSION['user_id'];


?>
<!--RIGHT SECTION-->
<div class="ud-rhs">
    <?php /*<!--    <div class="ud-rhs-sec-2">-->
    <!--        <h4>--><?php //echo $BIZBOOK['OTHER_USER_PROFILES']; ?><!--</h4>-->
    <!--        <ul>-->
    <!--            --><?php //foreach (getAllServiceUserExceptUserId($session_user_id) as $user_row) { ?>
    <!--            <li>-->
    <!--                <a href="--><?php //echo $webpage_full_link; ?><!--profile/--><?php //echo preg_replace('/\s+/', '-', strtolower($user_row['user_slug'])); ?><!--">-->
    <!--                    <img src="images/user/--><?php //if(($user_row['profile_image'] == NULL) || empty($user_row['profile_image'])){  echo $footer_row['user_default_image'];}else{ echo $user_row['profile_image']; } ?><!--" alt="">-->
    <!--                    <h5>--><?php //echo $user_row['first_name']; ?><!--</h5>-->
    <!--                    <p>--><?php //echo $BIZBOOK['JOIN_DATE']; ?><!--: <b>--><?php //echo dateFormatconverter($user_row['user_cdt'])?><!--</b> --><?php //echo $BIZBOOK['CITY']; ?><!--: <b> --><?php //if($user_row['user_city']== NULL){ echo "N/A"; } else { echo $user_row['user_city']; }?><!--</b></p>-->
    <!--                </a>-->
    <!--            </li>-->
    <!--                --><?php //} ?>
    <!--        </ul>-->
    <!--    </div>-->*/?>

    <div class="ud-rhs-pay">
        <div class="ud-rhs-pay-inn credit-poi">
            <h3><?php echo $BIZBOOK['INFO_CREDITS'];?></h3>
            <p>Recuerda que al crear la cuenta y al añadir una ficha/anuncio, es totalmente gratuito. Si quieres que tu anuncio se vea en las primeras posiciones y no se quede atrás, debes de comprar créditos. Te explicamos cómo hacerlo en el apartado Ayuda dentro de tu panel.</p>
            <span><?php echo $BIZBOOK['YOUR_CREDITS_POINTS'];?><b><?php echo AddingZero_BeforeNumber($user_details_row['user_credit']); ?></b></span>
            <?php if($user_details_row['setting_user_status'] == 0){?> <a href="db-credits" class="btn"><?php echo $BIZBOOK['BUY_CREDITS'];?></a><?php }?>
        </div>
    </div>
    <div class="ud-rhs-promo ud-rhs-promo-1">
        <h3><?php echo $BIZBOOK['MEMBER_COMMUNITY'];?></h3>
        <p><?php echo $BIZBOOK['FOLLOW_USER_COMMUNITY'];?>.</p>
        <a href="community"><?php echo $BIZBOOK['COMMUNITY'];?></a>
    </div>
    <div class="ud-rhs-sec-1 dash-adm-not-scr">
        <h4><?php echo $BIZBOOK['ADMIN_NOTIFICATION']; ?></h4>
        <ul>
            <?php
            if($user_details_row['user_type'] == 'Service provider'){
                $user_type_id = 101;
            }else{
                $user_type_id = 102;
            }
            if($user_plan_type['plan_type_id'] != NULL || !empty($user_plan_type['plan_type_id'])){
                $plan_type_id = $user_plan_type['plan_type_id'];
            }else{
                $plan_type_id = 0;
            }

            foreach (getAllUserNotification($user_type_id,$plan_type_id) as $notificationrow) {
                ?>
                <li>
                    <a target="_blank" href="<?php echo $notificationrow['notification_link']; ?>">
                        <h5><?php echo $notificationrow['notification_title']; ?></h5>
                        <p><?php echo $notificationrow['notification_message']; ?></p>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
    <div class="ud-rhs-sec-3">
        <div class="list-mig-like">
            <div class="list-ri-peo-like">
                <h3><?php echo $BIZBOOK['WHO_ALL_FOLLOW_YOU']; ?></h3>
                <ul>
                    <?php
                    $user_followers_array = explode(",", $user_details_row['user_followers']);
                    foreach ($user_followers_array as $user_followers) {
                        $user_followers_row = getUser($user_followers); // To Fetch particular User Data
                        ?>
                        <li>
                            <a href="<?php echo $webpage_full_link; ?>profesional/<?php echo $user_followers_row['user_slug']; ?>" target="_blank">
                                <img src="images/user/<?php if(($user_followers_row['profile_image'] == NULL) || empty($user_followers_row['profile_image'])){  echo $footer_row['user_default_image'];}else{ echo $user_followers_row['profile_image']; } ?>" title="<?php echo $BIZBOOK['WHO_ALL_FOLLOW_YOU']; ?>" alt="<?php echo $BIZBOOK['WHO_ALL_FOLLOW_YOU']; ?>">
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    <?php /*<!--                    <li>-->
                    <!--                        <a href="profile" target="_blank">-->
                    <!--                            <img src="images/user/2.jpg" alt="">-->
                    <!--                        </a>-->
                    <!--                    </li>-->
                    <!--                    <li>-->
                    <!--                        <a href="profile" target="_blank">-->
                    <!--                            <img src="images/user/3.jpg" alt="">-->
                    <!--                        </a>-->
                    <!--                    </li>-->
                    <!--                    <li>-->
                    <!--                        <a href="profile" target="_blank">-->
                    <!--                            <img src="images/user/4.jpg" alt="">-->
                    <!--                        </a>-->
                    <!--                    </li>-->
                    <!--                    <li>-->
                    <!--                        <a href="profile" target="_blank">-->
                    <!--                            <img src="images/user/5.jpg" alt="">-->
                    <!--                        </a>-->
                    <!--                    </li>-->
                    <!--                    <li>-->
                    <!--                        <a href="profile" target="_blank">-->
                    <!--                            <img src="images/user/6.jpg" alt="">-->
                    <!--                        </a>-->
                    <!--                    </li>-->
                    <!--                    <li>-->
                    <!--                        <a href="profile" target="_blank">-->
                    <!--                            <img src="images/user/7.jpg" alt="">-->
                    <!--                        </a>-->
                    <!--                    </li>-->
                    <!--                    <li>-->
                    <!--                        <a href="profile" target="_blank">-->
                    <!--                            <img src="images/user/8.jpg" alt="">-->
                    <!--                        </a>-->
                    <!--                    </li>-->*/?>
                </ul>
            </div>
        </div>
    </div>

</div>
</div>
</section>
<!--END PRICING DETAILS-->
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
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>