<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}


if (file_exists('config/admin_authentication.php')) {
    include('config/admin_authentication.php');
}

if ($_SERVER['HTTP_HOST'] == 'oficinadeprofesionales.com') {
    header('Location: '.$webpage_full_link.'admin');
}

$footer_row = getAllFooter(); //Fetch Footer Data

$admin_row = getAllSuperAdmin(); //Fetch Admin Data

$data_array['website_email_id'] = $footer_row['admin_primary_email'];
$data_array['admin_user_name'] = $admin_row['admin_email'];
$data_array['admin_user_password'] = $admin_row['admin_password'];

$all_texts_row = getAllTexts(); //Fetch All Text Data
?>
<!doctype html>
<html lang="es">

<head>
    <title>Landing pages - Download Request</title>
    <!--== META TAGS ==-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#76cef1" />
    <meta name="robots" content="noindex,nofollow" />
    <!--== FAV ICON(BROWSER TAB ICON) ==-->
    <link rel="shortcut icon" href="../images/fav.ico" type="image/x-icon">
    <!--== GOOGLE FONTS ==-->
    <link href="https://fonts.googleapis.com/css?family=Oswald:700|Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">
    <!--== CSS FILES ==-->
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="css/admin-style.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="../js/html5shiv.js"></script>
    <script src="../js/respond.min.js"></script>
    <![endif]-->
</head>

<body>


<!-- START -->
<section>
    <div class="ad-head">
        <div class="head-s1">
            <div class="menu">
                <i class="material-icons mopen">menu</i>
                <i class="material-icons mclose">close</i>
            </div>
            <div class="logo">
                <img src="../images/home/<?php echo $footer_row['header_logo']; ?>">
            </div>
        </div>
        <div class="head-s2">
            <div class="head-sear">
                <input type="text" id="search" placeholder="Search the listing and users..."  autocomplete="off">
            </div>
        </div>
        <div class="head-s3">
            <div class="head-pro">
                <?php
                $admin_row = getAdmin($_SESSION['admin_id']);
                ?>
                <img src="../images/user/<?php if(($admin_row['admin_photo'] == NULL) || empty($admin_row['admin_photo'])){  echo $footer_row['user_default_image'];}else{ echo $admin_row['admin_photo']; } ?>" alt="">
                <b>Profile by</b><br>
                <h4><?php echo $admin_row['admin_name']; ?></h4>
                <?php
                if($_SESSION['admin_id'] ==1) {
                    ?>
                    <a href="admin-setting.php" class="fclick"></a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<!-- START -->
<section>
    <div class="ad-menu-lhs mshow">
        <div class="ad-menu">
            <ul>
                <li class="ic-db">
                    <a href="profile.php" class="<?php if ($current_page == 'profile.php') { echo 'mact'; } ?>"><?php echo $BIZBOOK['MY_DASHBOARD'];?></a>
                </li>
                <?php if($admin_row['admin_user_options'] == 1){ ?>

                    <li class="ic-user">
                        <a href="#" class="<?php if ($current_page == 'admin-new-user-requests.php' || $current_page == 'admin-all-users.php'
                            || $current_page == 'admin-new-cod-requests.php' || $current_page == 'admin-non-paid-users.php' || $current_page == 'admin-paid-users.php'
                            || $current_page == 'admin-all-users-general.php' || $current_page == 'admin-all-users-service-provider.php'
                            || $current_page == 'admin-free-users.php' || $current_page == 'admin-standard-users.php'
                            || $current_page == 'admin-premium-users.php' || $current_page == 'admin-premium-plus-users.php'
                            || $current_page == 'admin-add-new-user.function.php') { echo 'mact'; } ?>"><?php echo $BIZBOOK['USERS'];?></a>
                        <div>
                            <ol>
                                <li>
                                    <a href="admin-new-user-requests.php"><?php echo $BIZBOOK['NEW_USER_REQUESTS'];?></a>
                                </li>
                                <?php /*<li>
                                    <a href="admin-new-cod-requests.php">New COD Payment Requests</a>
                                </li>*/?>
                                <?php
                                foreach(getAllPlanType() as $plan_type_row){
                                    $name[]=array('name'=>$plan_type_row['plan_type_name']);
                                }
                                ?>
                                <li>
                                    <a href="admin-all-users.php"><?php echo $BIZBOOK['ALL_USERS'];?></a>
                                </li>
                                <?php /*<li>
                                    <a href="admin-all-users-general.php">All Users - General</a>
                                </li>
                                <li>
                                    <a href="admin-all-users-service-provider.php">All Users - Service Providers</a>
                                </li>
                                <li>
                                    <a href="admin-free-users.php"><?php //echo $name[0]['name']; ?></a>
                                </li>
                                <li>
                                    <a href="admin-standard-users.php"><?php //echo $name[1]['name']; ?></a>
                                </li>
                                <li>
                                    <a href="admin-premium-users.php"><?php //echo $name[2]['name']; ?></a>
                                </li>
                                <li>
                                    <a href="admin-premium-plus-users.php"><?php //echo $name[3]['name']; ?></a>
                                </li>
                                <li>
                                    <a href="admin-non-paid-users.php">All Non-Paid Users</a>
                                </li>
                                <li>
                                    <a href="admin-paid-users.php">All Paid Users</a>
                                </li>
                                <li>
                                    <a href="admin-add-new-user.php">Add new User</a>
                                </li>*/?>
                            </ol>
                        </div>
                    </li>
                <?php } if($admin_row['admin_listing_options'] == 1){ ?>
                <li class="ic-li">
                    <a href="#" class="<?php if ($current_page == 'admin-all-listings.php' || $current_page == 'admin-add-new-listings.php'
                        || $current_page == 'admin-create-duplicate-listing.php' || $current_page == 'admin-trash-listing.php' || $current_page == 'admin-claim-listing.php'
                        ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['LISTINGS'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-all-listings.php"><?php echo $BIZBOOK['ALL_LISTING'];?></a>
                            </li>
                            <li>
                                <a href="admin-add-new-listings.php"><?php echo $BIZBOOK['ADD_NEW_LISTING'];?></a>
                            </li>
                            <li>
                                <a href="admin-all-featured-listing.php">Fichas destacadas</a>
                            </li>
                            <li>
                                <a href="admin-all-featured-listing-invoiceless.php">Fichas destacadas sin factura</a>
                            </li>
                            <li>
                                <a href="admin-create-duplicate-listing.php"><?php echo $BIZBOOK['CREATE_DUPLICATE_LISTING_LABEL'];?></a>
                            </li>
                            <li>
                                <a href="admin-claim-listing.php"><?php echo $BIZBOOK['ADMIN_CLAIM_REQUEST'];?></a>
                            </li>
                            <li>
                                <a href="admin-trash-listing.php"><?php echo $BIZBOOK['TRASH_LISTING'];?></a>
                            </li>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_store_options'] == 1){ ?>
                    <li class="ic-li">
                        <a href="#" class="<?php if ($current_page == 'admin-all-stores.php' || $current_page == 'admin-add-new-store.php'
                            || $current_page == 'admin-trash-store.php' || $current_page == 'admin-edit-store.php'
                            || $current_page == 'admin-delete-store.php'
                            || $current_page == 'admin-add-featured-store.php'
                            || $current_page == 'admin-add-new-category-store.php'
                            || $current_page == 'admin-category-store.php' || $current_page == 'admin-category-store-edit.php'
                            || $current_page == 'admin-category-store-delete.php'
                        ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['STORES'];?></a>
                        <div>
                            <ol>
                                <li>
                                    <a href="admin-all-stores.php"><?php echo $BIZBOOK['ALL_STORES'];?></a>
                                </li>
                                <li>
                                    <a href="admin-add-new-store.php"><?php echo $BIZBOOK['ADD_NEW_STORE'];?></a>
                                </li>
                                <li>
                                    <a href="admin-category-store.php"><?php echo $BIZBOOK['CATEGORY_STORE'];?></a>
                                </li>
                            </ol>
                        </div>
                    </li>
                <?php } if ($admin_row['admin_work_offer_options'] !== 1) {?>
                    <li class="ic-li">
                        <a href="#" class="<?php if ($current_page == 'admin-all-workoffer.php' || $current_page == 'admin-add-new-workoffer.php'
                            || $current_page == 'admin-category-workoffer.php' || $current_page == 'admin-enquiry-workoffer.php'
                            || $current_page == 'admin-edit-workoffer.php'
                            || $current_page == 'admin-delete-workoffer.php'
                            || $current_page == 'admin-add-new-category-workoffer.php'
                            || $current_page == 'admin-category-workoffer-edit.php'
                            || $current_page == 'admin-category-workoffer-delete.php'
                        ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['WORK_OFFERS'];?></a>
                        <div>
                            <ol>
                                <li>
                                    <a href="admin-all-workoffer.php">Todas <?php echo $BIZBOOK['WORK_OFFERS'];?></a>
                                </li>
                                <li>
                                    <a href="admin-add-new-workoffer.php"><?php echo $BIZBOOK['ADD_NEW_OFFER'];?></a>
                                </li>
                                <li>
                                    <a href="admin-category-workoffer.php"><?php echo $BIZBOOK['CATEGORIES'];?></a>
                                </li>
                                <li>
                                    <a href="admin-enquiry-workoffer.php">Solicitudes ofertas trabajo</a>
                                </li>
                            </ol>
                        </div>
                    </li>

                <?php } if($admin_row['admin_event_options'] == 1){ ?>
                <li class="ic-eve">
                    <a href="#" class="<?php if ($current_page == 'admin-event.php' || $current_page == 'admin-add-new-event.php' || $current_page == 'admin-year-event.php'
                       ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['EVENTS'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-event.php"><?php echo $BIZBOOK['ALL_EVENTS'];?></a>
                            </li>
                            <li>
                                <a href="admin-add-new-event.php"><?php echo $BIZBOOK['ADD_NEW_EVENT'];?></a>
                            </li>
                            <li>
                                <a href="admin-year-event.php"><?php echo $BIZBOOK['YEARS_EVENT'];?></a>
                            </li>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_blog_options'] == 1){ ?>
                <li class="ic-blo">
                    <a href="#" class="<?php if ($current_page == 'admin-all-blogs.php' || $current_page == 'admin-add-new-blogs.php'
                    ) { echo 'mact'; } ?>">Blogs</a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-all-blogs.php"><?php echo $BIZBOOK['ALL_BLOG'];?></a>
                            </li>
                            <li>
                                <a href="admin-add-new-blogs.php"><?php echo $BIZBOOK['ADD_NEW_POST'];?></a>
                            </li>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_product_options'] == 1){ ?>
                    <li class="ic-eve">
                        <a href="#" class="<?php if ($current_page == 'admin-all-products.php' || $current_page == 'admin-add-new-product.php'
                        ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['PRODUCTS'];?></a>
                        <div>
                            <ol>
                                <li>
                                    <a href="admin-all-products.php"><?php echo $BIZBOOK['ALL_PRODUCTS'];?></a>
                                </li>
                                <li>
                                    <a href="admin-add-new-product.php"><?php echo $BIZBOOK['ADD_NEW_PRODUCTS'];?></a>
                                </li>
                            </ol>
                        </div>
                    </li>
                <?php } if($admin_row['admin_category_options'] == 1){ ?>
                <li class="ic-cat">
                    <a href="#" class="<?php if ($current_page == 'admin-all-category.php' || $current_page == 'admin-add-new-category.php'
                        || $current_page == 'admin-all-sub-category.php' || $current_page == 'admin-add-new-sub-category.php'
                    ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['CATEGORIES'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-all-category.php"><?php echo $BIZBOOK['ALL__CATEGORIES'];?></a>
                            </li>
                            <li>
                                <a href="admin-add-new-category.php"><?php echo $BIZBOOK['ADD_NEW_CATEGORY'];?></a>
                            </li>
                            <?php /*<li>
                                <a href="admin-all-sub-category.php">All Listing Sub Category</a>
                            </li>
                            <li>
                                <a href="admin-add-new-sub-category.php">Add new Listing Sub Category</a>
                            </li>*/?>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_product_category_options'] == 1){ ?>
                    <li class="ic-cat">
                        <a href="#" class="<?php if ($current_page == 'admin-all-product-category.php' || $current_page == 'admin-add-new-product-category.php'
                            || $current_page == 'admin-all-product-sub-category.php' || $current_page == 'admin-add-new-product-sub-category.php'
                        ) { echo 'mact'; } ?>">Product Category</a>
                        <div>
                            <ol>
                                <li>
                                    <a href="admin-all-product-category.php">All Product Category</a>
                                </li>
                                <li>
                                    <a href="admin-add-new-product-category.php">Add new Product Category</a>
                                </li>
                                <li>
                                    <a href="admin-all-product-sub-category.php">All Product Sub Category</a>
                                </li>
                                <li>
                                    <a href="admin-add-new-product-sub-category.php">Add new Product Sub Category</a>
                                </li>
                            </ol>
                        </div>
                    </li>

                <?php } if($admin_row['admin_enquiry_options'] == 1){ ?>
                    
                <li class="ic-enq">
                    <a href="#" class="<?php if ($current_page == 'admin-all-contact.php' 
                    ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['LISTING_CONTACT'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-all-contact.php"><?php echo $BIZBOOK['ALL_ENQUERIES'];?></a>
                            </li>
                        </ol>
                    </div>
                </li>
                <li class="ic-enq">
                    <a href="#" class="<?php if ($current_page == 'admin-all-enquiry.php' || $current_page == 'admin-saved-enquiry.php'
                    ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['ENQUERY_&_QUOTE'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-all-enquiry.php"><?php echo $BIZBOOK['ALL_ENQUERIES'];?></a>
                            </li>
                            <?php /*<li>
                                <a href="admin-saved-enquiry.php"><?php echo $BIZBOOK['SAVED_ENQUERY'];?></a>
                            </li>*/?>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_review_options'] == 1){ ?>
                <li class="ic-rev">
                    <a href="#" class="<?php if ($current_page == 'admin-all-reviews.php' || $current_page == 'admin-saved-reviews.php'
                    ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['REVIEWS'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-all-reviews.php"><?php echo $BIZBOOK['ALL_REVIEWS'];?></a>
                            </li>
                            <?php /*<li>
                                <a href="admin-saved-reviews.php"><?php echo $BIZBOOK['SAVED_REVIEWS'];?></a>
                            </li>*/?>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_feedback_options'] == 1){ ?>
                    <li class="ic-rev">
                        <a href="#" class="<?php if ($current_page == 'admin-all-feedbacks.php'
                        ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['FEEDBACKS'];?></a>
                        <div>
                            <ol>
                                <li>
                                    <a href="admin-all-feedbacks.php"><?php echo $BIZBOOK['ALL_FEEDBACKS'];?></a>
                                </li>
                            </ol>
                        </div>
                    </li>
                <?php } if($admin_row['admin_notification_options'] == 1){ ?>
                <li class="ic-noti">
                    <a href="#" class="<?php if ($current_page == 'admin-notification-all.php' || $current_page == 'admin-create-notification.php'
                        ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['SEND_NOTIFICATIONS'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-notification-all.php"><?php echo $BIZBOOK['ALL_NOTIFICATIONS'];?></a>
                            </li>
                            <li>
                                <a href="admin-create-notification.php"><?php echo $BIZBOOK['CREATE_NEW_NOTIFICATIONS'];?></a>
                            </li>
                        </ol>
                    </div>
                </li>
                <?php }  if($admin_row['admin_ads_options'] == 1){ ?>
                <li class="ic-ads">
                    <a href="#" class="<?php if ($current_page == 'admin-current-ads.php' || $current_page == 'admin-create-ads.php'
                        || $current_page == 'admin-ads-request.php' || $current_page == 'admin-ads-price.php'
                        || $current_page == 'admin-ads-google-integration.php' || $current_page == 'admin-ads-history.php'
                    ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['ADS'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-current-ads.php"><?php echo $BIZBOOK['CURRENT_ADS'];?></a>
                            </li>
                            <li>
                                <a href="admin-current-ads-invoice-less.php">Anuncios sin facturación</a>
                            </li>
                            <li>
                                <a href="admin-create-ads.php"><?php echo $BIZBOOK['CREATE_AD'];?></a>
                            </li>
                            <li>
                                <a href="admin-ads-request.php"><?php echo $BIZBOOK['AD_REQUEST_ENQUIRY'];?></a>
                            </li>
                            <li>
                                <a href="admin-ads-price.php"><?php echo $BIZBOOK['AD_PRICING'];?></a>
                            </li>
                            <?php /*<li>
                               <a href="admin-ads-google-integration.html">Google Ads Integration</a>
                            </li>
                            <li>
                                <a href="admin-ads-history.html">Ads History</a>
                            </li>*/?>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_home_options'] == 1){ ?>
                <li class="ic-hom">
                    <a href="#" class="<?php if ($current_page == 'admin-home-category.php' || $current_page == 'admin-trending-category.php'
                        || $current_page == 'admin-home-top-services.php' || $current_page == 'admin-home-feature-events.php'
                        || $current_page == 'admin-home-youtube-video.php' || $current_page == 'admin-home-marcas-sector.php'
                        || $current_page == 'admin-add-new-home-marca.php' || $current_page == 'admin-home-marca-sector-edit.php'
                        || $current_page == 'admin-home-marca-sector-delete.php') { echo 'mact'; } ?>"><?php echo $BIZBOOK['HOME_PAGE'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-home-category.php"><?php echo $BIZBOOK['CHOOSE_CATEGORY'];?></a>
                            </li>
                            <li>
                                <a href="admin-trending-category.php"><?php echo $BIZBOOK['CHOOSE_TRENDING_CATEGORY'];?></a>
                            </li>
                            <?php /*
                            <li>
                                <a href="admin-home-popular-business.php"><?php echo $BIZBOOK['POPULAR_BUSINESS'];?></a>
                            </li>
                            <li>
                                <a href="admin-home-top-services.php"><?php echo $BIZBOOK['TOP_SERVICES'];?></a>
                            </li>*/?>
                            <li>
                                <a href="admin-home-feature-events.php"><?php echo $BIZBOOK['FEATURE_EVENTS'];?></a>
                            </li>
                            <li>
                                <a href="admin-home-youtube-video.php"><?php echo $BIZBOOK['YOUTUBE_VIDEO'];?></a>
                            </li>
                            <li>
                                <a href="admin-home-marcas-sector.php"><?php echo $BIZBOOK['MARCAS'];?></a>
                            </li>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_country_options'] == 1){ ?>                
                <li class="ic-planet">
                    <a href="#" class="<?php if ($current_page == 'admin-all-country.php' || $current_page == 'admin-add-country.php'
                        ) { echo 'mact'; } ?>">Country</a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-all-country.php">All Countries</a>
                            </li>
                            <li>
                                <a href="admin-add-country.php">Add New Country</a>
                            </li>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_state_options'] == 1){ ?>
                <li class="ic-cou">
                    <a href="#" class="<?php if ($current_page == 'admin-all-state.php' || $current_page == 'admin-add-state.php'
                        ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['STATES'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-all-state.php"><?php echo $BIZBOOK['ALL_STATES'];?></a>
                            </li>
                            <li>
                                <a href="admin-add-state.php"><?php echo $BIZBOOK['ADD_NEW_STATES'];?></a>
                            </li>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_city_options'] == 1){ ?>
                <li class="ic-cit">
                    <a href="#" class="<?php if ($current_page == 'admin-all-city.php' || $current_page == 'admin-add-city.php'
                        ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['SUB_REGIONS'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-all-city.php"><?php echo $BIZBOOK['ALL_SUB_REGIONS'];?></a>
                            </li>
                            <li>
                                <a href="admin-add-city.php"><?php echo $BIZBOOK['ADD_NEW_SUB_REGION'];?></a>
                            </li>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_listing_filter_options'] == 1){ ?>
                <li class="ic-fil">
                    <a href="#" class="<?php if ($current_page == 'admin-all-filters.php' || $current_page == 'admin-filter-features.php'
                        || $current_page == 'admin-filter-category.php' ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['LISTING_FILTERS'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-all-filters.php"><?php echo $BIZBOOK['ALL_FILTERS'];?></a>
                            </li>
                            <li>
                                <a href="admin-filter-features.php"><?php echo $BIZBOOK['FEATURES'];?></a>
                            </li>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_invoice_options'] == 1){ ?>
                <li class="ic-inv">
                    <a href="#" class="<?php if ($current_page == 'admin-invoice-create.php' || $current_page == 'admin-send-invoice.php'
                        || $current_page == 'admin-invoice-shared.php' || $current_page == 'admin-invoice-pending.php' ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['INVOICES'];?></a>
                    <div>
                        <ol>
                            <?php /*<li>
                                <a href="admin-invoice-create.php"><?php echo $BIZBOOK['CREATE_NEW_INVOICES'];?></a>
                            </li>
                            <?php /*<li>
                                <a href="admin-send-invoice.php"><?php echo $BIZBOOK['SEND_INVOICES'];?></a>
                            </li>*/?>
                            <li>
                                <a href="admin-invoice-shared.php"><?php echo $BIZBOOK['SHARE_INVOICES'];?></a>
                            </li>
                            <li>
                                <a href="admin-invoice-pending.php"><?php echo $BIZBOOK['PENDING_INVOICES'];?></a>
                            </li>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_import_options'] == 1){ ?>
                <li class="ic-imp">
                    <a href="#" class="<?php if ($current_page == 'admin-import.php' || $current_page == 'admin-export.php'
                    ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['IMPORT_EXPORT'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-import.php"><?php echo $BIZBOOK['IMPORT_DATA'];?></a>
                            </li>
                            <li>
                                <a href="admin-export.php"><?php echo $BIZBOOK['EXPORT_DATA'];?></a>
                            </li>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_sub_admin_options'] == 1){ ?>
                <li class="ic-sub">
                    <a href="#" class="<?php if ($current_page == 'admin-sub-admin-all.php' || $current_page == 'admin-sub-admin-create.php'
                        || $current_page == 'admin-sub-admin-log.php' ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['SUB_ADMINS'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-sub-admin-all.php"><?php echo $BIZBOOK['ALL_SUB_ADMINS'];?></a>
                            </li>
                            <li>
                                <a href="admin-sub-admin-create.php"><?php echo $BIZBOOK['CREATE_SUB_ADMIN'];?></a>
                            </li>
                            <?php /*<li>
                                <a href="admin-sub-admin-log.html">Log Details</a>
                            </li>*/?>
                        </ol>
                    </div>
                </li>
                <?php } if($admin_row['admin_text_options'] == 1){ ?>
                <li class="ic-txt">
                    <a class="<?php if ($current_page == 'admin-text-changes.php') { echo 'mact'; } ?>" href="admin-text-changes.php"><?php echo $BIZBOOK['ALL_TEXT_CHANGES'];?></a>
                </li>
                <?php } if($admin_row['admin_listing_price_options'] == 1){ ?>
                    <?php /*<li class="ic-pri">-->
                        <a class="--><?php //if ($current_page == 'admin-price.php') { echo 'mact'; } ?><!--" href="admin-price.php">Pricing Plans</a>-->
                    </li>*/?>
                    <li class="ic-pri">
                        <a class="<?php if ($current_page == 'admin-credit.php') { echo 'mact'; } ?>" href="admin-credit.php"><?php echo $BIZBOOK['CREDITS'];?></a>
                    </li>
                <?php } if($admin_row['admin_payment_options'] == 1) { ?>
                    <li class="ic-pay">
                        <a class="<?php if ($current_page == 'admin-payment-credentials.php') {
                            echo 'mact';
                        } ?>" href="admin-payment-credentials.php"><?php echo $BIZBOOK['ADMIN_PAYMENT_CREDENTIALS'];?></a>
                    </li>

                    <?php
                } if($_SESSION['admin_id'] ==1) {
                    ?>
                <?php if($admin_row['admin_setting_options'] == 1){ ?>
                <li class="ic-set">
                    <a class="<?php if ($current_page == 'admin-setting.php') { echo 'mact'; } ?>" href="admin-setting.php"><?php echo $BIZBOOK['SETTING'];?></a>
                </li>
                    <?php } ?>

                <?php } if($admin_row['admin_footer_options'] == 1){ ?>
                <li class="ic-fot">
                    <a class="<?php if ($current_page == 'admin-footer.php') { echo 'mact'; } ?>" href="admin-footer.php"><?php echo $BIZBOOK['FOOTER_CMS'];?></a>
                </li>
                <?php } if($admin_row['admin_dummy_image_options'] == 1){ ?>
                <li class="ic-dum">
                    <a class="<?php if ($current_page == 'admin-dummy-images.php') { echo 'mact'; } ?>" href="admin-dummy-images.php"><?php echo $BIZBOOK['DUMMY_IMAGES'];?></a>
                </li>
                <?php } if($admin_row['admin_mail_template_options'] == 1){ ?>
                <li class="ic-eve">
                    <a href="admin-all-mail.php" class="<?php if ($current_page == 'admin-all-mail.php') { echo 'mact'; } ?>"><?php echo $BIZBOOK['MAIL_TEMPLATES'];?></a>
                </li>
                <?php } ?>
                <li class="ic-dum">
                    <a href="#" class="<?php if ($current_page == 'admin-slider-all.php' || $current_page == 'admin-slider-create.php'
                        || $current_page == 'admin-slider-edit.php' || $current_page == 'admin-slider-delete.php' ) { echo 'mact'; } ?>"><?php echo $BIZBOOK['SLIDER_IMAGES'];?></a>
                    <div>
                        <ol>
                            <li>
                                <a href="admin-slider-all.php"><?php echo $BIZBOOK['ALL_SLIDER_IMAGES'];?></a>
                            </li>
                            <li>
                                <a href="admin-slider-create.php"><?php echo $BIZBOOK['ADD_NEW_IMAGES'];?></a>
                            </li>
                            <?php /*<li>
                                <a href="admin-sub-admin-log.html">Log Details</a>
                            </li>*/?>
                        </ol>
                    </div>
                </li>
                <?php /*<li class="ic-set">
                    <a href="admin-security-updates.php" class="<?php if ($current_page == 'admin-security-updates.php') { echo 'mact'; } ?>"><?php echo $BIZBOOK['NEWS_SECURITY_UPDATE'];?></a>
                </li>*/?>
                <li class="ic-lgo">
                    <a href="logout.php"><?php echo $BIZBOOK['LOG_OUT'];?></a>
                </li>
            </ul>
        </div>
    </div>
</section>
<!-- END -->