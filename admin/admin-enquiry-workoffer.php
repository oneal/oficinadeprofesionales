<?php
include "header.php";
?>

<?php if($admin_row['admin_work_offer_options'] != 1){
    header("Location: profile.php");
}
?>

<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['WORK_OFFERS'];?></span>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['WORK_OFFERS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="<?php echo $BIZBOOK['SEARCH'];?>..">
                    </div>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><?php echo $BIZBOOK['NAME'];?></th>
                            <th><?php echo $BIZBOOK['EMAIL'];?></th>
                            <th><?php echo $BIZBOOK['MOBILE_NUMBER'];?></th>
                            <th><?php echo $BIZBOOK['MESSAGE'];?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $si = 1;

                        foreach (getAllEnquiryWorkOffer() as $workOffer) { ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td>
                                    <?php echo $workOffer['enquiry_name'];?>
                                    <span><?php echo dateFormatconverter($workOffer['enquiry_cdt']); ?></span>
                                </td>
                                <td><?php echo $workOffer['enquiry_email'];?></td>
                                <td><?php echo $workOffer['enquiry_mobile'];?></td>
                                <td><?php echo $workOffer['enquiry_message'];?></td>
                                <td><a href="trash_enquiry_work_offer.php?row=<?php echo $workOffer['enquiry_id'];?>&code=<?php echo $workOffer['work_offer_id']; ?>"
                                       class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
                            </tr>
                            <?php
                            $si++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
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
<script src="js/admin-custom.js"></script>
<script src="../js/jquery.number.min.js"></script>
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>