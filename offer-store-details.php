<?phpinclude "header.php";if (isset($_SESSION['user_id'])) {    $session_user_id = $_SESSION['user_id'];}$user_details_row = getUser($session_user_id);if ($_GET['code'] == NULL && empty($_GET['code'])) {    header("Location:".$slash."almacenes");    exit();}$offer_store = getOfferStoreSlug($_GET['code']); //To Fetch the listingd$store_id = $offer_store['store_id'];$store = getIdStore($store_id);if(!isset($store)) {    header("Location:".$slash."almacenes");    exit();}$store_user_id = $store['user_id'];$category_id = $store['category_id'];$category = getCategoryStore($category_id);pageview($store_id); //Function To Find Page View$usersqlrow = getUser($store_user_id); // To Fetch particular User Data?><section class="<?php if ($footer_row['admin_language'] == 2) {    echo "lg-arb";} ?> list-pg-bg list-bann-2">    <div class="container">        <div class="row">            <div class="col-sm-12 col-12">                <div class="com-padd">                    <div class="list-pg-rt" style="margin-bottom: 10px">                        <!--LISTING DETAILS: LEFT PART 9-->                        <div class="list-rhs-form pglist-bg pglist-bg-2">                            <div class="pglist-bg pglist-p-com pglist-p-com-2">                                <div class="list-pg-inn-sp" style="text-align: center">                                    <img                                            src="<?php if ($offer_store['offer_img'] != "" || $offer_store['offer_img'] != NULL) {                                                echo $slash."images/offers_stores/".$offer_store['offer_img'];                                            } else {                                                echo $slash."images/services/".$category['category_image'];                                            } ?>"                                            title="<?php echo $offer_store['offer_name']; ?>" alt="<?php echo $offer_store['offer_name']; ?>" class="img-offer-detail"/>                                </div>                            </div>                        </div>                        <div>                            <p >                                <a href="<?php if((strpos($store['store_website'],'http') !== FALSE) || (strpos($store['store_website'],'https') !== FALSE)) { echo $store['store_website']; }else{  echo "http://".$store['store_website'];} ?>" class="offerbuy" target="_blank">Comprar</a>                            </p>                        </div>                    </div>                    <div class="list-pg-lt list-page-com-p">                        <div>                            <h3><?php echo $offer_store['offer_name'];?></h3>                            <p>                                <?php if($offer_store['offer_discount'] > 0) {?>                                    <span class="offer-price-details"> <?php echo  number_format($offer_store['offer_price'],2,',', '.')  ; ?>€</span>                                    <span class="offer-discount-details"><?php echo $offer_store['offer_discount']?>% de descuento</span>                                    <span class="offer-price-discount-details"> <?php echo  number_format(round($offer_store['offer_price'] - (($offer_store['offer_price']*$offer_store['offer_discount'])/100), 2),2,',', '.')  ; ?>€</span>                                <?php } else {?>                                    <span class="offer-price-details"> <?php echo  number_format(round($offer_store['offer_price'] - (($offer_store['offer_price']*$offer_store['offer_discount'])/100), 2),2,',', '.')  ; ?>€ </span>                                <?php }?>                            </p>                        </div>                        <div>                            <p><?php echo $offer_store['offer_description']?></p>                        </div>                        <div class="pglist-bg pglist-p-com">                            <div class="pglist-p-com-ti">                                <h3>Grantía</h3>                            </div>                            <div class="list-pg-inn-sp">                                <p><?php echo $offer_store['offer_warranty'];?> años</p>                            </div>                        </div>                        <?php if($offer_store['offer_tags'] != NULL || $offer_store['offer_tags'] != "") {?>                            <div class="pglist-bg pglist-p-com">                                <div class="pglist-p-com-ti">                                    <h3>Especificaciones</h3>                                </div>                                <div class="list-pg-inn-sp">                                    <?php                                        $details_id = explode(',', $offer_store['details_id']);                                        $details_values = explode(',', $offer_store['details_values']);                                    ?>                                    <?php for ($i=0; $i<count($details_id);$i++) {?>                                        <div class="row">                                            <?php if ($details_id[$i] != "") {?>                                                <div class="col-6 col-sm-6"><p><?php echo $details_id[$i];?></p></div>                                                <div class="col-2 col-sm-1"><p>:</p></div>                                                <div class="col-4 col-sm-5">                                                    <?php if ($details_values[$i] != "") {?>                                                        <p><?php echo  $details_values[$i];?></p>                                                    <?php }?>                                                </div>                                            <?php }?>                                        </div>                                    <?php }?>                                </div>                            </div>                        <?php }?>                        <div class="pglist-bg pglist-p-com">                            <div class="pglist-p-com-ti">                                <h3>Vendido por</h3>                            </div>                            <div class="list-pg-inn-sp">                                <p class="shipping-by"><?php echo $store['store_name'];?> <span class="show-store"><a href="<?php echo $webpage_full_link; ?>almacen/<?php echo $store['store_slug']?>">Ver almacen</a> </span></p>                            </div>                        </div>                        <?php if($offer_store['offer_tags'] != NULL || $offer_store['offer_tags'] != "") {?>                            <div class="pglist-bg pglist-p-com">                                <div class="pglist-p-com-ti">                                    <h3>Etiquetas</h3>                                </div>                                <div class="list-pg-inn-sp">                                    <?php $etiquetas = explode(",", $offer_store['offer_tags']);?>                                    <?php foreach ($etiquetas as $etiqueta) {?>                                        <span class="offer-tags"><?php echo $etiqueta;?></span>                                    <?php }?>                                </div>                            </div>                        <?php }?>                        <div class="pglist-bg pglist-p-com">                            <div class="pglist-p-com-ti">                                <h3>Compartir</h3>                            </div>                            <div class="list-pg-inn-sp">                                <?php                                //To Check whether listing owner made listing Share is enable                                $setting_share = $usersqlrow['setting_share'];                                if ($setting_share == 0) {?>                                    <div class="share-btn">                                        <?php                                        $listing_name_url = $offer_store['offer_slug'];                                        $fb_url = $webpage_full_link . "oferta-almacen/".$listing_name_url.'?src=facebook';  //URL Listing Detail  Facebook Link                                        $fb_link = urlencode($fb_url);                                        $twitter_url = $webpage_full_link . "oferta-almacen/".$listing_name_url.'?src=twitter';  //URL Listing Detail Twitter Link                                        $twitter_link = urlencode($twitter_url);                                        $whatsapp_url = $webpage_full_link . "oferta-almacen/".$listing_name_url.'?src=whatsapp';  //URL Listing Detail Whatsapp Link                                        $whatsapp_link = urlencode($whatsapp_url);                                        ?>                                        <ul>                                            <li>                                                <a target="_blank"                                                   href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $fb_url; ?>&quote=<?php echo $listrow['listing_name']; ?>"><?php echo $BIZBOOK['SHARE'];?>                                                    en Facebook</a></li>                                            <li>                                                <a target="_blank"                                                   href="http://twitter.com/share?text=<?php echo $listrow['listing_name']; ?>&url=<?php echo $twitter_link; ?>"><?php echo $BIZBOOK['SHARE'];?>                                                    en Twitter</a></li>                                            <li><a target="_blank" href="https://api.whatsapp.com/send?text=<?php echo $whatsapp_link; ?>"><?php echo $BIZBOOK['SHARE'];?>                                                    en                                                    Whatsapp</a></li>                                        </ul>                                    </div>                                <?php }?>                                <div>                                    <?php                                    if ($plan_type_row['plan_type_description'] == '1') {                                        echo $listrow['listing_description'];                                    }                                    ?>                                </div>                            </div>                        </div>                    </div>                </div>            </div>        </div>    </div></section><?phpinclude "footer.php";?><!-- Optional JavaScript --><!-- jQuery first, then Popper.js, then Bootstrap JS --><script src="<?php echo $slash; ?>js/jquery.min.js"></script><script src="<?php echo $slash; ?>js/popper.min.js"></script><script src="<?php echo $slash; ?>js/bootstrap.min.js"></script><script src="<?php echo $slash; ?>js/jquery-ui.min.js"></script><script src="<?php echo $slash; ?>js/custom.min.js"></script><script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script><script src="<?php echo $slash; ?>js/custom_validation.min.js"></script></body></html>