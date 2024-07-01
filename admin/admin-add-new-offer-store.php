<?phpinclude "header.php";?><?php if($admin_row['admin_category_options'] != 1){    header("Location: profile.php");}?><!-- START --><section>    <div class="ad-com">        <div class="ad-dash leftpadd">            <section class="login-reg">                <div class="container">                    <?php include "../page_level_message.php"; ?>                    <form name="category_form" id="category_form" method="post" action="insert_offer_store.php" class="cre-dup-form cre-dup-form-show" enctype="multipart/form-data">                        <div class="row">                            <div class="login-main add-list">                                <div class="log-bor">&nbsp;</div>                                <span class="udb-inst"><?php echo $BIZBOOK['ADD_NEW_OFFER_STORE'];?></span>                                <div class="log log-1">                                    <div class="login">                                        <div class="row">                                            <div class="col-md-12">                                                <div class="form-group">                                                    <label><?php echo $BIZBOOK['NAME'];?></label>                                                    <input type="text" id="offer_name" name="offer_name" class="form-control" placeholder="<?php echo $BIZBOOK['NAME'];?> *" required>                                                </div>                                            </div>                                        </div>                                        <div class="row">                                            <div class="col-md-12">                                                <div class="form-group">                                                    <?php $stores = getAllStoresByName()?>                                                    <label><?php echo $BIZBOOK['STORE'];?></label>                                                    <select id="offer_store_id" name="offer_store_id" class="form-control" required>                                                        <?php if(isset($stores)) {?>                                                            <option value="0"><?php echo $BIZBOOK['SELECT_STORE']?></option>                                                            <?php foreach ($stores as $store) {?>                                                                <option value="<?php echo $store['store_id'] ?>"><?php echo $store['store_name']?></option>                                                            <?php  }?>                                                        <?php } ?>                                                    </select>                                                </div>                                            </div>                                        </div>                                        <div class="row">                                            <div class="col-md-12">                                                <div class="form-group">                                                    <label><?php echo $BIZBOOK['DESCRIPCION'];?></label>                                                    <textarea id="offer_description" name="offer_description" class="form-control"></textarea>                                                </div>                                            </div>                                        </div>                                        <div class="row">                                            <div class="col-md-12">                                                <div class="form-group">                                                    <label><?php echo $BIZBOOK['PRICE'];?></label>                                                    <input type="number" id="offer_price" name="offer_price" class="form-control" placeholder="<?php echo $BIZBOOK['PRICE'];?>" min="0" step="0.01">                                                </div>                                            </div>                                        </div>                                        <div class="row">                                            <div class="col-md-12">                                                <div class="form-group">                                                    <label><?php echo $BIZBOOK['DISCOUNT'];?></label>                                                    <input type="number" id="offer_discount" name="offer_discount" class="form-control" placeholder="<?php echo $BIZBOOK['DISCOUNT'];?> " min="0" max="100" step="1">                                                </div>                                            </div>                                        </div>                                        <div class="row">                                            <div class="col-md-12">                                                <div class="form-group">                                                    <label><?php echo $BIZBOOK['WARRANTY'];?></label>                                                    <input type="number" id="offer_warranty" name="offer_warranty" class="form-control" placeholder="<?php echo $BIZBOOK['WARRANTY'];?>" min="0" max="100" step="1">                                                </div>                                            </div>                                        </div>                                        <div class="row">                                            <div class="col-md-12">                                                <div class="form-group">                                                    <label><?php echo $BIZBOOK['CHOOSE_IMAGE_FIRST'];?></label>                                                    <input type="file" name="profile_image" class="form-control">                                                </div>                                            </div>                                        </div>                                    </div>                                </div>                            </div>                        </div>                        <div class="row">                            <div class="login-main add-list add-noffer">                                <div class="log-bor">&nbsp;</div>                                <div class="log log-1">                                    <div class="login">                                        <h4><?php echo $BIZBOOK['EXPECIFICATIONS'];?></h4>                                        <span class="add-list-add-btn offer-add-btn" data-toggle="tooltip" title="<?php echo $BIZBOOK['ADD_FIELD_CATEGORY'];?>">+</span>                                        <span class="add-list-rem-btn offer-rem-btn" data-toggle="tooltip" title="<?php echo $BIZBOOK['DELL_FIELD_CATEGORY'];?>">-</span>                                        <div class="row">                                            <div class="col-md-12">                                                <ul>                                                    <li>                                                        <div class="row">                                                            <div class="col-md-6 col-sm-12">                                                                <div class="form-group">                                                                    <label><?php echo $BIZBOOK['EXPECIFICATION'];?></label>                                                                    <input type="text" id="details_id" name="details_id[]" class="form-control" placeholder="<?php echo $BIZBOOK['EXPECIFICATION'];?>">                                                                </div>                                                            </div>                                                            <div class="col-md-6 col-sm-12">                                                                <div class="form-group">                                                                    <label><?php echo $BIZBOOK['VALUE'];?></label>                                                                    <input type="text" id="details_text" name="details_text[]" class="form-control" placeholder="<?php echo $BIZBOOK['VALUE'];?>">                                                                </div>                                                            </div>                                                        </div>                                                    </li>                                                </ul>                                            </div>                                        </div>                                    </div>                                </div>                            </div>                        </div>                        <div class="row">                            <div class="login-main add-list">                                <div class="log-bor">&nbsp;</div>                                <div class="log log-1">                                    <div class="login">                                        <h4><?php echo $BIZBOOK['TAGS']?></h4>                                        <div class="row">                                            <div class="col-md-12">                                                <div class="form-group">                                                    <input type="text" id="offer_tags" name="offer_tags" class="form-control" placeholder="<?php echo $BIZBOOK['TAGS'];?>">                                                    <span>Separa las etiquetas por comas</span>                                                </div>                                            </div>                                        </div>                                    </div>                                </div>                            </div>                        </div>                        <div class="row">                            <div class="login-main add-list">                                <div class="log-bor">&nbsp;</div>                                <div class="log log-1">                                    <div class="login">                                        <div class="row">                                            <div class="col-md-12">                                                <button type="submit" name="offer_submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>                                            </div>                                        </div>                                        <div class="row">                                            <div class="col-md-12">                                                <a href="admin-offers-store.php" class="skip"><?php echo $BIZBOOK['GO_TO_ALL_OFFERS'];?> >></a>                                            </div>                                        </div>                                    </div>                                </div>                            </div>                        </div>                    </form>                </div>            </section>        </div>    </div></section><!-- END --><!-- Optional JavaScript --><!-- jQuery first, then Popper.js, then Bootstrap JS --><script src="../js/jquery.min.js"></script><script src="../js/popper.min.js"></script><script src="../js/bootstrap.min.js"></script><script src="../js/jquery-ui.js"></script><script src="js/admin-custom.js"></script> <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script></body></html>