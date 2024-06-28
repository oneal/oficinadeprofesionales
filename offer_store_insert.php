<?php

/**

 * Created by Vignesh.

 * User: Vignesh

 */



include "config/info.php";

if (isset($_POST['offer_submit'])) {

    $curDate = date("Y-m-d H:i:s", time());

    $store_id = $_POST["offer_store_id"];

    if(getCountAllOffersByStore($store_id) < 9) {
        if(!isset($_POST["offer_name"]) || $_POST["offer_name"] === '') {
            $_SESSION['status_msg'] = $BIZBOOK['NAME_IS_REQUIRED'];

            header('Location: create-new-offer-store.php');

            exit;
        }

        if(!isset($_POST["offer_store_id"]) || $_POST["offer_store_id"] == 0) {

            $_SESSION['status_msg'] = "Debes seleccionar un almacen";

            header('Location: create-new-offer-store.php');

            exit;
        }

        $offer_name = $_POST["offer_name"];
        $offer_description = addslashes($_POST["offer_description"]);
        $offer_price = $_POST["offer_price"];
        $offer_discount = $_POST["offer_discount"];
        $offer_warranty = $_POST["offer_warranty"];
        $offer_tags = $_POST["offer_tags"];

        $offer_name_slug = generar_texto_amigable($offer_name);

        $store = getIdStore($store_id);

        $user_id = $store["user_id"];

        $store_id = $store['store_id'];

        if (!empty($_FILES['profile_image']['name'])) {

            $file = generar_texto_amigable_img($_FILES['profile_image']['name']);

            $file_loc = $_FILES['profile_image']['tmp_name'];

            $file_size = $_FILES['profile_image']['size'];

            $file_type = $_FILES['profile_image']['type'];

            $folder = "./images/offers_stores/";

            $new_size = $file_size / 1024;

            $offer_image_temp = $file;

            move_uploaded_file($file_loc, $folder . $offer_image_temp);

            $offer_image = $offer_image_temp;

        }

        $details_id = '';
        if(isset($_POST['details_id'])) {
            foreach ($_POST['details_id'] as $d_id) {
                $details_id .=$d_id.',';
            }
        }

        $details_values = '';
        if(isset($_POST['details_text'])) {
            foreach ($_POST['details_text'] as $d_value) {
                $details_values .=$d_value.',';
            }
        }

        $details_id = substr($details_id, 0, -1);
        $details_values = substr($details_values, 0, -1);

        $store_qry = "INSERT INTO " . TBL . "offers_stores 

					(store_id, user_id, offer_name, offer_description, offer_img, offer_price

					, offer_discount, offer_warranty, details_id, details_values, offer_tags, offer_cdt, offer_slug) 

					VALUES 

					('$store_id', '$user_id', '$offer_name', '$offer_description', '$offer_image', '$offer_price'

					, '$offer_discount', '$offer_warranty', '$details_id', '$details_values', '$offer_tags', '$curDate', '$offer_name_slug')";


        $store_res = mysqli_query($conn,$store_qry);

        $ListingID = mysqli_insert_id($conn);

        $listlastID = $ListingID;



        $ListCode = 'OFFER_' . substr(sha1(time()), 0, 10);



        $lisupqry = "UPDATE " . TBL . "offers_stores 

					  SET offer_code = '$ListCode' 

					  WHERE offer_id = $listlastID";

        $lisupres = mysqli_query($conn,$lisupqry);

        $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];

        header('Location: db-offer-store.php');
    } else {
        $_SESSION['status_msg'] = "Has superado el limite. Has creado 9 ofertas para este almacen. ";

        header('Location: create-new-offer-store.php');
    }

}else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: create-new-offer-store.php');

}

?>