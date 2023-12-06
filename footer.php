<!-- START -->

<?php /*<span class="btn-ser-need-ani"><?php echo $BIZBOOK['HELP_&_SUPORT'];?></span>

<div class="ani-quo-form">
    <i class="material-icons ani-req-clo">close</i>
    <div class="tit">
        <h3><?php echo $BIZBOOK['HOM-WHAT-SER'];?> <span><?php echo $BIZBOOK['HOM-WHAT-BIZ'];?> <?php echo $BIZBOOK['HELP_YOU'];?></span></h3>
    </div>
    <div class="hom-col-req">
        <div id="home_slide_enq_success" class="log"
             style="display: none;">
            <p style="color: green; font-weight: bold"><?php echo $BIZBOOK['YOUT_ENQUIRY_SEND_SUCCESS'];?></p>
        </div>
        <div id="home_slide_enq_fail" class="log" style="display: none;">
            <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['SOMETHING_WENT_WRONG'];?></p>
        </div>
        <div id="home_slide_enq_same" class="log" style="display: none;">
            <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['YOU_CANNOT_MAKE_ENQUIRY'];?></p>
        </div>
        <div id="home_slide_enq_name" class="log" style="display: none;">
            <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['ENTER_NAME'];?></p>
        </div>
        <div id="home_slide_enq_phone" class="log" style="display: none;">
            <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['PHONE_NO_VALID'];?></p>
        </div>
        <div id="home_slide_enq_email" class="log" style="display: none;">
            <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['EMAIL_NO_VALID'];?></p>
        </div>
        <div id="home_slide_enq_message" class="log" style="display: none;">
            <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['ENTER_MESSAGE'];?></p>
        </div>
        <div id="home_slide_enq_theme" class="log" style="display: none;">
            <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['ENTER_THEME'];?></p>
        </div>
        <form name="home_slide_enquiry_form" id="home_slide_enquiry_form" method="post" enctype="multipart/form-data">
            <input type="hidden" class="form-control"
                   name="listing_id"
                   value="0"
                   placeholder=""
                   required="required">
            <input type="hidden" class="form-control"
                   name="listing_user_id"
                   value="0"
                   placeholder=""
                   required="required">
            <input type="hidden" class="form-control"
                   name="enquiry_sender_id"
                   value=""
                   placeholder=""
                   required="required">
            <input type="hidden" class="form-control"
                   name="enquiry_source"
                   value="<?php if (isset($_GET["src"])) {
                       echo $_GET["src"];
                   } else {
                       echo "Website";
                   }; ?>"
                   placeholder=""
                   required="required">
            <div class="form-group">
                <input type="text" name="enquiry_name" value="" required="required" class="form-control"
                       placeholder="<?php echo $BIZBOOK['NAME'];?>*">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_EMAIL'];?>*" required="required" value=""
                       name="enquiry_email"
                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                       title="<?php echo $BIZBOOK['INVALID_EMAIL'];?>">
            </div>
            <div class="form-group">
                <input type="tel" class="form-control" value="" name="enquiry_mobile"
                       placeholder="<?php echo $BIZBOOK['ENTER_MOBILE'];?> *" required="required">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" value="" name="theme"
                       placeholder="<?php echo $BIZBOOK['THEME'];?> *"
                       title="<?php echo $BIZBOOK['THEME'];?>" required="required">
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="3" name="enquiry_message"
                          placeholder="<?php echo $BIZBOOK['ENTER_MESSAGE'];?>" required="required"></textarea>
            </div>
            <div class="form-check" style="margin-bottom: 10px;">
                <input class="form-check-input" type="checkbox" value="politica-privacidad" name="politica_privacidad" id="politica-privacidad" required="required">
                <label class="form-check-label" style="color: #fff" for="politica-privacidad">He leido y acepto la <a href="#" data-toggle="modal" data-target="#contactoPoliticaPrivacidadModal" title="política de privacidad">política de privacidad</a></label>
            </div>
            <input type="hidden" id="source">
            <button type="submit" id="home_slide_enquiry_submit" name="home_slide_enquiry_submit"
                    class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?>
            </button>
        </form>
    </div>
</div>
<!-- END -->*/?>

<!-- START -->
<section>
    <div class="full-bot-book">
        <div class="container">
            <div class="row">
                <div class="bot-book">
                    <div class="col-md-2 bb-img">
                        <img src="<?php echo $slash;?>images/idea.png" alt="">
                    </div>
                    <div class="col-md-7 bb-text">
                        <h4><?php echo $BIZBOOK['FOOT-BAN-TIT']; ?></h4>
                        <p><?php echo $BIZBOOK['FOOT-BAN-SUB-TIT']; ?></p>
                    </div>
                    <div class="col-md-3 bb-link">
                        <a href="<?php echo $slash; ?>login"><?php echo $BIZBOOK['FOOT-BAN-ADD']; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->
<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> wed-hom-footer">
    <div class="container">
        <div class="row foot-supp">
            <h2><span><?php echo $BIZBOOK['FREE_SUPORT'];?>:</span> <?php echo $footer_row['footer_mobile']; ?> &nbsp;&nbsp;|&nbsp;&nbsp; <span>Email:</span> <?php echo $footer_row['admin_primary_email']; ?></h2>
        </div>
        <div class="row wed-foot-link">
            <div class="col-md-4 foot-tc-mar-t-o">
                <h4><?php echo $BIZBOOK['TOP_CATEGORY'];?></h4>
                <ul>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['top_category_1'])); ?>" title="<?php echo getCategoryName($footer_row['top_category_1']); ?>"><?php echo getCategoryName($footer_row['top_category_1']); ?></a></li>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['top_category_2'])); ?>" title="<?php echo getCategoryName($footer_row['top_category_2']); ?>"><?php echo getCategoryName($footer_row['top_category_2']); ?></a></li>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['top_category_3'])); ?>" title="<?php echo getCategoryName($footer_row['top_category_3']); ?>"><?php echo getCategoryName($footer_row['top_category_3']); ?></a></li>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['top_category_4'])); ?>" title="<?php echo getCategoryName($footer_row['top_category_4']); ?>"><?php echo getCategoryName($footer_row['top_category_4']); ?></a></li>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['top_category_5'])); ?>" title="<?php echo getCategoryName($footer_row['top_category_5']); ?>"><?php echo getCategoryName($footer_row['top_category_5']); ?></a></li>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['top_category_6'])); ?>" title="<?php echo getCategoryName($footer_row['top_category_6']); ?>"><?php echo getCategoryName($footer_row['top_category_6']); ?></a></li>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['top_category_7'])); ?>" title="<?php echo getCategoryName($footer_row['top_category_7']); ?>"><?php echo getCategoryName($footer_row['top_category_7']); ?></a></li>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['top_category_8'])); ?>" title="<?php echo getCategoryName($footer_row['top_category_8']); ?>"><?php echo getCategoryName($footer_row['top_category_8']); ?></a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4><?php echo $BIZBOOK['TRENDING_CATEGORY'];?></h4>
                <ul>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['trend_category_1'])); ?>" title="<?php echo getCategoryName($footer_row['trend_category_1']); ?>"><?php echo getCategoryName($footer_row['trend_category_1']); ?></a></li>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['trend_category_2'])); ?>" title="<?php echo getCategoryName($footer_row['trend_category_2']); ?>"><?php echo getCategoryName($footer_row['trend_category_2']); ?></a></li>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['trend_category_3'])); ?>" title="<?php echo getCategoryName($footer_row['trend_category_3']); ?>"><?php echo getCategoryName($footer_row['trend_category_3']); ?></a></li>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['trend_category_4'])); ?>" title="<?php echo getCategoryName($footer_row['trend_category_4']); ?>"><?php echo getCategoryName($footer_row['trend_category_4']); ?></a></li>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['trend_category_5'])); ?>" title="<?php echo getCategoryName($footer_row['trend_category_5']); ?>"><?php echo getCategoryName($footer_row['trend_category_5']); ?></a></li>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['trend_category_6'])); ?>" title="<?php echo getCategoryName($footer_row['trend_category_6']); ?>"><?php echo getCategoryName($footer_row['trend_category_6']); ?></a></li>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['trend_category_7'])); ?>" title="<?php echo getCategoryName($footer_row['trend_category_7']); ?>"><?php echo getCategoryName($footer_row['trend_category_7']); ?></a></li>
                    <li><a href="<?php echo $slash; ?>anuncios/<?php echo generar_texto_amigable(getCategoryName($footer_row['trend_category_8'])); ?>" title="<?php echo getCategoryName($footer_row['trend_category_8']); ?>"><?php echo getCategoryName($footer_row['trend_category_8']); ?></a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4><?php echo $BIZBOOK['HELP_&_SUPORT'];?></h4>
                <ul>
                    <li><a href="<?php echo $slash; ?><?php echo $footer_row['footer_page_url_1']; ?>" title="<?php echo $footer_row['footer_page_name_1']; ?>"><?php echo $footer_row['footer_page_name_1']; ?></a>
                    </li>
                    <li><a href="<?php echo $slash; ?><?php echo $footer_row['footer_page_url_2']; ?>" title="<?php echo $footer_row['footer_page_name_2']; ?>"><?php echo $footer_row['footer_page_name_2']; ?></a>
                    </li>
                    <li><a href="<?php echo $slash; ?><?php echo $footer_row['footer_page_url_3']; ?>" title="<?php echo $footer_row['footer_page_name_3']; ?>"><?php echo $footer_row['footer_page_name_3']; ?></a>
                    </li>
                    <li><a href="<?php echo $slash; ?><?php echo $footer_row['footer_page_url_4']; ?>" title="<?php echo $footer_row['footer_page_name_4']; ?>"><?php echo $footer_row['footer_page_name_4']; ?></a>
                    </li>
                    <li><a href="<?php echo $slash; ?>politica-privacidad" title="Política de privacidad">Política de privacidad</a>
                    </li>
                    <li><a href="<?php echo $slash; ?>aviso-legal" title="Aviso legal">Aviso legal</a>
                    </li>
                    <li><a href="<?php echo $slash; ?>condiciones-servicios" title="Condiciones servicio">Condiciones servicio</a>
                    </li>
                    <li><a href="<?php echo $slash; ?>condiciones-uso" title="Condiciones uso">Condiciones uso</a>
                    </li>
                    <li><a href="<?php echo $slash; ?>politica-cookies" title="Política de cookies">Política de cookies</a>
                    </li>
                    <?php /*<li><a href="#">--><?php //echo $footer_row['footer_page_name_1']; ?><!--</a>-->
                    </li>-->*/?>
                </ul>
            </div>
        </div>
        <div class="row wed-foot-link-1">
            <div class="col-md-4">
                <h4><?php echo $BIZBOOK['GET_IN_TOUCH'];?></h4>
                <?php /*<p><?php echo $BIZBOOK['ADDRESS'];?>: <?php echo $footer_row['footer_address']; ?></p>
                <p><?php echo $BIZBOOK['PHONE'];?>: <a href="tel:<?php echo $footer_row['footer_mobile']; ?>"><?php echo $footer_row['footer_mobile']; ?></a></p>*/?>
                <p>Email: <a href="mailto:<?php echo $footer_row['admin_primary_email']; ?>"><?php echo $footer_row['admin_primary_email']; ?></a></p>
            </div>
            <?php /*<div class="col-md-4 fot-app">
                <h4>Descarga nuestra app</h4>
                <ul>
                    <li><a href="<?php echo $footer_row['mobile_app_andriod']; ?>"><img src="<?php echo $slash; ?>images/gstore.png" alt=""></a>
                    </li>
                    <li><a href="<?php echo $footer_row['mobile_app_ios']; ?>"><img src="<?php echo $slash; ?>images/astore.png" alt=""></a>
                    </li>
                </ul>
            </div>*/?>
            <div class="col-md-4 fot-soc">
                <h4><?php echo $BIZBOOK['SOCIAL_MEDIA'];?></h4>
                <ul>
                    <?php if($footer_row['footer_linked_in']!=""){?>
                        <li><a target="_blank" href="<?php echo $footer_row['footer_linked_in']; ?>"><img src="<?php echo $slash; ?>images/social/1.png" title="Linkedin Oficina de profesionales" alt="Linkedin Oficina de profesionales"></a></li>
                    <?php }?>
                    <?php if($footer_row['footer_twitter']!=""){?>
                        <li><a target="_blank" href="<?php echo $footer_row['footer_twitter']; ?>"><img src="<?php echo $slash; ?>images/social/2.png" title="Twitter Oficina de profesionales" alt="Twitter Oficina de profesionales"></a></li>
                    <?php }?>
                    <?php if($footer_row['footer_fb']!=""){?>
                        <li><a target="_blank" href="<?php echo $footer_row['footer_fb']; ?>"><img src="<?php echo $slash; ?>images/social/3.png" title="Facebook Oficina de profesionales" alt="Facebook Oficina de profesionales"></a></li>
                    <?php }?>
                    <?php if($footer_row['footer_google_plus']!=""){?>
                        <li><a target="_blank" href="<?php echo $footer_row['footer_google_plus']; ?>"><img src="<?php echo $slash; ?>images/social/4.png" title="Google plus Oficina de profesionales" alt="Google plus Oficina de profesionales"></a></li>
                    <?php }?>
                    <?php if($footer_row['footer_youtube']!=""){?>
                        <li><a target="_blank" href="<?php echo $footer_row['footer_youtube']; ?>"><img src="<?php echo $slash; ?>images/social/5.png" title="Google plus Oficina de profesionales" alt="Google plus Oficina de profesionales"></a></li>
                    <?php }?>
                    <?php if($footer_row['footer_whatsapp']!=""){?>
                        <li><a target="_blank" href="https://wa.me/34<?php echo $footer_row['footer_whatsapp'];?>"><img src="<?php echo $slash; ?>images/social/6.png" title="Whatsapp Oficina de profesionales" alt="Whatsapp Oficina de profesionales"></a></li>
                    <?php }?>
                    <?php if($footer_row['footer_instagram']!=""){?>
                        <li><a target="_blank" href="<?php echo $footer_row['footer_instagram']; ?>"><img src="<?php echo $slash; ?>images/social/8.png" title="Instagram Oficina de profesionales" alt="Instagram Oficina de profesionales"></a></li>
                    <?php }?>
                </ul>
            </div>
            <div class="col-md-4 fot-soc">
                <span><img src="<?php echo $slash;?>images/paypal-logo.png" title="Pago PayPal" alt="Pago PayPal" style="max-width: 120px;"/><img src="<?php echo $slash;?>images/visa-mastercard.png" title="Pago Visa - Mastercard" alt="Pago Visa - Mastercard" style="max-width: 160px;"/></span>
            </div>
        </div>
        <div class="row foot-count">
            <ul>
                <li><a target="_blank" href="http://<?php echo $footer_row['footer_country_url_1']; ?>"><?php echo $footer_row['footer_country_name_1']; ?></a></li>
                <li><a target="_blank" href="http://<?php echo $footer_row['footer_country_url_2']; ?>"><?php echo $footer_row['footer_country_name_2']; ?></a></li>
                <li><a target="_blank" href="http://<?php echo $footer_row['footer_country_url_3']; ?>"><?php echo $footer_row['footer_country_name_3']; ?></a></li>
                <li><a target="_blank" href="http://<?php echo $footer_row['footer_country_url_4']; ?>"><?php echo $footer_row['footer_country_name_4']; ?></a></li>
                <li><a target="_blank" href="http://<?php echo $footer_row['footer_country_url_5']; ?>"><?php echo $footer_row['footer_country_name_5']; ?></a></li>
                <li><a target="_blank" href="http://<?php echo $footer_row['footer_country_url_6']; ?>"><?php echo $footer_row['footer_country_name_6']; ?></a></li>
                <li><a target="_blank" href="http://<?php echo $footer_row['footer_country_url_7']; ?>"><?php echo $footer_row['footer_country_name_7']; ?></a></li>
            </ul>
        </div>
    </div>
    
    <?php
        if(isset($_REQUEST['politica-cookies'])) {
            $value = $_GET['politica-cookies'];
            $caducidad = time() + (60 * 60 * 24 * 365);
            setcookie('c_9iyy1aqp7'.substr(md5(time()),0,10), $value, $caducidad);
        }
    ?>
    
    <?php if (!isset($_COOKIE['c_9iyy1aqp7'])): ?>
        <!-- Mensaje de cookies -->
        <div class="cookies">
            <h2>Cookies</h2>
            <p class="text-cookie">En oficinadeprofesionales.com sólo utilizamos cookies propias con
                finalidad técnica, no recaba ni cede datos de carácter personal de los
                usuarios sin su conocimiento. Puedes obtener mas información en nuestra
                <a href="<?php $webpage_full_link;?>politica-cookies" title="Política de cookies">Política de Cookies</a>.
                Nuestro portal contiene enlaces a otros sitios web de terceros con políticas
                de privacidad ajenas a la de oficinadeprofesionales.com que usted deberá
                aceptar o no cuando acceda a ellos.</p>
            <p class="b-cookie">
                <a href="#" class="p_c" title="Aceptar política de cookies">Aceptar</a>
            </p>
        </div>
    <?php endif; ?>
</section>

<!-- START -->
<section>
    <div class="cr">
        <div class="container">
            <div class="row">
                <p>Copyright © <?php echo $footer_row['copyright_year']; ?> <a href="<?php echo $footer_row['copyright_website_link']; ?>" target="_blank"><?php echo $footer_row['copyright_website']; ?></a> All rights reserved.</p>
            </div>
        </div>
    </div>
</section>
<!-- END -->
	