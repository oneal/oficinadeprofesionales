<?php
include "header.php";
?>
    <!-- START -->
<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> blog-head">
    <div class="container">
        <div class="blog-head-inn">
            <h1><?php echo $BIZBOOK['BLOG_POSTS'];?></h1>
        </div>
        <?php /*<div class="ban-search">
            <form>
                <ul>
                    <li class="sr-sea">
                        <input type="text" id="blog-search" class="autocomplete" placeholder="Search blog posts...">
                    </li>
                </ul>
            </form>
        </div>*/?>
    </div>
</section>
	<!--END-->
    
    <!-- START -->
	<section class="<?php if($footer_row['admin_language']== 2){ echo "lg-arb";}?> blog-body">
		<div class="container">
			<div class="us-ppg-com us-ppg-blog">
                <ul id="intseres">
                    <?php
                    $si = 1;
                    foreach (getAllActiveBlogs() as $blogrow) {

                        $user_id = $blogrow['user_id'];

                        $user_details_row = getAdmin($user_id);

                        ?>
                        <li>
                            <div class="pro-eve-box">
                                <div>
                                    <img src="<?php echo $webpage_full_link;?>images/blogs/<?php echo $blogrow['blog_image']; ?>" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">
                                </div>
                                <div>
                                    <p><?php  echo dateFormatconverter($blogrow['blog_cdt']); ?></p>
                                    <h2><?php echo $blogrow['blog_name']; ?></h2>
                                </div>
                                <a href="<?php echo $webpage_full_link; ?>blog/<?php echo $blogrow['blog_slug']; ?>" class="fclick">&nbsp;</a>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                        <?php /*
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/food3.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>Janie hotels and resorts in Indiana</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/bike4.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>Joney bike showroom</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/spa3.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>Lux Facial and Spa</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/re1.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>3BHK flat for sale</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/food2.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>Janie hotels and resorts in Indiana</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/gym1.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>The Real Finness for Womens</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/food3.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>Janie hotels and resorts in Indiana</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/bike4.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>Joney bike showroom</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/spa3.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>Lux Facial and Spa</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/re1.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>3BHK flat for sale</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/food2.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>Janie hotels and resorts in Indiana</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/re1.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>3BHK flat for sale</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/food2.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>Janie hotels and resorts in Indiana</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/gym1.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>The Real Finness for Womens</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <div class="pro-eve-box">-->
<!--                            <div>-->
<!--                                <img src="images/listings/food3.jpg" title="<?php echo $blogrow['blog_name']; ?>" alt="<?php echo $blogrow['blog_name']; ?>">-->
<!--                            </div>-->
<!--                            <div>-->
<!--                                <h2>Janie hotels and resorts in Indiana</h2>-->
<!--                            </div>-->
<!--                            <a href="blog-details.html" class="fclick">&nbsp;</a>-->
<!--                        </div>-->
<!--                    </li>-->*/?>
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
                    <h4>Get quote</h4>
                     <form>
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Enter name*" required>
                        </div>
                         <div class="form-group">
                          <input type="email" class="form-control" placeholder="Enter email*" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" title="Invalid email address" required>
                        </div>
                         <div class="form-group">
                          <input type="text" class="form-control" placeholder="Enter mobile number *" required>
                        </div>
                        <div class="form-group">
                          <textarea class="form-control" rows="3" placeholder="Enter your query or message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>