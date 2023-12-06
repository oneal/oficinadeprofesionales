<?php
/*
//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}

$category_id = $_POST['category_id'];


//get matched data from Sub - category table

if(getCountProductSubCategoryCategory($category_id) <= 0){
    ?>
    <option value="">No Sub Category Found</option>
    <?php
}else {

    foreach (getCategoryProductSubCategories($category_id) as $sub_categories_row) {

        ?>

        <option <?php if ($_SESSION['sub_category_id'] == $sub_categories_row['sub_category_id']) {
            echo "selected";
        } ?>
            value="<?php echo $sub_categories_row['sub_category_id']; ?>"><?php echo $sub_categories_row['sub_category_name']; ?></option>

        <?php
    }

}

?>
