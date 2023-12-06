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
        <span class="udb-inst">Respuestas ofertas de trabajo</span>
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
                    <?php /*<th>Curriculum</th>*/?>
                </tr>
                </thead>
                <tbody>

                <?php
                $si = 1;
                $user_id = $_SESSION['user_id'];
                $enquiry_work_offer_rs = getAllEnquiryWorkOffer($user_id);
                foreach (getAllEnquiryWorkOfferUser($user_id) as $enquiries_row) {?>
                    <tr>
                        <td><?php echo $si; ?></td>
                        <td><?php echo $enquiries_row['enquiry_name']; ?> 
                            <span><?php echo dateFormatconverter($enquiries_row['enquiry_cdt']); ?></span>
                        </td>
                        <td><?php echo $enquiries_row['enquiry_email']; ?></td>
                        <td><?php echo $enquiries_row['enquiry_mobile']; ?></td>
                        <td><?php echo $enquiries_row['enquiry_message']; ?></td>
                        <?php /*<td><a href="<?php echo $webpage_full_link;?>images/workoffer/curriculum/<?php echo $enquiries_row['work_offer_curriculum']; ?>" class="db-list-edit">Ver curriculum</a></td>*/?>
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