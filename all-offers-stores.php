<?phpinclude "header.php";if (isset($_SESSION['user_id'])) {    $session_user_id = $_SESSION['user_id'];}//Pagination Code Starts Here$url = $webpage_full_link.$_SERVER['REQUEST_URI'];$numberOfPages = 15;$limit = 15;$CantidadMostrar = 15;if (isset($_GET["page"])) {    $page = $_GET["page"];} else {    $page = 1;}$array_pagination = array();if(in_array($page,$array_pagination)){    $array_pagination[0] = $page;    $array_pagination[1] = ($page+1);    $array_pagination[2] = ($page+2);}$start_from = ($page - 1) * $limit;//Pagination Code Ends Here?><?php$inner_join_offer_stores = "INNER JOIN " . TBL ."stores ON vv_stores.store_id = " . TBL ."offers_stores.store_id";if(isset($_GET['s'])) {    $distinct = "distinct ";    $search_query_text= 'AND ' . TBL .'offers_stores.offer_name like \'%'.$_GET['s'].'%\'';}$lists_favorite_home = getAllStoreFavoritelisting();?><!-- START --><section>    <div class="all-list-bre" <?php if($lists_favorite_home->num_rows > 0) {?> style="padding: 35px 0 25px;" <?php }?>>        <div class="container sec-all-list-bre">            <div class="row">                <div class="col-12 col-sm-12">                    <h1>                    <?php                        echo $BIZBOOK['CATALOGUE_ONLINE'];                    ?>                    </h1>                    <ul>                        <li><a href="<?php echo $webpage_full_link; ?>">Home</a></li>                        <li><a href="<?php echo $slash;?>todas-ofertas-almacenes"><?php echo $BIZBOOK['CATALOGUE_ONLINE'];?></a></li>                    </ul>                </div>            </div>        </div>    </div></section><!-- END --><!-- START --><?phpif ($lists_favorite_home->num_rows > 0) {?>    <section>        <div class="str">            <div class="container">                <div class="row">                    <div class="col-12 col-sm-12">                        <div class="row">                            <div class="col-12 col-sm-12">                                <div class="home-tit">                                    <h2><span>ALMACENES DESTACADOS</span></h2>                                </div>                            </div>                        </div>                                                    <div class="row" style="margin-bottom: 150px;">                            <?php                            $vi = 1;                            foreach ($lists_favorite_home as $list_favorite_home) {                                $continuar = FALSE;                                if(($list_favorite_home['featured_store_price_id'] == '2') and $list_favorite_home['category_id'] == $category_id){                                    $continuar = TRUE;                                }else if(($list_favorite_home['featured_store_price_id'] == '5') and $list_favorite_home['category_id'] == $category_id and $list_favorite_home['state_id'] == $state_id and $list_favorite_home['city_id'] == $city_id){                                    $continuar = TRUE;                                }else if(($list_favorite_home['featured_store_price_id'] == '3') and $list_favorite_home['category_id'] == $category_id and $list_favorite_home['state_id'] == $state_id and $list_favorite_home['city_id'] != $city_id){                                    $continuar = TRUE;                                }else if($list_favorite_home['featured_listing_price_id'] == '7'){                                    $continuar = TRUE;                                }                                                                if($continuar){                                    // List Rating. for Rating of Star                                    ?>                                    <!--LISTINGS-->                                    <div class="col-12 col-sm-6 mt-md-5 col-md-4 col-lg-3 slick-slide">                                        <img src="<?php if ($list_favorite_home['profile_image'] != NULL || !empty($list_favorite_home['profile_image'])) {                                                echo $slash."images/stores/" . $list_favorite_home['profile_image'];                                            } else {                                                echo $slash."images/listings/hot4.jpg";                                            } ?>" title="<?php echo $list_favorite_home['offer_name']; ?>" alt="<?php echo $list_favorite_home['offer_name']; ?>">                                        <div class="text-item-slider">                                            <h5 class="titulo-slider">                                                <?php echo $list_favorite_home['offer_name']; ?>                                            </h5>                                            <span class="pho-destacado">                                                    <?php echo $list_favorite_home['store_mobile'];?>                                                </span>                                            <span class="email-destacado">                                                    <?php echo $list_favorite_home['store_email'];?>                                            </span>                                            <p class="text-store"><?php echo substr($list_favorite_home['store_description'],0,120).'...';?></p>                                        </div>                                        <a href="<?php if((strpos($list_favorite_home['store_website'],'http') !== FALSE) || (strpos($list_favorite_home['store_website'],'https') !== FALSE)) { echo $list_store['store_website']; }else{  echo "http://".$list_store['store_website'];} ?>" class="fclick"></a>                                    </div>                                <?php }?>                                <!--LISTINGS-->                            <?php                            }                            ?>                        </div>                    </div>                </div>                <hr/>            </div>        </div>    </section><?php }?><section>    <div class="all-listing">        <!--FILTER ON MOBILE VIEW-->        <div class="fil-mob fil-mob-act">            <h4><?php echo $BIZBOOK['LISTING_FILTERS'];?> <i class="material-icons">filter_list</i> </h4>        </div>        <div class="container">            <div class="row">                <?php                foreach (getAllListingFilter() as $all_listing_filter_row) {                    ?>                    <div class="col-md-3 fil-mob-view">                        <div class="all-filt">                                <div class="filt-com lhs-cate">                                    <h4>Buscar</h4>                                    <input type="text" class="form-control" id="select-text" name="select-text" placeholder="Introduce una cadena de busqueda" value="<?php echo $_GET['s'];?>">                                </div>                                <div class="filt-com lhs-cate">                                    <p class="sr-btn">                                        <button type="button" id="filter_submit_offer_store" name="filter_submit_offer_store" class="filter_submit"><?php echo $BIZBOOK['SEARCH']; ?></button>                                    </p>                                </div>                            <!--START-->                            <div class="filt-com lhs-ads">                                <ul>                                    <li>                                        <div class="ads-box">                                            <?php                                            $ad_position_id = 4;   //Ad position on All Listing page Left                                            $ad_row = getAds($ad_position_id, 3, $category_id);                                            if($ad_row and $ad_row['ad_enquiry_photo'] != ""){                                                $ad_price_row = getAdsPrice($ad_row['all_ads_price_id']);                                                $price_size = $ad_price_row['ad_price_size'];                                                $price_size = str_replace(' X ', ' ', $price_size);                                                $price_size = str_replace(' px', '', $price_size);                                                $array_size = explode(' ', $price_size);                                                $width_size = $array_size[0];                                                $height_size = $array_size[1];                                                $ad_enquiry_photo = $ad_row['ad_enquiry_photo'];                                                ?>                                                <a href="<?php echo stripslashes($ad_row['ad_link']); ?>">                                                    <span>Ad</span>                                                    <img                                                        src="<?php echo $slash;?>images/ads/<?php echo $ad_enquiry_photo;?>" title="<?php echo $storerow['offer_name']; ?>" alt="<?php echo $storerow['offer_name']; ?>" style="width: <?php echo $width_size;?>px; height: <?php echo $height_size;?>px; max-width: 100%;">                                                </a>                                            <?php } ?>                                        </div>                                    </li>                                </ul>                            </div>                            <!--END-->                        </div>                    </div>                    <?php                }                ?>                <div class="col-md-9">                    <?php                    $totalReg_sql = "SELECT $distinct" . TBL . "offers_stores.* FROM " . TBL . "offers_stores $inner_join_offer_stores WHERE " . TBL . "stores.store_status= 'Active' $search_query_text";                    $totalRegrs = mysqli_query($conn, $totalReg_sql);                    $TotalRegistro = mysqli_num_rows($totalRegrs);                    $listsql = "SELECT $distinct" . TBL . "offers_stores.* FROM " . TBL . "offers_stores $inner_join_offer_stores WHERE " . TBL . "stores.store_status= 'Active' $search_query_text ORDER BY " . TBL . "offers_stores.offer_cdt DESC LIMIT $start_from, $limit";                    $lists_stores = mysqli_query($conn, $listsql);                    ?>                    <div class="ban-ati-com ads-all-list">                        <?php                        $ad_position_id = 2;   //Ad position on All Listing page Top                        $ad_row = getAds($ad_position_id, 3);                        if($ad_row and $ad_row['ad_enquiry_photo'] != ""){                            $ad_price_row = getAdsPrice($ad_row['all_ads_price_id']);                            $price_size = $ad_price_row['ad_price_size'];                            $price_size = str_replace(' X ', ' ', $price_size);                            $price_size = str_replace(' px', '', $price_size);                            $array_size = explode(' ', $price_size);                            $width_size = $array_size[0];                            $height_size = $array_size[1];                            $ad_enquiry_photo = $ad_row['ad_enquiry_photo'];                            ?>                            <a href="<?php echo stripslashes($ad_row['ad_link']); ?>">                                <span>Ad</span>                                <img src="<?php echo $slash;?>images/ads/<?php echo $ad_enquiry_photo;?>" style="width: <?php echo $width_size;?>px; height: <?php echo $height_size;?>px; max-width: 100%">                            </a>                        <?php }?>                    </div>                    <?php if ($lists_stores->num_rows > 0) {?>                        <div class="ad-pgnat">                            <ul class="pagination">                                <?php                                    $IncrimentNum =(($page +1)<=$TotalRegistro)?($page +1):1;                                    $DecrementNum =(($page -1))<1?1:($page -1);                                    $num_paginas_total = ceil($TotalRegistro/$limit);                                    $Desde=$page-(ceil($CantidadMostrar/2)-1);                                    $Hasta=$page+(ceil($CantidadMostrar/2)-1);                                ?>                                <?php if($page > 1){?>                                    <li class="page-item prev"><a class="page-link" href="<?php echo '?page='.$DecrementNum?>"><?php echo $BIZBOOK['PREVIOUS'];?></a></li>                                <?php }?>                                <?php                                    $Desde=($Desde<1)?1: $Desde;                                    $Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;                                    //Se muestra los números de paginas                                    for($i=$Desde; $i<=$Hasta;$i++){                                       //Se valida la paginacion total                                       //de registros                                        if($i<=$TotalRegistro and $i <= $num_paginas_total){                                        //Validamos la pag activo                                            if($i==$page){                                                echo "<li class=\"page-item active\"><a href=\"?page=".$i."\" class=\"page-link\">".$i."</a></li>";                                            }else {                                                echo "<li class=\"page-item\"><a href=\"?page=".$i."\" class=\"page-link\">".$i."</a></li>";                                            }                                        }                                    }                                ?>                                <?php if(mysqli_num_rows($lists_stores)>=$limit){?>                                    <li class="page-item next"><a class="page-link" href="<?php echo '?page='.$IncrimentNum;?>"><?php echo $BIZBOOK['NEXT'];?></a></li>                                <?php }?>                            </ul>                        </div>                    <?php }?>                    <div class="all-list-sh all-listing-total">                        <div class="row pg-list-ser">                            <ul>                                <?php                                $vi = 1;                                foreach ($lists_stores as $offer_store) {                                    $store_id = $offer_store['store_id'];                                    $store = getIdStore($store_id);                                    $category_store_id = $store['category_id'];                                    $category_a_row = getCategoryStore($category_store_id);                                    ?>                                    <li>                                        <div class="eve-box">                                            <!---LISTING IMAGE--->                                            <div class="al-img2">                                                <a href="<?php echo $webpage_full_link; ?>oferta-almacen/<?php echo $offer_store['offer_slug']?>">                                                    <img src="<?php if ($offer_store['offer_img'] != NULL || !empty($offer_store['offer_img'])) {                                                        echo $slash."images/offers_stores/" . $offer_store['offer_img'];                                                    } else {                                                        echo $slash."images/services/".$category_a_row['category_image'];                                                    } ?>">                                                </a>                                            </div>                                            <div>                                                <h4 class="title-offer">                                                    <a href="<<?php echo $webpage_full_link; ?>oferta-almacen/<?php echo $offer_store['offer_slug']?>"><?php echo $offer_store['offer_name']; ?></a>                                                </h4>                                                <span class="store-city">Vendido por: <b><?php echo $store['store_name']?></b></span>                                                <p class="text-store"><?php echo substr($offer_store['offer_description'],0,250);?><?php if(strlen($offer_store['offer_description'])>250){?>...<?php }?></p>                                                <div class="offer-data">                                                    <?php if($offer_store['offer_discount'] > 0) {?>                                                        <span class="offer-price"><del><?php echo $offer_store['offer_price']?>€</del></span>                                                        <span class="offer-discount"> <?php echo  number_format(round($offer_store['offer_price'] - (($offer_store['offer_price']*$offer_store['offer_discount'])/100), 2),2,',', '.')  ; ?>€</span>                                                    <?php } else {?>                                                        <span class="offer-discount"><?php echo $offer_store['offer_price']?>€</span>                                                    <?php }?>                                                    <span class="offer-show"><a href="<?php echo $webpage_full_link; ?>oferta-almacen/<?php echo $offer_store['offer_slug']?>">Ver más</a> </span>                                                </div>                                            </div>                                            <!---END LISTING NAME--->                                        </div>                                    </li>                                <?php }?>                            </ul>                        </div>                    </div>                    <?php if ($lists_stores->num_rows > 0) {?>                        <div class="ad-pgnat">                            <ul class="pagination">                                <?php                                    $IncrimentNum =(($page +1)<=$TotalRegistro)?($page +1):1;                                    $DecrementNum =(($page -1))<1?1:($page -1);                                    $num_paginas_total = ceil($TotalRegistro/$limit);                                    $Desde=$page-(ceil($CantidadMostrar/2)-1);                                    $Hasta=$page+(ceil($CantidadMostrar/2)-1);                                ?>                                <?php if($page > 1){?>                                    <li class="page-item prev"><a class="page-link" href="<?php echo '?page='.$DecrementNum?>"><?php echo $BIZBOOK['PREVIOUS'];?></a></li>                                <?php }?>                                <?php                                    $Desde=($Desde<1)?1: $Desde;                                    $Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;                                    //Se muestra los números de paginas                                    for($i=$Desde; $i<=$Hasta;$i++){                                       //Se valida la paginacion total                                       //de registros                                       if($i<=$TotalRegistro and $i <= $num_paginas_total){                                        //Validamos la pag activo                                        if($i==$page){                                            echo "<li class=\"page-item active\"><a href=\"?page=".$i."\" class=\"page-link\">".$i."</a></li>";                                        }else {                                            echo "<li class=\"page-item\"><a href=\"?page=".$i."\" class=\"page-link\">".$i."</a></li>";                                        }                                    }                                }?>                                <?php if(mysqli_num_rows($lists_stores) >= $limit){?>                                    <li class="page-item next"><a class="page-link" href="<?php echo '?page='.$IncrimentNum;?>"><?php echo $BIZBOOK['NEXT'];?></a></li>                                <?php }?>                            </ul>                        </div>                    <?php }?>                    <!--ADS-->                    <div class="ban-ati-com ads-all-list">                        <?php                        $ad_position_id = 3;   //Ad position on All Listing page Bottom                        $ad_row = getAds($ad_position_id, 3);                        if($ad_row and $ad_row['ad_enquiry_photo'] != ""){                            $ad_price_row = getAdsPrice($ad_row['all_ads_price_id']);                            $price_size = $ad_price_row['ad_price_size'];                            $price_size = str_replace(' X ', ' ', $price_size);                            $price_size = str_replace(' px', '', $price_size);                            $array_size = explode(' ', $price_size);                            $width_size = $array_size[0];                            $height_size = $array_size[1];                            $ad_enquiry_photo = $ad_row['ad_enquiry_photo'];                            ?>                            <a href="<?php echo stripslashes($ad_row['ad_link']); ?>">                                <span>Ad</span>                                <img src="<?php echo $slash;?>images/ads/<?php echo $ad_enquiry_photo;?>" style="width: <?php echo $width_size;?>px; height: <?php echo $height_size;?>px; max-width: 100%">                            </a>                        <?php }?>                    </div>                    <!--ADS-->                </div>            </div>        </div>    </div></section><!-- END --><?phpinclude "footer.php";?><!-- START --><section>    <div class="str">        <div class="container">            <div class="row">            </div>        </div>    </div></section><!-- END --><!--  Quick View box starts  --><!-- START --><?phpinclude "modal_politca_privacidad.php";?><?phpinclude "modal_politca_privacidad_consigue_cita.php";?><!-- END --><!--  Quick View box ends  --><!-- Optional JavaScript --><!-- jQuery first, then Popper.js, then Bootstrap JS --><script src="<?php echo $slash;?>js/jquery.min.js"></script><script src="<?php echo $slash;?>js/popper.min.js"></script><script src="<?php echo $slash;?>js/bootstrap.min.js"></script><script src="<?php echo $slash;?>js/jquery-ui.js"></script><script src="<?php echo $slash;?>js/custom.min.js"></script><script src="<?php echo $slash;?>js/jquery.validate.min.js"></script><script src="<?php echo $slash;?>js/custom_validation.js"></script><script>    function breadcrumbs(val) {        $(".sec-all-list-bre").css("opacity", 0);        $.ajax({            type: "POST",            url: "category_filter_breadcrumb.php",            data: 'category_id=' + val,            success: function (data) {                if (data == null) {                    $(".sec-all-list-bre").css("opacity", 1);                } else {                    $(".sec-all-list-bre").html(data);                    $(".sec-all-list-bre").css("opacity", 1);                }            }        });    }    var scr_he = window.innerHeight;    var fiscr_he = scr_he;    if(scr_he >= 450){        $(".list-map-resu").css("height",fiscr_he);    }</script><script>    function gethomeCities(val) {        $.ajax({            type: "POST",            url: "<?php echo $slash;?>city_home_process.php",            data: 'select-city=' + val,            success: function (data) {                $("#select-city").html(data);                $('#select-city').trigger("chosen:updated");            }        });    }</script><script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script><script type="text/javascript">    $(document).ready(function(){        $('.items').slick({        dots: false,        infinite: true,        speed: 800,        autoplay: false,        autoplaySpeed: 2000,        slidesToShow: 4,        slidesToScroll: 4,        prevArrow: "<button type='button' class='btn-color-slider-next btn-slider slick-next'>next</button>",        nextArrow: "<button type='button' class='btn-color-slider-prev btn-slider slick-prev'>prev</button>",        responsive: [            {                breakpoint: 1024,                settings: {                    slidesToShow: 3,                    slidesToScroll: 3,                    infinite: true,                    dots: true                }            },            {                breakpoint: 600,                settings: {                    slidesToShow: 2,                    slidesToScroll: 2                }            },            {                breakpoint: 480,                settings: {                    slidesToShow: 1,                    slidesToScroll: 1                }            }        ]        });    });</script><?php if(!empty($_SESSION['user_name'])){?>    <script type="text/javascript">        //All Listing Page LIKE ANIMATION        $(".enq-sav i").click(function () {            var listing_id = $(this).attr('data-id');            var user_id = $(this).attr('data-item');            var listing_user_id = $(this).attr('data-num');            var like_status = $(this).attr('data-section');            var total_likes = $(this).attr('data-for');            if (user_id) {  //Check Current User is Null Means redirect to login page                if (listing_user_id == user_id) {  //Check Listing Owner and Current User is Same                    alert("Eres el propietario de esta ficha");                } else {                    $.ajax({                        type: 'POST',                        url: '<?php echo $slash; ?>/save_to_wishlist.php',                        cache: false,                        data: {listing: listing_id, listing_user: listing_user_id, user: user_id, status: like_status},                        success: function (response) {                            $(".Animatedheartfunc" + listing_id).toggleClass('sav-act');                            if (response == 1) {                                var total_likes1 = parseInt(total_likes) + 1;                                $(".Animatedheartfunc" + listing_id).attr("data-for", total_likes1); //setter                                $(".like-content" + listing_id).html(total_likes1 + " Likes");                            } else {                                var total_likes1 = parseInt(total_likes) - 1;                                if (total_likes1 == -1) {                                    var total_likes2 = 0;                                } else {                                    var total_likes2 = total_likes1;                                }                                $(".Animatedheartfunc" + listing_id).attr("data-for", total_likes2); //setter                                $(".like-content" + listing_id).html(total_likes2 + " Likes");                            }                            //$(".enq-sav i").toggleClass('sav-act');                        }                    });                }            } else {                window.location.href = host+dir+"/login.php";            }        });    </script><?php }?></body></html>