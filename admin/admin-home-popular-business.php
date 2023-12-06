<?php /*
include "header.php";
?>

<?php if ($admin_row['admin_home_options'] != 1) {
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['POPULAR_BUSINESS'];?></span>
                <div class="ud-cen-s2 hcat-cho">
                    <h2><?php echo $BIZBOOK['POPULAR_BUSINESS'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <table class="responsive-table bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><?php echo $BIZBOOK['LISTING_NAME'];?></th>
                            <th><?php echo $BIZBOOK['EDIT'];?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $si = 1;

                        foreach (getAllFeaturedListing() as $row) {

                            $listing_id = $row['listing_id'];

                            $listing_sql_row = getIdListing($listing_id);

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><?php echo $listing_sql_row['listing_name']; ?></td>
                                <td><a href="admin-home-popular-business-edit.php?row=<?php echo $listing_id; ?>"
                                       class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                            </tr>
                            <?php
                            $si++;
                        }
                        ?>
                            <?php /*
                            <tr>
                                <td>2</td>
                                <td>Guym and fitness</td>
                                <td>
                                   <img src="../images/services/2.jpg" alt=""> 
                                </td>
                                <td><a href="admin-home-category-edit.html" class="db-list-edit">Edit</a></td>
                                                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Hospital and midicals</td>
                                <td>
                                   <img src="../images/services/3.jpg" alt=""> 
                                </td>
                                <td><a href="admin-home-category-edit.html" class="db-list-edit">Edit</a></td>
                                                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Car and bike</td>
                                <td>
                                   <img src="../images/services/4.jpg" alt=""> 
                                </td>
                                <td><a href="admin-home-category-edit.html" class="db-list-edit">Edit</a></td>
                                                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Yoga training</td>
                                <td>
                                   <img src="../images/services/5.jpg" alt=""> 
                                </td>
                                <td><a href="admin-home-category-edit.html" class="db-list-edit">Edit</a></td>
                                                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Education and university</td>
                                <td>
                                   <img src="../images/services/6.jpg" alt=""> 
                                </td>
                                <td><a href="admin-home-category-edit.html" class="db-list-edit">Edit</a></td>
                                                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Real estate</td>
                                <td>
                                   <img src="../images/services/2.jpg" alt=""> 
                                </td>
                                <td><a href="admin-home-category-edit.html" class="db-list-edit">Edit</a></td>
                                                            </tr>
                             <tr>
                                <td>8</td>
                                <td>Tour and travels</td>
                                <td>
                                   <img src="../images/services/1.jpg" alt=""> 
                                </td>
                                <td><a href="admin-home-category-edit.html" class="db-list-edit">Edit</a></td>
                                                            </tr>?>

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

</html>*/