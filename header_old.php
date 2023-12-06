<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if (file_exists('functions.php')) {
    include('functions.php');
}

$current_page = basename($_SERVER['PHP_SELF']);
$footer_row = getAllFooter(); //Fetch Footer Data

$admin_row = getAllSuperAdmin(); //Fetch Admin Data

$data_array['website_email_id'] = $footer_row['admin_primary_email'];
$data_array['admin_user_name'] = $admin_row['admin_email'];
$data_array['admin_user_password'] = $admin_row['admin_password'];

$all_texts_row = getAllTexts(); //Fetch All Text Data

if (isset($_SESSION['user_id'])) {

    $user_details_row = getUser($_SESSION['user_id']); //Fetch Logged In user data
    $user_plan = $user_details_row['user_plan']; //Fetch of Logged In user Plan

    $user_plan_type = getPlanType($user_plan); //Fetch Logged In User Plan details and data
}

$slash = $webpage_full_link;

if ($current_page == "listing-details.php") {

    if ($_GET['code'] == NULL && empty($_GET['code'])) {
        header("Location: all-listing");
    }
    //$listing_codea1 = str_replace('-', ' ', $_GET['code']);
    $listing_codea = str_replace('.php', '', $_GET['code']);

    $listrow = getSlugListing($listing_codea); //To Fetch the listing
}

if ($current_page == "event-details.php") {


    if ($_GET['row'] == NULL && empty($_GET['row'])) {

        header("Location: events");
    }

    $event_codea1 = str_replace('-', ' ', $_GET['row']);
    $event_codea = str_replace('.php', '', $event_codea1);

    $events_a_row = getSlugEvent($event_codea); //To Fetch the Events

}

if ($current_page == "blog-details.php") {

    if ($_GET['row'] == NULL && empty($_GET['row'])) {

        header("Location: blog-posts");
    }

    $blog_codea1 = str_replace('-', ' ', $_GET['row']);
    $blog_codea = str_replace('.php', '', $blog_codea1);
    $blogs_a_row = getSlugBlog($blog_codea); //To Fetch the Blogs

}

if ($current_page == "product-details.php") {

    if ($_GET['code'] == NULL && empty($_GET['code'])) {

        header("Location: all-products");
    }

    $product_codea1 = str_replace('-', ' ', $_GET['code']);
    $product_codea = str_replace('.php', '', $product_codea1);
    $productrow = getSlugProduct($product_codea); //To Fetch the product

}

?>
<?php
    header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="es">

<head>
    <?php if ($current_page != "listing-details.php" || $current_page != "event-details.php" || $current_page != "blog-details.php" || $current_page != "product-details.php") { ?>
        <title><?php
            if($current_page == "listing-details.php") {
                if (!empty($listrow['seo_title']) || $listrow['seo_title'] != NULL) {
                    echo ucfirst(strtolower($listrow['seo_title']))." - Oficina de profesionales";
                }else{
                    echo ucfirst(strtolower($listrow['listing_name']))." - Oficina de profesionales";
                }
            }elseif($current_page == "event-details.php") {

                if (!empty($events_a_row['seo_title']) || $events_a_row['seo_title'] != NULL) {
                    echo ucfirst(strtolower($events_a_row['seo_title']))." - Oficina de profesionales";
                }else{
                    echo ucfirst(strtolower($events_a_row['event_name']))." - Oficina de profesionales";
                }
            }elseif($current_page == "blog-details.php") {

                if (!empty($blogs_a_row['seo_title']) || $blogs_a_row['seo_title'] != NULL) {
                    echo ucfirst(strtolower($blogs_a_row['seo_title']))." - Oficina de profesionales";
                }else{
                    echo ucfirst(strtolower($blogs_a_row['blog_name']))." - Oficina de profesionales";
                }
            }elseif($current_page == "product-details.php") {
                if (!empty($productrow['seo_title']) || $productrow['seo_title'] != NULL) {
                    echo ucfirst(strtolower($productrow['seo_title']))." - Oficina de profesionales";
                }else{
                    echo ucfirst(strtolower($productrow['product_name']))." - Oficina de profesionales";
                }
            }else {
                if(strpos($_SERVER['REQUEST_URI'],'anuncios')){
                    $values = explode("/", $_SERVER['REQUEST_URI']);
                    $select_cate = $values[2];
                    $select_city = $values[3];

                    $search_query_city = "";
                    
                    if(!empty($select_cate) or !empty($select_city)){
                        $city_seo = "";
                        $category_seo = "";
                        if(!empty($select_cate)){
                            $category_sql = "SELECT * FROM  " . TBL . "categories where category_slug='" . $select_cate . "'";
                            $category_rs = mysqli_query($conn, $category_sql);
                            $category_row = mysqli_fetch_array($category_rs);
                            $category_seo = ucfirst(strtolower($category_row['category_name']));
                        }

                        if(!empty($select_city)){
                            $city_sql = "SELECT * FROM  " . TBL . "cities where city_slug='" . $select_city . "'";
                            $city_rs = mysqli_query($conn, $city_sql);
                            $city_row = mysqli_fetch_array($city_rs);
                            $city_seo = " en ".$city_row['city_name'];
                        }
                        echo $category_seo.$city_seo." - Oficina de profesionales";
                    }else{
                        $footer_row['admin_seo_title'];
                    }
                  }else{
                    echo $footer_row['admin_seo_title'];
                  }
            } ?></title>
        <!--== META TAGS ==-->
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
        <meta name="theme-color" content="#76cef1"/>
        <meta name="description"
              content="<?php if (!empty($listrow['seo_description']) || $listrow['seo_description'] != NULL) {
                  echo $listrow['seo_description'];
              } elseif(!empty($events_a_row['seo_description']) || $events_a_row['seo_description'] !=NULL){
                  echo $events_a_row['seo_description'];
              } elseif(!empty($blogs_a_row['seo_description']) || $blogs_a_row['seo_description'] !=NULL){
                  echo $blogs_a_row['seo_description'];
              } elseif(!empty($productrow['seo_description']) || $productrow['seo_description'] !=NULL){
                  echo $productrow['seo_description'];
              } else {
                  if(strpos($_SERVER['REQUEST_URI'],'anuncios')){
                    $values = explode("/", $_SERVER['REQUEST_URI']);
                    $select_cate = $values[2];
                    $select_city = $values[3];

                    $search_query_city = "";
                    
                    if($select_cate != "" or $select_city != ""){
                        $city_seo = "";
                        $category_seo = "";
                        if($select_cate != ""){
                            $category_sql = "SELECT * FROM  " . TBL . "categories where category_slug='" . $select_cate . "'";
                            $category_rs = mysqli_query($conn, $category_sql);
                            $category_row = mysqli_fetch_array($category_rs);
                            $category_seo = "de ".strtolower($category_row['category_name']);
                        }

                        if($select_city != ""){
                            $city_sql = "SELECT * FROM  " . TBL . "cities where city_slug='" . $select_city . "'";
                            $city_rs = mysqli_query($conn, $city_sql);
                            $city_row = mysqli_fetch_array($city_rs);
                            $city_seo = " en ".$city_row['city_name'];
                        }
                        echo "Empresas ".$category_seo.$city_seo." en Oficina de profesionales. Toda la información de negocios y empresas relacionados con ".strtolower($category_row['category_name']);
                    
                        
                    }else{
                        echo $footer_row['admin_seo_description'];
                    }
                  }else{
                    echo $footer_row['admin_seo_description'];
                  }
              } ?>"/>
        <?php /*<meta name="keyword"
              content="<?php if (!empty($listrow['seo_keywords']) || $listrow['seo_keywords'] != NULL) {
                  echo $listrow['seo_keywords'];
              }elseif(!empty($events_a_row['seo_keywords']) || $events_a_row['seo_keywords'] !=NULL){
                  echo $events_a_row['seo_keywords'];
              }elseif(!empty($blogs_a_row['seo_keywords']) || $blogs_a_row['seo_keywords'] !=NULL){
                  echo $blogs_a_row['seo_keywords'];
              }elseif(!empty($productrow['seo_keywords']) || $productrow['seo_keywords'] !=NULL){
                  echo $productrow['seo_keywords'];
              }
              else {
                  echo $footer_row['admin_seo_keywords'];
              } ?>"/>*/?>
        <?php
    }
    ?>
    <!--== FAV ICON(BROWSER TAB ICON) ==-->
    <link rel="shortcut icon" href="<?php echo $slash; ?>images/<?php echo $footer_row['home_page_fav_icon']; ?>" type="image/x-icon"/>
    <!--== GOOGLE FONTS ==-->
    <link href="https://fonts.googleapis.com/css?family=Oswald:700|Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet"/>
    <!--== CSS FILES ==-->
    <link rel="stylesheet" href="<?php echo $slash; ?>css/jquery-ui.css"/>
    <link rel="stylesheet" href="<?php echo $slash; ?>css/bootstrap.css"/>
    <link rel="stylesheet" href="<?php echo $slash; ?>css/style.css"/>
    <link rel="stylesheet" href="<?php echo $slash; ?>css/fonts.css"/>
    <?php /*<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />*/?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo $slash; ?>js/html5shiv.js"></script>
    <script src="<?php echo $slash; ?>js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>

<!-- START -->
<section>
    <div class="str">
        <div <?php if ($current_page == "index.php"  || $current_page == "all-category.php") { ?> class="hom-head" style=" background-image: url(images/<?php echo $footer_row['home_page_banner']; ?>);" <?php } ?>>
            <div class="hom-top">
                <div class="container">
                    <div class="row">
                        <div class="hom-nav <?php if (!isset($_SESSION['user_name']) && empty($_SESSION['user_name'])) {
                        } else { ?> db-open <?php } ?>"><!--MOBILE MENU-->
                            <div class="menu">
                                <i class="material-icons mopen">menu</i>
                            </div>
                            <div class="pop-menu">
                                <div class="container">
                                    <div class="row">
                                        <i class="material-icons clopme">close</i>
                                        <div class="pmenu-sear">
                                            <form>
                                                <input type="text" id="search" placeholder="Search for services and business..." class="ui-autocomplete-input">
                                            </form>
                                        </div>
                                        <div class="pmenu-cat">
                                            <h4><?php echo $BIZBOOK['ALL_CATEGORIES']; ?></h4>
                                            <input type="text" id="pg-sear" placeholder="<?php echo $BIZBOOK['SEARCH_CATEGORY'];?>">
                                            <ul id="pg-resu">
                                                <?php
                                                foreach (getAllCategories() as $category_row) {

                                                    ?>
                                                    <li><a href="<?php echo $webpage_full_link; ?>anuncios/<?php echo $category_row['category_slug']; ?>"><?php echo $category_row['category_name']; ?></a></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="pmenu-eve">
                                            <ul>
                                                <li>
                                                    <div class="pm-box">
                                                        <h4><?php echo $BIZBOOK['ALLSERVICES']; ?></h4>
                                                        <p><?php echo $BIZBOOK['MENU-SER-ALL']; ?></p>
                                                        <a href="<?php echo $webpage_full_link; ?>todas-categorias" class="fclick">&nbsp;</a>
                                                    </div>
                                                </li>
                                                <?php /*<li>
                                                    <div class="pm-box">
                                                        <h4><?php echo $BIZBOOK['PRODUCTS']; ?></h4>
                                                        <p><?php echo $BIZBOOK['MENU-PRO-PERA']; ?></p>
                                                        <a href="<?php echo $webpage_full_link; ?>all-products" class="fclick">&nbsp;</a>
                                                    </div>
                                                </li>*/?>
                                                <li>
                                                    <div class="pm-box">
                                                        <h4><?php echo $BIZBOOK['EVENTS']; ?></h4>
                                                        <p><?php echo $BIZBOOK['MENU-EVE-PERA']; ?></p>
                                                        <a href="<?php echo $webpage_full_link; ?>eventos" class="fclick">&nbsp;</a>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="pm-box">
                                                        <h4><?php echo $BIZBOOK['BLOG_POSTS']; ?></h4>
                                                        <p><?php echo $BIZBOOK['MENU-BLO-PERA']; ?></p>
                                                        <a href="<?php echo $webpage_full_link; ?>blog-posts" class="fclick">&nbsp;</a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="pm-box">
                                                        <h4><?php echo $BIZBOOK['4K+_USERS']; ?></h4>
                                                        <p><?php echo $BIZBOOK['MENU-COMM-PERA']; ?></p>
                                                        <a href="<?php echo $webpage_full_link; ?>community" class="fclick">&nbsp;</a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="pm-box">
                                                        <h4><?php echo $BIZBOOK['POST_ADS']; ?></h4>
                                                        <p><?php echo $BIZBOOK['MENU-ADS-PERA']; ?></p>
                                                        <a href="<?php
                                                        if (!isset($_SESSION['user_name']) && empty($_SESSION['user_name'])) {
                                                            ?><?php echo $webpage_full_link; ?>login <?php } else { ?> <?php echo $webpage_full_link; ?>add-listing-start <?php } ?>" class="fclick">&nbsp;</a>
                                                    </div>
                                                </li>
                                                <?php /*<li>
                                                    <div class="pm-box">
                                                        <h4><?php echo $BIZBOOK['ADD_LISTING']; ?></h4>
                                                        <p><?php echo $BIZBOOK['MENU-ADD-LIS-PERA']; ?></p>
                                                        <a href="<?php
                                                        if (!isset($_SESSION['user_name']) && empty($_SESSION['user_name'])) {
                                                            ?><?php echo $webpage_full_link; ?>login <?php } else { ?> <?php echo $webpage_full_link; ?>add-listing-start <?php } ?>" class="fclick">&nbsp;</a>
                                                    </div>
                                                </li>*/?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END MOBILE MENU-->
                            <a href="<?php echo $webpage_full_link; ?>" class="top-log"><img src="<?php echo $slash; ?>images/home/<?php echo $footer_row['header_logo']; ?>" alt="" class="ic-logo"></a>
                            <div class="top-ser">
                                <form name="filter_form" id="filter_form" class="filter_form">
                                    <ul>
                                        <li class="sr-sea">
                                            <input type="text" id="<?php 
                                            if ($current_page == "profile.php" || $current_page == "event-details.php" || $current_page == "blog-details.php" || $current_page == "product-details.php" || $current_page == "listing-details.php") {
                                            echo "top-select-search-new";
                                            }else{
                                            echo "top-select-search";}?>" class="autocomplete" placeholder="<?php echo $BIZBOOK['SEARCHBOX_LABEL'];?>">
                                        </li>
                                        <li class="sbtn">
                                            <button type="button" class="btn btn-success" id="top_filter_submit"><i class="material-icons">search</i></button>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                            <?php
                            if (!isset($_SESSION['user_name']) && empty($_SESSION['user_name'])) {
                                ?>
                                <ul class="bl">
                                    <?php /*<li><a href="<?php echo $webpage_full_link; ?>pricing-details"><?php echo $BIZBOOK['ADD_BUSINESS']; ?></a></li>*/?>
                                    <li><a href="<?php echo $webpage_full_link; ?>login"><?php echo $BIZBOOK['SIGN_IN']; ?></a></li>
                                    <li><a href="<?php echo $webpage_full_link; ?>login?login=register"><?php echo $BIZBOOK['CREATE_AN_ACCOUNT']; ?></a></li>
                                </ul>
                                <?php
                            } else {
                                ?>
                                <div class="al">
                                    <div class="head-pro">
                                        <img
                                            src="<?php echo $slash; ?>images/user/<?php if (($user_details_row['profile_image'] == NULL) || empty($user_details_row['profile_image'])) {
                                                echo $footer_row['user_default_image'];
                                            } else {
                                                echo $user_details_row['profile_image'];
                                            } ?>" alt="">
                                        <b><?php echo $BIZBOOK['PROFILE_BY']; ?></b><br>
                                        <h4><?php echo $user_details_row['first_name']; ?></h4>
                                        <a href="<?php echo $webpage_full_link; ?>dashboard" class="fclick"></a>
                                    </div>
                                    <div class="db-menu">
                                        <ul>
                                            <li>
                                            <li>
                                                <a href="<?php echo $webpage_full_link; ?>dashboard" class="db-lact"><img src="<?php echo $slash; ?>images/icon/dbl1.png"
                                                                                         alt=""/> <?php echo $BIZBOOK['MY_DASHBOARD']; ?></a>
                                            </li>
                                            <?php
                                            if ($user_details_row['user_type'] == "Service provider") {  //To Check User type is Service provider
                                                ?>
                                                <li>
                                                    <a href="<?php echo $webpage_full_link; ?>db-all-listing"><img src="<?php echo $slash; ?>images/icon/dbl7.png" alt=""/>
                                                        <?php echo $BIZBOOK['ALL_LISTING']; ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $webpage_full_link; ?>add-listing-start" class="tz-lma"><img src="<?php echo $slash; ?>images/icon/dbl3.png" alt=""/> <?php echo $BIZBOOK['ADD_NEW_LISTING']; ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $webpage_full_link; ?>db-enquiry"><img src="<?php echo $slash; ?>images/icon/dbl14.png" alt=""/><?php echo $BIZBOOK['LEAD_ENQUIRY']; ?></a>
                                                </li>
                                                <?php /*<li>
                                                    <a href="<?php echo $webpage_full_link; ?>db-events"><img src="<?php echo $slash; ?>images/icon/dbl4.png" alt=""/><?php echo $BIZBOOK['EVENTS']; ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $webpage_full_link; ?>db-blog-posts"><img src="<?php echo $slash; ?>images/icon/dbl10.png" alt=""/><?php echo $BIZBOOK['BLOG_POSTS']; ?></a>
                                                </li>*/?>
                                                <?php
                                            }
                                            ?>
                                            <li>
                                                <a href="<?php echo $webpage_full_link; ?>db-review"><img src="<?php echo $slash; ?>images/icon/dbl13.png" alt=""/><?php echo $BIZBOOK['REVIEWS']; ?></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $webpage_full_link; ?>db-my-profile"><img src="<?php echo $slash; ?>images/icon/dbl6.png" alt=""/> <?php echo $BIZBOOK['MY_PROFILE']; ?></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $webpage_full_link; ?>logout"><img src="<?php echo $slash; ?>images/icon/dbl12.png" alt=""/> <?php echo $BIZBOOK['LOG_OUT']; ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <!--MOBILE MENU-->
                            <div class="mob-menu">
                                <div class="mob-me-ic"><i class="material-icons">menu</i></div>
                                <div class="mob-me-all">
                                    <div class="mob-me-clo"><i class="material-icons">close</i></div>
                                    <?php
                                    if (!isset($_SESSION['user_name']) && empty($_SESSION['user_name'])) {
                                        ?>
                                        <div class="mv-bus">
                                            <h4></h4>
                                            <ul>
                                                <li><a href="<?php echo $webpage_full_link; ?>pricing-details"><?php echo $BIZBOOK['ADD_BUSINESS']; ?></a></li>
                                                <li><a href="<?php echo $webpage_full_link; ?>login"><?php echo $BIZBOOK['SIGN_IN']; ?></a></li>
                                                <li><a href="<?php echo $webpage_full_link; ?>login?login=register"><?php echo $BIZBOOK['CREATE_AN_ACCOUNT']; ?></a></li>
                                            </ul>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="mv-pro ud-lhs-s1">
                                            <div class="row">
                                                <div class="col-md-11 col-sm-10 col-9">
                                                    <div class="row">
                                                        <div class="col-md-1 col-sm-2 col-3">
                                                            <img
                                                                src="<?php echo $slash; ?>images/user/<?php if (($user_details_row['profile_image'] == NULL) || empty($user_details_row['profile_image'])) {
                                                                    echo $footer_row['user_default_image'];
                                                                } else {
                                                                    echo $user_details_row['profile_image'];
                                                                } ?>" title="<?php echo $user_details_row['first_name']; ?>" alt="<?php echo $user_details_row['first_name']; ?>">
                                                        </div>
                                                        <div class="col-md-11 col-sm-10 col-9">
                                                            <h4><?php echo $user_details_row['first_name']; ?> </h4>
                                                            <b><?php echo $BIZBOOK['JOIN_ON']; ?> <?php echo dateFormatconverter($user_details_row['user_cdt']) ?></b>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-1 col-sm-2 col-3">
                                                    <span class="mv-menu-client"><i class="material-icons">menu</i></span>
                                                </div>
                                            </div>
                                        
                                        </div>
                                        <div class="mv-pro-menu ud-lhs-s2">
                                            <ul>
                                                <li>
                                                    <a href="<?php echo $webpage_full_link; ?>dashboard" class="db-lact"><img src="<?php echo $slash; ?>images/icon/dbl1.png" title="<?php echo $BIZBOOK['MY_DASHBOARD']; ?>" alt="<?php echo $BIZBOOK['MY_DASHBOARD']; ?>"/> <?php echo $BIZBOOK['MY_DASHBOARD']; ?></a>
                                                </li>
                                                <?php
                                                if ($user_details_row['user_type'] == "Service provider") {  //To Check User type is Service provider
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $webpage_full_link; ?>db-all-listing"><img src="<?php echo $slash; ?>images/icon/dbl7.png" title="<?php echo $BIZBOOK['ALL_LISTING']; ?>" alt="<?php echo $BIZBOOK['ALL_LISTING']; ?>"/><?php echo $BIZBOOK['ALL_LISTING']; ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo $webpage_full_link; ?>add-listing-start" class="tz-lma"><img src="<?php echo $slash; ?>images/icon/dbl3.png" title="<?php echo $BIZBOOK['ADD_NEW_LISTING']; ?>" alt="<?php echo $BIZBOOK['ADD_NEW_LISTING']; ?>"/> <?php echo $BIZBOOK['ADD_NEW_LISTING']; ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo $webpage_full_link; ?>db-claims"><img src="<?php echo $slash; ?>images/icon/dbl14.png" title="<?php echo $BIZBOOK['LEAD_CLAIMS']; ?>" alt="<?php echo $BIZBOOK['LEAD_CLAIMS']; ?>"/> <?php echo $BIZBOOK['LEAD_CLAIMS']; ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo $webpage_full_link; ?>db-enquiry"><img src="<?php echo $slash; ?>images/icon/dbl14.png" title="<?php echo $BIZBOOK['LEAD_ENQUIRY']; ?>" alt="<?php echo $BIZBOOK['LEAD_ENQUIRY']; ?>"/> <?php echo $BIZBOOK['LEAD_ENQUIRY']; ?></a>
                                                    </li>
                                                    <?php /*<li>
                                                        <a href="<?php echo $webpage_full_link; ?>db-events"><img src="<?php echo $slash; ?>images/icon/dbl4.png" title="<?php echo $BIZBOOK['EVENTS']; ?>" alt="<?php echo $BIZBOOK['EVENTS']; ?>"/><?php echo $BIZBOOK['EVENTS']; ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo $webpage_full_link; ?>db-blog-posts"><img src="<?php echo $slash; ?>images/icon/dbl10.png" title="<?php echo $BIZBOOK['BLOG_POSTS']; ?>" alt="<?php echo $BIZBOOK['BLOG_POSTS']; ?>"/><?php echo $BIZBOOK['BLOG_POSTS']; ?></a>
                                                    </li>*/?>
                                                    <?php
                                                }
                                                ?>
                                                <li>
                                                    <a href="<?php echo $webpage_full_link; ?>db-review"><img src="<?php echo $slash; ?>images/icon/dbl13.png" title="<?php echo $BIZBOOK['REVIEWS']; ?>" alt="<?php echo $BIZBOOK['REVIEWS']; ?>"/><?php echo $BIZBOOK['REVIEWS']; ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $webpage_full_link; ?>db-my-profile"><img src="<?php echo $slash; ?>images/icon/dbl6.png" title="<?php echo $BIZBOOK['MY_PROFILE']; ?>" alt="<?php echo $BIZBOOK['MY_PROFILE']; ?>"/><?php echo $BIZBOOK['MY_PROFILE']; ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $webpage_full_link; ?>db-like-listings"><img src="<?php echo $slash; ?>images/icon/dbl15.png" title="<?php echo $BIZBOOK['LIKED_LISTINGS']; ?>" alt="<?php echo $BIZBOOK['LIKED_LISTINGS']; ?>"><?php echo $BIZBOOK['LIKED_LISTINGS']; ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $webpage_full_link; ?>db-followings"><img src="<?php echo $slash; ?>images/icon/dbl18.png" title="<?php echo $BIZBOOK['PROFESSIONALS_FOLLOWS']; ?>" alt="<?php echo $BIZBOOK['PROFESSIONALS_FOLLOWS']; ?>"><?php echo $BIZBOOK['PROFESSIONALS_FOLLOWS']; ?></a>
                                                </li>
                                                <?php
                                                if ($user_details_row['user_type'] == "Service provider") {  //To Check User type is Service provider
                                                    ?>
                                                    <?php /*<li>
                                                        <a href="<?php echo $webpage_full_link; ?>db-post-ads"><img src="<?php echo $slash; ?>images/icon/dbl11.png" title="<?php echo $BIZBOOK['AD_SUMMARY']; ?>" alt="<?php echo $BIZBOOK['AD_SUMMARY']; ?>"><?php echo $BIZBOOK['AD_SUMMARY']; ?></a>
                                                    </li>*/?>
                                                    <?php /*<li>
                                                        <a href="<?php echo $webpage_full_link; ?>db-payment"><img src="<?php echo $slash; ?>images/icon/dbl9.png" title="<?php echo $BIZBOOK['CHECK_OUT']; ?>" alt="<?php echo $BIZBOOK['CHECK_OUT']; ?>"><?php echo $BIZBOOK['CHECK_OUT']; ?></a>
                                                    </li>*/?>
                                                    <li>
                                                        <a href="<?php echo $webpage_full_link; ?>db-invoice-all"><img src="<?php echo $slash; ?>images/icon/dbl16.png" title="<?php echo $BIZBOOK['PAYMENT_INVOICE']; ?>" alt="<?php echo $BIZBOOK['PAYMENT_INVOICE']; ?>"><?php echo $BIZBOOK['PAYMENT_INVOICE']; ?></a>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                                <?php /*<li>
                                                    <a href="<?php echo $webpage_full_link; ?>db-notifications"><img src="<?php echo $slash; ?>images/icon/dbl19.png" title="<?php echo $BIZBOOK['NOTIFICATIONS']; ?>" alt="<?php echo $BIZBOOK['NOTIFICATIONS']; ?>"> <?php echo $BIZBOOK['NOTIFICATIONS']; ?></a>
                                                </li>*/?>
                                                <li>
                                                    <a href="<?php echo $webpage_full_link; ?>how-to" target="_blank"><img src="<?php echo $slash; ?>images/icon/dbl17.png" title="<?php echo $BIZBOOK['HOW_TOS']; ?>" alt="<?php echo $BIZBOOK['HOW_TOS']; ?>"> <?php echo $BIZBOOK['HOW_TOS']; ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $webpage_full_link; ?>db-setting"><img src="<?php echo $slash; ?>images/icon/dbl210.png" title="<?php echo $BIZBOOK['SETTING']; ?>" alt="<?php echo $BIZBOOK['SETTING']; ?>"><?php echo $BIZBOOK['SETTING']; ?></a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $webpage_full_link; ?>logout"><img src="<?php echo $slash; ?>images/icon/dbl12.png" title="<?php echo $BIZBOOK['LOG_OUT']; ?>" alt="<?php echo $BIZBOOK['LOG_OUT']; ?>"> <?php echo $BIZBOOK['LOG_OUT']; ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="mv-cate">
                                        <h4><?php echo $BIZBOOK['ALL_CATEGORIES']; ?></h4>
                                        <ul>
                                            <?php foreach (getAllCategories() as $row) { ?>
                                                <li>
                                                    <a href="<?php echo $webpage_full_link; ?>anuncios/<?php echo $row['category_slug']; ?>"><?php echo $row['category_name']; ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--END MOBILE MENU-->
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($current_page == "index.php" || $current_page == "all-category.php") { ?>
                <div class="container">
                    <div class="row">
                        <div class="ban-tit">
                            <h1>
                                <?php if ($current_page == "all-category.php") { ?>
                                    <b><?php echo $BIZBOOK['HOM-BAN-TIT'];?></b>
                                <?php }else{ ?>
                                    <b><?php echo $BIZBOOK['HOM-BAN-TIT']; ?></b> <span><?php echo $BIZBOOK['HOM-BAN-SUB-TIT']; ?></span>
                                <?php }?>
                            </h1>
                        </div>
                        <div class="ban-search">
                            <form name="filter_form" id="filter_form" class="filter_form">
                                <ul>
                                    <li class="sr-cat">
                                        <select <?php /*onChange="getSubCategory(this.value);"*/?> name="select-cate" id="select-cate" class="form-control">
                                            <option value=""><?php echo $BIZBOOK['SELECT_CATEGORY'];?></option>
                                            <?php
                                            foreach (getAllCategories() as $categories_row) {
                                                ?>
                                                <option
                                                    value="<?php echo $categories_row['category_slug']; ?>"><?php echo $categories_row['category_name']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </li>
                                    <li class="sr-reg">
                                        <select onChange="gethomeCities(this.value);" name="select-state" id="select-state"
                                                class="form-control">
                                            <option value=""><?php echo $BIZBOOK['SELECT_YOUR_STATE']?></option>
                                            <?php
                                            //Countries Query
                                            //                                            $admin_countries = $footer_row['admin_countries'];
                                            //                                            $catArray = explode(',', $admin_countries);
                                            //                                            foreach($catArray as $cat_Array) {

                                            foreach (getAllStates(1) as $state_row) {
                                                ?>
                                                <option <?php if ($_SESSION['state_slug'] == $state_row['state_slug']) {
                                                    echo "selected";
                                                } ?>
                                                    value="<?php echo $state_row['state_slug']; ?>"><?php echo $state_row['state_name']; ?></option>
                                                <?php
                                            }
                                            //                                            }
                                            ?>
                                        </select>
                                        <?php /*<input type="text" id="select-citye" name="select-city" class="autocomplete" placeholder="Region">*/?>
                                    </li>
                                    <li class="sr-reg-sub">
                                        <select data-placeholder="Subregion" name="select-city" id="select-city"
                                                class="form-control">
                                            <option value=""><?php echo $BIZBOOK['SELECT_YOUR_CITY']; ?></option>
                                        </select>
                                        <?php /*<input type="text" id="select-reg-sub" name="select-reg-sub" class="autocomplete" placeholder="Subregion">*/?>
                                    </li>
                                    <li class="sr-btn">
                                        <button type="button" id="filter_submit" name="filter_submit" class="filter_submit"><?php echo $BIZBOOK['SEARCH']; ?></button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                        <div class="ban-ql">
                            <ul>
                                <li>
                                    <div>
                                        <img src="<?php echo $slash; ?>images/icon/listing.png" title="<?php echo $BIZBOOK['ALL_SERVICES']; ?>" alt="<?php echo $BIZBOOK['ALL_SERVICES']; ?>">
                                        <h5><span class="count1"><?php echo AddingZero_BeforeNumber(getCountListing()); ?></span><?php echo $BIZBOOK['ALL_SERVICES']; ?></h5>
                                        <a href="<?php echo $webpage_full_link; ?>todas-categorias">&nbsp;</a>
                                    </div>
                                </li>
                                <?php /*<li>
                                    <div>
                                        <img src="<?php echo $slash; ?>images/icon/shop.png" title="<?php echo $BIZBOOK['PRODUCTS']; ?>" alt="<?php echo $BIZBOOK['PRODUCTS']; ?>">
                                        <h5><span class="count1"><?php echo AddingZero_BeforeNumber(getCountProduct()); ?></span><?php echo $BIZBOOK['PRODUCTS']; ?></h5>
                                        <a href="<?php echo $webpage_full_link; ?>all-products">&nbsp;</a>
                                    </div>
                                </li>*/?>
                                <li>
                                    <div>
                                        <img src="<?php echo $slash; ?>images/icon/event.png" title="<?php echo $BIZBOOK['EVENTS']; ?>" alt="<?php echo $BIZBOOK['EVENTS']; ?>">
                                        <h5><span class="count1"><?php echo AddingZero_BeforeNumber(getCountEvent()); ?></span><?php echo $BIZBOOK['EVENTS']; ?></h5>
                                        <a href="<?php echo $webpage_full_link; ?>eventos">&nbsp;</a>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <img src="<?php echo $slash; ?>images/icon/blog.png" title="<?php echo $BIZBOOK['BLOGS']; ?>" alt="<?php echo $BIZBOOK['BLOGS']; ?>">
                                        <h5><span class="count1"><?php echo AddingZero_BeforeNumber(getCountBlog()); ?></span><?php echo $BIZBOOK['BLOGS']; ?></h5>
                                        <a href="<?php echo $webpage_full_link; ?>blog-posts">&nbsp;</a>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <img src="<?php echo $slash; ?>images/icon/general.png" title="<?php echo $BIZBOOK['COMMUNITY']; ?>" alt="<?php echo $BIZBOOK['COMMUNITY']; ?>">
                                        <h5><span class="count1"><?php echo AddingZero_BeforeNumber(getCountUser()); ?></span><?php echo $BIZBOOK['COMMUNITY']; ?></h5>
                                        <a href="<?php echo $webpage_full_link; ?>community">&nbsp;</a>
                                    </div>
                                </li>
                            </ul>
                            <?php /*<ul>
                                <li>
                                    <a href="<?php //echo $webpage_full_link; ?>all-category.php">All services</a>
                                </li>
                                <li>
                                    <a href="<?php //echo $webpage_full_link; ?>events.php">Events</a>
                                </li>
                                <li>
                                    <a href="<?php //echo $webpage_full_link; ?>blog-posts.php">Articles</a>
                                </li>
                                <li>
                                    <a href="<?php //echo $webpage_full_link; ?>db-all-users.php">Business users</a>
                                </li>
                            </ul>-->*/?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- END -->