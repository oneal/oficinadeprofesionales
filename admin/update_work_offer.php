<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['work_offer_submit'])) {

        $work_offer_id = $_POST["work_offer_id"];

        $work_offer = getWorkOffer($work_offer_id);

        $work_offer_code = $work_offer['work_offer_code'];

        $work_offer_image_old = $_POST["work_offer_image_old"];

        $category_id = $_POST["select-cate"];
        if($category_id == ""){
            $_SESSION['status_msg'] = "Debes seleccionar una categoría";

            header("Location: admin-edit-workoffer.php?code=$work_offer_code");
        }
        $state_id = $_POST["select-state"];
        if($state_id == ""){
            $_SESSION['status_msg'] = "Debes seleccionar una comunidad autónoma";

            header("Location: admin-edit-workoffer.php?code=$work_offer_code");
        }
        $city_id = $_POST["select-city"];
        if($state_id == ""){
            $_SESSION['status_msg'] = "Debes seleccionar una ciudad";

            header("Location: admin-edit-workoffer.php?code=$work_offer_code");
        }

// Common blog Details
        $work_offer_name = $_POST["work_offer_name"];
        if($work_offer_name == ""){
            $_SESSION['status_msg'] = "Debes introducir un título a tu oferta";

            header("Location: admin-edit-workoffer.php?code=$work_offer_code");
        }
        $work_offer_description = addslashes($_POST["work_offer_description"]);
        $isenquiry_old = $_POST["isenquiry"];

        if($isenquiry_old == "on"){
            $isenquiry = 1;
        }else{
            $isenquiry = 0;
        }

//    Condition to get User Id starts

        $user_id = $_POST['user_id'];

        $work_offers_slug = generar_texto_amigable($work_offer_name);
        $work_offer_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "work_offers  WHERE work_offer_slug='" . $work_offers_slug . "' AND work_offer_id != " . $work_offer_id);

        if (mysqli_num_rows($work_offer_name_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header("Location: admin-edit-workoffer.php?code=$work_offer_code");
            exit;
        }



        $work_offer_qry =
            "UPDATE  " . TBL . "work_offers  SET user_id='" . $user_id . "', work_offer_name='" . $work_offer_name . "',work_offer_description='" . $work_offer_description . "',  isenquiry='" . $isenquiry . "'
        , work_offer_slug='" . $work_offers_slug . "', category_id='" . $category_id . "', state_id='" . $state_id . "', city_id='" . $city_id . "' where work_offer_id='" . $work_offer_id . "'";

        $work_offer_res = mysqli_query($conn,$work_offer_qry);

        if ($work_offer_res) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];

            header('Location: admin-all-workoffer.php');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header("Location: admin-edit-workoffer.php?code=$work_offer_code");
        }

        //    blog Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-all-workoffer.php');
}