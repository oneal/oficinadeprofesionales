<?php

//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}

$state_slug = $_POST['select-city'];

$state_sql = "SELECT * FROM  " . TBL . "states where state_slug='" . $state_slug . "'";
$state_rs = mysqli_query($conn, $state_sql);
$state_row = mysqli_fetch_array($state_rs);


$city_sql = "SELECT * FROM  " . TBL . "cities where state_id='" . $state_row['state_id'] . "' ORDER by city_name ASC";
$city_rs = mysqli_query($conn, $city_sql);

if($city_rs->num_rows>0){?>
    <option value=""><?php echo $BIZBOOK['SELECT_YOUR_CITY']?></option>
    <?php while ($city_row = mysqli_fetch_array($city_rs)) {?>
        <option value="<?php echo $city_row['city_slug']; ?>"><?php echo $city_row['city_name']; ?></option>
    <?php }
}else{?>
    <option value=""><?php echo $BIZBOOK['SELECT_YOUR_CITY']?></option>
<?php }?>
