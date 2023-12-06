<?php
include "header.php";
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['ALL_SLIDER_IMAGES'];?></span>
                <div class="ud-cen-s2 ad-table-inn">
                    <h2><?php echo $BIZBOOK['ALL_SLIDER_IMAGES'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <table class="responsive-table bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Slider</th>
                            <th>Link</th>
                            <th><?php echo $BIZBOOK['EDIT'];?></th>
                            <th><?php echo $BIZBOOK['DELETE'];?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $si =1;
                        foreach (getAllSlider() as $row) {


                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td>
                                    <img src="../images/slider/<?php echo $row['slider_photo']; ?>" title="<?php echo $row['slider_photo']; ?>" alt="<?php echo $row['slider_photo']; ?>">
                                </td>
                                <td><?php echo $row['slider_link']; ?></td>
                                <td><a href="admin-slider-edit.php?row=<?php echo $row['slider_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                <td><a href="admin-slider-delete.php?row=<?php echo $row['slider_id']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
                            </tr>
                            <?php
                            $si++;
                        }
                        ?>
                        <?php /*
                            <tr>
                                <td>2</td>
                                <td>All listing page<br>Top</td>
                                <td>
                                    <img src="../images/ads/ad-size.png" alt="">
                                </td>
                                <td>728 X 90 px</td>
                                <td>50$</td>
                                <td><span class="db-list-rat">Active</span></td>
                                <td><a href="admin-ads-price-edit.html" class="db-list-edit">Edit</a></td>
                            </tr> 
                            <tr>
                                <td>3</td>
                                <td>All listing page<br>Bottom</td>
                                <td>
                                    <img src="../images/ads/ad-size.png" alt="">
                                </td>
                                <td>728 X 90 px</td>
                                <td>40$</td>
                                <td><span class="db-list-rat">Active</span></td>
                                <td><a href="admin-ads-price-edit.html" class="db-list-edit">Edit</a></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>All listing page<br>Left</td>
                                <td>
                                    <img src="../images/ads/ad-size.png" alt="">
                                </td>
                                <td>300 X 300 px</td>
                                <td>45$</td>
                                <td><span class="db-list-rat">Active</span></td>
                                <td><a href="admin-ads-price-edit.html" class="db-list-edit">Edit</a></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Listing detail page<br>Right</td>
                                <td>
                                    <img src="../images/ads/ad-size.png" alt="">
                                </td>
                                <td>300 X 300 px</td>
                                <td>30$</td>
                                <td><span class="db-list-rat">Active</span></td>
                                <td><a href="admin-ads-price-edit.html" class="db-list-edit">Edit</a></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Listing detail page<br>Bottom</td>
                                <td>
                                    <img src="../images/ads/ad-size.png" alt="">
                                </td>
                                <td>728 X 90 px</td>
                                <td>30$</td>
                                <td><span class="db-list-rat">Active</span></td>
                                <td><a href="admin-ads-price-edit.html" class="db-list-edit">Edit</a></td>
                            </tr>*/?>
                        </tbody>
                    </table>
                </div>
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
<script src="js/admin-custom.js"></script> <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>