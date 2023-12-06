<?php/*
include "header.php";
?>
<?php if($admin_row['admin_invoice_options'] != 1){
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['CREATE_INVOICE'];?></span>
                <div class="ud-cen-s2 add-list">
                    <div id="content2" contenteditable="true">
                        <div class="pdf-main">
                            <div class="inn">
                                <table class="table">
                                    <tbody>
                                        <tr style="width: 700px;">
                                            <td style=" background: #0b253a; width: 350px"><img src="../images/home/24147logo-blanco.png" style="max-width: 200px; padding-left: 20px"></td>
                                            <?php /*<td style="width: 350px; text-align: right;">
                                                <h2 style="font-size:1em"> N&deg; Factura: ' . $transaction_row['transaction_invoice'] . '</h2>
                                                <p style="font-size:1em"><strong>Fecha factura:</strong>' . date("d/m/Y", strtotime($transaction_row['transaction_cdt'])).'</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-left: 20px; width:50%">
                                                <h2 style="font-size:1.2em;color:#333;">La Oficina de los profesionales</h2>
                                                <p>
                                                    Carretera de Torrequebradilla km 3,5<br/>
                                                    Jaén<br/>
                                                    23009 - Jaén <br/>
                                                    CIF/NIF - B-23449309
                                                </p>
                                            </td>
                                            <td style="width:50%;">
                                                <h2 style="font-size:1.2em;color:#333;">Usuario de prueba</h2>
                                                <p>Calle de prueba, 87<br/>Ciudad de prueba<br/>23445 - Provincia de prueba<br/>CIF/NIF - B-23449309</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table align="center" border="0" cellpadding="8" cellspacing="0" width="100%">
                                    <tr>
                                        <td>
                                            <table border="0" cellpadding="5" cellspacing="0" width="100%">
                                                <tr align="center">
                                                        <th>Cantidad</th>
                                                        <th>Descripción</th>
                                                        <th>Precio</th>
                                                        <th>Valor</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="7"><hr></td>
                                                </tr>
                                                <tr align="center">
                                                    <td>1</td>
                                                    <td>Package 1</td>
                                                    <td>1&euro;</td>
                                                    <td>1&euro;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7" contenteditable="false"><hr></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7" contenteditable="false">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7" contenteditable="false">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7" contenteditable="false">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7" contenteditable="false">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7" contenteditable="false">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7" contenteditable="false">&nbsp;</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="7" contenteditable="false">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align: right;">BASE</td>
                                                    <td style="text-align: center;">1&euro;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align: right;">IVA 21%</td>
                                                    <td style="text-align: center;">1&euro;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="text-align: right;">TOTAL</td>
                                                    <td style="text-align: center;">1&euro;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <button class="btn-mpdf" id="downloadPDF"><?php echo $BIZBOOK['DOWNLOAD'];?></button>
                    <?php /*
                    <div class="col-md-12">
                        <a href="admin-send-invoice.php" class="skip">Send Invoice &gt;&gt;</a>
                    </div>
                    <div class="ud-notes">
                        <p><?php echo $BIZBOOK['NOTE_INVOICE'];?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery.min.js"></script>
<script src="js/dom-to-image.min.js"></script>
<script src="js/jspdf.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="js/admin-custom.js"></script> <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>