<?php /*
include "header.php";
if (isset($_SESSION['user_id'])) {
    $session_user_id = $_SESSION['user_id'];
}
$user_details_row = getUser($session_user_id);

$redirect_url = $webpage_full_link.'dashboard';  //Redirect Url

if ($_GET['code'] == NULL && empty($_GET['code'])) {

    header("Location: $redirect_url");
}
//$product_codea = $_GET['code'];

$product_codea1 = str_replace('-', ' ', $_GET['code']);
$product_codea = str_replace('.php', '', $product_codea1);

$productrow = getSlugProduct($product_codea); //To Fetch the product

$product_id = $productrow['product_id'];
$product_user_id = $productrow['user_id'];

$product_category_id = $productrow['category_id'];

$product_category_row = getProductCategory($product_category_id); //Product Category Database Fetch

if ($product_id == NULL && empty($product_id)) {

    header("Location: $redirect_url");  //Redirect When No product Found in Table
}

productpageview($product_id); //Function To Find Page View

$usersqlrow = getUser($product_user_id); // To Fetch particular User Data

$user_plan = $usersqlrow['user_plan'];


$plan_type_row = getPlanType($user_plan); //User Plan Type Database Fetch

?>
<div class="all-list-bre all-pro-bre">
    <div class="container sec-all-list-bre">
        <div class="row">
            <h2><?php echo $product_category_row['category_name']; ?></h2>
            <ul>
                <li><a href="<?php echo $slash; ?>index">Home</a></li>
                <li><a href="<?php echo $slash; ?>all-products">All category</a></li>
                <li><a href="<?php echo $slash; ?>all-products?category=<?php echo preg_replace('/\s+/', '-', strtolower($product_category_row['category_name'])); ?>"><?php echo $product_category_row['category_name']; ?></a></li>
                <li><a href="#"><?php echo $productrow['product_name']; ?></a></li>
            </ul>
        </div>
    </div>
</div>


<!-- START -->
<section class="biz-pro">
    <div class="container">
        <div class="row">
            <div class="col-md-5 lhs">
                <div class="bpro-sli">
                    <div id="demo" class="carousel slide" data-ride="carousel">
                        <!-- The slideshow -->
                        <div class="carousel-inner">
                            <?php
                            $gallery_image_array = $productrow['gallery_image'];
                            $gallery_image = explode(',', $gallery_image_array);
                            ?>
                            <?php

                            $p = 1;
                            foreach ($gallery_image as $item) {

                                ?>
                                <div class="carousel-item <?php if ($p == 1) {
                                    echo "active";
                                } ?>">
                                    <img src="<?php echo $slash; ?>images/products/<?php echo $item; ?>"
                                         alt="<?php echo $item; ?>">
                                </div>
                                <?php
                                $p++;
                            }
                            ?>
                        </div>
                        <?php
                        if (count($gallery_image) > 1) {
                            ?>
                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="biz-pro-btn">
                    <a data-toggle="modal" data-target="#quote" class="btn btn1">Get quote</a>
                    <a <?php if($productrow['product_payment_link'] != NULL ){ ?> target="_blank" href="<?php echo $productrow['product_payment_link']; } else{ echo "#!";} ?>" class="btn btn2">Buy now</a>
                </div>
            </div>
            <div class="col-md-7 rhs">
                <div class="pro-pri-box">
                    <div class="pro-pbox-2">
                        <?php
                        if ($plan_type_row['plan_type_verified'] == '1') {
                            ?>
                            <span class="veri">Verified</span>
                            <?php
                        }
                        ?>
                        <h1><?php echo $productrow['product_name']; ?></h1>
                        <span class="rat">4.0</span>
                        <span
                            class="pro-cost"><?php echo $footer_row['currency_symbol']; ?><?php echo $productrow['product_price']; ?> <?php if ($productrow['product_price_offer'] != NULL) { ?>
                                <b class="pro-off"><?php echo $productrow['product_price_offer']; ?>% off</b><?php } ?></span>
                    </div>
                    <?php if ($productrow['product_highlights'] != NULL) { ?>
                        <div class="pro-pbox-3 pro-pbox-com">
                            <h4>Highlights</h4>
                            <ul>
                                <?php
                                $products_a_row_product_highlights_Array = explode('|', $productrow['product_highlights']);

                                foreach ($products_a_row_product_highlights_Array as $tuple) {
                                    if ($tuple != NULL) {
                                        ?>
                                        <li><?php echo $tuple; ?></li>
                                        <?php
                                    }
                                }
                                ?>
                                <!--                                <li>Carry It Along 2 in 1 Laptop</li>-->
                                <!--                                <li>12.3 inch Quad HD LED Backlit PixelSense</li>-->
                                <!--                                <li>10 Point Multi-touch, 3:2 Aspect Ratio, 267 ppi</li>-->
                                <!--                                <li>Light Laptop without Optical Disk Drive</li>-->
                                <!--                                <li>Windows 10 OS</li>-->
                                <!--                                <li>EMI starting from $50/month</li>-->
                                <!--                                <li>1 Year Onsite Warranty</li>-->
                            </ul>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="pro-pbox-4 pro-pbox-com">
                        <h4>Descriptions</h4>
                        <p><?php echo $productrow['product_description']; ?></p>
                    </div>

                    <?php if ($productrow['product_info_question'] != NULL) { ?>
                        <div class="pro-pbox-5 pro-pbox-com">
                            <h4>Specifications</h4>
                            <ul>
                                <?php
                                $products_a_row_product_info_question_Array = explode(',', $productrow['product_info_question']);
                                $products_a_row_product_info_answer_Array = explode(',', $productrow['product_info_answer']);

                                $zipped = array_map(null, $products_a_row_product_info_question_Array, $products_a_row_product_info_answer_Array);

                                foreach ($zipped as $tuple) {
                                    $tuple[0]; // Info question
                                    $tuple[1]; // Info Answer
                                    if ($tuple[0] != NULL) {
                                        ?>
                                        <li>
                                            <span class="pro-spe-li"><?php echo $tuple[0]; ?></span>:
                                            <span class="pro-spe-po">&nbsp;&nbsp;<?php echo $tuple[1]; ?></span>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                                <!--                                <li>-->
                                <!--                                    <span class="pro-spe-li">-->
                                <!--Sales Package</span>:-->
                                <!--                                    <span class="pro-spe-po">-->
                                <!--2 in 1 Laptop, Power Adaptor, User Guide, Warranty Documents</span>-->
                                <!--                                </li>-->
                                <!--                                <li>-->
                                <!--                                    <span class="pro-spe-li">Model Number</span>:-->
                                <!--                                    <span class="pro-spe-po">M1866</span>-->
                                <!--                                </li>-->
                                <!--                                <li>-->
                                <!--                                    <span class="pro-spe-li">Part Number</span>:-->
                                <!--                                    <span class="pro-spe-po">-->
                                <!--PUV-00028</span>-->
                                <!--                                </li>-->
                                <!--                                <li>-->
                                <!--                                    <span class="pro-spe-li">Series</span>:-->
                                <!--                                    <span class="pro-spe-po">Surface Pro 7</span>-->
                                <!--                                </li>-->
                                <!--                                <li>-->
                                <!--                                    <span class="pro-spe-li">Color</span>:-->
                                <!--                                    <span class="pro-spe-po">Matte Black</span>-->
                                <!--                                </li>-->
                                <!--                                <li>-->
                                <!--                                    <span class="pro-spe-li">Type</span>:-->
                                <!--                                    <span class="pro-spe-po">2 in 1 Laptop</span>-->
                                <!--                                </li>-->
                                <!--                                <li>-->
                                <!--                                    <span class="pro-spe-li">Battery Backup</span>:-->
                                <!--                                    <span class="pro-spe-po">Upto 10.5 hours</span>-->
                                <!--                                </li>-->
                            </ul>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="pro-pbox-7 pro-pbox-com">
                        <h4>Tags</h4>
                        <?php
                        $products_a_row_product_tags_Array = explode(',', $productrow['product_tags']);

                        foreach ($products_a_row_product_tags_Array as $tuple) {
                            if ($tuple != NULL) {
                                ?>
                                <a href="<?php echo $slash; ?>search-results?q=<?php echo $tuple; ?>"><?php echo $tuple; ?></a>
                                <?php
                            }
                        }
                        ?>
                        <!--                        <a href="https://directoryfinder.net/demo/business-directory-template/search-results?q=lorem">Laptops</a>-->
                        <!--                        <a href="https://directoryfinder.net/demo/business-directory-template/search-results?q=lorem">Electronic items</a>-->
                        <!--                        <a href="https://directoryfinder.net/demo/business-directory-template/search-results?q=lorem">Products</a>-->
                        <!--                        <a href="https://directoryfinder.net/demo/business-directory-template/search-results?q=lorem">Microsoft</a>-->
                        <!--                        <a href="https://directoryfinder.net/demo/business-directory-template/search-results?q=lorem">Offers</a>-->
                        <!--                        <a href="https://directoryfinder.net/demo/business-directory-template/search-results?q=lorem">Surface</a>-->
                    </div>
                    <div class="pro-pbox-6 pro-pbox-com">
                        <h4>Created by</h4>
                        <div class="ud-lhs-s1">
                            <img src="<?php echo $slash; ?>images/user/<?php if (($usersqlrow['profile_image'] == NULL) || empty($usersqlrow['profile_image'])) {
                                echo $footer_row['user_default_image'];
                            } else {
                                echo $usersqlrow['profile_image'];
                            } ?>" alt="">
                            <h4><?php echo $usersqlrow['first_name']; ?></h4>
                            <b>Join on <?php $user_date = $usersqlrow['user_cdt'];;
                                $user_date1 = strtotime($user_date);
                                echo date("M Y", $user_date1); ?></b>
                            <a href="<?php echo $webpage_full_link; ?>profile/<?php echo $usersqlrow['user_slug']; ?>" target="_blank" class="fclick">&nbsp;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END-->

<!-- START -->
<section class="eve-deta-body blog-deta-body">
    <div class="container">
        <div class="pro-bot-shar">
            <h4>Share this post</h4>
            <?php
            $product_name_url = preg_replace('/\s+/', '-', strtolower($productrow['product_slug']));
            
            $fb_url = $webpage_full_link . "product/". $product_name_url."?src=facebook";  //URL product Detail  Facebook Link
            $fb_link = urlencode($fb_url);

            $twitter_url = $webpage_full_link . "product/". $product_name_url."?src=twitter";  //URL product Detail Twitter Link
            $twitter_link = urlencode($twitter_url);

            $linkedin_url = $webpage_full_link. "product/". $product_name_url."?src=linkedin";  //URL Product Detail Linkedin Link
            $linkedin_link = urlencode($linkedin_url);

            $whatsapp_url = $webpage_full_link . "product/". $product_name_url."?src=whatsapp";  //URL product Detail Whatsapp Link
            $whatsapp_link = urlencode($whatsapp_url);
            ?>
            <ul>
                <li>
                    <div class="sh-pro-shar sh-pro-face">
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $fb_url; ?>&quote=<?php echo $productrow['product_name']; ?>"><img src="<?php echo $slash; ?>images/social/3.png" alt=""> Facebook</a>
                    </div>
                </li>
                <li>
                    <div class="sh-pro-shar sh-pro-twi">
                        <a target="_blank"
                           href="http://twitter.com/share?text=<?php echo $productrow['product_name']; ?>&url=<?php echo $twitter_link; ?>"><img src="<?php echo $slash; ?>images/social/2.png" alt=""> Twitter</a>
                    </div>
                </li>
                <li>
                    <div class="sh-pro-shar sh-pro-link">
                        <a target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $linkedin_link; ?>"><img src="<?php echo $slash; ?>images/social/1.png" alt=""> Linkedin</a>
                    </div>
                </li>
                <li>
                    <div class="sh-pro-shar sh-pro-what">
                        <a target="_blank"
                           href="whatsapp://send?text=<?php echo $whatsapp_link; ?>"><img src="<?php echo $slash; ?>images/social/6.png" alt=""> WhatsApp</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="pro-rel-pro-box">
            <h4>Related Posts</h4>
            <div class="us-ppg-com us-ppg-blog">
                <ul>
                    <?php
                    $si = 1;
                    foreach (getExceptProduct($product_id) as $productErow) {

                        ?>
                        <li>
                            <div class="pro-eve-box">
                                <div>
                                    <img src="<?php echo $slash; ?>images/products/<?php echo array_shift(explode(',', $productErow['gallery_image'])); ?>" alt="">
                                </div>
                                <div>
                                    <span><?php echo $footer_row['currency_symbol']; ?><?php echo $productErow['product_price']; ?></span>
                                    <h2><?php echo $productErow['product_name']; ?></h2>
                                    <!--                                <p>28800 Orchard Lake Road, Suite 180 Farmington Hills, Los Angeles, USA.</p>-->
                                </div>
                                <a href="<?php echo $webpage_full_link; ?>product/<?php echo preg_replace('/\s+/', '-', strtolower($productErow['product_slug'])); ?>" class="fclick">&nbsp;</a>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                    <!--                    <li>-->
                    <!--                        <div class="pro-eve-box">-->
                    <!--                            <div>-->
                    <!--                                <img src="images/listings/food3.jpg" alt="">-->
                    <!--                            </div>-->
                    <!--                            <div>-->
                    <!--                                <span>28 February</span>-->
                    <!--                                <h2>Food street team dinner</h2>-->
                    <!--                                <p>28800 Orchard Lake Road, Suite 180 Farmington Hills, Los Angeles, USA.</p>-->
                    <!--                            </div>-->
                    <!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
                    <!--                        </div>-->
                    <!--                    </li>-->
                    <!--                    <li>-->
                    <!--                        <div class="pro-eve-box">-->
                    <!--                            <div>-->
                    <!--                                <img src="images/listings/re3.jpg" alt="">-->
                    <!--                            </div>-->
                    <!--                            <div>-->
                    <!--                                <span>28 February</span>-->
                    <!--                                <h2>Food street team dinner</h2>-->
                    <!--                                <p>28800 Orchard Lake Road, Suite 180 Farmington Hills, Los Angeles, USA.</p>-->
                    <!--                            </div>-->
                    <!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
                    <!--                        </div>-->
                    <!--                    </li>-->
                </ul>
            </div>
        </div>
    </div>
</section>
<!--END-->

<?php
include "footer.php";
?>

<section>
    <div class="pop-ups pop-quo">
        <!-- The Modal -->
        <div class="modal fade" id="quote">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
                    <div class="quote-pop">
                        <h4>Get quote</h4>
                        <div id="product_detail_enq_success" class="log" style="display: none;"><p>Your
                                Enquiry Is Submitted Successfully</p>
                        </div>
                        <div id="product_detail_enq_same" class="log" style="display: none;"><p>You cannot make
                                enquiry on your own product</p>
                        </div>
                        <div id="product_detail_enq_fail" class="log" style="display: none;"><p>Something
                                Went Wrong!!!</p>
                        </div>
                        <form method="post" name="product_detail_enquiry_form" id="product_detail_enquiry_form">
                            <input type="hidden" class="form-control" name="product_id"
                                   value="<?php echo $product_id; ?>"
                                   placeholder=""
                                   required>
                            <input type="hidden" class="form-control"
                                   name="listing_user_id"
                                   value="<?php echo $product_user_id; ?>" placeholder=""
                                   required>
                            <input type="hidden" class="form-control"
                                   name="enquiry_sender_id"
                                   value="<?php echo $session_user_id; ?>"
                                   placeholder=""
                                   required>
                            <input type="hidden" class="form-control"
                                   name="enquiry_source"
                                   value="<?php if (isset($_GET["src"])) {
                                       echo $_GET["src"];
                                   } else {
                                       echo "Website";
                                   }; ?>"
                                   placeholder=""
                                   required>
                            <div class="form-group">
                                <input type="text" name="enquiry_name"
                                       value="<?php echo $user_details_row['first_name'] ?>"
                                       required="required" class="form-control"
                                       placeholder="Enter name*">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control"
                                       placeholder="Enter email*" required="required"
                                       value="<?php echo $user_details_row['email_id'] ?>"
                                       name="enquiry_email"
                                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                       title="Invalid email address">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control"
                                       value="<?php echo $user_details_row['mobile_number'] ?>"
                                       name="enquiry_mobile"
                                       placeholder="Enter mobile number *"
                                       pattern="[7-9]{1}[0-9]{9}"
                                       title="Phone number starting with 7-9 and remaing 9 digit with 0-9"
                                       required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="enquiry_message"
                                          placeholder="Enter your query or message"></textarea>
                            </div>
                            <input type="hidden" id="source">
                            <button  <?php if ($session_user_id == NULL || empty($session_user_id)) {
                                ?> disabled="disabled" <?php } ?> type="submit" id="product_detail_enquiry_submit" name="enquiry_submit"
                                                                  class="btn btn-primary"><?php if ($session_user_id == NULL || empty($session_user_id)) {
                                    ?> Log In To Submit <?php }else{ ?>Submit <?php }?>
                            </button>
                        </form>
                    </div>
                    <div class="log-bor">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo $slash; ?>js/jquery.min.js"></script>
<script src="<?php echo $slash; ?>js/popper.min.js"></script>
<script src="<?php echo $slash; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $slash; ?>js/jquery-ui.js"></script>
<script src="<?php echo $slash; ?>js/custom.js"></script>
<script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo $slash; ?>js/custom_validation.js"></script>
<script>


//    <!--Product Enquiry Form Detail Page Ajax Call And Validation starts-->
    $("#product_detail_enquiry_submit").click(function() {
        $("#product_detail_enquiry_form").validate({
            rules: {
                enquiry_name: {required: true},
                enquiry_email: {required: true, email: true},
                enquiry_mobile: {required: true}

            },
            messages: {

                enquiry_name: {required: "Name is Required"},
                enquiry_email: {required: "Email ID is Required"},
                enquiry_mobile: {required: "Mobile Number is Required"}
            },

            submitHandler: function (form) { // for demo
                //form.submit();
                $.ajax({
                    type: "POST",
                    data: $("#product_detail_enquiry_form").serialize(),
                    url: "<?php echo $slash; ?>enquiry_submit.php",
                    cache: true,
                    success: function (html) {
                        // alert(html);
                        if (html == 1) {
                            $("#product_detail_enq_success").show();
                            $("#product_detail_enquiry_form")[0].reset();
                        } else {
                            if (html == 3) {
                                $("#product_detail_enq_same").show();
                                $("#product_detail_enquiry_form")[0].reset();
                            }else {
                                $("#product_detail_enq_fail").show();
                                $("#product_detail_enquiry_form")[0].reset();
                            }
                        }

                    }

                })
            }
        });
    });
    <!--Product Enquiry Form Detail Page Ajax Call And Validation ends-->

</script>
<script>
    //Auto complete For Listing Name and Category Name Starts Top Header Page particularly for All details page

    jQuery(document).ready(function ($) {

        $(function () {
            $.ajax({
                url: '<?php echo $slash; ?>list_category_search.php',
                success: function (response) {

                    var categoryArray = JSON.parse(response);

                    // var dataCountry = {};
                    // for (var i = 0; i < categoryArray.length; i++) {
                    //     dataCountry[categoryArray[i]] = undefined; //categoryArray[i].flag or null
                    // }
                    $('#top-select-search-new.autocomplete').autocomplete({  //Home Page City Search Box
                        source: categoryArray,
                        limit: 10 // The max amount of results that can be shown at once. Default: Infinity.
                    });
                }
            });
        });
    });
</script>
<script>
    //Auto complete For Listing Name and Category Name Starts Top Header Page particularly for All details page

    jQuery(document).ready(function ($) {

        $(function () {
            $.ajax({
                url: '<?php echo $slash; ?>list_category_search.php',
                success: function (response) {

                    var categoryArray = JSON.parse(response);

                    // var dataCountry = {};
                    // for (var i = 0; i < categoryArray.length; i++) {
                    //     dataCountry[categoryArray[i]] = undefined; //categoryArray[i].flag or null
                    // }
                    $('#top-select-search-new.autocomplete').autocomplete({  //Home Page City Search Box
                        source: categoryArray,
                        limit: 10 // The max amount of results that can be shown at once. Default: Infinity.
                    });
                }
            });
        });
    });
</script>
</body>

</html>