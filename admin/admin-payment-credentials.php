<?php
include "header.php";
?>

<?php if($admin_row['admin_payment_options'] != 1){
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['PAYMENT_DETAILS'];?></span>
                <div class="ud-cen-s2">
                     <h2><?php echo $BIZBOOK['PAYMENT_DETAILS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $BIZBOOK['PAYMENT_TYPE'];?></th>
                                <th><?php echo $BIZBOOK['DETAILS'];?></th>
                                <th><?php echo $BIZBOOK['EDIT'];?></th>
                                <th><?php echo $BIZBOOK['STATUS'];?></th>
                            </tr>
                        </thead>
                        <?php

                       $row_f = getAllFooter();
                        
                        ?>
							<tbody>
								<tr>
                                    <td>1</td>
                                    <td><?php echo $BIZBOOK['CASH_ON_DELIVERY'];?></td>
                                    <td><span class="db-list-rat"><?php echo $row_f['admin_cod_entity_bank']; ?></span><span class="db-list-rat"><?php echo $row_f['admin_cod_num_bank']; ?></span><span class="db-list-rat"><?php echo $row_f['admin_cod_iban']; ?></span><span class="db-list-rat"><?php echo $row_f['admin_cod_bic_swift']; ?></span><span class="db-list-rat"><?php echo $row_f['admin_cod_benify']; ?></span></td>
                                    <td><a href="admin-payment-credentials-edit.php?row=cod" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                    <td><span class="db-list-appro"><?php echo $row_f['admin_cod_status']; ?></span></td>
								</tr>
                                <tr>
                                    <td>2</td>
                                    <td>PayPal</td>
                                    <td><span class="db-list-rat"><?php echo $row_f['admin_paypal_id']; ?></span></td>
                                    <td><a href="admin-payment-credentials-edit.php?row=paypal" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                    <td><span class="db-list-appro"><?php echo $row_f['admin_paypal_status']; ?></span></td>
                                </tr>
                                
                                <tr>
                                    <td>3</td>
                                    <td>Stripe</td>
                                    <td><span class="db-list-rat"><?php echo $row_f['admin_stripe_id']; ?></span></td>
                                    <td><a href="admin-payment-credentials-edit.php?row=stripe" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                    <td><span class="db-list-appro"><?php echo $row_f['admin_stripe_status']; ?></span></td>
                                </tr>
                                
                                <tr>
                                    <td>4</td>
                                    <td>TPV</td>
                                    <td><span class="db-list-rat"><?php echo $row_f['admin_tpv_name']; ?></span></td>
                                    <td><a href="admin-payment-credentials-edit.php?row=tpv" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                    <td><span class="db-list-appro"><?php echo $row_f['admin_tpv_status']; ?></span></td>
                                </tr>
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