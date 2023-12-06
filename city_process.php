<?php

//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}

$country_id = $_POST['state_id'];



    $city_sql = "SELECT * FROM  " . TBL . "cities where state_id='" . $country_id . "' ORDER by city_name ASC";
    $city_rs = mysqli_query($conn, $city_sql);

    while($city_row = mysqli_fetch_array($city_rs)) {

        ?>

        <option 
            value="<?php echo $city_row['city_id']; ?>"><?php echo $city_row['city_name']; ?></option>

        <?php
}

?>
