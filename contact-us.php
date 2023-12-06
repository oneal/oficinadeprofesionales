<?php
include "header.php";
?>
<?php /*<!-- START -->
	<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> con-us-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1278.5174513549355!2d-3.754858359962736!3d37.79874714991229!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzfCsDQ3JzU3LjQiTiAzwrA0NScxNS45Ilc!5e0!3m2!1ses!2ses!4v1618006346343!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
	</section>
	<!--END-->
*/?>
    <!-- START -->
<section class="<?php //if($footer_row['admin_language']== 2){ echo "lg-arb";}?>con-us-loc">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="tit">
                        <h2>Contactanos</h2>
                        <h6>Puedes contactar con nosotros por el e-mail, por correo postal, o completando el formulario. Te atenderemos lo antes posibles.</h6>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-12">
                    <div class="con-pg-addr ">
                        <h4>Dirección:</h4>
                        <h5>España:</h5>
                        <p><?php echo $footer_row['footer_address'];?></p>
                        
                    </div>
                    <div class="con-pg-info">
                        <h4>Contact info:</h4>
                        <ul>
                            <li class="ic-eml">Email: <?php echo $footer_row['admin_primary_email'];?></li>
                        </ul>
                    </div>
                    <div class="con-pg-soc">
                        <h4>Redes sociales:</h4>
                        <ul>
                            <?php if($footer_row['footer_fb'] != ""){?>
                                <li class="ic-man-fb"><a href="<?php echo $footer_row['footer_fb'];?>">Facebook</a></li>
                            <?php }?>
                            <?php if($footer_row['footer_twitter'] != ""){?>    
                                <li class="ic-man-tw"><a href="<?php echo $footer_row['footer_twitter'];?>">Twitter</a></li>
                            <?php }?>
                            <?php if($footer_row['footer_linked_in'] != ""){?>    
                                <li class="ic-man-ld"><a href="<?php echo $footer_row['footer_linked_in'];?>">Linkedin</a></li>
                            <?php }?>
                            <?php if($footer_row['footer_youtube'] != ""){?>    
                                <li class="ic-man-youtube"><a href="<?php echo $footer_row['footer_youtube'];?>">Youtube</a></li>
                            <?php }?>
                            <?php if($footer_row['footer_whatsapp'] != ""){?>    
                                <li class="ic-man-whatsapp"><a href="<?php echo $footer_row['footer_whatsapp'];?>">Whatsapp</a></li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-12">
                    <div class="hom-col-req">
                        <div class="log-bor">&nbsp;</div>
                        <span class="udb-inst">Rellena el formulario</span>
                        <h4>¿En que podemos ayudarte?</h4>
                        <div id="home_enq_success" class="log" style="display: none;">
                            <p style="color: green; font-weight: bold"><?php echo $BIZBOOK['YOUT_ENQUIRY_SEND_SUCCESS'];?></p>
                        </div>
                        <div id="home_enq_fail" class="log" style="display: none;">
                            <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['SOMETHING_WENT_WRONG'];?></p>
                        </div>
                        <div id="home_enq_same" class="log" style="display: none;">
                            <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['YOU_CANNOT_MAKE_ENQUIRY'];?></p>
                        </div>
                        <div id="home_enq_name" class="log" style="display: none;">
                            <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['ENTER_NAME'];?></p>
                        </div>
                        <div id="home_enq_phone" class="log" style="display: none;">
                            <p style="color: red; font-weight: bold" ><?php echo $BIZBOOK['PHONE_NO_VALID'];?></p>
                        </div>
                        <div id="home_enq_email" class="log" style="display: none;">
                            <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['EMAIL_NO_VALID'];?></p>
                        </div>
                        <div id="home_enq_message" class="log" style="display: none;">
                            <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['ENTER_MESSAGE'];?></p>
                        </div>
                        <div id="home_enq_theme" class="log" style="display: none;">
                            <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['ENTER_THEME'];?></p>
                        </div>
                        <form name="home_contact_form" id="home_contact_form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="enquiry_name" value="" required="required" class="form-control"
                                       placeholder="<?php echo $BIZBOOK['ENTER_NAME'];?>*">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_EMAIL'];?>*" required="required"
                                       value=""
                                       name="enquiry_email"
                                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                       title="<?php echo $BIZBOOK['INVALID_EMAIL'];?>">
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" value="" name="enquiry_mobile"
                                       placeholder="<?php echo $BIZBOOK['PHONE'];?> *" required="required">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" value="" name="theme"
                                       placeholder="<?php echo $BIZBOOK['THEME'];?> *"
                                       title="<?php echo $BIZBOOK['THEME'];?>" required="required">
                            </div>
                            <div class="form-group">
                            <textarea class="form-control" rows="3" name="enquiry_message" placeholder="<?php echo $BIZBOOK['ENQUIRY_MESSAGE'];?>" required="required"></textarea>
                            </div>
                            <div class="form-check" style="margin-bottom: 10px;">
                                <input class="form-check-input" type="checkbox" value="politica-privacidad" name="politica_privacidad" id="politica-privacidad" required="required">
                                <label class="form-check-label" for="politica-privacidad">He leido y acepto la <a href="#" data-toggle="modal" data-target="#contactoPoliticaPrivacidadModal" title="política de privacidad">política de privacidad</a></label>
                            </div>
                            <input type="hidden" id="source">
                            <button type="submit" id="home_contact_submit" name="home_contact_submit"
                                    class="btn btn-primary">
                                <?php echo $BIZBOOK['SUBMIT'];?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>
	<!--END-->
        
<?php
include "modal_politca_privacidad.php";
?>
<?php
include "footer.php";
?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>
</body>

</html>

