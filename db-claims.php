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
        <span class="udb-inst"><?php echo $BIZBOOK['LEAD_CLAIMS']; ?></span>
        <?php
        if ($user_details_row['user_status'] == 'Inactive') {
            ?>
            <div class="log-error use-act-err"><p><?php echo $BIZBOOK['IMPORTANT_PROFILE'];?>.</p></div>
            <?php
        }
        ?>
        <div class="ud-cen-s2">
            <h2><?php echo $BIZBOOK['ENQUIRY_DETAILS']; ?></h2>
            <?php include "page_level_message.php"; ?>
            <table class="responsive-table bordered">
                <thead>
                <tr>
                    <th><?php echo $BIZBOOK['S_NO']; ?></th>
                    <th><?php echo $BIZBOOK['NAME']; ?></th>
                    <th><?php echo $BIZBOOK['EMAIL']; ?></th>
                    <th><?php echo $BIZBOOK['PHONE']; ?></th>
                    <th><?php echo $BIZBOOK['MESSAGE']; ?></th>
                </tr>
                </thead>
                <tbody>

                <?php
                $si = 1;
                $user_id = $_SESSION['user_id'];
                foreach (getAllClaimListings($user_id) as $enquiries_row) {

                    $enquiry_listing_id = $enquiries_row['listing_id'];

                    $listing_enquiry_row = getAllListingUserListing($session_user_id,$enquiry_listing_id);

                    ?>
                    <tr>
                        <td><?php echo $si; ?></td>
                        <td><?php echo $enquiries_row['enquiry_name']; ?> 
                            <span><?php echo dateFormatconverter($enquiries_row['claim_cdt']); ?></span>
                        </td>
                        <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                        <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                        <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                    </tr>
                    <?php
                    $si++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
include "dashboard_right_pane.php";
?>