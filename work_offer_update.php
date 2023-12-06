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

        $work_offer_image_old = $_POST["work_offer_image_old"];

        $category_id = $_POST["select-cate"];
        if($category_id == ""){
            $_SESSION['status_msg'] = "Debes seleccionar una categoría";

            header("Location: edit-work-offer?code=$work_offer_id");
        }
        $state_id = $_POST["select-state"];
        if($state_id == ""){
            $_SESSION['status_msg'] = "Debes seleccionar una comunidad autónoma";

            header("Location: edit-work-offer?code=$work_offer_id");
        }
        $city_id = $_POST["select-city"];
        if($state_id == ""){
            $_SESSION['status_msg'] = "Debes seleccionar una ciudad";

            header("Location: edit-work-offer?code=$work_offer_id");
        }

// Common blog Details
        $work_offer_name = $_POST["work_offer_name"];
        if($work_offer_name == ""){
            $_SESSION['status_msg'] = "Debes introducir un título a tu oferta";

            header("Location: edit-work-offer?code=$work_offer_id");
        }
        $work_offer_description = addslashes($_POST["work_offer_description"]);
        $isenquiry_old = $_POST["isenquiry"];

        if($isenquiry_old == "on"){
            $isenquiry = 1;
        }else{
            $isenquiry = 0;
        }

        $work_offer_type_id = 1;
        
//    Condition to get User Id starts

        if (isset($_SESSION['user_code']) && !empty($_SESSION['user_code'])) {
            $user_code = $_SESSION['user_code'];
            $user_details = mysqli_query($conn,"SELECT * FROM  " . TBL . "users where user_code='" . $user_code . "'");
            $user_details_row = mysqli_fetch_array($user_details);

            $user_id = $user_details_row['user_id'];  //User Id

            $work_offers_status = "Active";
        }

        $curDate = date("Y-m-d H:i:s", time());
//    Condition to get User Id Ends

        $work_offers_slug = generar_texto_amigable($work_offer_name);
        $work_offer_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "work_offers  WHERE work_offer_slug='" . $work_offers_slug . "' AND work_offer_id != " . $work_offer_id);

        if (mysqli_num_rows($work_offer_name_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header("Location: edit-work-offer?code=$work_offer_id");
            exit;
        }

        $work_offer_qry =
            "UPDATE  " . TBL . "work_offers  SET user_id='" . $user_id . "', work_offer_name='" . $work_offer_name . "',work_offer_description='" . $work_offer_description . "', work_offer_status='" . $work_offers_status . "',  isenquiry='" . $isenquiry . "'
        , work_offer_slug='" . $work_offers_slug . "', category_id='" . $category_id . "', state_id='" . $state_id . "', city_id='" . $city_id . "' where work_offer_id='" . $work_offer_id . "'";

        $work_offer_res = mysqli_query($conn,$work_offer_qry);

        if ($work_offer_res) {

            $_SESSION['status_msg'] = $BIZBOOK['UPDATE_SUCCESS'];

            header('Location: db-work-offers');
            exit;

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header("Location: edit-work-offer?code=$work_offer_id");
        }

        //    blog Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: dashboard');
}