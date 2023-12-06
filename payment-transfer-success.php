<?php
    include "header.php";
?>
<?php if(!isset($_GET['row']) and empty($_GET['row'])){
    header('Location: db-credits');
    exit;
} ?>

<?php 
    $TransCode = $_GET['row'];
    $transaction_row = getTransaction($TransCode);
    
    $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
    $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
?>
    <!-- START -->
<section class="login-reg">
    <div class="container">
        <div class="row">
            <div class="login-main add-list posr">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst">Pago Transferencia</span>
                <div class="log log-1">
                    <div class="login">
                        <h4>Datos para hacer transferencia</h4>
                        <p>
                            <strong>Concepto: </strong>Pago <?php echo $transaction_row['transaction_code'];?><br/>
                            <strong>Entidad: </strong><?php echo $admin_primary_email_fetchrow['admin_cod_entity_bank'];?><br/>
                            <strong>NºCuenta: </strong><?php echo $admin_primary_email_fetchrow['admin_cod_num_bank'];?><br/>
                            <strong>IBAN: </strong><?php echo $admin_primary_email_fetchrow['admin_cod_iban'];?><br/>
                            <strong>Código BIC/SWIFT: </strong><?php echo $admin_primary_email_fetchrow['admin_cod_bic_swift'];?><br/>
                            <strong>Beneficiario: </strong><?php echo $admin_primary_email_fetchrow['admin_cod_benify'];?><br/>
                            <strong>Importe: </strong><?php echo number_format($transaction_row['transaction_amount'],2,',','');?>&euro;<br/>
                        </p>
                        <p>
                            <?php echo $BIZBOOK['TEXT_TRANFER'];?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include "footer.php";
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/select-opt.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>
</body>

</html>
