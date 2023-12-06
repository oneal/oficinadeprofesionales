<?php
include "header.php";

include "facebook_config.php"; //Facebook Config File

include "google_config.php"; //Facebook Config File

if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) {
    header("Location: dashboard");
}
?>

<!-- START -->
<!--PRICING DETAILS-->
<section class="<?php if ($footer_row['admin_language'] == 2) {
    echo "lg-arb";
} ?> login-reg">
    <div class="container">
        <div class="row">
            <div class="login-main">
                <div class="log-bor">&nbsp;</div>
                <div class="log log-1">
                    <div class="login">
                        <h4><?php echo $BIZBOOK['MEMBER_LOGIN']; ?></h4>
                        <p>Nota. Si aún no estas registrado, <a href="#"><span class="ll-2">crea una cuenta</span></a> y podrás subir tu negocio totalmente gratis. </p>
                        <?php
                        if (isset($_SESSION['login_status_msg'])) {
                            include "page_level_message.php";
                            unset($_SESSION['login_status_msg']);
                        }
                        ?>
                        <form id="login_form" name="login_form" method="post" action="login_check.php">
                            <div class="form-group">
                                <input type="email" autocomplete="off" name="email_id" id="email_id"
                                       class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_EMAIL_STAR']; ?>"
                                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                       title="<?php echo $BIZBOOK['ENTER_EMAIL_STAR']; ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="<?php echo $BIZBOOK['ENTER_PASSWORD_STAR']; ?>" required>
                            </div>
                            <div class="g-recaptcha" data-sitekey="6LdanaAaAAAAAMcQtSwY8Sn9YYDkcSx04msG2NXR"></div>
                            <button type="submit" name="login_submit" value="submit"
                                    class="btn btn-primary"><?php echo $BIZBOOK['SIGN_IN']; ?>
                            </button>
                        </form>

                        <?php if ($footer_row['admin_google_login'] == 1 || $footer_row['admin_facebook_login'] == 1) {?>
                            <!-- SOCIAL MEDIA LOGIN -->
                            <div class="soc-log">
                                <ul>
                                    <li>
                                        <div class="g-signin2" data-onsuccess="onSignIn"></div>

                                    </li>
                                    <?php /*<li>
                                        <a href="google_login.php" class="login-goog"><img src="images/icon/seo.png">Continue
                                            with Google</a>
                                    </li>*/?>
                                    <li>
                                        <a href="javascript:void(0);" onclick="fbLogin();" class="login-fb"><img
                                                src="images/icon/facebook.png"> Continue with Facebook</a>
                                    </li>

                                </ul>

                            </div>
                        <?php }?>
                        <!-- END SOCIAL MEDIA LOGIN -->

                    </div>
                </div>
                <div class="log log-2">
                    <div class="login">
                        <?php
                        if (isset($_SESSION['register_status_msg'])) {
                            include "page_level_message.php";
                            unset($_SESSION['register_status_msg']);
                        }
                        ?>
                        <h4><?php echo $BIZBOOK['CREATE_AN_ACCOUNT']; ?></h4>
                        <p><?php echo $BIZBOOK['REGISTER_LABEL']; ?></p>
                        <form name="register_form" id="register_form" method="post" action="register_update.php">

                            <input type="hidden" autocomplete="off" name="trap_box" id="trap_box" class="validate">

                            <input type="hidden" autocomplete="off" name="mode_path" value="XeFrOnT_MoDeX_PATHXHU"
                                   id="mode_path" class="validate">

                            <div class="form-group">
                                <input type="text" autocomplete="off" name="first_name" id="first_name"
                                       class="form-control" required placeholder="<?php echo $BIZBOOK['NAME_BUSSINESS']; ?>*">
                            </div>
                            <div class="form-group">
                                <input type="email" autocomplete="off" name="email_id" id="email_id" class="form-control error" placeholder="<?php echo $BIZBOOK['EMAIL']; ?>*" required/>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="<?php echo $BIZBOOK['PASSWORD_STAR']; ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" placeholder="<?php echo $BIZBOOK['CONTACT_PHONE_NUMBER'];?> *" autocomplete="off"
                                       name="mobile_number" id="mobile_number" class="form-control"
                                       placeholder="<?php echo $BIZBOOK['PHONE']; ?>*" required>
                            </div>
                            <?php /*<div class="form-group ca-sh-user">
                                <select name="user_type" id="user_type" class="form-control ca-check-plan">
                                    <option value=""><?php //echo $BIZBOOK['USER_TYPE']; ?><!--</option>
                                    <option value="General">General user</option>
                                    <option value="Service provider">Service provider</option>
                                </select>
                                <a href="user-type" class="frmtip"
                                   target="_blank"><?php //echo $BIZBOOK['USER_OPTIONS']; ?><!--</a>
                            </div>
                            <div class="form-group ca-sh-plan">
                                <select name="user_plan" id="user_plan" class="form-control">
                                    <option value="" disabled="disabled"
                                            selected="selected"><?php //echo $BIZBOOK['CHOOSE_YOUR_PLAN']; ?><!--</option>
                                    <?php
                            //                                    $plan_type = "SELECT *
                            //										FROM " . TBL . "plan_type WHERE plan_type_status='Active'
                            //
                            //										ORDER BY plan_type_id ASC";
                            //
                            //
                            //                                    $rs_plan_type = mysqli_query($conn, $plan_type);
                            //
                            //                                    $si = 1;
                            //                                    while ($plan_type_row = mysqli_fetch_array($rs_plan_type)) {
                            //                                        ?>
                                        <option
                                            value="<?php //echo $plan_type_row['plan_type_id']; ?><!--"><?php //echo $plan_type_row['plan_type_name'];
                            //                                            if ($plan_type_row['plan_type_price'] != 0) {
                            //                                                echo ' - ' . $footer_row['currency_symbol'] . '' . $plan_type_row['plan_type_price'] . '/year';
                            //                                            } ?><!--</option>
                                        <?php
                            //                                    }
                            //                                    ?>
                                                                        <option value="Standard plan">Standard plan - $120/year</option>
                                                                        <option value="Premium plan">Premium plan - $250/year</option>
                                                                        <option>Premium plus plan - $350/year</option>
                                </select>
                                <a href="pricing-details" class="frmtip"
                                   target="_blank"><?php //echo $BIZBOOK['PLAN_DETAILS']; ?><!--</a>
                            </div>*/?>
                            <div class="form-check" style="margin-bottom: 10px;">
                                <input class="form-check-input" type="checkbox" value="politica-privacidad" name="politica_privacidad" id="politica-privacidad" required="true">
                                <label class="form-check-label" for="politica-privacidad">He leido y acepto la <a href="#" data-toggle="modal" data-target="#registroPoliticaPrivacidadModal" title="política de privacidad">política de privacidad</a> y <a href="<?php $webpage_full_link;?>condiciones-servicios" title="condiciones de uso">condiciones de servicio</a></label>
                            </div>
                            <div class="g-recaptcha" data-sitekey="6LdanaAaAAAAAMcQtSwY8Sn9YYDkcSx04msG2NXR"></div>
                            <button type="submit" name="register_submit" class="btn btn-primary"><?php echo $BIZBOOK['REGISTER_NOW']; ?></button>
                        </form>
                        <?php
                        if ($footer_row['admin_google_login'] == 1 || $footer_row['admin_facebook_login'] == 1) {
                            ?>
                            <!-- SOCIAL MEDIA LOGIN -->
                            <div class="soc-log">
                                <ul>
                                    <?php
                                    if ($footer_row['admin_google_login'] == 1) {
                                        ?>
                                        <li>
                                            <div class="g-signin2" data-onsuccess="onSignIn"></div>

                                        </li>
                                        <?php /*<li>
                                            <a href="google_login.php" class="login-goog"><img
                                                    src="images/icon/seo.png">Continue
                                                with Google</a>
                                        </li>*/?>
                                        <?php
                                    }
                                    if ($footer_row['admin_facebook_login'] == 1) {
                                        ?>
                                        <li>
                                            <a href="javascript:void(0);" onclick="fbLogin();" class="login-fb"><img
                                                    src="images/icon/facebook.png"> Continue with Facebook</a>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                </ul>

                            </div>
                            <!-- END SOCIAL MEDIA LOGIN -->
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="log log-3">
                    <div class="login">
                        <?php
                        if (isset($_SESSION['forgot_status_msg'])) {
                            include "page_level_message.php";
                            unset($_SESSION['forgot_status_msg']);
                        }
                        ?>
                        <h4><?php echo $BIZBOOK['FORGOT_PASSWORD']; ?></h4>
                        <form id="forget_form" name="forget_form" method="post" action="forgot_process.php">
                            <div class="form-group">
                                <input type="email" autocomplete="off" name="email_id" id="email_id"
                                       class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_EMAIL_STAR']; ?>"
                                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                       title="Invalid email address" required>
                            </div>
                            <div class="g-recaptcha" data-sitekey="6LdanaAaAAAAAMcQtSwY8Sn9YYDkcSx04msG2NXR"></div>
                            <button type="submit" name="forgot_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT']; ?></button>
                        </form>
                    </div>
                </div>
                <div class="log-bot">
                    <ul>
                        <li>
                            <span class="ll-1"><?php echo $BIZBOOK['LOGIN_QUESTIONMARK']; ?></span>
                        </li>
                        <li>
                            <span class="ll-2"><?php echo $BIZBOOK['CREATE_ACCOUNT_QUESTIONMARK']; ?></span>
                        </li>
                        <li>
                            <span class="ll-3"><?php echo $BIZBOOK['FORGOT_PASSWORD_QUESTIONMARK']; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END PRICING DETAILS-->


<section>
    <div class="pop-ups pop-quo">
        <!-- The Modal -->
        <div class="modal fade" id="quote">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="quote-pop">
                        <h4><?php echo $BIZBOOK['GET_QOUTE'];?></h4>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_NAME'];?>*" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_EMAIL_STAR'];?>*"
                                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                       title="<?php echo $BIZBOOK['INVALID_EMAIL'];?>" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" placeholder="<?php echo $BIZBOOK['CONTACT_PHONE_NUMBER'];?> *" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3"
                                          placeholder="<?php echo $BIZBOOK['ENQUIRY_MESSAGE'];?>"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="registroPoliticaPrivacidadModal" tabindex="-1" aria-labelledby="registroPoliticaPrivacidadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Política de privacidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <h5>POLÍTICA DE PRIVACIDAD </h5>
          <p><strong>Responsable de Tratamiento:</strong></p>     
          <p>Gesfotiplay, S.L., con CIF: B-23449309 y dirección postal: Apartado de correos 2097. 23080 de Jaén. España. Teléfono: 953 120 999. E-mail: <a href="mailto:dpd@data-sur.com">general@oficinadeprofesionales.com</a>.</p>
          <p><strong>Delegado de Protección de Datos:</strong> Datasur Protección de Datos, S.L.<br/>
            Telf.: 958 958230. E-mail: <a href="mailto:dpd@data-sur.com">dpd@data-sur.com</a>. Chat: <a href="https://www.data-sur.com/">https://www.data-sur.com/</a></p>
          <p><strong>Finalidad:</strong></p>
          <p>En oficinadeprofesionales.com tratamos la información que nos facilita según el Reglamento General de Protección de Datos y Ley Orgánica de Protección de Datos Personales y Garantía de Derechos Digitales, con el fin de gestionar los servicios o productos que le prestamos o nos demanda mediante la página Web. Todos los datos solicitados (nombre, e-mail, y aquellos incluidos en la consulta) son estrictamente necesarios para la gestión de las consultas formuladas y publicación de anuncios profesionales, incluyendo la existencia de posibles decisiones automatizadas, no elaborando perfiles en ningún caso.</p>
          <p><strong>Almacenamiento:</strong></p>
          <p>Sus datos personales van a ser almacenados en el Registro de Actividades de Tratamiento: Usuario y/o Publica Tu Anuncio (según proceda). La finalidad de dicho tratamiento es la gestión y registro como Usuario en nuestra web.</p>  
          <p><strong>Conservación:</strong></p>
          <p>Los datos proporcionados se conservarán durante el tiempo necesario para la tramitación y respuesta de la consulta o mientras exista la relación, cumpliendo con la finalidad para la que se recaban o durante los años necesarios para cumplir con las obligaciones legales.</p>
          <p><strong>Comunicación y Transferencia Internacional:</strong></p>
          <p>Los datos no se cederán a terceros salvo en los casos en que exista una obligación legal y para la prestación de los servicios ofertados, así haya que hacerlo y no están previstas las transferencias internacionales de datos.</p>
          <p><strong>Legitimación:</strong></p>
          <p>El tratamiento de sus datos está legitimado mediante el consentimiento expreso del interesado, que voluntariamente los remite a través del formulario mediante una clara acción afirmativa.</p>
          <p><strong>Edad:</strong></p>
          <p>Los usuarios menores de 18 años no podrán registrase en el Portal.</p>
          <p><strong>Derechos:</strong></p>
          <p>Usted tiene derecho a obtener confirmación sobre si en Gesfotiplay, S.L. estamos tratando sus datos personales,  por tanto tiene derecho a acceder a sus datos personales, rectificar los datos inexactos o solicitar su supresión cuando los datos ya no sean necesarios, así como el derecho a la limitación u oposición a su tratamiento, portabilidad de sus datos y retirar el consentimiento aceptado al tratamiento de sus datos e incluso interponer reclamación ante la Agencia Española de Protección de Datos (<a href="https://www.aepd.es/">https://www.aepd.es/</a>).</p>
          <p><strong>Comunicaciones Comerciales:</strong></p>
          <p>En lo referente a comunicaciones comerciales, Gesfotiplay, S.L. se compromete a NO REMITIR COMUNICACIONES COMERCIALES SIN IDENTIFICARLAS COMO TALES, conforme a lo dispuesto en la Ley 34/2002 de Servicios de la Sociedad de la Información y de Comercio Electrónico. No será considerado como comunicación comercial toda la información que se envíe al Usuario del portal de Gesfotiplay, S.L.  Siempre que tenga por finalidad el mantenimiento de la relación contractual existente entre usuario y Gesfotiplay, S.L., así como el desempeño de las tareas de información, formación y otras actividades propias del servicio que el cliente/usuario pueda contratado con la Entidad.</p>
          <p>Gesfotiplay, S.L., se compromete a través de este medio a NO REALIZAR PUBLICIDAD ENGAÑOSA. A estos efectos, por lo tanto, no serán considerados como publicidad engañosa los errores formales o numéricos que puedan encontrarse a lo largo del contenido de las distintas secciones de la web de Gesfotiplay, S.L., producidos como consecuencia de un mantenimiento y/o actualización incompleta o defectuosa de la información contenida es estas secciones. Gesfotiplay, S.L., como consecuencia de lo dispuesto en este apartado, se compromete a corregirlo tan pronto como tenga conocimiento de dichos errores.</p>
      </div>      
    </div>
  </div>
</div>

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
<script src="https://www.google.com/recaptcha/api.js?hl=es" async defer></script>

<?php
if (isset($_GET["page"])) {
    ?>
    <?php
    if (isset($_POST['SubmitButton'])) { // Check if form was submitted

        if (!empty($_FILES['inputText']['name'])) {
            $file = rand(1000, 100000) . $_FILES['inputText']['name'];
            $file_loc = $_FILES['inputText']['tmp_name'];
            $file_size = $_FILES['inputText']['size'];
            $file_type = $_FILES['inputText']['type'];
            $folder = "images/listings/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $event_image = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $event_image);
            $inputText1 = $event_image;
            $inputText = $inputText1;
        }
    }
    ?>
    <form action="#" enctype="multipart/form-data" method="post">
        <input type="file" name="inputText"/>
        <input type="submit" name="SubmitButton"/>
    </form>
    <?php
}
?>
</body>
</html>