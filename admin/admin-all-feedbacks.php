<?php
include "header.php";
?>

<?php if($admin_row['admin_listing_options'] != 1){
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['ALL_FEEDBACKS'];?></span>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['ALL_FEEDBACKS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <table class="responsive-table bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><?php echo $BIZBOOK['NAME'];?></th>
                            <th><?php echo $BIZBOOK['MOBILE'];?></th>
                            <th><?php echo $BIZBOOK['EMAIL'];?></th>
                            <th><?php echo $BIZBOOK['MESSAGE'];?></th>
                            <th><?php echo $BIZBOOK['INFO_IP'];?></th>
                            <th><?php echo $BIZBOOK['DATE'];?></th>
                            <th><?php echo $BIZBOOK['DELETE'];?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $si = 1;
                        foreach (getAllMessages() as $claimrow) {

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><?php echo $claimrow['sender_name']; ?></td>
                                <td><?php echo $claimrow['sender_mobile']; ?></td>
                                <td><?php echo $claimrow['sender_email']; ?></td>
                                <td><?php echo $claimrow['message']; ?></td>
                                <td><?php echo $claimrow['ip']; ?></td>
                                <td><span class="db-list-rat"><?php  echo dateFormatconverter($claimrow['message_cdt']); ?></span></td>
                                <td><a href="trash-feedback.php?trashfeedbacktrashfeedbacktrashfeedbacktrashfeedbacktrashfeedback=<?php echo $claimrow['message_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
                            </tr>
                            <?php
                            $si++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="ad-pgnat">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#"><?php echo $BIZBOOK['PREVIOUS'];?></a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#"><?php echo $BIZBOOK['NEXT'];?></a></li>
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
</body>

</html>