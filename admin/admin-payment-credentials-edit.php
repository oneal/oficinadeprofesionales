<?php
include "header.php";
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                 <section class="login-reg">
		<div class="container">
			<div class="row">
                <div class="login-main add-list add-ncate">
                     <div class="log-bor">&nbsp;</div>
                    <?php
                    $payment_name1 =$_GET['row'];
                    if($payment_name1 == "cod"){
                        $payment_name = $BIZBOOK['CASH_ON_DELIVERY'];
                    }else if ($payment_name1 == "paypal"){
                        $payment_name = "PayPal";
                    }else if ($payment_name1 == "stripe"){
                        $payment_name = "Stripe";
                    }else if ($payment_name1 == "tpv"){
                        $payment_name = "tpv";
                    }

                    $row = getAllFooter();
                    ?>
                    <span class="udb-inst"><?php echo $payment_name; ?></span>
                    <div class="log log-1">
                        <div class="login">
                            <h4><?php echo $BIZBOOK['CREDENTIALS'];?> <?php echo $payment_name; ?></h4>
                            <?php include "../page_level_message.php"; ?>
                             <form name="payment_credentials" id="payment_credentials" action="update_payment_credential.php" method="post" enctype="multipart/form-data" class="cre-dup-form cre-dup-form-show">
                                 <input type="hidden" autocomplete="off" name="footer_id"
                                        value="<?php echo $row['footer_id']; ?>" id="footer_id" class="validate">
                                 <input type="hidden" autocomplete="off" name="footer_path"
                                        value="<?php echo $payment_name1; ?>" id="footer_id" class="validate">
                                 <ul>
                                     <li>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <?php if($payment_name1 =="paypal"){ ?>
                                                        <input type="text" name="admin_paypal_id" value="<?php echo $row['admin_paypal_id']; ?>" class="form-control" placeholder="Introduce email bussiness <?php echo $payment_name; ?> *" required>
                                                        <div class="chbox" style="margin-top: 5px; margin-bottom: 5px">
                                                            <input type="checkbox" id="paypal_test" name="paypal_test" <?php echo $pruebas = ($row['admin_paypal_pruebas']==1) ? 'checked' : '';?> value="<?php echo $row['admin_paypal_pruebas'];?>">
                                                            <label for="paypal_test">Modo pruebas</label>
                                                        </div>
                                                    <?php } else if($payment_name1 =="stripe"){ ?>
                                                        <input type="text" name="admin_stripe_id" value="<?php echo $row['admin_stripe_id']; ?>" class="form-control" placeholder="Introduce id <?php echo $payment_name; ?> *" required>
                                                    <?php } else if($payment_name1 =="cod"){ ?> 
                                                        <input type="text" name="admin_cod_entity_bank" value="<?php echo $row['admin_cod_entity_bank']; ?>" class="form-control" placeholder="Entidad *" required>
                                                        <input type="text" name="admin_cod_num_bank" value="<?php echo $row['admin_cod_num_bank']; ?>" class="form-control" placeholder="NºCuenta España: XXXX-XXXX-XX-XXXXXXXXXX *" required>
                                                        <input type="text" name="admin_cod_iban" value="<?php echo $row['admin_cod_iban']; ?>" class="form-control" placeholder="IBAN: ESXX-XXXX-XXXX-XXXX-XXXX-XXXX *" required>
                                                        <input type="text" name="admin_cod_bic_swift" value="<?php echo $row['admin_cod_bic_swift']; ?>" class="form-control" placeholder="Código BIC/SWIFT *" required>
                                                        <input type="text" name="admin_cod_benify" value="<?php echo $row['admin_cod_benify']; ?>" class="form-control" placeholder="Beneficiario *" required>
                                                    <?php } else if($payment_name1 =="tpv"){ ?>
                                                        <input type="text" name="admin_tpv_version" value="<?php echo $row['admin_tpv_version']; ?>" class="form-control" placeholder="Versión *" required>
                                                        <input type="text" name="admin_tpv_clave" value="<?php echo $row['admin_tpv_clave']; ?>" class="form-control" placeholder="Clave de firma *" required>
                                                        <input type="text" name="admin_tpv_name" value="<?php echo $row['admin_tpv_name']; ?>" class="form-control" placeholder="Nombre entidad *" required>
                                                        <input type="text" name="admin_tpv_code" value="<?php echo $row['admin_tpv_code']; ?>" class="form-control" placeholder="Código comercio *" required>
                                                        <input type="text" name="admin_tpv_terminal" value="<?php echo $row['admin_tpv_terminal']; ?>" class="form-control" placeholder="Nº terminal *" required>
                                                        <div class="chbox" style="margin-top: 5px; margin-bottom: 5px">
                                                            <input type="checkbox" id="tpv_test" name="tpv_test" <?php echo $pruebas = ($row['admin_tpv_pruebas']==1) ? 'checked' : '';?> value="<?php echo $row['admin_tpv_pruebas'];?>">
                                                            <label for="tpv_test">Modo pruebas</label>
                                                        </div>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                  <select <?php if($payment_name1 =="paypal"){ ?> name="admin_paypal_status"  <?php } ?>
                                                      <?php if($payment_name1 =="stripe"){ ?> name="admin_stripe_status" <?php } ?>
                                                      <?php if($payment_name1 =="cod"){ ?> name="admin_cod_status" <?php } ?>
                                                      <?php if($payment_name1 =="tpv"){ ?> name="admin_tpv_status" <?php } ?>required="required" class="form-control">
                                                    <option value="">Select status</option>
                                                    <option <?php if($payment_name1 =="paypal"){ if($row['admin_paypal_status']=="Active"){ ?> selected="selected"  <?php } } ?>
                                                        <?php if($payment_name1 =="stripe"){ if($row['admin_stripe_status']=="Active"){ ?> selected="selected"  <?php } }  ?>
                                                        <?php if($payment_name1 =="cod"){ if($row['admin_cod_status']=="Active"){ ?> selected="selected"  <?php } } ?>
                                                        <?php if($payment_name1 =="tpv"){ if($row['admin_tpv_status']=="Active"){ ?> selected="selected"  <?php } } ?>>Active</option>
                                                    <option <?php if($payment_name1 =="paypal"){ if($row['admin_paypal_status']=="InActive"){ ?> selected="selected"  <?php } } ?>
                                                        <?php if($payment_name1 =="stripe"){ if($row['admin_stripe_status']=="InActive"){ ?> selected="selected"  <?php } }  ?>
                                                        <?php if($payment_name1 =="cod"){ if($row['admin_cod_status']=="InActive"){ ?> selected="selected"  <?php } } ?>
                                                        <?php if($payment_name1 =="tpv"){ if($row['admin_tpv_status']=="InActive"){ ?> selected="selected"  <?php } } ?>>InActive</option>
                                                  </select>
                                                </div>
                                            </div>
                                        </div>
                                     </li>
                                 </ul>
                                <button type="submit" name="payment_credential_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>
                            </form>
                            <div class="col-md-12">
                                    <a href="admin-payment-credentials.php" class="skip"><?php echo $BIZBOOK['GO_TO_PAYMENT_CREDENTIALS'];?> >></a>
                                </div>

                        </div>
                    </div>
                </div>
			</div>
		</div>
	</section>

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
    <script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>