<?phpinclude "header.php";?>    <!-- START -->	<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> abou-pg">        <div class="about-ban">            <h1>Nuestro compromiso</h1>            <?php /*<p>injected humourThere are many variations of passages of Lorem Ipsum available</p>*/?>        </div>        <div class="container">            <div class="row" style="margin-top: 15px;">                <div class="col-sm-6 col-12">                    <p>La oficina de los profesionales es una plataforma comprometida en dar servicio, tanto al usuario general que necesita contratar los servicios de un profesional, como al profesional, para que su trabajo o empresa sea visible por miles de personas.</p>                    <p>Nos encargamos de la publicidad de tú negocio en las redes sociales y en los buscadores. Nosotros nos encargamos de que te conozcan con tan solo registrarte en nuestra plataforma y subir tus anuncios gratuitamente.</p>                    <p class="text-border">Registrate creando una cuenta.<br/>                        Escríbenos si lo deseas a:<br/>                        <a href="mailto:general@oficinadeprofesionales.com">general@oficinadeprofesionales.com</a><br/>                        o en las redes sociales<br/><br/>                        <?php if($footer_row['footer_linked_in']!=""){?>                            <a target="_blank" href="<?php echo $footer_row['footer_linked_in']; ?>"><img src="<?php echo $slash; ?>images/social/1.png" alt=""></a>                        <?php }?>                        <?php if($footer_row['footer_twitter']!=""){?>                            <a target="_blank" href="<?php echo $footer_row['footer_twitter']; ?>"><img src="<?php echo $slash; ?>images/social/2.png" alt=""></a>                        <?php }?>                        <?php if($footer_row['footer_fb']!=""){?>                            <a target="_blank" href="<?php echo $footer_row['footer_fb']; ?>"><img src="<?php echo $slash; ?>images/social/3.png" alt=""></a>                        <?php }?>                        <?php if($footer_row['footer_google_plus']!=""){?>                            <a target="_blank" href="<?php echo $footer_row['footer_google_plus']; ?>"><img src="<?php echo $slash; ?>images/social/4.png" alt=""></a>                        <?php }?>                        <?php if($footer_row['footer_youtube']!=""){?>                            <a target="_blank" href="<?php echo $footer_row['footer_youtube']; ?>"><img src="<?php echo $slash; ?>images/social/5.png" alt=""></a>                        <?php }?>                        <?php if($footer_row['footer_whatsapp']!=""){?>                            <a target="_blank" href="https://wa.me/34<?php echo $footer_row['footer_whatsapp']; ?>"><img src="<?php echo $slash; ?>images/social/6.png" alt=""></a>                        <?php }?>                        <?php if($footer_row['footer_instagram']!=""){?>                            <a target="_blank" href="<?php echo $footer_row['footer_instagram']; ?>"><img src="<?php echo $slash; ?>images/social/8.png" alt=""></a>                        <?php }?>                    </p>                </div>                <div class="col-sm-6 col-12">                    <img src="<?php echo $slash; ?>images/nuestrocompromiso1.jpg" title="Nuestro compromiso" alt="Nuestro compromiso" class="img-fluid"/>                </div>            </div>            <div class="row">                <div class="col-sm-12 col-12">                    <img src="<?php echo $slash; ?>images/nuestrocompromiso2.jpg" title="Nuestro compromiso" alt="Nuestro compromiso" class="img-fluid"/>                </div>            </div>            <div class="how-wrks">                <div class="home-tit">                    <h2><span><?php echo $BIZBOOK['HOM-HOW-TIT']; ?></span></h2>                    <p><?php echo $BIZBOOK['HOM-HOW-SUB-TIT']; ?></p>                </div>                <div class="how-wrks-inn">                    <ul>                        <li>                            <div>                                <a href="#" data-toggle="modal" data-target="#crearcuentaModal" title="Crear una cuenta">                                        <span>1</span>                                    <img src="images/icon/how1.png" title="<?php echo $BIZBOOK['HOM-HOW-P-TIT-1']; ?>" alt="<?php echo $BIZBOOK['HOM-HOW-P-TIT-1']; ?>">                                    <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-1']; ?></h4>                                    <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-1']; ?></p>                                </a>                            </div>                        </li>                        <li>                            <div>                                <a href="#" data-toggle="modal" data-target="#anadenegocioModal" title="Añade tu negocio">                                    <span>2</span>                                    <img src="images/icon/how2.png" title="<?php echo $BIZBOOK['HOM-HOW-P-TIT-2']; ?>" alt="<?php echo $BIZBOOK['HOM-HOW-P-TIT-2']; ?>">                                    <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-2']; ?></h4>                                    <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-2']; ?></p>                                </a>                            </div>                        </li>                        <li>                            <div>                                <a href="#" data-toggle="modal" data-target="#consigueclientesModal" title="Consigue clientes">                                    <span>3</span>                                    <img src="images/icon/how3.png" title="<?php echo $BIZBOOK['HOM-HOW-P-TIT-3']; ?>" alt="<?php echo $BIZBOOK['HOM-HOW-P-TIT-3']; ?>">                                    <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-3']; ?></h4>                                    <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-3']; ?></p>                                </a>                            </div>                        </li>                        <li>                            <div>                                <a href="#" data-toggle="modal" data-target="#lograobjetivosModal" title="Logra tus objetivos">                                    <span>4</span>                                    <img src="images/icon/how4.png" title="<?php echo $BIZBOOK['HOM-HOW-P-TIT-4']; ?>" alt="<?php echo $BIZBOOK['HOM-HOW-P-TIT-4']; ?>">                                    <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-4']; ?></h4>                                    <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-4']; ?></p>                                </a>                            </div>                        </li>                    </ul>                </div>            </div>            <?php include 'modales_textos_home.php';?>            <?php /*<div class="how-wrks">                    <div class="home-tit">                        <h2><span>Out Team</span></h2>                        <p>Explore some of the best tips from around the world from our<br>partners and friends.lacinia viverra lectus.</p>                    </div>                    <div class="how-wrks-inn abo-memb">                        <ul>                            <li>                                <div>                                    <img src="<?php echo $slash;?>images/user/user2.jpg" alt="">                                    <h4>John smith</h4>                                    <p>Fusce imperdiet ullamcorper metus eu fringilla. from around the world from our partners and friends.</p>                                </div>                            </li>                            <li>                                <div>                                    <img src="<?php echo $slash;?>images/user/user1.jpg" alt="">                                    <h4>Lusia Ann</h4>                                    <p>Fusce imperdiet ullamcorper metus eu fringilla. from around the world from our                                        partners and friends.</p>                                </div>                            </li>                            <li>                                <div>                                    <img src="<?php echo $slash;?>images/user/user3.jpg" alt="">                                    <h4>Mark luberk</h4>                                    <p>Fusce imperdiet ullamcorper metus eu fringilla. from around the world from our                                        partners and friends.</p>                                </div>                            </li>                            <li>                                <div>                                    <img src="<?php echo $slash;?>images/user/user4.jpg" alt="">                                    <h4>Anjalena juley</h4>                                    <p>Fusce imperdiet ullamcorper metus eu fringilla. from around the world from our                                        partners and friends.</p>                                </div>                            </li>                        </ul>                    </div>                </div>            </div>*/?>        </div>    </section>    <!--END-->    <?php        include "form_contact_home.php";    ?>        <?php        include "modal_politca_privacidad.php";    ?>   <?php include "footer.php";?><!-- Optional JavaScript --><!-- jQuery first, then Popper.js, then Bootstrap JS --><script src="<?php echo $slash;?>js/jquery.min.js"></script><script src="<?php echo $slash;?>js/popper.min.js"></script><script src="<?php echo $slash;?>js/bootstrap.min.js"></script><script src="<?php echo $slash;?>js/jquery-ui.min.js"></script><script src="<?php echo $slash;?>js/custom.min.js"></script><script src="<?php echo $slash;?>js/jquery.validate.min.js"></script><script src="<?php echo $slash;?>js/custom_validation.min.js"></script></body></html>