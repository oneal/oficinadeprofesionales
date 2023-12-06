<?php
include "header.php";

if(isset($_GET['q'])) {
    $select_search = $_GET['q'];

//get matched data from listings table
    $listings_qry = "SELECT * FROM " . TBL . "listings WHERE listing_description LIKE '%$select_search%' 
     OR listing_address LIKE '%$select_search%'  OR service_id LIKE '%$select_search%' OR service_1_name LIKE '%$select_search%' 
     OR service_1_detail LIKE '%$select_search%' OR listing_info_question LIKE '%$select_search%' OR listing_info_answer LIKE '%$select_search%'
     OR service_locations LIKE '%$select_search%' OR listing_name LIKE '%$select_search%' 
     AND listing_status= 'Active' AND listing_is_delete != '2'  ";
    $listings_query = mysqli_query($conn, $listings_qry);

//get matched data from events table
    $event_qry = "SELECT * FROM " . TBL . "events WHERE event_description LIKE '%$select_search%' 
    OR event_name LIKE '%$select_search%' OR event_address LIKE '%$select_search%' AND event_status= 'Active'";
    $event_query = mysqli_query($conn, $event_qry);

//get matched data from blog table
    $blog_qry = "SELECT * FROM " . TBL . "blogs WHERE blog_description LIKE '%$select_search%' 
    OR blog_name LIKE '%$select_search%' AND blog_status= 'Active'";
    $blog_query = mysqli_query($conn, $blog_qry);

//get matched data from product table
    $product_qry = "SELECT * FROM " . TBL . "products WHERE product_description LIKE '%$select_search%' 
    OR product_name LIKE '%$select_search%' OR product_info_question LIKE '%$select_search%' 
    OR product_info_answer LIKE '%$select_search%' OR product_highlights LIKE '%$select_search%' 
    OR product_tags LIKE '%$select_search%' AND product_status= 'Active'";
    $product_query = mysqli_query($conn, $product_qry);
}
?>
<!-- START -->
<section class="<?php if ($footer_row['admin_language'] == 2) {
    echo "lg-arb";
} ?> ser-head">
    <div class="container">
        <div class="blog-head-inn">
            <h1><?php echo $BIZBOOK['SEARCH_RESULTS'];?></h1>
        </div>
        <?php /*<div class="ban-search">
            <form>
                <ul>
                    <li class="sr-sea">
                        <input type="text" id="select-search" value="<?php echo $select_search; ?>" class="autocomplete" placeholder="Search anything...">
                    </li>
                    <li class="sr-btn">
                        <input type="submit" id="filter_submit" name="filter_submit"  value="Search" class="filter_submit">
                    </li>
                </ul>
            </form>
        </div>*/?>
    </div>
</section>

<?php
//No results found section
if (mysqli_num_rows($listings_query) <= 0 && mysqli_num_rows($event_query) <= 0 && mysqli_num_rows($blog_query) <= 0 && mysqli_num_rows($product_query) <= 0 || $select_search == NULL || empty($select_search)) {
    ?>
    <div class="container"><?php echo $BIZBOOK['NO_RESULTS_FOUND'];?> <b><?php echo $select_search; ?></b>. <?php echo $BIZBOOK['PLEASE_TRY_WITH_OTHER'];?></div>
    <?php
}
else {
    $count = mysqli_num_rows($listings_query) + mysqli_num_rows($event_query) +  mysqli_num_rows($blog_query) +   mysqli_num_rows($product_query);
    ?>
    <div class="container ser-re-hu"><?php echo $BIZBOOK['HURRAY'];?>!!! <?php echo $count; ?> <?php echo $BIZBOOK['RESULTS_FIND_FOR'];?> <b><?php echo $select_search; ?></b>.</div>
    <?php
}
?>
    
<!--END-->
<?php if(isset($_GET['select_city'])){?>
    <?php $lists_favorite_home = getAllListingFavoritelisting($select_city,$select_reg_sub,$select_cate);?>
    <?php if ($lists_favorite_home->num_rows > 0) {?>
        <section>
            <div class="str str-full">
                <div class="container">
                    <div class="row">
                        <div class="home-tit" style="padding-top: 20px;">
                            <h2><span><?php echo $BIZBOOK['HOM-TOPSER-TIT']; ?></span></h2>
                        </div>
                        <div class="ho-popu-bod">
                            <?php
                            $vi = 1;
                            foreach ($lists_favorite_home as $list_favorite_home) {

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
                                <div class="col-md-3">
                                    <div class="hot-page2-hom-pre">
                                        <ul>
                                            <li>
                                                <div class="hot-page2-hom-pre-1"><img
                                                        src="<?php if ($list_favorite_home['profile_image'] != NULL || !empty($list_favorite_home['profile_image'])) {
                                                            echo "images/listings/" . $list_favorite_home['profile_image'];
                                                        } else {
                                                            echo "images/listings/hot4.jpg";
                                                        } ?>" title="<?php echo $list_favorite_home['listing_name']; ?>" alt="<?php echo $list_favorite_home['listing_name']; ?>">
                                                </div>
                                                <div class="hot-page2-hom-pre-2">
                                                    <h5><?php echo $list_favorite_home['listing_name']; ?></h5>
                                                    <span><?php echo $list_favorite_home['listing_address']; ?></span>
                                                </div>
                                                <?php if ($star_rate != 0) { ?>
                                                    <div class="hot-page2-hom-pre-3"><span><?php echo $star_rate; ?></span>
                                                    </div>
                                                <?php } ?>
                                                <a href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $list_favorite_home['listing_slug']; ?>"
                                                   class="fclick"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--LISTINGS-->
                            <?php
                            }
                            ?>      
                        </div>
                    </div>

                    <hr/>
                </div>
            </div>
        </section>
    <?php }?>
<?php }?>
<?php
//No results found section
/*if (mysqli_num_rows($listings_query) <= 0 && mysqli_num_rows($event_query) <= 0 && mysqli_num_rows($blog_query) <= 0 && mysqli_num_rows($product_query) <= 0 || $select_search == NULL || empty($select_search)) {
   ?>
    <div class="container">Oops!!! No result(s) Found for <b><?php echo $select_search; ?></b>. Please try with other!!!</div>
    <?php
}
else {
    $count = mysqli_num_rows($listings_query) + mysqli_num_rows($event_query) +  mysqli_num_rows($blog_query) +   mysqli_num_rows($product_query);
    ?>
    <div class="container ser-re-hu">Hurray!!! <?php echo $count; ?> result(s) Found for <b><?php echo $select_search; ?></b>.</div>
    <?php
}*/
?>


<!-- START -->
<section class="<?php if ($footer_row['admin_language'] == 2) {
    echo "lg-arb";
} ?> event-body ser-resu">
    <div class="container">
        <div class="">
            <ul id="intseres">

                <?php
                //                <!--                //Listing search print starts-->
                if (mysqli_num_rows($listings_query) > 0) {
                    while ($listings_row = mysqli_fetch_array($listings_query)) {
                        ?>
                        <li>
                            <div class="smbox">
                                <div class="ser0"><img
                                        src="<?php if ($listings_row['profile_image'] != NULL || !empty($listings_row['profile_image'])) {
                                            echo $slash."images/listings/" . $listings_row['profile_image'];
                                        } else {
                                            echo $slash."images/listings/hot4.jpg";
                                        } ?>">
                                </div>
                                <div class="ser1">
                                    <a href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $listings_row['listing_slug']; ?>"><?php echo $listings_row['listing_name']; ?></a>
                                </div>
                                <span class="ser2"><?php echo $BIZBOOK['LISTING'];?></span>
                                <div class="ser3">
                                    <?php
                                    if (strlen($listings_row['listing_description']) >= 50) {
                                        $pos = strpos($listings_row['listing_description'], ' ', 50);
                                        echo substr(stripslashes($listings_row['listing_description']), 0, $pos);
                                    }else{
                                        echo stripslashes($listings_row['listing_description']);
                                    }

                                    ?>

                                </div>
                            <span class="ser4">
                                <a href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $listings_row['listing_slug']; ?>"><?php echo $webpage_full_link; ?>anuncio/<?php echo $listings_row['listing_slug']; ?></a>
                            </span>
                            </div>
                        </li>
                        <?php
                    }
                }
                //                <!--                //Listing search print ends-->

                //                <!--                //Event search print starts-->


                if (mysqli_num_rows($event_query) > 0) {
                    while ($events_row = mysqli_fetch_array($event_query)) {
                        ?>
                        <li>
                            <div class="smbox">
                                <div class="ser0">
                                    <img src="images/events/<?php echo $events_row['event_image']; ?>" title="<?php echo $events_row['event_name']; ?>" alt="<?php echo $events_row['event_name']; ?>">
                                </div>
                                <div class="ser1">
                                    <a href="<?php echo $webpage_full_link; ?>evento/<?php echo $events_row['event_slug']; ?>"><?php echo $events_row['event_name']; ?></a>
                                </div>
                                <span class="ser2 ser-ev"><?php echo $BIZBOOK['EVENT'];?></span>
                                <div class="ser3">

                                    <?php
                                    if (strlen($events_row['event_description']) >= 50) {
                                        $pos = strpos($events_row['event_description'], ' ', 50);
                                        echo substr(stripslashes($events_row['event_description']), 0, $pos);
                                    } else {
                                        echo stripslashes($events_row['event_description']);
                                    }
                                    ?>
                                </div>
                            <span class="ser4">
                                <a href="<?php echo $webpage_full_link; ?>evento/<?php echo $events_row['event_slug']; ?>"><?php echo $webpage_full_link; ?>event/<?php echo $events_row['event_slug']; ?></a>
                            </span>
                            </div>
                        </li>
                        <?php
                    }
                }
                //                <!--                //Event search print ends-->

                //                <!--                //Blog search print starts-->

                if (mysqli_num_rows($blog_query) > 0) {
                    while ($blog_row = mysqli_fetch_array($blog_query)) {
                        ?>
                        <li>
                            <div class="smbox">
                                <div class="ser0">
                                    <img src="images/blogs/<?php echo $blog_row['blog_image']; ?>" title="<?php echo $blog_row['blog_name']; ?>" alt="<?php echo $blog_row['blog_name']; ?>">
                                </div>
                                <div class="ser1"><a
                                        href="<?php echo $webpage_full_link; ?>blog/<?php echo $blog_row['blog_slug']; ?>"><?php echo $blog_row['blog_name']; ?></a>
                                </div>
                                <span class="ser2 ser-bl">Blog</span>
                                <div class="ser3">
                                    <?php
                                    if (strlen($blog_row['blog_description']) >= 50) {
                                        $pos = strpos($blog_row['blog_description'], ' ', 50);
                                        echo substr(stripslashes($blog_row['blog_description']), 0, $pos);
                                    }else{
                                        echo stripslashes($blog_row['blog_description']);
                                    }

                                    ?>
                                </div>
                            <span class="ser4">
                                <a href="<?php echo $webpage_full_link; ?>blog/<?php echo $blog_row['blog_slug']; ?>"><?php echo $webpage_full_link; ?>blog/<?php echo $blog_row['blog_slug']; ?></a>
                            </span>
                            </div>
                        </li>
                        <?php
                    }
                }
                //                <!--                //Blog search print ends-->

                //                <!--                //Product search print starts-->

                if (mysqli_num_rows($product_query) > 0) {
                    while ($product_row = mysqli_fetch_array($product_query)) {
                        ?>
                        <li>
                            <div class="smbox">
                                <div class="ser0">
                                    <img src="images/products/<?php echo array_shift(explode(',', $product_row['gallery_image'])); ?>" title="<?php echo $product_row['product_name']; ?>" alt="<?php echo $product_row['product_name']; ?>">
                                </div>
                                <div class="ser1"><a
                                        href="<?php echo $webpage_full_link; ?>product/<?php echo $product_row['product_slug']; ?>"><?php echo $product_row['product_name']; ?></a>
                                </div>
                                <span class="ser2 ser-bl"><?php echo $BIZBOOK['PRODUCT'];?></span>
                                <div class="ser3">
                                    <?php
                                    if (strlen($product_row['product_description']) >= 50) {
                                        $pos = strpos($product_row['product_description'], ' ', 50);
                                        echo substr(stripslashes($product_row['product_description']), 0, $pos);
                                    }else{
                                        echo stripslashes($product_row['product_description']);
                                    }

                                    ?>
                                </div>
                            <span class="ser4">
                                <a href="<?php echo $webpage_full_link; ?>product/<?php echo $product_row['product_slug']; ?>"><?php echo $webpage_full_link; ?>product/<?php echo $product_row['product_slug']; ?></a>
                            </span>
                            </div>
                        </li>
                        <?php
                    }
                }
                //                <!--                //Product search print ends-->

                ?>
            </ul>
        </div>

    </div>
</section>
<!--END-->

<section>
    <div class="pop-ups pop-quo">
        <!-- The Modal -->
        <div class="modal fade" id="quote">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="quote-pop">
                        <h4><?php echo $BIZBOOK['GET_QOUTE'];?></h4>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_NAME'];?>*" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_EMAIL'];?>*"
                                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                       title="<?php echo $BIZBOOK['INVALID_EMAIL'];?>" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_MOBILE'];?> *"
                                       pattern="[0-9]{9}"
                                       title="<?php echo $BIZBOOK['PHONE_NUMBER_STARTING'];?>" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3"
                                          placeholder="<?php echo $BIZBOOK['ENQUIRY_MESSAGE'];?>"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary"><?php echo $BIZBOOK['SUBMIT'];?></button>
                        </form>
                    </div>
                    <div class="log-bor">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include "footer.php";
?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo $slash;?>js/jquery.min.js"></script>
<script src="<?php echo $slash;?>js/popper.min.js"></script>
<script src="<?php echo $slash;?>js/bootstrap.min.js"></script>
<script src="<?php echo $slash;?>js/jquery-ui.js"></script>
<script src="<?php echo $slash;?>js/custom.js"></script>
</body>

</html>