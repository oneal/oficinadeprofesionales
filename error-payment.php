<?php

include "header.php";
    
if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}

if(isset($_GET['code']) and empty($_GET['code'])){
    header('Location: dashboard');
    exit;
}
$row_f = getAllFooter();

$order = $_GET['code'];
$transaction_row = getTransaction($order);
?>
<section class="login-reg">
    <div class="container">
        <div class="row">
            <div class="login-main add-list posr">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst">Error pago</span>
                <div class="log log-1">
                    <div class="login">
                        <h4>Se ha producido un error en el pago</h4>
                        <p>Puedes ponerte en contacto con nosotros en <a href="mailto:<?php echo EMAIL_PAY;?>"><?php echo EMAIL_PAY;?></a> para que podamos ayudarte. De todas formas, si prefieres realizar el pago por trasferencia, aquí tienes los datos.</p>
                        <p>Nota. Se te ha enviado un correo electrónico con esta información.</p>
                        <h4>Datos para hacer transferencia</h4>
                        <p>
                            <strong>Concepto: </strong>Pago <?php echo $transaction_row['transaction_code'];?><br/>
                            <strong>Entidad: </strong><?php echo $row_f['admin_cod_entity_bank'];?><br/>
                            <strong>NºCuenta: </strong><?php echo $row_f['admin_cod_num_bank'];?><br/>
                            <strong>IBAN: </strong><?php echo $row_f['admin_cod_iban'];?><br/>
                            <strong>Código BIC/SWIFT: </strong><?php echo $row_f['admin_cod_bic_swift'];?><br/>
                            <strong>Beneficiario: </strong><?php echo $row_f['admin_cod_benify'];?><br/>
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
<script src="<?php echo $slash; ?>js/jquery.min.js"></script>
<script src="<?php echo $slash; ?>js/popper.min.js"></script>
<script src="<?php echo $slash; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $slash; ?>js/jquery-ui.js"></script>
<script src="<?php echo $slash; ?>js/custom.js"></script>
<script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo $slash; ?>js/custom_validation.js"></script>
</body>

</html>
