<?php
include "header.php";
?>

<?php if($admin_row['admin_listing_price_options'] != 1){
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['CREDITS'];?></span>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['CREDITS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <a href="admin-add-new-credit.php" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_CREDIT'];?></a>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><?php echo $BIZBOOK['NAME'];?></th>
                            <th><?php echo $BIZBOOK['PRICE'];?></th>
                            <th><?php echo $BIZBOOK['CREDITS_POINTS'];?></th>
<!--                            <th>Status</th>-->
                            <th><?php echo $BIZBOOK['EDIT'];?></th>
                            <th><?php echo $BIZBOOK['DELETE'];?></th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $si = 1;
                        foreach (getAllCreditType() as $credit_row) {
                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><?php echo $credit_row['credit_name']; ?></td>
                                <td><span class="db-list-rat"><?php if($credit_row['credit_price'] == 0){
                                            echo "Free";
                                        }else{
                                            echo $credit_row['credit_price'].''.$footer_row['currency_symbol'];
                                        }  ?></span></td>
                                <td><span class="db-list-rat"><?php echo $credit_row['credit_points']; ?></span></td>
<!--                                <td><span class="db-list-appro">--><?php //echo $credit_row['credit_status']; ?><!--</span></td>-->
                                <td><a href="admin-credit-edit.php?row=<?php echo $credit_row['credit_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                <td><a href="admin-credit-delete.php?row=<?php echo $credit_row['credit_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>

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
<script src="js/admin-custom.js"></script> <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>