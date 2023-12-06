<?php
include "header.php";
?>
<style>
    .hom-top {
        transition: all 0.5s ease;
        background: none;
        box-shadow: none;
    }

    .dmact .top-ser {
        display: block;
    }
    .caro-home{margin-top: 90px;float: left;width: 100%;}
    .carousel-item:before{background:none;}
</style>

<?php $lists_favorite_home = getAllListingFavoriteHome();?>
<?php if ($lists_favorite_home->num_rows > 0) {?>
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

                        <div class="row">
                            <?php

                            $vi = 1;
                            foreach ($lists_favorite_home as $list_favorite_home) {
                                $category_id_listing_favorite_home = $list_favorite_home['category_id'];
                                $category_listing_favorite_home = getCategory($category_id_listing_favorite_home);

                                // List Rating. for Rating of Star
                                foreach (getListingReview($list_favorite_home['listing_id']) as $star_rating_row) {
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
                                            echo "images/listings/" . $list_favorite_home['profile_image'];
                                        } else {
                                            echo "images/listings/hot4.jpg";
                                        } ?>" title="<?php echo $list_favorite_home['listing_name']; ?>" alt="<?php echo $list_favorite_home['listing_name']; ?>"/>
                                    <div class="text-item-slider">
                                        <h5 class="titulo-slider"><?php echo $list_favorite_home['listing_name']; ?><br/>
                                            <span><?php echo $category_listing_favorite_home['category_name']; ?></span>
                                        </h5>

                                        <?php if ($star_rate != 0) { ?>
                                            <p class="home-rate-destacados"><span><?php echo $star_rate; ?></span></p>
                                        <?php } ?>
                                        <p class="parrafo-slider"><?php echo substr(strip_tags($list_favorite_home['listing_description']),0,120)."...";?></p>
                                    </div>
                                    <a href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $list_favorite_home['listing_slug']; ?>" class="fclick"></a>
                                </div>
                                <!--LISTINGS-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php }?>
<!-- START -->
<section>
    <div class="str">
        <div class="container">
            <div class="row">
                <?php /*<div class="home-tit">
                    <h2><span>Top Services</span> Cras nulla nulla, pulvinar sit amet nunc at, lacinia viverra lectus. Fusce imperdiet ullamcorper metus eu fringilla.</h2>
                </div>*/?>
                <div class="home-tit">
                    <h2><span><?php echo $BIZBOOK['HOM-POP-TIT']; ?></span> <?php echo $BIZBOOK['HOM-POP-TIT1']; ?></h2>
                    <p><?php echo $BIZBOOK['HOM-POP-SUB-TIT']; ?></p>
                </div>
                <div class="land-pack">
                    <ul>
                        <?php
                        foreach (getAllTopCategories() as $toprow) {

                            $category_name = $toprow['category_name'];

                            $category_sql_row = getCategory($category_name);

                            ?>
                            <li>
                                <div class="land-pack-grid">
                                    <div class="land-pack-grid-img">
                                        <img src="images/services/<?php echo $toprow['category_image']; ?>" title="<?php echo $category_sql_row['category_name']; ?>" alt="<?php echo $category_sql_row['category_name']; ?>">
                                    </div>
                                    <div class="land-pack-grid-text">
                                        <h4><?php echo $category_sql_row['category_name']; ?></h4>
                                        <a href="anuncios/<?php echo $category_sql_row['category_slug']; ?>"
                                           class="land-pack-grid-btn"><?php echo $BIZBOOK['ALL_LISTING'];?></a>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <a href="todas-categorias" class="more"><?php echo $BIZBOOK['HOM-VI-ALL-SER']; ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->


<!-- START -->
<?php
 include "form_contact_home.php";
?>
<!-- END -->

<?php /*<!-- START -->
<section>
    <div class="str str-full">
        <div class="container">
            <div class="row">
                <div class="home-tit">
                    <h2><span><?php echo $BIZBOOK['HOM-TOPSER-TIT']; ?></span> <?php echo $BIZBOOK['HOM-TOPSER-TIT1']; ?></h2>
                    <p><?php echo $BIZBOOK['HOM-TOPSER-SUB-TIT']; ?></p>
                </div>
                <div class="ho-popu-bod">
                    <!--Top Branding Hotels-->
                    <?php
                    $si = 1;
                    foreach (getAllTopServiceProviders() as $row) {

                        $top_service_category_id = $row['top_service_provider_category_id'];

                        $top_service_listing_id = $row['top_service_provider_listings'];

                        $top_service_category_sql_row = getCategory($top_service_category_id);

                        ?>
                        <div class="col-md-4">
                            <div class="hot-page2-hom-pre-head">
                                <h4><?php echo $all_texts_row['branding_title']; ?>
                                    <span><?php echo $top_service_category_sql_row['category_name']; ?></span></h4>
                            </div>
                            <div class="hot-page2-hom-pre">
                                <ul>
                                    <?php
                                    $top_list_array = explode(',', $top_service_listing_id);
                                    $vi = 1;
                                    foreach ($top_list_array as $top_all_listing_array) {
                                        $top_listing_row = getIdListing($top_all_listing_array);
                                        // List Rating. for Rating of Star
                                        foreach (getListingReview($top_listing_row['listing_id']) as $star_rating_row) {
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
                                        <li>
                                            <div class="hot-page2-hom-pre-1"><img
                                                    src="<?php if ($top_listing_row['profile_image'] != NULL || !empty($top_listing_row['profile_image'])) {
                                                        echo "images/listings/" . $top_listing_row['profile_image'];
                                                    } else {
                                                        echo "images/listings/hot4.jpg";
                                                    } ?>" alt="">
                                            </div>
                                            <div class="hot-page2-hom-pre-2">
                                                <h5><?php echo $top_listing_row['listing_name']; ?></h5>
                                                <span><?php echo $top_listing_row['listing_address']; ?></span>
                                            </div>
                                            <?php if ($star_rate != 0) { ?>
                                                <div class="hot-page2-hom-pre-3"><span><?php echo $star_rate; ?></span>
                                                </div>
                                            <?php } ?>
                                            <a href="<?php echo $webpage_full_link; ?>listing/<?php echo preg_replace('/\s+/', '-', strtolower($top_listing_row['listing_slug'])); ?>"
                                               class="fclick"></a>
                                        </li>
                                        <!--LISTINGS-->
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <!--End Top Branding Hotels-->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->*/?>

<section>
    <div id="demo" class="carousel slide cate-sli caro-home" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $si =1;
            foreach (getAllSlider() as $slider_row) {

                ?>
                <div class="carousel-item <?php if($si== 1){ ?>active<?php } ?>">
                    <img src="images/slider/<?php echo $slider_row['slider_photo']; ?>" alt="Los Angeles" width="1100" height="500">
                    <a href="<?php echo $slider_row['slider_link']; ?>" target="_blank"></a>
                </div>
                <?php
                $si++;
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</section>

<!-- START -->
<section>
    <div class="str count">
        <div class="container">
            <div class="row">

                <div class="how-wrks">
                    <div class="home-tit">
                        <h2><span><?php echo $BIZBOOK['HOM-HOW-TIT']; ?></span></h2>
                        <p><?php echo $BIZBOOK['HOM-HOW-SUB-TIT']; ?></p>
                    </div>
                    <div class="how-wrks-inn">
                        <ul>
                            <li>
                                <div>
                                    <a href="#" data-toggle="modal" data-target="#crearcuentaModal" title="Crear una cuenta">
                                        <span>1</span>
                                        <img src="images/icon/how1.png" title="<?php echo $BIZBOOK['HOM-HOW-P-TIT-1']; ?>" alt="<?php echo $BIZBOOK['HOM-HOW-P-TIT-1']; ?>">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-1']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-1']; ?></p>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="#" data-toggle="modal" data-target="#anadenegocioModal" title="Añade tu negocio">
                                        <span>2</span>
                                        <img src="images/icon/how2.png" title="<?php echo $BIZBOOK['HOM-HOW-P-TIT-2']; ?>" alt="<?php echo $BIZBOOK['HOM-HOW-P-TIT-2']; ?>">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-2']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-2']; ?></p>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="#" data-toggle="modal" data-target="#consigueclientesModal" title="Consigue clientes">
                                        <span>3</span>
                                        <img src="images/icon/how3.png" title="<?php echo $BIZBOOK['HOM-HOW-P-TIT-3']; ?>" alt="<?php echo $BIZBOOK['HOM-HOW-P-TIT-3']; ?>">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-3']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-3']; ?></p>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="#" data-toggle="modal" data-target="#lograobjetivosModal" title="Logra tus objetivos">
                                        <span>4</span>
                                        <img src="images/icon/how4.png" title="<?php echo $BIZBOOK['HOM-HOW-P-TIT-4']; ?>" alt="<?php echo $BIZBOOK['HOM-HOW-P-TIT-4']; ?>">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-4']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-4']; ?></p>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php include 'modales_textos_home.php';?>
                <?php /*<div class="home-tit">
                    <h2><span><?php echo $all_texts_row['quick_title']; ?></span> <?php echo $all_texts_row['quick_light_title']; ?></h2>
                    <p><?php echo $all_texts_row['quick_sub_title']; ?></p>
                </div>
                <div class="inte">
                    <ul>
                        <li>
                            <div class="hom-oth">
                                <div>
                                    <img src="images/listings/hot5.jpg" alt="">
                                </div>
                                <div>
                                    <h4>Events</h4>
                                    <span>Email configuration</span>
                                </div>
                                <a href="events" class="fclick"></a>
                            </div>
                        </li>
                        <li>
                            <div class="hom-oth">
                                <div>
                                    <img src="images/listings/re1.jpg" alt="">
                                </div>
                                <div>
                                    <h4>Blog posts</h4>
                                    <span>Email configuration</span>
                                </div>
                                <a href="blog-posts" class="fclick"></a>
                            </div>
                        </li>
                        <li>
                            <div class="hom-oth">
                                <div>
                                    <img src="images/listings/spa3.jpg" alt="">
                                </div>
                                <div>
                                    <h4>How it works</h4>
                                    <span>Email configuration</span>
                                </div>
                                <a href="how-to" class="fclick"></a>
                            </div>
                        </li>
                        <li>
                            <div class="hom-oth">
                                <div>
                                    <img src="images/listings/re5.jpg" alt="">
                                </div>
                                <div>
                                    <h4>Pricing details</h4>
                                    <span>Email configuration</span>
                                </div>
                                <a href="pricing-details" class="fclick"></a>
                            </div>
                        </li>
                    </ul>
                </div>*/?>
                <div class="country">
                    <div class="country-inn">
                        <?php /*<h4><?php echo $all_texts_row['world_title']; ?>
                            <span class="cont2"><?php echo $all_texts_row['world_sub_title']; ?></span>
                        </h4>*/?>
                        <?php $youtube = getAllFooter(); ?>
                        <?php echo $youtube['admin_home_youtube']; ?>
                    </div>
                </div>

                <?php /*<div class="mob-app">
                    <div class="lhs">
                        <img src="images/mobile.png" alt="">
                    </div>
                    <div class="rhs">
                        <h2><?php echo $BIZBOOK['HOM-APP-TIT']; ?><span><?php echo $BIZBOOK['HOM-APP-TIT-SUB']; ?></span></h2>
                        <ul>
                            <li><?php echo $BIZBOOK['HOM-APP-PO-1']; ?></li>
                            <li><?php echo $BIZBOOK['HOM-APP-PO-2']; ?></li>
                            <li><?php echo $BIZBOOK['HOM-APP-PO-3']; ?></li>
                            <li><?php echo $BIZBOOK['HOM-APP-PO-4']; ?></li>
                        </ul>
                        <span><?php echo $BIZBOOK['HOM-APP-SEND']; ?></span>
                        <form>
                            <ul>
                                <li>
                                    <input type="email" placeholder="<?php echo $BIZBOOK['ENTER_EMAIL'];?>" required></li>
                                <li>
                                    <input type="submit" value="Get App Link"></li>
                            </ul>
                        </form>
                        <a href="#"><img src="images/android.png" alt=""> </a>
                        <a href="#"><img src="images/apple.png" alt=""> </a>
                    </div>
                </div>*/?>
            </div>
        </div>
    </div>
</section>
<!-- END -->


<!-- START -->
<section>
    <div class="hom-ads">
        <div class="container">
            <div class="row">
                <div class="filt-com lhs-ads">
                    <div class="ads-box">
                        <?php
                        $ad_position_id = 1;   //Ad position on home page bottom
                        $ad_row = getAds($ad_position_id, 4);
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
                                <img src="images/ads/<?php echo $ad_enquiry_photo;?>" alt="" style="width: <?php echo $width_size;?>px; height: <?php echo $height_size;?>px; max-width: 100%;">
                            </a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<?php if(getAllMarcas()->num_rows > 0) {?>
<section>
    <div class="str">
        <div class="container">
            <div class="row">
                <?php /*<div class="home-tit">
                    <h2><span>Top Services</span> Cras nulla nulla, pulvinar sit amet nunc at, lacinia viverra lectus. Fusce imperdiet ullamcorper metus eu fringilla.</h2>
                </div>*/?>
                <div class="home-tit">
                    <h2>Marcas del sector</h2>
                </div>
                <div class="land-pack" style="width: 100%">
                    <ul class="items">
                        <?php
                        foreach (getAllMarcas() as $toprow) {?>
                            <li>
                                <div class="land-pack-grid-marca">
                                    <div class="land-pack-grid-img">
                                        <img src="images/services/<?php echo $toprow['marca_image']; ?>" title="<?php echo $toprow['marca_image']; ?>" alt="<?php echo $toprow['marca_image']; ?>" des>
                                    </div>
                                    <div class="land-pack-grid-text">
                                        <h4><?php echo $toprow['marca_name']; ?></h4>

                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }?>

<!-- START -->
<div class="ani-quo">
    <div class="ani-q1">
        <h4><?php echo $BIZBOOK['HOM-WHAT-LOOK-TIT']; ?></h4>
        <p><?php echo $BIZBOOK['HOM-WHAT-LOOK-SUB']; ?></p>
        <span><?php echo $BIZBOOK['HOM-WHAT-LOOK-CTA']; ?></span>
    </div>
    <div class="ani-q2">
        <img src="images/quote.png" alt="">
    </div>
</div>
<!-- END -->

<?php
include "modal_politca_privacidad.php";
?>

<?php
include "footer.php";
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo $webpage_full_link;?>js/jquery.min.js"></script>
<script src="<?php echo $webpage_full_link;?>js/popper.min.js"></script>
<script src="<?php echo $webpage_full_link;?>js/bootstrap.min.js"></script>
<script src="<?php echo $webpage_full_link;?>js/jquery-ui.js"></script>
<script src="<?php echo $webpage_full_link;?>js/custom.js"></script>
<script src="<?php echo $webpage_full_link;?>js/jquery.validate.min.js"></script>
<script src="<?php echo $webpage_full_link;?>js/custom_validation.js"></script>

<script>
    function gethomeCities(val) {
        $.ajax({
            type: "POST",
            url: "city_home_process.php",
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
        if (screen.width < 768) {
            $('.items').slick({
                dots: false,
                infinite: true,
                speed: 800,
                autoplay: false,
                autoplaySpeed: 2000,
                slidesToShow: 4,
                slidesToScroll: 4,
                prevArrow: "<a type='button' class='btn-color-slider-prev btn-slider slick-prev'></a>",
                nextArrow: "<a type='button' class='btn-color-slider-next btn-slider slick-next'></a>",
                responsive: [
                    {
                        breakpoint: 768,
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
        }
    });
</script>
</body>

</html>
