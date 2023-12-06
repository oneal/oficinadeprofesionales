<?php

//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}

$category_id = $_POST['category_id'];


//get matched data from Sub - category table

if (getCountCategoryCategory($category_id) <= 0) {
    ?>
    <div class="row">
        <h1><?php echo $BIZBOOK['ALL__CATEGORY'];?></h1>

        <ul>
            <li><a href="<?php echo $slash;?>">Home</a></li>
            <li><a href="<?php echo $slash;?>anuncios"><?php echo $BIZBOOK['ALL__CATEGORY'];?></a></li>

        </ul>
    </div>
    <?php
} else {
    ?>

    <div class="row">
        <?php
        $category_name = getCategoryName($category_id);
        ?>
        <h1><?php echo $category_name; ?></h1>

        <ul>
            <li><a href="<?php echo $slash;?>">Home</a></li>
            <li><a href="<?php echo $slash;?>anuncios"><?php echo $BIZBOOK['ALL__CATEGORY'];?></a></li>
            <li>
                <a href="<?php echo $slash;?>anuncios/<?php echo $category_name; ?>"><?php echo $category_name; ?></a>
            </li>

        </ul>
    </div>

<?php /*
    <!--    <div class="sub_cat_section filt-com lhs-sub">-->
    <!--        <h4>Sub category</h4>-->
    <!--        <ul>-->
    <!--            --><?php
//            foreach (getCategorySubCategories($category_id) as $sub_category_row) {
//
//                ?>
    <!---->
    <!--                <li>-->
    <!--                    <div class="chbox">-->
    <!--                        <input type="checkbox" class="sub_cat_check" name="sub_cat_check"-->
    <!--                               value="--><?php //echo $sub_category_row['sub_category_id']; ?><!--"-->
    <!--                               id="--><?php //echo $sub_category_row['sub_category_name']; ?><!--"/>-->
    <!--                        <label-->
    <!--                            for="--><?php //echo $sub_category_row['sub_category_name']; ?><!--">--><?php //echo $sub_category_row['sub_category_name']; ?><!--</label>-->
    <!--                    </div>-->
    <!--                </li>-->
    <!---->
    <!--                --><?php
//            }
//            ?>
    <!--        </ul>-->
    <!--    </div>-->*/?>
    <?php

}

?>

