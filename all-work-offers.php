<?php
include "header.php";
if (isset($_SESSION['user_id'])) {
    $session_user_id = $_SESSION['user_id'];
}
//Pagination Code Starts Here
$url = $webpage_full_link.$_SERVER['REQUEST_URI'];
$numberOfPages = 8;
$limit = 8;
$CantidadMostrar=8;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$array_pagination = array();
if(in_array($page,$array_pagination)){
    $array_pagination[0] = $page;
    $array_pagination[1] = ($page+1);
    $array_pagination[2] = ($page+2);
}
$start_from = ($page - 1) * $limit;

//Pagination Code Ends Here

?>

<?php
if (isset($_GET['select_cate'])) {
    $values = explode("/", $_GET['select_cate']);
    if (count($values)== 3) {
        $select_city = $values[1];
        $select_state = $values[2];
        $select_cate = $values[0];
    } else if (count($values)== 2) {
        $select_city = "";
        $select_state = $values[1];
        $select_cate = $values[0];
    } else if (count($values)== 1) {
        $select_city = "";
        $select_state = "";
        $select_cate = $values[0];
    } else {
        $select_city = "";
        $select_state = "";
        $select_cate = "";
    }
    
    $category_search_name = "";
    $search_query_category = "";
    $search_query_city = "";
    $search_query_state = "";
    if($select_cate != ""){
        $category_sql = "SELECT * FROM " . TBL . "categories_work_offer where category_slug='" . $select_cate . "'";
        $category_rs = mysqli_query($conn, $category_sql);
        $category_row = mysqli_fetch_array($category_rs);
        $category_search_name = $category_row['category_name'];
        $category_id = $category_row['category_id'];
        $search_query_category = "AND FIND_IN_SET($category_id, category_id)";
    }
    
    if($select_city != ""){
        $city_sql = "SELECT * FROM " . TBL . "cities where city_slug='" . $select_city . "'";
        $city_rs = mysqli_query($conn, $city_sql);
        $city_row = mysqli_fetch_array($city_rs);
        $city_id = $city_row['city_id'];
        $search_query_city = "AND FIND_IN_SET($city_id, city_id)";
    }
    
    if($select_state != ""){
        $state_sql = "SELECT * FROM  " . TBL . "states where state_slug='" . $select_state . "'";
        $state_rs = mysqli_query($conn, $state_sql);
        $state_row = mysqli_fetch_array($state_rs);
        $state_id = $state_row['state_id'];
        $search_query_state= "AND FIND_IN_SET($state_id, state_id)";
    }
}
?>

<!-- START -->
<section>
    <div class="all-list-bre">
        <div class="container sec-all-list-bre">
            <div class="row">
                <?php
                $text_work_offer = "";
                if (strpos($_SERVER['REQUEST_URI'], 'ofertas-trabajo') != FALSE) {
                    $text_work_offer = strtoupper($BIZBOOK['WORK_OFFERS'])." ";
                }
                if (isset($select_cate)) {
                    ?>
                    <h1><?php echo $text_work_offer.$category_search_name; ?></h1>
                    <?php
                }else{
                    ?>
                    <h1><?php echo $text_work_offer.$BIZBOOK['ALL__CATEGORIES'];?></h1>
                    <?php
                }
                ?>
                <ul>
                    <li><a href="<?php echo $webpage_full_link; ?>">Home</a></li>
                    <li><a href="<?php echo $slash;?>ofertas-trabajo"><?php echo $BIZBOOK['ALL__CATEGORIES'];?></a></li>
                    <?php
                    if (isset($select_cate)) {
                        ?>
                        <li><a href="<?php echo $slash;?>ofertas-trabajo/<?php echo $select_cate; ?>"><?php echo $category_search_name; ?></a></li>
                        <?php
                    }?>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- END -->
<!-- START -->
<?php /*$lists_favorite_home = getAllListingFavoritelisting();
    if ($lists_favorite_home->num_rows > 0) {?>
    <section>
        <div class="str">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <div class="home-tit">
                                    <h2><span><?php echo $BIZBOOK['HOM-TOPSER-TIT']; ?></span></h2>
                                </div>
                            </div>
                        </div>
                            
                        <div class="row" style="margin-bottom: 150px;">
                            <?php

                            $vi = 1;
                            foreach ($lists_favorite_home as $list_favorite_home) {
                                $continuar = FALSE;
                                if(($list_favorite_home['featured_listing_price_id'] == '2' OR $list_favorite_home['featured_listing_price_id'] == '6') and $list_favorite_home['category_id'] == $category_id){
                                    $continuar = TRUE;
                                }else if(($list_favorite_home['featured_listing_price_id'] == '5' OR $list_favorite_home['featured_listing_price_id'] == '6') and $list_favorite_home['category_id'] == $category_id and $list_favorite_home['state_id'] == $state_id and $list_favorite_home['city_id'] == $city_id){
                                    $continuar = TRUE;
                                }else if(($list_favorite_home['featured_listing_price_id'] == '3' OR $list_favorite_home['featured_listing_price_id'] == '6') and $list_favorite_home['category_id'] == $category_id and $list_favorite_home['state_id'] == $state_id and $list_favorite_home['city_id'] != $city_id){
                                    $continuar = TRUE;
                                }else if($list_favorite_home['featured_listing_price_id'] == '7'){
                                    $continuar = TRUE;
                                }
                                
                                if($continuar){
                                    // List Rating. for Rating of Star
                                    foreach (getListingReview($list_favorite_home['listing_id']) as $star_rating_row) {
                                        $category_id_listing_favorite_home = $list_favorite_home['category_id'];
                                        $category_listing_favorite_home = getCategory($category_id_listing_favorite_home);
                                        
                                        if ($star_rating_row["rate_cnt"] > 0) {
                                            $star_rate_times = $star_rating_row["rate_cnt"];
                                            $star_sum_rates = $star_rating_row["total_rate"];
                                            $star_rate_one = $star_sum_rates / $star_rate_times;
                                            //$star_rate_one = (($Star_rate_value)/5)*100;
                                            $star_rate_two = number_format($star_rate_one, 1);
                                            $star_rate = floatval($star_rate_two);

                                        } else {
                                            $rate_times = 0;
                                            $rate_value = 0;
                                            $star_rate = 0;
                                        }
                                    }
                                    ?>
                                    <!--LISTINGS-->
                                    <div class="col-12 col-sm-6 col-md-3 slick-slide">
                                        <img src="<?php if ($list_favorite_home['profile_image'] != NULL || !empty($list_favorite_home['profile_image'])) {
                                                echo $slash."images/listings/" . $list_favorite_home['profile_image'];
                                            } else {
                                                echo $slash."images/listings/hot4.jpg";
                                            } ?>" title="<?php echo $list_favorite_home['work_offer_name']; ?>" alt="<?php echo $list_favorite_home['listing_name']; ?>">
                                        <div class="text-item-slider">
                                            <h5 class="titulo-slider"><?php echo $list_favorite_home['work_offer_name']; ?><br/>
                                                <span><?php echo $category_listing_favorite_home['category_name']; ?></span>
                                            </h5>

                                            <?php if ($star_rate != 0) { ?>
                                                <p class="home-rate-destacados"><span><?php echo $star_rate; ?></span></p>
                                            <?php } ?>
                                            <p class="parrafo-slider"><?php echo substr(strip_tags($list_favorite_home['listing_description']),0,120)."...";?></p>
                                        </div>
                                        <a href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $list_favorite_home['listing_slug']; ?>" class="fclick"></a>
                                    </div>
                                <?php }?>
                                <!--LISTINGS-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <hr/>
            </div>
        </div>
    </section>
<?php }*/?>
<section>
    <div class="all-listing">
        <!--FILTER ON MOBILE VIEW-->
        <div class="fil-mob fil-mob-act">
            <h4><?php echo $BIZBOOK['LISTING_FILTERS'];?> <i class="material-icons">filter_list</i> </h4>
        </div>
        <div class="container">
            <div class="row">
                <?php
                foreach (getAllListingFilter() as $all_listing_filter_row) {

                    ?>
                    <div class="col-md-3 fil-mob-view">
                        <div class="all-filt">


                                <!--END-->
                                <!--START-->
                                <div class="filt-com lhs-cate">
                                    <h4><?php echo utf8_decode(utf8_encode($BIZBOOK['CATEGORIES']));?></h4>
                                    <div class="dropdown">
                                        <?php /*<button id="dLabel" class="dropdown-select" type="button" data-toggle="dropdown"
                                             aria-haspopup="true" aria-expanded="false">All categories</button>
                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                            <?php //foreach (getAllCategories() as $category_row) { ?>
                                                <li><?php echo $category_row['category_name']; ?></li>
                                            <?php }?>
                                            </ul>*/?>
                                        <select <?php /*onChange="SubcategoryFilter(this.value);"*/?> class="cat_check" name="select-cate" id="select-cate" class="chosen-select ">
                                            <option value=""><?php echo $BIZBOOK['SELECT_CATEGORY']?></option>
                                            <?php
                                            foreach (getAllCategoriesWorkOffer() as $categories_row) {?>
                                                <option <?php if ($category_id === $categories_row['category_id']) {
                                                    echo 'selected';
                                                } ?>
                                                    value="<?php echo $categories_row['category_slug']; ?>"><?php echo $categories_row['category_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="filt-com lhs-cate">
                                    <h4><?php echo $BIZBOOK['STATES']?></h4>
                                    <div class="dropdown">
                                        <select onChange="gethomeCities(this.value);" class="cat_check" name="select-state" id="select-state" class="chosen-select ">
                                            <option value=""><?php echo $BIZBOOK['SELECT_YOUR_STATE']?></option>
                                            <?php
                                            foreach (getAllStates(1) as $state_row) { ?>
                                                <option <?php if ($state_id == $state_row['state_id']) {
                                                    echo 'selected';
                                                } ?>
                                                    value="<?php echo $state_row['state_slug']; ?>"><?php echo $state_row['state_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="filt-com lhs-cate">
                                    <h4><?php echo $BIZBOOK['SUB_REGIONS']?></h4>
                                    <div class="dropdown">
                                        <select  class="cat_check" name="select-city" id="select-city" class="chosen-select">
                                            <option value=""><?php echo $BIZBOOK['SELECT_YOUR_CITY']?></option>
                                            <?php if($state_id != "") {?>
                                                <?php
                                                    foreach (getAllCitiesIdState($state_id) as $city_row) {?>
                                                        <option <?php if ($city_id == $city_row['city_id']) {
                                                            echo 'selected';
                                                        } ?>
                                                            value="<?php echo $city_row['city_slug']; ?>"><?php echo $city_row['city_name']; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="filt-com lhs-cate">
                                    <p class="sr-btn">
                                        <button type="button" id="filter_submit_offer" name="filter_submit_offer" class="filter_submit"><?php echo $BIZBOOK['SEARCH']; ?></button>
                                    </p>
                                </div>

                            <!--START-->
                            <div class="filt-com lhs-ads">
                                <ul>
                                    <li>
                                        <div class="ads-box">
                                            <?php
                                            $ad_position_id = 4;   //Ad position on All Listing page Left
                                            $ad_row = getAds($ad_position_id, 2, $category_id);

                                            if($ad_row and $ad_row['ad_enquiry_photo'] != ""){
                                                $ad_price_row = getAdsPrice($ad_row['all_ads_price_id']);
                                                $price_size = $ad_price_row['ad_price_size'];
                                                $price_size = str_replace(' X ', ' ', $price_size);
                                                $price_size = str_replace(' px', '', $price_size);
                                                $array_size = explode(' ', $price_size);
                                                $width_size = $array_size[0];
                                                $height_size = $array_size[1];
                                                $ad_enquiry_photo = $ad_row['ad_enquiry_photo'];
                                                ?>
                                                <a href="<?php echo stripslashes($ad_row['ad_link']); ?>">
                                                    <span>Ad</span>

                                                    <img
                                                        src="<?php echo $slash;?>images/ads/<?php echo $ad_enquiry_photo;?>" title="<?php echo $workofferrow['work_offer_name']; ?>" alt="<?php echo $workofferrow['work_offer_name']; ?>" style="width: <?php echo $width_size;?>px; height: <?php echo $height_size;?>px; max-width: 100%;">
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </li>
                                    <?php /*<li>
                                        <div class="ads-box">
                                            <?php
                                            $ad_position_id = 3;   //Ad position on All Listing page Bottom
                                            $ad_row = getAds($ad_position_id);
                                            $ad_enquiry_photo = $ad_row['ad_enquiry_photo'];
                                            ?>
                                           <a href="<?php //echo stripslashes($ad_row['ad_link']); ?><!--">
                                                <span>Ad</span>

                                                <img
                                                    src="images/ads/<?php //if ($ad_enquiry_photo != NULL || !empty($ad_enquiry_photo)) {
                                                       echo $ad_enquiry_photo;
                                                    } else {
                                                        echo "ads2.jpg";
                                                    } ?><!--" title="<?php echo $workofferrow['work_offer_name']; ?>" alt="<?php echo $workofferrow['work_offer_name']; ?>">
                                            </a>
                                        </div>
                                    </li>*/?>
                                </ul>
                            </div>
                            <!--END-->
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="col-md-9">
                    <?php
//                          $listsql = "SELECT *
//			    FROM " . TBL . "listings  WHERE listing_status= 'Active' AND listing_is_delete != '2'
//			    $category_search_query $city_search_query ORDER BY listing_id DESC LIMIT $start_from, $limit";

                            $totalReg_sql = $listsql = "SELECT " . TBL . "work_offers.* FROM " . TBL . "work_offers
                            
                            LEFT JOIN " . TBL . "users ON " . TBL . "work_offers.user_id = " . TBL . "users.user_id  WHERE " . TBL . "work_offers.work_offer_status= 'Active' 

                            $search_query_state $search_query_city $search_query_category ";
                            $totalRegrs = mysqli_query($conn, $totalReg_sql);
                            $TotalRegistro = mysqli_num_rows($totalRegrs);

                            $listsql = "SELECT " . TBL . "work_offers.* FROM " . TBL . "work_offers
                            
 LEFT JOIN " . TBL . "users ON " . TBL . "work_offers.user_id = " . TBL . "users.user_id  WHERE " . TBL . "work_offers.work_offer_status= 'Active' 
 
 $search_query_state $search_query_city $search_query_category 
 
 ORDER BY " . TBL . "work_offers.work_offer_cdt DESC LIMIT $start_from, $limit";

                            $listrs = mysqli_query($conn, $listsql);?>

                    <?php /*<div class="f2">
                        <div class="vfilter">
                            <i class="material-icons ic1 <?php if (isset($_GET['grid'])) { echo "act"; }?>" title="Grid view">apps</i>
                            <i class="material-icons ic2 <?php if (isset($_GET['list'])) { echo "act"; }elseif (!isset($_GET['grid']) && !isset($_GET['list'])) { echo "act"; }?>" title="List view">format_list_bulleted</i>
                            <?php /*<i class="material-icons ic3" title="Map view">location_on</i>
                        </div>
                    </div>*/?>

                    <div class="ban-ati-com ads-all-list">
                        <?php
                        $ad_position_id = 2;   //Ad position on All Listing page Top
                        $ad_row = getAds($ad_position_id, 2, $category_id);
                        if($ad_row and $ad_row['ad_enquiry_photo'] != ""){
                            $ad_price_row = getAdsPrice($ad_row['all_ads_price_id']);
                            $price_size = $ad_price_row['ad_price_size'];
                            $price_size = str_replace(' X ', ' ', $price_size);
                            $price_size = str_replace(' px', '', $price_size);
                            $array_size = explode(' ', $price_size);
                            $width_size = $array_size[0];
                            $height_size = $array_size[1];
                            $ad_enquiry_photo = $ad_row['ad_enquiry_photo'];
                            ?>
                            <a href="<?php echo stripslashes($ad_row['ad_link']); ?>">
                                <span>Ad</span>
                                <img src="<?php echo $slash;?>images/ads/<?php echo $ad_enquiry_photo;?>" style="width: <?php echo $width_size;?>px; height: <?php echo $height_size;?>px; max-width: 100%">
                            </a>
                        <?php }?>
                    </div>
                    <?php if (mysqli_num_rows($listrs) > 0) {?>
                        <div class="ad-pgnat">
                            <ul class="pagination">
                                <?php
                                    $IncrimentNum =(($page +1)<=$TotalRegistro)?($page +1):1;
                                    $DecrementNum =(($page -1))<1?1:($page -1);

                                    $num_paginas_total = ceil($TotalRegistro/$limit);

                                    $Desde=$page-(ceil($CantidadMostrar/2)-1);
                                    $Hasta=$page+(ceil($CantidadMostrar/2)-1);
                                ?>
                                <?php if($page > 1){?>
                                    <li class="page-item prev"><a class="page-link" href="<?php echo '?page='.$DecrementNum?>"><?php echo $BIZBOOK['PREVIOUS'];?></a></li>
                                <?php }?>
                                <?php
                                    $Desde=($Desde<1)?1: $Desde;
                                    $Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
                                    //Se muestra los números de paginas
                                    for($i=$Desde; $i<=$Hasta;$i++){
                                       //Se valida la paginacion total
                                       //de registros
                                        if($i<=$TotalRegistro and $i <= $num_paginas_total){
                                        //Validamos la pag activo
                                            if($i==$page){
                                                echo "<li class=\"page-item active\"><a href=\"?page=".$i."\" class=\"page-link\">".$i."</a></li>";
                                            }else {
                                                echo "<li class=\"page-item\"><a href=\"?page=".$i."\" class=\"page-link\">".$i."</a></li>";
                                            }
                                        }
                                    }
                                ?>
                                <?php if(mysqli_num_rows($listrs)>=$limit){?>
                                    <li class="page-item next"><a class="page-link" href="<?php echo '?page='.$IncrimentNum;?>"><?php echo $BIZBOOK['NEXT'];?></a></li>
                                <?php }?>
                            </ul>
                        </div>
                    <?php }?>
                    <div class="all-list-sh all-listing-total">
                        <!--ADS-->

                        <!--ADS-->
                        <ul>


                            <?php if (mysqli_num_rows($listrs) > 0) {

                                while ($workofferrow = mysqli_fetch_array($listrs)) {

                                    $work_offer_code = $workofferrow['work_offer_code'];
                                    $listing_id = $workofferrow['work_offer_id'];
                                    $list_user_id = $workofferrow['user_id'];
                                    $category_work_offer_id = $workofferrow['category_id'];

                                    $category_a_row = getCategoryWokrOffer($category_work_offer_id);

                                    $usersqlrow = getUser($list_user_id); // To Fetch particular User Data


                                    $user_code = $usersqlrow['user_code'];

                                    // $star_rating_row = getListingReview($listing_id); // List Rating. for Rating of Star
                                    foreach (getListingReview($listing_id) as $star_rating_row) {
                                        if ($star_rating_row["rate_cnt"] > 0) {
                                            $star_rate_times = $star_rating_row["rate_cnt"];
                                            $star_sum_rates = $star_rating_row["total_rate"];
                                            $star_rate_one = $star_sum_rates / $star_rate_times;
                                            //$star_rate_one = (($Star_rate_value)/5)*100;
                                            $star_rate_two = number_format($star_rate_one, 1);
                                            $star_rate = floatval($star_rate_two);

                                        } else {
                                            $rate_times = 0;
                                            $rate_value = 0;
                                            $star_rate = 0;
                                        }
                                    }
                                    $listing_likes_total = getCountUserLikedListing($listing_id, $session_user_id); // To get count of likes

                                    if ($listing_likes_total >= 1) {
                                        $check_listing_likes_total = 0;
                                        $active_listing_likes = 'sav-act';
                                    } else {
                                        $check_listing_likes_total = 1;
                                        $active_listing_likes = '';
                                    }


                                    //Likes Query Ends
                                    ?>

                                    <li>
                                        <div class="eve-box">
                                            <!---LISTING IMAGE--->
                                            <div class="al-img">
                                                <a href="<?php echo $webpage_full_link; ?>oferta-trabajo/<?php echo $workofferrow['work_offer_slug']; ?>">
                                                    <img
                                                        src="<?php if ($category_a_row['category_image'] != NULL || !empty($category_a_row['category_image'])) {
                                                            echo $slash."images/services/" . $category_a_row['category_image'];
                                                        } else {
                                                            echo $slash."images/listing/hot4.jpg";
                                                        } ?>">
                                                </a>
                                                <div class="auth">
                                                    <?php
                                                    //To Check whether listing owner made profile is visible

                                                    $setting_profile_show = $usersqlrow['setting_profile_show'];
                                                    if ($setting_profile_show == 0) {

                                                        ?>
                                                        <img
                                                            src="<?php echo $slash;?>images/user/<?php if (($usersqlrow['profile_image'] == NULL) || empty($usersqlrow['profile_image'])) {
                                                                echo $footer_row['user_default_image'];
                                                            } else {
                                                                echo $usersqlrow['profile_image'];
                                                            } ?>" title="<?php echo $workofferrow['work_offer_name']; ?>" alt="<?php echo $workofferrow['work_offer_name']; ?>">
                                                        <b>Created by</b><br>
                                                        <h4><?php echo $usersqlrow['first_name']; ?></h4>
                                                        <a target="_blank"
                                                           href="<?php echo $webpage_full_link; ?>profesional/<?php echo $usersqlrow['user_slug']; ?>"
                                                           class="fclick"></a>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <!---END LISTING IMAGE--->

                                            <!---LISTING NAME--->
                                            <div>
                                                <h4>
                                                    <a href="<?php echo $webpage_full_link; ?>oferta-trabajo/<?php echo $workofferrow['work_offer_slug']; ?>"><?php echo $workofferrow['work_offer_name']; ?></a>
                                                </h4>

                                                <?php /*<span class="pho">
                                                    <?php
                                                        echo $usersqlrow['mobile_number'];
                                                        /*if ($workofferrow['listing_mobile'] != NULL || $usersqlrow['mobile_number'] != NULL) {

                                                        if ($list_user_id == 1) {
                                                            echo $workofferrow['listing_mobile'];
                                                        } else {
                                                            echo $usersqlrow['mobile_number'];
                                                        }
                                                        }
                                                    ?></span>
                                                    <span class="mail"><?php
                                                    if ($usersqlrow['email_id'] != NULL) {

                                                        echo $usersqlrow['email_id'];
                                                        ?>
                                                        <?php
                                                    }
                                                    ?>
                                                </span>*/?>

                                                <div class="links">
                                                    <?php /*<a href="#" data-toggle="modal" data-target="#quote<?php echo $listing_id ?>"><?php echo $BIZBOOK['GET_QOUTE'];?></a>*/?>
                                                    <?php /*<?php if ($session_user_id != NULL || !empty($session_user_id)) {
                                                        ?>
                                                        <a href="#" data-toggle="modal"
                                                            <?php
                                                            if ($list_user_id != 1) { ?>
                                                                data-target="#quote<?php echo $listing_id ?>"
                                                                <?php
                                                            }
                                                            ?>><?php echo $BIZBOOK['GET_QOUTE'];?></a>
                                                        <?php
                                                    } else { ?>
                                                        <a href="<?php echo $webpage_full_link; ?>login"><?php echo $BIZBOOK['GET_QOUTE'];?></a>
                                                        <?php
                                                    }
                                                    ?>*/?>
                                                    <a href="<?php echo $webpage_full_link; ?>oferta-trabajo/<?php echo $workofferrow['work_offer_slug']; ?>"><?php echo $BIZBOOK['VIEW_MORE'];?></a>

                                                    <span id="qvv<?php echo $workofferrow['work_offer_code']; ?>"
                                                          class="qvv qvv<?php echo $workofferrow['work_offer_code']; ?>"><?php echo $BIZBOOK['QUICK_VIEW'];?></span>
                                                </div>

                                            </div>
                                            <!---END LISTING NAME--->
                                        </div>

                                        <div id="list-qview<?php echo $workofferrow['work_offer_code']; ?>"
                                             class="list-qview list-qview<?php echo $workofferrow['work_offer_code']; ?>">
                                            <div class="eve-box">
                                                <div>
                                                        <span class="clo-list"><i
                                                                class="material-icons">close</i></span>
                                                    <a href="<?php echo $webpage_full_link; ?>oferta-trabajo/<?php echo $workofferrow['work_offer_slug']; ?>">
                                                        <img
                                                            src="<?php if ($category_a_row['category_image'] != NULL || !empty($category_a_row['category_image'])) {
                                                                echo $slash."images/services/" . $category_a_row['category_image'];
                                                            } else {
                                                                echo $slash."images/listings/hot4.jpg";
                                                            } ?>">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="abo" style="padding: 20px">
                                                <h4><b><?php echo $workofferrow['work_offer_name']; ?></b></h4>
                                                <?php echo $workofferrow['work_offer_description']; ?>
                                            </div>
                                            <div class="com share">

                                                <?php

                                                $fb_url = $webpage_full_link . "listing-details?src=facebook&&code=" . $workofferrow['work_offer_code'];  //URL Listing Detail  Facebook Link
                                                $fb_link = urlencode($fb_url);

                                                $twitter_url = $webpage_full_link . "listing-details?src=twitter&&code=" . $workofferrow['work_offer_code'];  //URL Listing Detail Twitter Link
                                                $twitter_link = urlencode($twitter_url);

                                                $linkedin_url = $webpage_full_link . "listing-details?src=linkedin&&code=" . $workofferrow['work_offer_code'];  //URL Listing Detail Linkedin Link
                                                $linkedin_link = urlencode($linkedin_url);

                                                $whatsapp_url = $webpage_full_link . "listing-details?src=whatsapp&&code=" . $workofferrow['work_offer_code'];  //URL Listing Detail Whatsapp Link
                                                $whatsapp_link = urlencode($whatsapp_url);

                                                ?>

                                                <h4><?php echo $BIZBOOK['SHARE_THIS_SERVICE'];?></h4>
                                                <ul>
                                                    <li>
                                                        <a target="_blank"
                                                           href="http://www.facebook.com/sharer/sharer.php?href=<?php echo $fb_link; ?>"><img
                                                                src="<?php echo $slash;?>images/social/3.png" title="<?php echo $workofferrow['work_offer_name']; ?>" alt="<?php echo $workofferrow['work_offer_name']; ?>"></a>
                                                    </li>
                                                    <li>
                                                        <a target="_blank"
                                                           href="http://twitter.com/share?text=<?php echo $workofferrow['work_offer_name']; ?>&url=<?php echo $twitter_link; ?>"><img
                                                                src="<?php echo $slash;?>images/social/2.png" title="<?php echo $workofferrow['work_offer_name']; ?>" alt="<?php echo $workofferrow['work_offer_name']; ?>"></a>
                                                    </li>
                                                    <li>
                                                        <a target="_blank"
                                                           href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $linkedin_link; ?>"><img
                                                                src="<?php echo $slash;?>images/social/1.png" title="<?php echo $workofferrow['work_offer_name']; ?>" alt="<?php echo $workofferrow['work_offer_name']; ?>"></a>
                                                    </li>
                                                    <li>
                                                        <a target="_blank" href="https://api.whatsapp.com/send?text=<?php echo $whatsapp_link; ?>"><img
                                                                src="<?php echo $slash;?>images/social/6.png" title="<?php echo $workofferrow['work_offer_name']; ?>" alt="<?php echo $workofferrow['work_offer_name']; ?>"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </li>


                                    <!--  Get Quote Pop up box starts  -->
                                    <?php /*<section>
                                        <div class="pop-ups pop-quo">
                                            <!-- The Modal -->
                                            <div class="modal fade" id="quote<?php echo $listing_id ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="log-bor">&nbsp;</div>
                                                        <span class="udb-inst"><?php echo $BIZBOOK['SEND_ENQUIRY'];?></span>
                                                        <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        <!-- Modal Header -->
                                                        <div class="quote-pop">
                                                            <h4><?php echo $BIZBOOK['GET_QOUTE'];?></h4>
                                                            <div id="enq_success<?php echo $listing_id ?>" class="log">
                                                                <p style="color: green; font-weight: bold"><?php echo $BIZBOOK['YOUT_ENQUIRY_SEND_SUCCESS'];?></p>
                                                            </div>
                                                            <div id="enq_fail<?php echo $listing_id ?>" class="log">
                                                                <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['SOMETHING_WENT_WRONG'];?></p>
                                                            </div>
                                                            <div id="enq_same<?php echo $listing_id ?>" class="log">
                                                                <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['YOU_CANNOT_MAKE_ENQUIRY'];?></p>
                                                            </div>
                                                            <div id="enq_name<?php echo $listing_id ?>" class="log">
                                                                <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['ENTER_NAME'];?></p>
                                                            </div>
                                                            <div id="enq_phone<?php echo $listing_id ?>" class="log">
                                                                <p style="color: red; font-weight: bold" ><?php echo $BIZBOOK['PHONE_NO_VALID'];?></p>
                                                            </div>
                                                            <div id="enq_email<?php echo $listing_id ?>" class="log">
                                                                <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['EMAIL_NO_VALID'];?></p>
                                                            </div>
                                                            <div id="enq_message<?php echo $listing_id ?>" class="log">
                                                                <p style="color: red; font-weight: bold"><?php echo $BIZBOOK['ENTER_MESSAGE'];?></p>
                                                            </div>
                                                            <form name="all_enquiry_form" id="all_enquiry_form<?php echo $listing_id ?>" method="post" enctype='multipart/form-data'>
                                                                <input type="hidden" class="form-control"
                                                                       name="listing_id"
                                                                       value="<?php echo $work_offer_code;?>"
                                                                       placeholder=""
                                                                       required="required">
                                                                <input type="hidden" class="form-control"
                                                                       name="listing_user_id"
                                                                       value="<?php echo $user_code; ?>"
                                                                       placeholder=""
                                                                       required="required">
                                                                <input type="hidden" class="form-control"
                                                                       name="enquiry_sender_id"
                                                                       value="<?php echo $session_user_id; ?>"
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
                                                                    <input type="text" name="enquiry_name"
                                                                           value=""
                                                                           required="required" class="form-control"
                                                                           placeholder="<?php echo $BIZBOOK['ENTER_NAME'];?>*">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="email" class="form-control"
                                                                           placeholder="<?php echo $BIZBOOK['ENTER_EMAIL'];?>*"
                                                                           value=""
                                                                           name="enquiry_email"
                                                                           pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                                                           title="<?php echo $BIZBOOK['INVALID_EMAIL'];?>" required="required">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="tel" class="form-control"
                                                                           value=""
                                                                           name="enquiry_mobile"
                                                                           placeholder="<?php echo $BIZBOOK['ENTER_MOBILE'];?> *"
                                                                           required="required">
                                                                </div>
                                                                <div class="form-group">
                                                                        <textarea class="form-control" rows="3"
                                                                                  name="enquiry_message"
                                                                                  placeholder="<?php echo $BIZBOOK['ENQUIRY_MESSAGE'];?>" required="required"></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Adjunta tu curriculum</label>
                                                                    <input type="file" name="work_offer_curri" class="form-control" accept=".pdf" multiple="multiple">
                                                                </div>
                                                                <div class="form-check" style="margin-bottom: 10px;">
                                                                    <input class="form-check-input" type="checkbox" value="politica-privacidad" name="politica_privacidad" id="politica-privacidad" required="required">
                                                                    <label class="form-check-label" for="politica-privacidad">He leido y acepto la <a href="#" data-toggle="modal" data-target="#consigueCitaPoliticaPrivacidadModal" title="política de privacidad">política de privacidad</a></label>
                                                                </div>
                                                                <input type="hidden" id="source">
                                                                <button type="submit" id="all_enquiry_submit" name="enquiry_submit" onclick="send_enquiry(<?php echo $listing_id ?>); return false;"
                                                                        class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </section>
                                    <!--  Get Quote Pop up box ends  -->
                                    */?>

                              <?php }?>



                            <?php } else { ?>
                                <span style="    font-size: 21px;
                                    color: #bfbfbf;
                                    letter-spacing: 1px;
                                    /* background: #525252; */
                                    text-shadow: 0px 0px 2px #fff;
                                    text-transform: uppercase;
                                    margin-top: 5%;"><?php echo $BIZBOOK['OOPS_NO_LISTING'];?></span>
                            <?php }?>
                        </ul>

                    </div>
                    <?php if (mysqli_num_rows($listrs) > 0) {?>
                        <div class="ad-pgnat">
                            <ul class="pagination">
                                <?php
                                    $IncrimentNum =(($page +1)<=$TotalRegistro)?($page +1):1;
                                    $DecrementNum =(($page -1))<1?1:($page -1);

                                    $num_paginas_total = ceil($TotalRegistro/$limit);

                                    $Desde=$page-(ceil($CantidadMostrar/2)-1);
                                    $Hasta=$page+(ceil($CantidadMostrar/2)-1);
                                ?>
                                <?php if($page > 1){?>
                                    <li class="page-item prev"><a class="page-link" href="<?php echo '?page='.$DecrementNum?>"><?php echo $BIZBOOK['PREVIOUS'];?></a></li>
                                <?php }?>
                                <?php
                                    $Desde=($Desde<1)?1: $Desde;
                                    $Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
                                    //Se muestra los números de paginas
                                    for($i=$Desde; $i<=$Hasta;$i++){
                                       //Se valida la paginacion total
                                       //de registros
                                       if($i<=$TotalRegistro and $i <= $num_paginas_total){
                                        //Validamos la pag activo
                                        if($i==$page){
                                            echo "<li class=\"page-item active\"><a href=\"?page=".$i."\" class=\"page-link\">".$i."</a></li>";
                                        }else {
                                            echo "<li class=\"page-item\"><a href=\"?page=".$i."\" class=\"page-link\">".$i."</a></li>";
                                        }
                                    }
                                }?>
                                <?php if(mysqli_num_rows($listrs)>=$limit){?>
                                    <li class="page-item next"><a class="page-link" href="<?php echo '?page='.$IncrimentNum;?>"><?php echo $BIZBOOK['NEXT'];?></a></li>
                                <?php }?>
                            </ul>
                        </div>
                    <?php }?>
                    <!--ADS-->
                    <div class="ban-ati-com ads-all-list">
                        <?php
                        $ad_position_id = 3;   //Ad position on All Listing page Bottom
                        $ad_row = getAds($ad_position_id, 2, $category_id);

                        if($ad_row and $ad_row['ad_enquiry_photo'] != ""){
                            $ad_price_row = getAdsPrice($ad_row['all_ads_price_id']);
                            $price_size = $ad_price_row['ad_price_size'];
                            $price_size = str_replace(' X ', ' ', $price_size);
                            $price_size = str_replace(' px', '', $price_size);
                            $array_size = explode(' ', $price_size);
                            $width_size = $array_size[0];
                            $height_size = $array_size[1];
                            $ad_enquiry_photo = $ad_row['ad_enquiry_photo'];
                            ?>
                            <a href="<?php echo stripslashes($ad_row['ad_link']); ?>">
                                <span>Ad</span>
                                <img src="<?php echo $slash;?>images/ads/<?php echo $ad_enquiry_photo;?>" style="width: <?php echo $width_size;?>px; height: <?php echo $height_size;?>px; max-width: 100%">
                            </a>
                        <?php }?>
                    </div>
                    <!--ADS-->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<!-- START -->
<?php /*<section>
    <div class="list-map">
        <?php
        include "listing-map-view.php";
        ?>
    </div>
</section>*/?>
<!-- END -->

<?php
include "footer.php";
?>

<!-- START -->
<section>
    <div class="str">
        <div class="container">
            <div class="row">
            </div>
        </div>
    </div>
</section>
<!-- END -->

<section>
    <div class="pop-ups">
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="list-pop">
                        <div class="img">
                            <img src="<?php echo $slash;?>images/services/2.jpg" title="<?php echo $workofferrow['work_offer_name']; ?>" alt="<?php echo $workofferrow['work_offer_name']; ?>">
                            <span>4.2</span>
                        </div>
                        <div class="tit">
                            <img src="<?php echo $slash;?>images/services/5.jpg" title="<?php echo $workofferrow['work_offer_name']; ?>" alt="<?php echo $workofferrow['work_offer_name']; ?>">
                            <h2>Lake Palace view Hotel</h2>
                            <p><b>Address:</b> 28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.</p>
                        </div>
                        <div class="addr">
                            <ul>
                                <li class="ic-pho">+91 98767 46546</li>
                                <li class="ic-eml">support@rn53themes@gmail.com</li>
                                <li class="ic-web">www.rn53themes.net</li>
                                <li class="ic-map">Direction</li>
                            </ul>
                        </div>
                        <div class="shar">
                            <span class="ic-sha"></span>
                            <span class="ic-lik"></span>
                        </div>
                        <div class="enq">
                            <span>Enquiry</span>
                            <a href="<?php echo $webpage_full_link; ?>listing-details">View more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--  Quick View box starts  -->
<!-- START -->
<?php
include "modal_politca_privacidad.php";
?>
<?php
include "modal_politca_privacidad_consigue_cita.php";
?>
<!-- END -->
<!--  Quick View box ends  -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo $slash;?>js/jquery.min.js"></script>
<script src="<?php echo $slash;?>js/popper.min.js"></script>
<script src="<?php echo $slash;?>js/bootstrap.min.js"></script>
<script src="<?php echo $slash;?>js/jquery-ui.js"></script>
<script src="<?php echo $slash;?>js/custom.js"></script>
<script src="<?php echo $slash;?>js/jquery.validate.min.js"></script>
<script src="<?php echo $slash;?>js/custom_validation.js"></script>
<script>
    <?php foreach (getAllWorkOffers() as $rowq){ ?>
    $('.qvv<?php echo $rowq['work_offer_code'] ?>').on('click', function () {
        $('.list-qview').removeClass('qview-show');
        $('.list-qview<?php echo $rowq['work_offer_code'] ?>').addClass('qview-show');
    });
    $('.list-qview<?php echo $rowq['work_offer_code'] ?>').on('mouseleave', function () {
        $('.list-qview<?php echo $rowq['work_offer_code'] ?>').removeClass('qview-show');
    });
    <?php
    }
    ?>
</script>
<?php /*<script>
    <?php
    if (isset($_GET['map'])) {
    ?>
    $(".all-list-bre, .all-listing").hide();
    $(".list-map").show();

    <?php
    }if (isset($_GET['grid'])) {
    ?>
    $(".list-map").hide();
    $(".all-list-bre, .all-listing").show();
    $('.all-list-sh').removeClass('cview3');
    $('.all-list-sh').addClass('cview1');

    <?php
    }if (isset($_GET['list'])) {
    ?>
    $(".list-map").hide();
    $(".all-list-bre, .all-listing").show();
    $('.all-list-sh').removeClass('cview1');
    $('.all-list-sh').removeClass('cview3');

    <?php
    }?>
</script>*/?>
<script>
    function SubcategoryFilter(val) {
        breadcrumbs(val);
        $(".sub_cat_section").css("opacity",0);
        $.ajax({
            type: "POST",
            url: "sub_category_filter.php",
            data: 'category_id=' + val,
            success: function (data) {
                if(data == null){
                    $(".sub_cat_section").remove();
                }else{
                    $(".sub_cat_section").html(data);
                    $(".sub_cat_section").css("opacity",1);
                }

            }
        });
    }
</script>

<script>
    function breadcrumbs(val) {
        $(".sec-all-list-bre").css("opacity", 0);
        $.ajax({
            type: "POST",
            url: "category_filter_breadcrumb.php",
            data: 'category_id=' + val,
            success: function (data) {
                if (data == null) {
                    $(".sec-all-list-bre").css("opacity", 1);
                } else {
                    $(".sec-all-list-bre").html(data);
                    $(".sec-all-list-bre").css("opacity", 1);
                }

            }
        });
    }

    var scr_he = window.innerHeight;
    var fiscr_he = scr_he;
    if(scr_he >= 450){
        $(".list-map-resu").css("height",fiscr_he);
    }
</script>
<script>
    function gethomeCities(val) {
        $.ajax({
            type: "POST",
            url: "<?php echo $slash;?>city_home_process.php",
            data: 'select-city=' + val,
            success: function (data) {
                $("#select-city").html(data);
                $('#select-city').trigger("chosen:updated");
            }
        });
    }
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.items').slick({
        dots: false,
        infinite: true,
        speed: 800,
        autoplay: false,
        autoplaySpeed: 2000,
        slidesToShow: 4,
        slidesToScroll: 4,
        prevArrow: "<button type='button' class='btn-color-slider-next btn-slider slick-next'>next</button>",
        nextArrow: "<button type='button' class='btn-color-slider-prev btn-slider slick-prev'>prev</button>",
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]
        });
    });
</script>
<?php /*<script type="text/javascript">
    function send_enquiry(id_listing) {

        console.log($("#all_enquiry_form"+id_listing).serialize());
        $.ajax({
            type: "POST",
            data: {listing_id: $('#listing_id').val(), listing_user_id:  $('#listing_user_id').val(), enquiry_sender_id:  $('#enquiry_sender_id').val(), enquiry_name:  $('#enquiry_name').val(), enquiry_email:  $('#enquiry_email').val(), enquiry_mobile:  $('#enquiry_mobile').val(), enquiry_message:  $('#enquiry_message').val(), work_offer_curri:  $('#work_offer_curri').val()},
            url: "<?php echo $slash;?>enquiry_work_offer_submit.php",
            cache: true,
            success: function (html) {
                if (html == 1) {
                    $("#enq_success"+id_listing).show();
                    $("#all_enquiry_form"+id_listing)[0].reset();
                } else {
                    if (html == 3) {
                        $("#enq_same"+id_listing).show();
                        $("#all_enquiry_form"+id_listing)[0].reset();
                    }else {
                        if (html == -4) {
                            $("#enq_name"+id_listing).show();
                            $("#all_enquiry_form"+id_listing)[0].reset();
                        }else{
                            if (html == -5) {
                                $("#enq_email"+id_listing).show();
                                $("#all_enquiry_form"+id_listing)[0].reset();
                            }else{
                                if (html == -6) {
                                    $("#enq_phone"+id_listing).show();
                                    $("#all_enquiry_form"+id_listing)[0].reset();
                                }else{
                                    if (html == -7) {
                                        $("#enq_message"+id_listing).show();
                                        $("#all_enquiry_form"+id_listing)[0].reset();
                                    }else{
                                        $("#enq_fail"+id_listing).show();
                                        $("#all_enquiry_form"+id_listing)[0].reset();
                                    }
                                }
                            }
                        }
                    }
                }

            }

        });
    }
</script>*/?>
<?php if(!empty($_SESSION['user_name'])){?>
    <script type="text/javascript">
        //All Listing Page LIKE ANIMATION
        $(".enq-sav i").click(function () {

            var listing_id = $(this).attr('data-id');
            var user_id = $(this).attr('data-item');
            var listing_user_id = $(this).attr('data-num');
            var like_status = $(this).attr('data-section');
            var total_likes = $(this).attr('data-for');

            if (user_id) {  //Check Current User is Null Means redirect to login page
                if (listing_user_id == user_id) {  //Check Listing Owner and Current User is Same
                    alert("Eres el propietario de esta ficha");
                } else {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $slash; ?>/save_to_wishlist.php',
                        cache: false,
                        data: {listing: listing_id, listing_user: listing_user_id, user: user_id, status: like_status},
                        success: function (response) {
                            $(".Animatedheartfunc" + listing_id).toggleClass('sav-act');
                            if (response == 1) {

                                var total_likes1 = parseInt(total_likes) + 1;

                                $(".Animatedheartfunc" + listing_id).attr("data-for", total_likes1); //setter
                                $(".like-content" + listing_id).html(total_likes1 + " Likes");
                            } else {
                                var total_likes1 = parseInt(total_likes) - 1;
                                if (total_likes1 == -1) {
                                    var total_likes2 = 0;
                                } else {
                                    var total_likes2 = total_likes1;
                                }

                                $(".Animatedheartfunc" + listing_id).attr("data-for", total_likes2); //setter

                                $(".like-content" + listing_id).html(total_likes2 + " Likes");
                            }


                            //$(".enq-sav i").toggleClass('sav-act');
                        }
                    });
                }
            } else {
                window.location.href = host+dir+"/login.php";
            }

        });
    </script>
<?php }?>
</body>

</html>