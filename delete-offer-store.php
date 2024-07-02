<?php include "header.php";if (file_exists('config/user_authentication.php')) {    include('config/user_authentication.php');}//To redirect the general type user to dashboard to avoid using this pageif($user_details_row['user_type'] == "General" || $user_details_row['user_type'] == "Service provider") {    header("Location: dashboard");}?><!-- START --><!--PRICING DETAILS--><section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> login-reg">    <div class="container">        <div class="row">            <div class="login-main add-list">                <div class="log-bor">&nbsp;</div>                <span class="steps"><?php echo $BIZBOOK['DELETE_WORK_OFFER']; ?></span>                <div class="log">                    <div class="login add-list-off">                        <?php                        $offer_codea = $_GET['row'];                        $offer_row = getOfferStore($offer_codea);                        ?>                        <h4><?php echo $BIZBOOK['DELETE_WORK_OFFER']; ?></h4>                        <?php include "./page_level_message.php"; ?>                        <form action="offer_store_delete.php" class="offer_store_delete_form" id="offer_store_delete_form" name="offer_store_delete_form"                              method="post" enctype="multipart/form-data">                            <input type="hidden" id="offer_id" value="<?php echo $offer_row['offer_id']; ?>"                                   name="offer_id" class="validate">                            <input type="hidden" id="offer_code" value="<?php echo $offer_row['offer_code']; ?>"                                   name="offer_code" class="validate">                                    <!--FILED START-->                            <div class="row">                                <div class="col-md-12">                                    <div class="form-group">                                        <label><?php echo $BIZBOOK['NAME'];?></label>                                        <input type="text" id="offer_name" name="offer_name" class="form-control" disabled="disabled" placeholder="<?php echo $BIZBOOK['NAME'];?> *" value="<?php echo $offer_row['offer_name']?>" required >                                    </div>                                </div>                            </div>                            <div class="row">                                <div class="col-md-12">                                    <div class="form-group">                                        <?php $stores = getAllStores()?>                                        <label><?php echo $BIZBOOK['STORE'];?></label>                                        <select id="offer_store_id" name="offer_store_id" disabled="disabled" class="form-control" required>                                            <?php if(isset($stores)) {?>                                                <option value="0"><?php echo $BIZBOOK['SELECT_STORE']?></option>                                                <?php foreach ($stores as $store) {?>                                                    <option value="<?php echo $store['store_id'] ?>" <?php if($store['store_id'] === $offer_row['store_id']){?> selected<?php }?>><?php echo $store['store_name']?></option>                                                <?php  }?>                                            <?php } ?>                                        </select>                                    </div>                                </div>                            </div>                            <div class="row">                                <div class="col-md-12">                                    <div class="form-group">                                        <label><?php echo $BIZBOOK['DESCRIPCION'];?></label>                                        <textarea type="text" disabled="discabled" id="offer_description" name="offer_description" class="form-control"><?php echo $offer_row['offer_description']?></textarea>                                    </div>                                </div>                            </div>                            <div class="row">                                <div class="col-md-12">                                    <div class="form-group">                                        <label><?php echo $BIZBOOK['PRICE'];?></label>                                        <input type="number" id="offer_price" name="offer_price" disabled="disabled" class="form-control" placeholder="<?php echo $BIZBOOK['PRICE'];?>" min="0" step="0.01" value="<?php echo $offer_row['offer_price']?>">                                    </div>                                </div>                            </div>                            <div class="row">                                <div class="col-md-12">                                    <div class="form-group">                                        <label><?php echo $BIZBOOK['DISCOUNT'];?></label>                                        <input type="number" id="offer_discount" name="offer_discount" disabled="disabled" class="form-control" placeholder="<?php echo $BIZBOOK['DISCOUNT'];?> " min="0" max="100" step="1" value="<?php echo $offer_row['offer_discount']?>">                                    </div>                                </div>                            </div>                            <div class="row">                                <div class="col-md-12">                                    <div class="form-group">                                        <label><?php echo $BIZBOOK['WARRANTY'];?></label>                                        <input type="number" id="offer_warranty" name="offer_warranty" disabled="disabled" class="form-control" placeholder="<?php echo $BIZBOOK['WARRANTY'];?>" min="0" max="100" step="1" value="<?php echo $offer_row['offer_warranty']?>">                                    </div>                                </div>                            </div>                            <div class="row">                                <div class="col-md-12">                                    <div class="form-group">                                        <label><?php echo $BIZBOOK['CHOOSE_IMAGE_FIRST'];?></label><br/>                                        <?php if($offer_row['offer_img']!=""){?>                                            <img src="./images/offers_stores/<?php echo $offer_row['offer_img'];?>" style="max-width: 120px"/>                                            <input type="hidden" id="profile_image_old"                                                   value="<?php echo $offer_row['offer_img']; ?>" name="profile_image_old"                                                   class="validate">                                        <?php }?>                                        <input type="file" name="profile_image" disabled="disabled" class="form-control">                                    </div>                                </div>                            </div>                            <div class="row">                                <div class="col-12">                                    <h4><?php echo $BIZBOOK['EXPECIFICATIONS'];?></h4>                                    <div class="row">                                        <div class="col-md-12">                                            <?php if($offer_row['details_id'] ==! '' || isset($offer_row['details_id'])){?>                                                <?php                                                $detailsId = explode(',', $offer_row['details_id']);                                                $detailsText = explode(',', $offer_row['details_values']);                                                ?>                                                <ul>                                                    <?php for($i = 0; $i<count($detailsId); $i++){?>                                                        <li>                                                            <div class="row">                                                                <div class="col-md-6 col-sm-12">                                                                    <div class="form-group">                                                                        <label><?php echo $BIZBOOK['EXPECIFICATION'];?></label>                                                                        <input type="text" id="details_id" name="details_id[]" class="form-control" disabled="disabled" placeholder="<?php echo $BIZBOOK['EXPECIFICATION'];?>" value="<?php echo $detailsId[$i]?>">                                                                    </div>                                                                </div>                                                                <div class="col-md-6 col-sm-12">                                                                    <div class="form-group">                                                                        <label><?php echo $BIZBOOK['VALUE'];?></label>                                                                        <input type="text" id="details_text" name="details_text[]" class="form-control" disabled="disabled" placeholder="<?php echo $BIZBOOK['VALUE'];?>" value="<?php echo $detailsText[$i]?>">                                                                    </div>                                                                </div>                                                            </div>                                                        </li>                                                    <?php }?>                                                </ul>                                            <?php } else {?>                                                <ul>                                                    <li>                                                        <div class="row">                                                            <div class="col-md-6 col-sm-12">                                                                <div class="form-group">                                                                    <label><?php echo $BIZBOOK['EXPECIFICATION'];?></label>                                                                    <input type="text" id="details_id" name="details_id[]" class="form-control" disabled="disabled" placeholder="<?php echo $BIZBOOK['EXPECIFICATION'];?>">                                                                </div>                                                            </div>                                                            <div class="col-md-6 col-sm-12">                                                                <div class="form-group">                                                                    <label><?php echo $BIZBOOK['VALUE'];?></label>                                                                    <input type="text" id="details_text" name="details_text[]" class="form-control" disabled="disabled" placeholder="<?php echo $BIZBOOK['VALUE'];?>">                                                                </div>                                                            </div>                                                        </div>                                                    </li>                                                </ul>                                            <?php }?>                                        </div>                                    </div>                                </div>                            </div>                            <div class="row">                                <div class="col-12" >                                    <h4><?php echo $BIZBOOK['TAGS']?></h4>                                    <div class="row">                                        <div class="col-md-12">                                            <div class="form-group">                                                <input type="text" id="offer_tags" name="offer_tags" class="form-control" disabled="disabled" placeholder="<?php echo $BIZBOOK['TAGS'];?>" value="<?php echo $offer_row['offer_tags']?>">                                                <span>Separa las etiquetas por comas</span>                                            </div>                                        </div>                                    </div>                                </div>                            </div>                            <div class="row">                                <div class="col-md-12">                                    <button type="submit" name="offer_submit" class="btn btn-primary"><?php echo $BIZBOOK['DELETE']; ?></button>                                </div>                                <div class="col-md-12">                                    <a href="db-offer-store" class="skip"><?php echo $BIZBOOK['GO_TO_ALL_OFFERS']; ?> >></a>                                </div>                            </div>                        </form>                    </div>                </div>            </div>        </div>    </div></section><!--END PRICING DETAILS--><!-- Optional JavaScript --><!-- jQuery first, then Popper.js, then Bootstrap JS --><script src="js/jquery.min.js"></script><script src="js/popper.min.js"></script><script src="js/bootstrap.min.js"></script><script src="js/jquery-ui.min.js"></script><script src="js/custom.min.js"></script></body></html>