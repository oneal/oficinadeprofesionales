<section>
    <div class="hom-mpop-ser">
        <div class="container">
            
            <div class="hlead-coll">
                <div class="col-md-6">
                    <div class="hom-cre-acc-left">
                        <h3><?php echo $BIZBOOK['HOM-WHAT-SER']; ?> <span><?php echo $BIZBOOK['HOM-WHAT-BIZ']; ?></span></h3>
                        <p><?php echo $BIZBOOK['HOM-WHAT-SUB-HEAD']; ?></p>
                        <ul>
                            <li><img src="images/icon/email.png" title="<?php echo $BIZBOOK['HOM-WHAT-SER-PO1']; ?>" alt="<?php echo $BIZBOOK['HOM-WHAT-SER-PO1']; ?>">
                                <div>
                                    <h5><?php echo $BIZBOOK['HOM-WHAT-SER-PO1']; ?></h5>
                                    <p><?php echo $BIZBOOK['HOM-WHAT-SER-PO1-SUB']; ?></p>
                                </div>
                            </li>
                            <li><img src="images/icon/shield.png" title="<?php echo $BIZBOOK['HOM-WHAT-SER-PO2']; ?>" alt="<?php echo $BIZBOOK['HOM-WHAT-SER-PO2']; ?>">
                                <div>
                                    <h5><?php echo $BIZBOOK['HOM-WHAT-SER-PO2']; ?></h5>
                                    <p><?php echo $BIZBOOK['HOM-WHAT-SER-PO2-SUB']; ?></p>
                                </div>
                            </li>
                            <li><img src="images/icon/group.png" title="<?php echo $BIZBOOK['HOM-WHAT-SER-PO3']; ?>" alt="<?php echo $BIZBOOK['HOM-WHAT-SER-PO3']; ?>">
                                <div>
                                    <h5><?php echo $BIZBOOK['HOM-WHAT-SER-PO3']; ?></h5>
                                    <p><?php echo $BIZBOOK['HOM-WHAT-SER-PO3-SUB']; ?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="hom-col-req">
                        <div class="log-bor">&nbsp;</div>
                        <span class="udb-inst">Rellena el formulario</span>
                        <h4><?php echo $BIZBOOK['HOM-WHT-LOOK-TIT']; ?></h4>
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
                                       placeholder="<?php echo $BIZBOOK['NAME_BUSSINESS'];?>*">
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
                        <?php /*<form name="home_enquiry_form" id="home_enquiry_form" method="post"
                              enctype="multipart/form-data">
                            <input type="hidden" class="form-control"
                                   name="listing_id"
                                   value="0"
                                   placeholder=""
                                   required>
                            <input type="hidden" class="form-control"
                                   name="listing_user_id"
                                   value="0"
                                   placeholder=""
                                   required>
                            <input type="hidden" class="form-control"
                                   name="enquiry_sender_id"
                                   value=""
                                   placeholder=""
                                   required>
                            <input type="hidden" class="form-control"
                                   name="enquiry_source"
                                   value="<?php if (isset($_GET["src"])) {
                                       echo $_GET["src"];
                                   } else {
                                       echo "Website";
                                   }; ?>"
                                   placeholder=""
                                   required>
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
                                <input type="text" class="form-control" value="" name="enquiry_mobile"
                                       placeholder="Teléfono*" pattern="[7-9]{1}[0-9]{9}"
                                       title="<?php echo $BIZBOOK['PHONE_NUMBER_STARTING'];?>" required>
                            </div>
                            <div class="form-group">
                                <select name="enquiry_category" id="enquiry_category" class="form-control">
                                    <option value=""><?php echo $BIZBOOK['CATEGORY'];?></option>
                                    <?php
                                    foreach (getAllCategories() as $categories_row) {
                                        ?>
                                        <option
                                            value="<?php echo $categories_row['category_id']; ?>"><?php echo $categories_row['category_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                            <textarea class="form-control" rows="3" name="enquiry_message" placeholder="<?php echo $BIZBOOK['ENQUIRY_MESSAGE'];?>"></textarea>
                            </div>
                            <div class="form-check" style="margin-bottom: 10px;">
                                <input class="form-check-input" type="checkbox" value="politica-privacidad" name="politica_privacidad" id="politica-privacidad" required="true">
                                <label class="form-check-label" for="politica-privacidad">He leido y acepto la <a href="#" data-toggle="modal" data-target="#contactoPoliticaPrivacidadModal" title="política de privacidad">política de privacidad</a></label>
                            </div>
                            <input type="hidden" id="source">
                            <button type="submit" id="home_enquiry_submit" name="home_enquiry_submit"
                                    class="btn btn-primary">
                                <?php echo $BIZBOOK['SUBMIT'];?>
                            </button>
                        </form>*/?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

