<?php
//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}

$type = $_POST['type'];
if($type == 1) {
    $category_sql = "SELECT * FROM  " . TBL . "categories ORDER BY category_name ASC";
    $category_rs = mysqli_query($conn, $category_sql);
} else if($type == 2) {
    $category_sql = "SELECT * FROM  " . TBL . "categories_work_offer ORDER BY category_name ASC";
    $category_rs = mysqli_query($conn, $category_sql);
} else if($type == 3) {
    $category_sql = "SELECT * FROM  " . TBL . "categories_stores ORDER BY category_name ASC";
    $category_rs = mysqli_query($conn, $category_sql);
}?>

<div class="row">
    <div class="col-md-12">
        <div class="form-group add-category">
            <select name="all_category" required="required" class="form-control" id="adcategory">
                <?php if($category_rs->num_rows>0){?>
                    <option value="0">Selecciona una categoría</option>
                    <?php while ($category_row = mysqli_fetch_array($category_rs)) {?>
                        <option value="<?php echo $category_row['category_id']; ?>"><?php echo $category_row['category_name']; ?></option>
                    <?php }
                }else{?>
                    <option value="0">Selecciona una categoría</option>
                <?php }?>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group ca-sh-user">
            <select name="all_ads_price_id" required="required" class="form-control" id="adposi">
                <option value=""><?php echo $BIZBOOK['AD_POSITION'];?> *</option>
                <?php
                foreach (getAllActiveAdsPrice() as $row) {
                    if(strpos($row['type'], $type) !== FALSE) {?>
                            <option myTag = "<?php echo $row['ad_price_cost']; ?>"
                                    value="<?php echo $row['all_ads_price_id']; ?>"><?php echo $row['ad_price_name']; ?> (<?php echo $row['ad_price_cost']; ?><?php echo $footer_row['currency_symbol']; ?>/por día)</option>
                            <?php
                    }
                }
                ?>
            </select>
            <?php /*<a href="../ad-details.php" class="frmtip" target="_blank"><?php echo $BIZBOOK['PRICING_DETAILS'];?></a>*/?>
        </div>
    </div>
</div>
