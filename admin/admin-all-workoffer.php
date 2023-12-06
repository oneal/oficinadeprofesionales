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
                    <a href="admin-add-new-workoffer.php" class="db-tit-btn">Nueva oferta trabajo</a>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><?php echo $BIZBOOK['NAME'];?></th>
                            <th><?php echo $BIZBOOK['CATEGORY'];?></th>
                            <th><?php echo $BIZBOOK['VIEW'];?></th>
                            <th><?php echo $BIZBOOK['CREATED_BY'];?></th>
                            <th><?php echo $BIZBOOK['EDIT'];?></th>
                            <th><?php echo $BIZBOOK['DELETE'];?></th>
                            <th><?php echo $BIZBOOK['PREVIEW'];?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $si = 1;
                        foreach (getAllWorkOffers() as $workOffer) {

                            $user_id = $workOffer['user_id'];
                            $category_row = getCategoryWokrOffer($workOffer['category_id']);

                            $user_details_row = getUser($user_id);

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><img
                                        src="<?php if ($workOffer['profile_image'] != NULL || !empty($category_row['category_image'])) {
                                            echo "../images/services/" . $category_row['category_image'];
                                        } else {
                                            echo "../images/listings/hot4.jpg";
                                        } ?>"><?php echo $workOffer['work_offer_name']; ?>
                                    <span><?php echo dateFormatconverter($workOffer['work_offer_cdt']); ?></span>
                                </td>
                                <td>
                                    <span class="db-list-rat"><?php echo $category_row['category_name']; ?></span>
                                </td>
                                <td><span
                                        class="db-list-rat"><?php echo work_offer_pageview_count($workOffer['work_offer_id']); ?></span>
                                </td>
                                <td><a href="<?php echo $webpage_full_link; ?>profesional/<?php echo $user_details_row['user_slug']; ?>"
                                       class="db-list-ststus"
                                       target="_blank"><?php echo $user_details_row['first_name'] ?></a></td>
                                <td><a href="admin-edit-workoffer.php?code=<?php echo $workOffer['work_offer_code']; ?>"
                                       class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                <td><a href="admin-delete-workoffer.php?code=<?php echo $workOffer['work_offer_code']; ?>"
                                       class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
                                <td><a href="<?php echo $webpage_full_link; ?>oferta-trabajo/<?php echo $workOffer['work_offer_slug']; ?>" class="db-list-edit" target="_blank"><?php echo $BIZBOOK['PREVIEW'];?></a></td>
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