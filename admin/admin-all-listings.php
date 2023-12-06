<?php
include "header.php";
?>

<?php if($admin_row['admin_listing_options'] != 1){
    header("Location: profile.php");
}
?>

<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['ALL_LISTING'];?></span>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['ALL_LISTING'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="<?php echo $BIZBOOK['SEARCH'];?>..">
                    </div>
                    <a href="admin-add-new-listings.php" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_LISTING'];?></a>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><?php echo $BIZBOOK['NAME'];?></th>
                            <th><?php echo $BIZBOOK['CATEGORY'];?></th>
                            <th><?php echo $BIZBOOK['RATING'];?></th>
                            <th><?php echo $BIZBOOK['VIEW'];?></th>
                            <th><?php echo $BIZBOOK['CREATED_BY'];?></th>
                            <th><?php echo $BIZBOOK['EDIT'];?></th>
                            <th><?php echo $BIZBOOK['DELETE'];?></th>
                            <th><?php echo $BIZBOOK['PREVIEW'];?></th>
                            <th>Fechas destacado</th>
                            <th><?php echo $BIZBOOK['IMPORTANT_LISTING'];?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $si = 1;
                        foreach (getAllListing() as $listrow) {

                            $reviewlisting_id = $listrow['listing_id'];
                            $user_id = $listrow['user_id'];
                            $category_row = getCategory($listrow['category_id']);
                        
                            foreach (getListingReview($reviewlisting_id) as $Star_rateRow) {
    //                            $Star_rateRow = getListingReview($reviewlisting_id);

                                if ($Star_rateRow["rate_cnt"] > 0) {
                                    $Star_rate_times = $Star_rateRow["rate_cnt"];
                                    $Star_sum_rates = $Star_rateRow["total_rate"];
                                    $star_rate_one = $Star_sum_rates / $Star_rate_times;
                                    //$star_rate_one = (($Star_rate_value)/5)*100;
                                    $star_rate_two = number_format($star_rate_one, 1);
                                    $star_rate = floatval($star_rate_two);

                                } else {
                                    $rate_times = 0;
                                    $rate_value = 0;
                                    $star_rate = 0;
                                }
                            }

                            $user_details_row = getUser($user_id);

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><img
                                        src="<?php if ($listrow['profile_image'] != NULL || !empty($listrow['profile_image'])) {
                                            echo "../images/listings/" . $listrow['profile_image'];
                                        } else {
                                            echo "../images/listings/hot4.jpg";
                                        } ?>"><?php echo $listrow['listing_name']; ?>
                                    <span><?php echo dateFormatconverter($listrow['listing_cdt']); ?></span>
                                </td>
                                <td>
                                    <span class="db-list-rat"><?php echo $category_row['category_name']; ?></span>
                                </td>
                                <td><span class="db-list-rat"><?php echo $star_rate; ?></span></td>
                                <td><span
                                        class="db-list-rat"><?php echo pageview_count($listrow['listing_id']); ?></span>
                                </td>
                                <td><a href="<?php echo $webpage_full_link; ?>profesional/<?php echo $user_details_row['user_slug']; ?>"
                                       class="db-list-ststus"
                                       target="_blank"><?php echo $user_details_row['first_name'] ?></a></td>
                                <td><a href="admin-edit-listings.php?code=<?php echo $listrow['listing_code']; ?>"
                                       class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                <td><a href="admin-delete-listings.php?code=<?php echo $listrow['listing_code']; ?>"
                                       class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
                                <td><a href="<?php echo $webpage_full_link; ?>anuncio/<?php echo $listrow['listing_slug']; ?>" class="db-list-edit" target="_blank"><?php echo $BIZBOOK['PREVIEW'];?></a></td>
                                <?php if($listrow['featured_listing_id'] != 0){
                                    $sql = "SELECT * FROM  " . TBL . "featured_listings  where featured_listing_id = ".$listrow['featured_listing_id'];
                                    $featured_listings_rs = mysqli_query($conn, $sql);
                                    $featured_listings_row = mysqli_fetch_array($featured_listings_rs);
//                                    $date_start_old = $featured_listings_row['date_start'];
//                                    $timestamp = strtotime($date_start_old);
                                    $date_start = date('d-m-Y', $featured_listings_row['date_start']);
//                                    $date_end_old = $featured_listings_row['date_end'];
//                                    $timestamp1 = strtotime($date_end_old);
                                    $date_end = date('d-m-Y', $featured_listings_row['date_end']);?>
                                    <td>
                                        Fecha inicio:<br/> <?php echo $date_start; ?><br/>Fecha fin:<br/> <?php echo $date_end; ?>
                                    </td>
                                <?php }else{?>
                                    <td>
                                        <br/>
                                    </td>
                                <?php }?>
                                <?php /*<td><a href="javascript:void(0)" id="favorite-listing-<?= $listrow['listing_id'];?>" onclick="open_modal_featured_listing(<?= $listrow['listing_id'];?>)" title="<?php echo $BIZBOOK['IMPORTANT_LISTING'];?>" class="db-list-edit <?php echo $class_favorite = ($listrow['featured_listing_id'] != 0) ? 'favorite-active': '';?>"><?php echo $BIZBOOK['ADD_IMPORTANT'];?></a></td>*/?>
                                    <td><a href="admin-add-featured-listing.php?code=<?php echo $listrow['listing_code']; ?>"  title="<?php echo $BIZBOOK['IMPORTANT_LISTING'];?>" class="db-list-edit <?php echo $class_favorite = ($listrow['featured_listing_id'] != 0) ? 'favorite-active': '';?>"><?php echo $BIZBOOK['ADD_IMPORTANT'];?></a></td>
                            </tr>
                            <?php
                            $si++;
                        }
                        ?>
                            <?php /*
                        								<tr>
                                                            <td>2</td>
                        									<td><img src="../images/listings/car3.jpg" alt="">National Auto Care <span>28 Feb 2019</span></td>
                        									<td><span class="db-list-rat">3.5</span></td>
                        									<td><span class="db-list-rat">12</span></td>
                                                            <td><a href="../profile.php" class="db-list-ststus" target="_blank">John smith</a></td>
                        									<td><a href="admin-edit-listings.html" class="db-list-edit">Edit</a></td>
                        									<td><span class="db-list-edit">Delete</span></td>
                        									<td><a href="../listing-details.html" class="db-list-edit" target="_blank">Preview</a></td>
                        								</tr>
                        								<tr>
                                                            <td>3</td>
                                                            <td><img src="../images/listings/spa3.jpg" alt=""> Pearl Perfumes <span>04 Mar 2019</span></td>
                        									<td><span class="db-list-rat">3.8</span></td>
                        									<td><span class="db-list-rat">232</span></td><td><a href="../profile.php" class="db-list-ststus" target="_blank">William</a></td>
                        									<td><a href="admin-edit-listings.html" class="db-list-edit">Edit</a></td>
                        									<td><span class="db-list-edit">Delete</span></td>
                        									<td><a href="../listing-details.html" class="db-list-edit" target="_blank">Preview</a></td>
                        								</tr>
                        								<tr>
                                                            <td>4</td>
                                                            <td><img src="../images/listings/car4.jpg" alt=""> MG SUV Cars <span>04 Mar 2019</span></td>
                        									<td><span class="db-list-rat">4.2</span></td>
                        									<td><span class="db-list-rat">232</span></td>
                        									<td><a href="../profile.php" class="db-list-ststus" target="_blank">Peter parker</a></td>
                        									<td><a href="admin-edit-listings.html" class="db-list-edit">Edit</a></td>
                        									<td><span class="db-list-edit">Delete</span></td>
                        									<td><a href="../listing-details.html" class="db-list-edit" target="_blank">Preview</a></td>
                        								</tr>
                        								<tr>
                                                            <td>5</td>
                                                            <td><img src="../images/listings/bike4.jpg" alt="">Ducati Bike 310 <span>16 March 2018</span></td>
                        									<td><span class="db-list-rat">4.8</span></td>
                        									<td><span class="db-list-rat">1052</span></td>
                        									<td><a href="../profile.php" class="db-list-ststus" target="_blank">Steve jobs</a></td>
                        									<td><a href="admin-edit-listings.html" class="db-list-edit">Edit</a></td>
                        									<td><span class="db-list-edit">Delete</span></td>
                        									<td><a href="../listing-details.html" class="db-list-edit" target="_blank">Preview</a></td>
                        								</tr>
                        								<tr>
                                                            <td>6</td>
                                                            <td><img src="../images/listings/food1.jpg" alt="">Forca hotels and resorts <span>5 May 2016</span></td>
                        									<td><span class="db-list-rat">4.4</span></td>
                        									<td><span class="db-list-rat">1052</span></td>
                        									<td><a href="../profile.php" class="db-list-ststus" target="_blank">Hendry</a></td>
                        									<td><a href="admin-edit-listings.html" class="db-list-edit">Edit</a></td>
                        									<td><span class="db-list-edit">Delete</span></td>
                        									<td><a href="../listing-details.html" class="db-list-edit" target="_blank">Preview</a></td>
                        								</tr>
                        								<tr>
                                                            <td>7</td>
                                                            <td><img src="../images/listings/hot6.jpg" alt="">Taj Luxury Hotel <span>12 Jan 2019</span></td>
                        									<td><span class="db-list-rat">4.2</span></td>
                        									<td><span class="db-list-rat">76</span></td>
                        									<td><a href="../profile.php" class="db-list-ststus" target="_blank">Andru russul</a></td>
                        									<td><a href="admin-edit-listings.html" class="db-list-edit">Edit</a></td>
                        									<td><span class="db-list-edit">Delete</span></td>
                        									<td><a href="../listing-details.html" class="db-list-edit" target="_blank">Preview</a></td>
                        								</tr>
                        								<tr>
                                                            <td>8</td>
                        									<td><img src="../images/listings/re6.jpg" alt="">National Auto Care <span>28 Feb 2019</span></td>
                        									<td><span class="db-list-rat">3.5</span></td>
                        									<td><span class="db-list-rat">12</span></td>
                        									<td><a href="../profile.php" class="db-list-ststus" target="_blank">Liase</a></td>
                        									<td><a href="admin-edit-listings.html" class="db-list-edit">Edit</a></td>
                        									<td><span class="db-list-edit">Delete</span></td>
                        									<td><a href="../listing-details.html" class="db-list-edit" target="_blank">Preview</a></td>
                        								</tr>
                        								<tr>
                                                            <td>9</td>
                                                            <td><img src="../images/listings/re2.jpg" alt=""> Pearl Perfumes <span>04 Mar 2019</span></td>
                        									<td><span class="db-list-rat">3.8</span></td>
                        									<td><span class="db-list-rat">232</span></td>
                        									<td><a href="../profile.php" class="db-list-ststus" target="_blank">Andriya</a></td>
                        									<td><a href="admin-edit-listings.html" class="db-list-edit">Edit</a></td>
                        									<td><span class="db-list-edit">Delete</span></td>
                        									<td><a href="../listing-details.html" class="db-list-edit" target="_blank">Preview</a></td>
                        								</tr>
                        								<tr>
                                                            <td>10</td>
                                                            <td><img src="../images/listings/list1.jpg" alt=""> MG SUV Cars <span>04 Mar 2019</span></td>
                        									<td><span class="db-list-rat">4.2</span></td>
                        									<td><span class="db-list-rat">232</span></td>
                        									<td><a href="../profile.php" class="db-list-ststus" target="_blank">Andriya</a></td>
                        									<td><a href="admin-edit-listings.html" class="db-list-edit">Edit</a></td>
                        									<td><span class="db-list-edit">Delete</span></td>
                        									<td><a href="../listing-details.html" class="db-list-edit" target="_blank">Preview</a></td>
                        								</tr>
                        								<tr>
                                                            <td>11</td>
                                                            <td><img src="../images/listings/spa1.jpg" alt="">Ducati Bike 310 <span>16 March 2018</span></td>
                        									<td><span class="db-list-rat">4.8</span></td>
                        									<td><span class="db-list-rat">1052</span></td>
                        									<td><a href="../profile.php" class="db-list-ststus" target="_blank">Andriya</a></td>
                        									<td><a href="admin-edit-listings.html" class="db-list-edit">Edit</a></td>
                        									<td><span class="db-list-edit">Delete</span></td>
                        									<td><a href="../listing-details.html" class="db-list-edit" target="_blank">Preview</a></td>
                        								</tr>
                        								<tr>
                                                            <td>12</td>
                                                            <td><img src="../images/listings/spa5.jpg" alt="">Forca hotels and resorts <span>5 May 2016</span></td>
                        									<td><span class="db-list-rat">4.4</span></td>
                        									<td><span class="db-list-rat">1052</span></td>
                        									<td><a href="../profile.php" class="db-list-ststus" target="_blank">Andriya</a></td>
                        									<td><a href="admin-edit-listings.html" class="db-list-edit">Edit</a></td>
                        									<td><span class="db-list-edit">Delete</span></td>
                        									<td><a href="../listing-details.html" class="db-list-edit" target="_blank">Preview</a></td>
                        								</tr>*/?>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="ad-pgnat">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="js/admin-custom.js"></script> 
<script src="../js/jquery.number.min.js"></script>
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>