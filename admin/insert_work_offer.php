<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD']=='POST') {

    if (isset($_POST['work_offer_submit'])) {

// Basic Personal Details
        $category_id = $_POST["select-cate"];
        if($category_id == ""){
            $_SESSION['status_msg'] = "Debes seleccionar una categoría";

            header('Location: admin-all-workoffer.php');
        }
        $category_row = getCategoryWokrOffer($category_id);
        $category_name = $category_row['category_name'];

        $state_id = $_POST["select-state"];
        if($state_id == ""){
            $_SESSION['status_msg'] = "Debes seleccionar una comunidad autónoma";

            header('Location: admin-all-workoffer.php');
        }
        $state_row = getState($state_id);
        $state_name = $state_row['state_name'];

        $city_id = $_POST["select-city"];
        if($state_id == ""){
            $_SESSION['status_msg'] = "Debes seleccionar una ciudad";

            header('Location: admin-all-workoffer.php');
        }
        $city_row = getCity($city_id);
        $city_name = $city_row['city_name'];

// Common blog Details
        $work_offers_name = $_POST["work_offer_name"];
        if($work_offers_name == ""){
            $_SESSION['status_msg'] = "Debes introducir un título a tu oferta";

            header('Location: admin-all-workoffer.php');
        }
        $work_offers_description = $_POST["work_offer_description"];
        $work_offers_description = addslashes($work_offers_description);
        $isenquiry_old = $_POST["isenquiry"];

        if($isenquiry_old == "on"){
            $isenquiry = 1;
        }else{
            $isenquiry = 0;
        }

//    Condition to get User Id starts

        $user_id = $_POST['user_id'];

        $user_details_row = getUser($user_id);

        $work_offers_slug = generar_texto_amigable($work_offers_name);
        $work_offer_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "work_offers  WHERE work_offer_slug='" . $work_offers_slug . "' ");

        if (mysqli_num_rows($work_offer_name_exist_check) > 0) {
            $_SESSION['status_msg'] = $BIZBOOK['VALUE_EXIST'];

            header('Location: admin-all-workoffer.php');
            exit;
        }

        $work_offer_code = 'WORK' . substr(sha1(time()), 0, 10);

//    blog Insert Part Starts

        $curDate = date("Y-m-d H:i:s", time());

        $work_offer_image = "";

        $work_offers_status = 'Active';

        $work_offers_qry = "INSERT INTO " . TBL . "work_offers 
					(user_id, work_offer_name, work_offer_description, work_offer_code, category_id, state_id, city_id, work_offer_image, work_offer_status, isenquiry, work_offer_slug, work_offer_cdt) 
					VALUES 
					('$user_id', '$work_offers_name', '$work_offers_description', '$work_offer_code', '$category_id', '$state_id', '$city_id', '$work_offer_image', '$work_offers_status', '$isenquiry', '$work_offers_slug', '$curDate')";

        $work_offers_res = mysqli_query($conn,$work_offers_qry);


        //****************************    Admin Primary email fetch starts    *************************

        $admin_primary_email_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
        $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
        $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
        $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
        $admin_site_name = $admin_primary_email_fetchrow['website_address'];
        $admin_address = $admin_primary_email_fetchrow['footer_address'];

        //****************************    Admin Primary email fetch ends    *************************

        if ($work_offers_res) {

            $admin_email = $admin_primary_email; // Admin Email Id

            $webpage_full_link_with_login = $webpage_full_link. "login";  //URL Login Link

//****************************    Admin email starts    *************************

            $to = $user_details_row['email_id'];
            $subject = $admin_site_name." - Nueva oferta trabajo creada";

            $first_name = $user_details_row['first_name'];

            $admin_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 53"); //admin mail template fetch
            $admin_sql_fetch_row = mysqli_fetch_array($admin_sql_fetch);

            $mail_template_admin = $admin_sql_fetch_row['mail_template'];

            $message1 =   stripslashes(str_replace(array('\' . $admin_site_name . \'', '\' . $work_offers_name . \'', '\' . $work_offers_description . \'', '\' . $category_name . \'', '\' . $state_name . \'', '\' . $city_name . \'', '\' . $first_name . \''),
                array('' . $admin_site_name . '', '' . $work_offers_name . '', '' . $work_offers_description . '', '' . $category_name . '', '' . $state_name . '', '' . $city_name . '', '' . $first_name . '' ), $mail_template_admin));

            $headers = "From: " . "$admin_email" . "\r\n";
            $headers .= "Reply-To: " . "$admin_email" . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";

            mail($to, $subject, $message1, $headers); //admin email

//****************************    client email ends    *************************

            $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];

            header('Location: admin-all-workoffer.php');


        } else {

            $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

            header('Location: admin-all-workoffer.php');
        }

        //    blog Insert Part Ends

    }
}else {

    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];

    header('Location: admin-all-workoffer.php');
}