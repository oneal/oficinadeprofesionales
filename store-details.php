<?phpinclude "header.php";if (isset($_SESSION['user_id'])) {    $session_user_id = $_SESSION['user_id'];}$user_details_row = getUser($session_user_id);if ($_GET['code'] == NULL && empty($_GET['code'])) {    header("Location:".$slash."almacenes");    exit();}$storerow = getSlugStore($_GET['code']); //To Fetch the listingdif (!isset($storerow)) {    header("Location:".$slash."almacenes");    exit();}$store_id = $storerow['store_id'];$store_user_id = $storerow['user_id'];$category_id = $storerow['category_id'];$category = getCategoryStore($category_id);pageview($store_id); //Function To Find Page View$usersqlrow = getUser($store_user_id); // To Fetch particular User Data?><!-- START --><section>    <div class="list-det-fix">        <div class="container">            <div class="row">                <div class="list-det-fix-inn">                    <div class="list-fix-pro">                        <img src="<?php if ($storerow['profile_image'] != NULL || !empty($storerow['profile_image'])) {                            echo $slash."images/stores/" . $storerow['profile_image'];                        } else {                            echo $slash."images/listings/hot4.jpg";                        } ?>" title="<?php echo $storerow['store_name']; ?>" alt="<?php echo $storerow['store_name']; ?>">                    </div>                    <div class="list-fix-tit">                        <h3><?php echo $storerow['store_name']; ?></h3>                    </div>                    <div class="list-fix-btn">                        <?php if($storerow['store_website'] != NULL || $storerow['store_website'] != "") {?>                            <li>                                    <span class="pulse">                                        <a href="<?php echo $storerow['store_website'];?>" target="_blank">Visitar el almacén</a>                                    </span>                            </li>                        <?php }?>                    </div>                </div>            </div>        </div>    </div></section><!-- END --><!-- START --><section>    <div class="list-bann">        <img src="<?php if ($category['category_image'] != NULL || !empty($category['category_image'])) {            echo $slash."images/services/" . $category['category_image'];        } else {            echo $slash."images/listing-ban/1.jpg";        } ?>" title="<?php echo $storerow['store_name']; ?>" alt="<?php echo $storerow['store_name']; ?>">    </div></section><!-- END --><!-- START --><!--LISTING DETAILS--><section class="<?php if ($footer_row['admin_language'] == 2) {    echo "lg-arb";} ?> pg-list-1">    <div class="container">        <div class="row">            <div class="col-md-12">                <div class="pg-list-1-pro">                    <img src="<?php if ($storerow['profile_image'] != NULL || !empty($storerow['profile_image'])) {                        echo $slash."images/stores/" . $storerow['profile_image'];                    } else {                        echo $slash."images/listings/hot4.jpg";                    } ?>" title="<?php echo $storerow['store_name']; ?>" alt="<?php $storerow['store_name']; ?>">                    <?php                    if ($plan_type_row['plan_type_verified'] == '1') {                        ?>                        <span class="stat"><?php echo $BIZBOOK['VERIFIED'];?></span>                        <?php                    }                    ?>                </div>                <div class="pg-list-1-left">                    <h3><?php echo $storerow['store_name']; ?></h3>                    <div class="list-number pag-p1-phone d-none d-lg-block d-md-block d-sm-block d-xs-none">                        <ul>                            <a href="Tel:<?php echo $storerow['store_mobile'];?>">                                <li class="ic-php"><?php echo $storerow['store_mobile'];?></li>                            </a>                            <a href="mailto:<?php if ($storerow['store_email'] != NULL) {                                echo $usersqlrow['email_id'];                            } ?>"><li class="ic-mai"><?php if ($storerow['store_email'] != NULL) {                                    echo $storerow['store_email'];                                } ?>                            </li></a>                        </ul>                    </div>                    <div class="d-block d-lg-none d-md-none d-sm-none d-xs-block">                        <div class="row">                            <div class="col-4 col-sm-4 text-center">                                <a href="Tel:<?php echo $storerow['store_mobile'];?>" class="link-header-details">                                    <span class="ic-phone">Teléfono</span>                                </a>                            </div>                            <?php if ($storerow['store_email'] != NULL || $storerow['store_email'] != "") {?>                                <div class="col-4 col-sm-4 text-center">                                    <a href="mailto:<?php echo $storerow['store_email'];?>" class="link-header-details">                                        <span class="ic-email">Email</span>                                    </a>                                </div>                            <?php }?>                        </div>                    </div>                </div>                <div class="list-ban-btn">                    <ul>                        <?php if($storerow['store_website'] != NULL || $storerow['store_website'] != "") {?>                            <li>                                <span class="pulse">                                    <a href="<?php echo $storerow['store_website'];?>" target="_blank">Visitar el almacén</a>                                </span>                            </li>                        <?php }?>                    </ul>                </div>            </div>        </div>    </div></section><section class="<?php if ($footer_row['admin_language'] == 2) {    echo "lg-arb";} ?> list-pg-bg">    <div class="container">        <div class="row">            <div class="col-sm-12 col-12">                <div class="com-padd">                    <div class="list-pg-lt list-page-com-p">                            <!--LISTING DETAILS: LEFT PART 1-->                            <div class="pglist-bg pglist-p-com">                                <div class="pglist-p-com-ti">                                    <h3><span><?php echo $BIZBOOK['ABOUT'];?></span> <?php echo $storerow['store_name']; ?></h3>                                </div>                                <div class="list-pg-inn-sp">                                        <?php                                        //To Check whether listing owner made listing Share is enable                                        $setting_share = $usersqlrow['setting_share'];                                        if ($setting_share == 0) {?>                                            <div class="share-btn">                                                <?php                                                $listing_name_url = $storerow['store_slug'];                                                $fb_url = $webpage_full_link . "almacen/".$listing_name_url.'?src=facebook';  //URL Listing Detail  Facebook Link                                                $fb_link = urlencode($fb_url);                                                $twitter_url = $webpage_full_link . "almacen/".$listing_name_url.'?src=twitter';  //URL Listing Detail Twitter Link                                                $twitter_link = urlencode($twitter_url);                                                $whatsapp_url = $webpage_full_link . "almacen/".$listing_name_url.'?src=whatsapp';  //URL Listing Detail Whatsapp Link                                                $whatsapp_link = urlencode($whatsapp_url);                                                ?>                                                <ul>                                                    <li>                                                        <a target="_blank"                                                           href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $fb_url; ?>&quote=<?php echo $listrow['listing_name']; ?>"><?php echo $BIZBOOK['SHARE'];?>                                                            en Facebook</a></li>                                                    <li>                                                        <a target="_blank"                                                           href="http://twitter.com/share?text=<?php echo $listrow['listing_name']; ?>&url=<?php echo $twitter_link; ?>"><?php echo $BIZBOOK['SHARE'];?>                                                            en Twitter</a></li>                                                    <li><a target="_blank" href="https://api.whatsapp.com/send?text=<?php echo $whatsapp_link; ?>"><?php echo $BIZBOOK['SHARE'];?>                                                            en                                                            Whatsapp</a></li>                                                </ul>                                            </div>                                            <?php                                        }                                    ?>                                    <div>                                        <div>                                            <p><?php echo $storerow['store_description']?></p>                                        </div>                                    </div>                                </div>                            </div>                            <!--END LISTING DETAILS: LEFT PART 1-->                            <!--LISTING DETAILS: LEFT PART 2-->                            <?php if (getCountAllOffersByStore($store_id) > 0) { ?>                                <div class="pglist-bg pglist-p-com">                                    <div class="pglist-p-com-ti">                                        <h3>Ofertas especiales</h3>                                    </div>                                    <div class="all-list-sh all-listing-total">                                        <div class="row pg-list-ser">                                            <ul>                                                <?php                                                $vi = 1;                                                foreach (getAllOffersByStore($store_id) as $offer_store) {                                                    $store_id = $offer_store['store_id'];                                                    $store = getIdStore($store_id);                                                    $category_store_id = $store['category_id'];                                                    $category_a_row = getCategoryStore($category_store_id);                                                    ?>                                                    <li>                                                        <div class="eve-box">                                                            <!---LISTING IMAGE--->                                                            <div class="al-img2">                                                                <a href="<?php echo $webpage_full_link; ?>oferta-almacen/<?php echo $offer_store['offer_slug']?>">                                                                    <img src="<?php if ($offer_store['offer_img'] != NULL || !empty($offer_store['offer_img'])) {                                                                        echo $slash."images/offers_stores/" . $offer_store['offer_img'];                                                                    } else {                                                                        echo $slash."images/services/".$category_a_row['category_image'];                                                                    } ?>">                                                                </a>                                                            </div>                                                            <div>                                                                <h4 class="title-offer">                                                                    <a href="<?php echo $webpage_full_link; ?>oferta-almacen/<?php echo $offer_store['offer_slug']?>"><?php echo $offer_store['offer_name']; ?></a>                                                                </h4>                                                                <span class="store-city">Vendido por: <b><?php echo $store['store_name']?></b></span>                                                                <p class="text-store"><?php echo substr($offer_store['offer_description'],0,250);?><?php if(strlen($offer_store['offer_description'])>250){?>...<?php }?></p>                                                                <div class="offer-data">                                                                    <?php if($offer_store['offer_discount'] > 0) {?>                                                                        <span class="offer-price"><del><?php echo $offer_store['offer_price']?>€</del></span>                                                                        <span class="offer-discount"> <?php echo  number_format(round($offer_store['offer_price'] - (($offer_store['offer_price']*$offer_store['offer_discount'])/100), 2),2,',', '.')  ; ?>€</span>                                                                    <?php } else {?>                                                                        <span class="offer-discount"><?php echo $offer_store['offer_price']?>€</span>                                                                    <?php }?>                                                                    <span class="offer-show"><a href="<?php echo $webpage_full_link; ?>oferta-almacen/<?php echo $offer_store['offer_slug']?>">Ver más</a> </span>                                                                </div>                                                            </div>                                                            <!---END LISTING NAME--->                                                        </div>                                                    </li>                                                <?php }?>                                            </ul>                                        </div>                                    </div>                                </div>                            <?php } ?>                    </div>                    <div class="list-pg-rt">                        <!--LISTING DETAILS: LEFT PART 9-->                        <div class="list-rhs-form pglist-bg pglist-p-com">                            <div class="pglist-p-com-ti">                                <h3><span>Productos relacionados</span> </h3>                            </div>                            <div class="list-pg-inn-sp">                                <div class="row pg-list-ser">                                    <?php if(getCountOfferStoresRelated($category_id,$store_id) > 0){?>                                        <ul>                                            <?php foreach (getOfferStoresRelated($category_id,$store_id) as $related_offer_store) {?>                                                <li class="col-12">                                                    <a href="<?php echo $webpage_full_link; ?>oferta-almacen/<?php echo $related_offer_store['offer_slug']?>">                                                        <div class="pg-list-ser-p1"><img                                                                    src="<?php if ($related_offer_store['offer_img'] != "" and $related_offer_store['offer_img'] != NULL) {                                                                        echo $slash."images/offers_stores/".$related_offer_store['offer_img'];                                                                    } else {                                                                        echo $slash."images/services/".$category['category_image'];                                                                    } ?>"                                                                    title="<?php echo $related_offer_store['offer_name']; ?>" alt="<?php echo $related_offer_store['offer_name']; ?>"/>                                                        </div>                                                    </a>                                                </li>                                            <?php }?>                                        </ul>                                    <?php } else {?>                                        <p>No hay productos relacionados</p>                                    <?php }?>                                </div>                            </div>                        </div>                    </div>            </div>        </div>    </div></section><?phpinclude "footer.php";?><!-- Optional JavaScript --><!-- jQuery first, then Popper.js, then Bootstrap JS --><script src="<?php echo $slash; ?>js/jquery.min.js"></script><script src="<?php echo $slash; ?>js/popper.min.js"></script><script src="<?php echo $slash; ?>js/bootstrap.min.js"></script><script src="<?php echo $slash; ?>js/jquery-ui.min.js"></script><script src="<?php echo $slash; ?>js/custom.min.js"></script><script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script><script src="<?php echo $slash; ?>js/custom_validation.min.js"></script></body></html>