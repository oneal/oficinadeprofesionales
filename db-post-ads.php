<?php /*
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}
include "dashboard_left_pane.php";
?>
    <!--CENTER SECTION-->
    <div class="ud-cen">
        <div class="log-bor">&nbsp;</div>
        <span class="udb-inst">Paid ads</span>
        <?php
        if ($user_details_row['user_status'] == 'Inactive') {
            ?>
            <div class="log-error use-act-err"><p>Important: Your Profile has not been activated yet. You can create your Listings, Products, Events & Blogs. But it will be posted after profile activation.</p></div>
            <?php
        }
        ?>
        <div class="ud-cen-s2">
            <h2>Your Banner Ads</h2>
            <?php include "page_level_message.php"; ?>
            <a href="post-your-ads" class="db-tit-btn db-tit-btn-2-ads">Post your Ads</a>
            <a href="ad-details" class="db-tit-btn">Pricing and other details</a>
            <table class="responsive-table bordered">
                <thead>
                <tr>
                    <th>No</th>
<!--                    <th>Ads Name</th>-->
                    <th>Ads Position</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Clicks</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $si = 1;
                $session_user_id = $_SESSION['user_id'];
                foreach (getAllUserAdsEnquiry($session_user_id) as $row) {

                    $all_ads_price_id = $row['all_ads_price_id'];

                    $user_id = $row['user_id'];

                    $user_details_row = getUser($user_id);

                    $ads_price_details_row = getAdsPrice($all_ads_price_id);

                    ?>
                    <tr>
                        <td><?php echo $si; ?></td>
<!--                        <td>Taj Luxury Hotel</td>-->
                        <td><?php echo $ads_price_details_row['ad_price_name']; ?></td>
                        <td><?php echo dateFormatconverter($row['ad_start_date']);?></td>
                        <td><?php echo dateFormatconverter($row['ad_end_date']);?></td>
                        <td><?php echo $row['ad_total_days']; ?> Days</td>
                        <td><span class="db-list-ststus"><?php echo $row['ad_enquiry_status']; ?></span></td>
                        <td><span class="db-list-rat">1k</span></td>
                        <td><span class="db-list-rat">642</span></td>
                    </tr>
                    <?php
                    $si++;
                }
                ?>
                </tbody>
            </table>
            <div class="ud-notes">
                <p><b>Notes:</b> Hi, Before start "Ads Payment" you must know the pricing details and positions and all.
                    You just click the "Pricing and other details" button in this same page and you know the all
                    details. If your payment done means your invoice automaticall received your "Payment invoice" page
                    and you never stop your Ads till the end date.</p>
            </div>
        </div>
    </div>
<?php
include "dashboard_right_pane.php";
?>