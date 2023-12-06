<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

include "config/info.php";
if (isset($_POST['city_submit'])) {

    $cnt = count($_POST['city_name']);
    $country_id = $_POST['country_id'];

// *********** if Count of city name is zero means redirect starts ********

    if($cnt == 0){
        header('Location: admin-add-city.php');
        exit;
    }

// *********** if Count of city name is zero means redirect ends ********

    for ($i = 0; $i < $cnt; $i++) {

        $city_name = $_POST['city_name'][$i];


            
//************ city Name Already Exist Check Starts ***************

        $city_slug = generar_texto_amigable($city_name);
        
        $city_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "cities  WHERE city_slug='" . $city_slug . "' AND state_id='" . $country_id . "' ");

        if (mysqli_num_rows($city_name_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header('Location: admin-add-city.php');
            exit;
        }
        $curDate = date("Y-m-d H:i:s", time());

        $sql = mysqli_query($conn, "INSERT INTO  " . TBL . "cities (city_name,state_id,city_slug,city_cdt)
                            VALUES ('$city_name','$country_id','$city_slug','$curDate')");
        
    }


    if ($sql) {

        $_SESSION['status_msg'] = $BIZBOOK['SUCCESS'];


        header('Location: admin-all-city.php');
        exit;

    } else {


        $_SESSION['status_msg'] = $BIZBOOK['error'];

        header('Location: admin-add-city.php');
        exit;
    }

}
?>