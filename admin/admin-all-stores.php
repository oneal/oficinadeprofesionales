<?php
include "header.php";
?>

<?php if($admin_row['admin_store_options'] != 1){
    header("Location: profile.php");
}
?>

<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <div class="ud-cen">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['ALL_STORES'];?></span>
                <div class="ud-cen-s2">
                    <h2><?php echo $BIZBOOK['ALL_STORES'];?></h2>
                    <?php include "../page_level_message.php"; ?>
                    <div class="ad-int-sear">
                        <input type="text" id="pg-sear" placeholder="<?php echo $BIZBOOK['SEARCH'];?>..">
                    </div>
                    <a href="admin-add-new-store.php" class="db-tit-btn"><?php echo $BIZBOOK['ADD_NEW_STORE'];?></a>
                    <table class="responsive-table bordered" id="pg-resu">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th><?php echo $BIZBOOK['NAME'];?></th>
                            <th><?php echo $BIZBOOK['CATEGORY'];?></th>
                            <th><?php echo $BIZBOOK['EDIT'];?></th>
                            <th><?php echo $BIZBOOK['DELETE'];?></th>
                            <th>Fechas destacado</th>
                            <th><?php echo $BIZBOOK['IMPORTANT_LISTING'];?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $si = 1;
                        foreach (getAllStores() as $storerow) {

                            $reviewstore_id = $storerow['store_id'];
                            $user_id = $storerow['user_id'];
                            $category_row = getCategoryStore($storerow['category_id']);

                            ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><img
                                        src="<?php if ($storerow['profile_image'] != NULL || !empty($storerow['profile_image'])) {
                                            echo "../images/stores/" . $storerow['profile_image'];
                                        } else {
                                            echo "../images/stores/hot4.jpg";
                                        } ?>"><?php echo $storerow['store_name']; ?>
                                    <span><?php echo dateFormatconverter($storerow['store_cdt']); ?></span>
                                </td>
                                <td>
                                    <span class="db-list-rat"><?php echo $category_row['category_name']; ?></span>
                                </td>
                                <td><a href="admin-edit-store.php?code=<?php echo $storerow['store_code']; ?>"
                                       class="db-list-edit"><?php echo $BIZBOOK['EDIT'];?></a></td>
                                <td><a href="admin-delete-store.php?code=<?php echo $storerow['store_code']; ?>"
                                       class="db-list-edit"><?php echo $BIZBOOK['DELETE'];?></a></td>
                                <?php if($storerow['featured_store_id'] != 0){
                                    $sql = "SELECT * FROM  " . TBL . "featured_stores  where featured_store_id = ".$storerow['featured_store_id'];
                                    $featured_stores_rs = mysqli_query($conn, $sql);
                                    $featured_stores_row = mysqli_fetch_array($featured_stores_rs);
//                                    $date_start_old = $featured_stores_row['date_start'];
//                                    $timestamp = strtotime($date_start_old);
                                    $date_start = date('d-m-Y', $featured_stores_row['date_start']);
//                                    $date_end_old = $featured_stores_row['date_end'];
//                                    $timestamp1 = strtotime($date_end_old);
                                    $date_end = date('d-m-Y', $featured_stores_row['date_end']);?>
                                    <td>
                                        Fecha inicio:<br/> <?php echo $date_start; ?><br/>Fecha fin:<br/> <?php echo $date_end; ?>
                                    </td>
                                <?php }else{?>
                                    <td>
                                        <br/>
                                    </td>
                                <?php }?>
                                    <td><a href="admin-add-featured-store.php?code=<?php echo $storerow['store_code']; ?>"  title="<?php echo $BIZBOOK['IMPORTANT_LISTING'];?>" class="db-list-edit <?php echo $class_favorite = ($storerow['featured_store_id'] != 0) ? 'favorite-active': '';?>"><?php echo $BIZBOOK['ADD_IMPORTANT'];?></a></td>

                            </tr>
                            <?php
                            $si++;
                        }
                        ?>
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