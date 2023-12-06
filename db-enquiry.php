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
        <span class="udb-inst"><?php echo $BIZBOOK['LEADS']; ?></span>
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
                    <th><?php echo $BIZBOOK['PAGE_NAME']; ?></th>
                    <th><?php echo $BIZBOOK['TRACKING_ID']; ?></th>
                    <th><?php echo $BIZBOOK['URL']; ?></th>
                    <?php /*<th><?php echo $BIZBOOK['DELETE']; ?></th>*/?>
                </tr>
                </thead>
                <tbody>

                <?php
                $si = 1;
                $session_user_id = $_SESSION['user_id'];
                foreach (getUserEnquiries($session_user_id) as $enquiries_row) {

                    $enquiry_listing_id = $enquiries_row['listing_id'];
                    $enquiry_event_id = $enquiries_row['event_id'];
                    $enquiry_blog_id = $enquiries_row['blog_id'];
                    $enquiry_product_id = $enquiries_row['product_id'];

                    $listing_enquiry_row = getAllListingUserListing($session_user_id,$enquiry_listing_id);
                    $event_enquiry_row = getEvent($enquiry_event_id);
                    $blog_enquiry_row = getBlog($enquiry_blog_id);
                    $product_enquiry_row = getIdProduct($enquiry_product_id);

                    ?>
                    <tr>
                        <td><?php echo $si; ?></td>
                        <td><?php echo $enquiries_row['enquiry_name']; ?> 
                            <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                        </td>
                        <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                        <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                        <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                        <td><?php
                            if($enquiry_listing_id != 0){
                                echo $listing_enquiry_row['listing_name'];
                            }else if($enquiry_event_id != 0){
                                echo $event_enquiry_row['event_name'];
                            } elseif($enquiry_blog_id != 0){
                                echo $blog_enquiry_row['blog_name'];
                            }elseif($enquiry_product_id != 0){
                                echo $product_enquiry_row['product_name'];
                            } else{
                                echo "N/A";
                            }
                             ?></td>
                        <td><?php echo $enquiries_row['enquiry_source']; ?></td>
                        <td><?php echo $webpage_full_link.'anuncio/'. $listing_enquiry_row['listing_slug'];?></td>
                        <?php /*<td><a href="enquiry_trash.php?messageenquirymessageenquirymessageenquirymessageenquiry=<?php echo $enquiries_row['enquiry_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE']; ?></a></td>*/?>
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
if (isset($_GET['ledname_1'])) {
    trashFolderNew($_GET['ledname_1']);
}
include "dashboard_right_pane.php";
?>