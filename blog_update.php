<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */
/*
if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['blog_submit'])) {

        $blog_id = $_POST["blog_id"];

        $blog_image_old = $_POST["blog_image_old"];


// Basic Personal Details
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $mobile_number = $_POST["mobile_number"];
        $email_id = $_POST["email_id"];

        $register_mode = "Direct";
//        $user_status = "Inactive";

// Common blog Details
        $blog_name = $_POST["blog_name"];
        $blog_description = addslashes($_POST["blog_description"]);
        $isenquiry_old = $_POST["isenquiry"];

        if($isenquiry_old == "on"){
            $isenquiry = 1;
        }else{
            $isenquiry = 0;
        }

// blog Status
//        $blog_status = "Active";
        // $blog_status = "Pending";
        $payment_status = "Pending";

        $blog_type_id = 1;



//    Condition to get User Id starts

        if (isset($_SESSION['user_code']) && !empty($_SESSION['user_code'])) {
            $user_code = $_SESSION['user_code'];
            $user_details = mysqli_query($conn,"SELECT * FROM  " . TBL . "users where user_code='" . $user_code . "'");
            $user_details_row = mysqli_fetch_array($user_details);

            $user_id = $user_details_row['user_id'];  //User Id

            if($user_details_row['user_status'] == 'Active'){
                // Blog Status
                $blog_status = "Active";
            }else{
                // Blog Status
                $blog_status = "Inactive";
            }

        } else {

            $user_status = "Inactive";
            
            $curDate = date("Y-m-d H:i:s", time());

            $qry = "INSERT INTO " . TBL . "users 
					(first_name, last_name, email_id, mobile_number, register_mode, user_status, user_cdt) 
					VALUES ('$first_name', '$last_name', '$email_id', '$mobile_number','$register_mode', '$user_status', '$curDate')";

            $res = mysqli_query($conn,$qry);
            $LID = mysqli_insert_id($conn);
            $lastID = $LID;

            switch (strlen($LID)) {
                case 1:
                    $LID = '00' . $LID;
                    break;
                case 2:
                    $LID = '0' . $LID;
                    break;
                default:
                    $LID = $LID;
                    break;
            }

            $userID = 'USER' . $LID;

            $upqry = "UPDATE " . TBL . "users 
					  SET user_code = '$userID' 
					  WHERE user_id = $lastID";

            //echo $upqry; die();
            $upres = mysqli_query($conn,$upqry);

            $user_id = $lastID; //User Id
// Blog Status
            $blog_status = "Inactive";

        }
//    Condition to get User Id Ends


        if (!empty($_FILES['blog_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['blog_image']['name'];
            $file_loc = $_FILES['blog_image']['tmp_name'];
            $file_size = $_FILES['blog_image']['size'];
            $file_type = $_FILES['blog_image']['type'];
            $folder = "images/blogs/";
            $new_size = $file_size / 1024;
            $new_file_name = strtolower($file);
            $blog_image_old1 = str_replace(' ', '-', $new_file_name);
            move_uploaded_file($file_loc, $folder . $blog_image_old1);
            $blog_image = $blog_image_old1;
        }else {
            $blog_image = $blog_image_old;
        }

        function checkBlogSlug($link,$blog_id, $counter=1){
            global $conn;
            $newLink = $link;
            do{
                $checkLink = mysqli_query($conn, "SELECT blog_id FROM " . TBL . "blogs WHERE blog_slug = '$newLink' AND blog_id != '$blog_id'");
                if(mysqli_num_rows($checkLink) > 0){
                    $newLink = $link.''.$counter;
                    $counter++;
                } else {
                    break;
                }
            } while(1);

            return $newLink;
        }


        $blog_name1 = preg_replace('/[^A-Za-z0-9]/', ' ', $blog_name);
        $blog_slug = checkBlogSlug($blog_name1,$blog_id);


 $blog_qry =
            "UPDATE  " . TBL . "blogs  SET user_id='" . $user_id . "', blog_name='" . $blog_name . "',blog_description='" . $blog_description . "',
      blog_image='" . $blog_image . "', blog_status='" . $blog_status . "',  isenquiry='" . $isenquiry . "'
     , blog_slug='" . $blog_slug . "' where blog_id='" . $blog_id . "'";

    


        $blog_res = mysqli_query($conn,$blog_qry);

        //****************************    Admin Primary email fetch starts    *************************

        $admin_primary_email_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
        $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
        $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
        $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
        $admin_site_name = $admin_primary_email_fetchrow['website_address'];
        $admin_address = $admin_primary_email_fetchrow['footer_address'];

        //****************************    Admin Primary email fetch ends    *************************

        if ($blog_res) {

            $admin_email = $admin_primary_email; // Admin Email Id

            $webpage_full_link_with_login = $webpage_full_link. "login";  //URL Login Link

//****************************    Admin email starts    *************************

            $to = $admin_email;
            $subject = "'.$admin_site_name.' - blog has been updated";

            $admin_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 17 "); //admin mail template fetch
            $admin_sql_fetch_row = mysqli_fetch_array($admin_sql_fetch);

            $mail_template_admin = $admin_sql_fetch_row['mail_template'];

            $message1 =   stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
            ,'\' . $mobile_number . \'', '\' . $blog_name . \'', '\' . $blog_email . \'', '\' . $blog_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'','\'.$webpage_full_link_with_login.\'','\'.$admin_primary_email.\''),
                array(''.$admin_site_name.'', '' . $first_name . '', '' . $email_id . '','' . $mobile_number . '', '' . $blog_name . '', '' . $blog_email . '', '' . $blog_mobile . '', ''.$admin_footer_copyright.'', ''.$admin_address.'', ''.$webpage_full_link.'',''.$webpage_full_link_with_login.'',''.$admin_primary_email.''), $mail_template_admin));


//            $message1 = '<style type="text/css" rel="stylesheet" media="all">
//    /* Base ------------------------------ */
//
//    @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");
//    body{width:100%!important;height:100%;margin:0;-webkit-text-size-adjust:none}
//a{color:#3869D4}
//a img{border:none}
//td{word-break:break-word}
//.preheader{display:none!important;visibility:hidden;mso-hide:all;font-size:1px;line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden}
//body,td,th{font-family:"Nunito Sans",Helvetica,Arial,sans-serif}
//h1{margin-top:0;color:#333;font-size:22px;font-weight:700;text-align:left}
//h2{margin-top:0;color:#333;font-size:16px;font-weight:700;text-align:left}
//h3{margin-top:0;color:#333;font-size:14px;font-weight:700;text-align:left}
//td,th{font-size:16px}
//p,ul,ol,blockquote{margin:.4em 0 1.1875em;font-size:16px;line-height:1.625}
//p.sub{font-size:13px}
//.align-right{text-align:right}
//.align-left{text-align:left}
//.align-center{text-align:center}
//.button{background-color:#3869D4;border-top:10px solid #3869D4;border-right:18px solid #3869D4;border-bottom:10px solid #3869D4;border-left:18px solid #3869D4;display:inline-block;color:#FFF;text-decoration:none;border-radius:3px;box-shadow:0 2px 3px rgba(0,0,0,0.16);-webkit-text-size-adjust:none;box-sizing:border-box}
//.button--green{background-color:#22BC66;border-top:10px solid #22BC66;border-right:18px solid #22BC66;border-bottom:10px solid #22BC66;border-left:18px solid #22BC66}
//.button--red{background-color:#FF6136;border-top:10px solid #FF6136;border-right:18px solid #FF6136;border-bottom:10px solid #FF6136;border-left:18px solid #FF6136}
//@media only screen and (max-width: 500px) {
//.button{width:100%!important;text-align:center!important}
//}
//.attributes{margin:0 0 21px}
//.attributes_content{background-color:#F4F4F7;padding:16px}
//.attributes_item{padding:0}
//.related{width:100%;margin:0;padding:25px 0 0;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0}
//.related_item{padding:10px 0;color:#CBCCCF;font-size:15px;line-height:18px}
//.related_item-title{display:block;margin:.5em 0 0}
//.related_item-thumb{display:block;padding-bottom:10px}
//.related_heading{border-top:1px solid #CBCCCF;text-align:center;padding:25px 0 10px}
//.discount{width:100%;margin:0;padding:24px;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0;background-color:#F4F4F7;border:2px dashed #CBCCCF}
//.discount_heading{text-align:center}
//.discount_body{text-align:center;font-size:15px}
//.social{width:auto}
//.social td{padding:0;width:auto}
//.social_icon{height:20px;margin:0 8px 10px;padding:0}
//.purchase{width:100%;margin:0;padding:35px 0;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0}
//.purchase_content{width:100%;margin:0;padding:25px 0 0;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0}
//.purchase_item{padding:10px 0;color:#51545E;font-size:15px;line-height:18px}
//.purchase_heading{padding-bottom:8px;border-bottom:1px solid #EAEAEC}
//.purchase_heading p{margin:0;color:#85878E;font-size:12px}
//.purchase_footer{padding-top:15px;border-top:1px solid #EAEAEC}
//.purchase_total{margin:0;text-align:right;font-weight:700;color:#333}
//.purchase_total--label{padding:0 15px 0 0}
//body{background-color:#F4F4F7;color:#51545E}
//p{color:#51545E}
//p.sub{color:#6B6E76}
//.email-wrapper{width:100%;margin:0;padding:0;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0;background-color:#F4F4F7}
//.email-content{width:100%;margin:0;padding:0;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0}
//.email-masthead{padding:25px 0;text-align:center}
//.email-masthead_logo{width:94px}
//.email-masthead_name{font-size:16px;font-weight:700;color:#A8AAAF;text-decoration:none;text-shadow:0 1px 0 #fff}
//.email-body{width:100%;margin:0;padding:0;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0;background-color:#FFF}
//.email-body_inner{width:570px;margin:0 auto;padding:0;-premailer-width:570px;-premailer-cellpadding:0;-premailer-cellspacing:0;background-color:#FFF}
//.email-footer{width:570px;margin:0 auto;padding:0;-premailer-width:570px;-premailer-cellpadding:0;-premailer-cellspacing:0;text-align:center}
//.email-footer p{color:#6B6E76}
//.body-action{width:100%;margin:30px auto;padding:0;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0;text-align:center}
//.body-sub{margin-top:25px;padding-top:25px;border-top:1px solid #EAEAEC}
//.content-cell{padding:35px}
//@media only screen and (max-width: 600px) {
//.email-body_inner,.email-footer{width:100%!important}
//}
//@media (prefers-color-scheme: dark) {
//body,.email-body,.email-body_inner,.email-content,.email-wrapper,.email-masthead,.email-footer{background-color:#333!important;color:#FFF!important}
//p,ul,ol,blockquote,h1,h2,h3{color:#FFF!important}
//.attributes_content,.discount{background-color:#222!important}
//.email-masthead_name{text-shadow:none!important}
//}
//    </style>
//
//    <style type="text/css">
//      .f-fallback  {
//        font-family: Arial, sans-serif;
//      }
//    </style>
//
//  </head>
//  <body style="background-color: #F4F4F7;color: #51545E;">
//<span class="preheader">Thanks for trying out '.$admin_site_name.'. We’ve pulled together some information and resources to help you get started.</span>
//<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%;margin: 0;padding: 0;background-color: #F4F4F7;">
//    <tr>
//        <td align="center">
//            <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%;margin: 0;padding: 0;">
//                <tr>
//                    <td class="email-masthead" style="padding: 25px 0;text-align: center;">
//                        <a href="'.$webpage_full_link.'" class="f-fallback email-masthead_name">
//                            '.$admin_site_name.'
//                        </a>
//                    </td>
//                </tr>
//                <!-- Email Body -->
//                <tr>
//                    <td class="email-body" width="100%" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;padding: 0;background-color: #FFF;">
//                        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px;margin: 0 auto;padding: 0;background-color: #FFF;">
//                            <!-- Body content -->
//                            <tr>
//                                <td class="content-cell" style="padding: 35px;">
//                                    <div class="f-fallback">
//                                        <h1>Dear Admin!</h1>
//                                        <p>An Existing ' . $blog_name . '.Blog has been successfully updated.</p>
//                                        <!-- Action -->
//                                        <p>For reference, here\'s the blog information:</p >
//                                        <table class="attributes" width = "100%" cellpadding = "0" cellspacing = "0" role = "presentation" style="margin: 0 0 21px;" >
//                                            <tr >
//                                                <td class="attributes_content" style="background-color: #F4F4F7;padding: 16px;">
//                                                    <table width = "100%" cellpadding = "0" cellspacing = "0" role = "presentation" >
//                                                        <tr >
//                                                            <td class="attributes_item" >
//                                    <span class="f-fallback" >
//              <strong > Blog name:</strong > ' . $blog_name . '
//            </span>
//                                                            </td>
//                                                        </tr>
//                                                        <tr>
//                                                            <td class="attributes_item">
//                                    <span class="f-fallback">
//              <strong>Mobile Number :</strong> ' . $mobile_number . '
//            </span>
//                                                            </td>
//                                                        </tr>
//                                                        <tr>
//                                                            <td class="attributes_item">
//                                    <span class="f-fallback">
//              <strong>Email Id :</strong> ' . $email_id . '
//            </span>
//                                                            </td>
//                                                        </tr>
//                                                    </table>
//                                                </td>
//                                            </tr>
//                                        </table>
//                                    </div>
//                                </td>
//                            </tr>
//                        </table>
//                    </td>
//                </tr>
//                <tr>
//                    <td>
//                        <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px;margin: 0 auto;padding: 0;">
//                            <tr>
//                                <td class="content-cell" align="center">
//                                    <p class="f-fallback sub align-center">&copy; '.$admin_footer_copyright.' '.$admin_site_name.'. All rights reserved.</p>
//                                    <p class="f-fallback sub align-center">
//                                        '.$admin_site_name.'
//                                        <br>'.$admin_address.'
//                                    </p>
//                                </td>
//                            </tr>
//                        </table>
//                    </td>
//                </tr>
//            </table>
//        </td>
//    </tr>
//</table>
//</body>';
/*
            $headers = "From: " . "$email_id" . "\r\n";
            $headers .= "Reply-To: " . "$email_id" . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=utf-8\r\n";


            mail($to, $subject, $message1, $headers); //admin email


//****************************    Admin email ends    *************************

//****************************    Client email starts    *************************

            $to1 = $email_id;
            $subject1 = "'.$admin_site_name.' blog Update Successful";

            $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 16 "); //User mail template fetch
            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

            $mail_template_client = $client_sql_fetch_row['mail_template'];

            $message2 =   stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
            ,'\' . $mobile_number . \'', '\' . $blog_name . \'', '\' . $blog_email . \'', '\' . $blog_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'','\'.$webpage_full_link_with_login.\'','\'.$admin_primary_email.\''),
                array(''.$admin_site_name.'', '' . $first_name . '', '' . $email_id . '','' . $mobile_number . '', '' . $blog_name . '', '' . $blog_email . '', '' . $blog_mobile . '', ''.$admin_footer_copyright.'', ''.$admin_address.'', ''.$webpage_full_link.'',''.$webpage_full_link_with_login.'',''.$admin_primary_email.''), $mail_template_client));


//            $message2 = '<style type="text/css" rel="stylesheet" media="all">
//    /* Base ------------------------------ */
//
//    @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");
//    body{width:100%!important;height:100%;margin:0;-webkit-text-size-adjust:none}
//a{color:#3869D4}
//a img{border:none}
//td{word-break:break-word}
//.preheader{display:none!important;visibility:hidden;mso-hide:all;font-size:1px;line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden}
//body,td,th{font-family:"Nunito Sans",Helvetica,Arial,sans-serif}
//h1{margin-top:0;color:#333;font-size:22px;font-weight:700;text-align:left}
//h2{margin-top:0;color:#333;font-size:16px;font-weight:700;text-align:left}
//h3{margin-top:0;color:#333;font-size:14px;font-weight:700;text-align:left}
//td,th{font-size:16px}
//p,ul,ol,blockquote{margin:.4em 0 1.1875em;font-size:16px;line-height:1.625}
//p.sub{font-size:13px}
//.align-right{text-align:right}
//.align-left{text-align:left}
//.align-center{text-align:center}
//.button{background-color:#3869D4;border-top:10px solid #3869D4;border-right:18px solid #3869D4;border-bottom:10px solid #3869D4;border-left:18px solid #3869D4;display:inline-block;color:#FFF;text-decoration:none;border-radius:3px;box-shadow:0 2px 3px rgba(0,0,0,0.16);-webkit-text-size-adjust:none;box-sizing:border-box}
//.button--green{background-color:#22BC66;border-top:10px solid #22BC66;border-right:18px solid #22BC66;border-bottom:10px solid #22BC66;border-left:18px solid #22BC66}
//.button--red{background-color:#FF6136;border-top:10px solid #FF6136;border-right:18px solid #FF6136;border-bottom:10px solid #FF6136;border-left:18px solid #FF6136}
//@media only screen and (max-width: 500px) {
//.button{width:100%!important;text-align:center!important}
//}
//.attributes{margin:0 0 21px}
//.attributes_content{background-color:#F4F4F7;padding:16px}
//.attributes_item{padding:0}
//.related{width:100%;margin:0;padding:25px 0 0;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0}
//.related_item{padding:10px 0;color:#CBCCCF;font-size:15px;line-height:18px}
//.related_item-title{display:block;margin:.5em 0 0}
//.related_item-thumb{display:block;padding-bottom:10px}
//.related_heading{border-top:1px solid #CBCCCF;text-align:center;padding:25px 0 10px}
//.discount{width:100%;margin:0;padding:24px;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0;background-color:#F4F4F7;border:2px dashed #CBCCCF}
//.discount_heading{text-align:center}
//.discount_body{text-align:center;font-size:15px}
//.social{width:auto}
//.social td{padding:0;width:auto}
//.social_icon{height:20px;margin:0 8px 10px;padding:0}
//.purchase{width:100%;margin:0;padding:35px 0;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0}
//.purchase_content{width:100%;margin:0;padding:25px 0 0;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0}
//.purchase_item{padding:10px 0;color:#51545E;font-size:15px;line-height:18px}
//.purchase_heading{padding-bottom:8px;border-bottom:1px solid #EAEAEC}
//.purchase_heading p{margin:0;color:#85878E;font-size:12px}
//.purchase_footer{padding-top:15px;border-top:1px solid #EAEAEC}
//.purchase_total{margin:0;text-align:right;font-weight:700;color:#333}
//.purchase_total--label{padding:0 15px 0 0}
//body{background-color:#F4F4F7;color:#51545E}
//p{color:#51545E}
//p.sub{color:#6B6E76}
//.email-wrapper{width:100%;margin:0;padding:0;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0;background-color:#F4F4F7}
//.email-content{width:100%;margin:0;padding:0;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0}
//.email-masthead{padding:25px 0;text-align:center}
//.email-masthead_logo{width:94px}
//.email-masthead_name{font-size:16px;font-weight:700;color:#A8AAAF;text-decoration:none;text-shadow:0 1px 0 #fff}
//.email-body{width:100%;margin:0;padding:0;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0;background-color:#FFF}
//.email-body_inner{width:570px;margin:0 auto;padding:0;-premailer-width:570px;-premailer-cellpadding:0;-premailer-cellspacing:0;background-color:#FFF}
//.email-footer{width:570px;margin:0 auto;padding:0;-premailer-width:570px;-premailer-cellpadding:0;-premailer-cellspacing:0;text-align:center}
//.email-footer p{color:#6B6E76}
//.body-action{width:100%;margin:30px auto;padding:0;-premailer-width:100%;-premailer-cellpadding:0;-premailer-cellspacing:0;text-align:center}
//.body-sub{margin-top:25px;padding-top:25px;border-top:1px solid #EAEAEC}
//.content-cell{padding:35px}
//@media only screen and (max-width: 600px) {
//.email-body_inner,.email-footer{width:100%!important}
//}
//@media (prefers-color-scheme: dark) {
//body,.email-body,.email-body_inner,.email-content,.email-wrapper,.email-masthead,.email-footer{background-color:#333!important;color:#FFF!important}
//p,ul,ol,blockquote,h1,h2,h3{color:#FFF!important}
//.attributes_content,.discount{background-color:#222!important}
//.email-masthead_name{text-shadow:none!important}
//}
//    </style>
//
//    <style type="text/css">
//      .f-fallback  {
//        font-family: Arial, sans-serif;
//      }
//    </style>
//
//  </head>
//  <body style="background-color: #F4F4F7;color: #51545E;">
//<span class="preheader">Thanks for trying out '.$admin_site_name.'. We’ve pulled together some information and resources to help you get started.</span>
//<table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%;margin: 0;padding: 0;background-color: #F4F4F7;">
//    <tr>
//        <td align="center">
//            <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
//                <tr>
//                    <td class="email-masthead" style="padding: 25px 0;text-align: center;">
//                        <a href="'.$webpage_full_link.'" class="f-fallback email-masthead_name" style="font-size: 16px;font-weight: 700;color: #A8AAAF;text-decoration: none;text-shadow: 0 1px 0 #fff;">
//                            '.$admin_site_name.'
//                        </a>
//                    </td>
//                </tr>
//                <!-- Email Body -->
//                <tr>
//                    <td class="email-body" width="100%" cellpadding="0" cellspacing="0" style="width: 100%;margin: 0;padding: 0;background-color: #FFF;">
//                        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px;margin: 0 auto;padding: 0;background-color: #FFF;">
//                            <!-- Body content -->
//                            <tr>
//                                <td class="content-cell" style="padding: 35px;">
//                                    <div class="f-fallback">
//                                        <h1>Hi, ' . $first_name . '!</h1>
//                                        <p>Thanks for updating ' . $blog_name . '.Your Blog has been successfully updated.</p>
//                                        <!-- Action -->
//                                        <p>For reference, here\'s your blog information:</p >
//                                        <table class="attributes" width = "100%" cellpadding = "0" cellspacing = "0" role = "presentation" style="margin: 0 0 21px;" >
//                                            <tr >
//                                                <td class="attributes_content" style="background-color: #F4F4F7;padding: 16px;" >
//                                                    <table width = "100%" cellpadding = "0" cellspacing = "0" role = "presentation" >
//                                                        <tr >
//                                                            <td class="attributes_item" style="line-height: 28px;" >
//                                    <span class="f-fallback" >
//              <strong > Blog name:</strong > ' . $blog_name . '
//            </span>
//                                                            </td>
//                                                        </tr>
//                                                        <tr>
//                                                            <td class="attributes_item" style="line-height: 28px;">
//                                    <span class="f-fallback">
//              <strong>Mobile Number :</strong> ' . $blog_mobile . '
//            </span>
//                                                            </td>
//                                                        </tr>
//                                                        <tr>
//                                                            <td class="attributes_item" style="line-height: 28px;">
//                                    <span class="f-fallback">
//              <strong>Email Id :</strong> ' . $blog_email . '
//            </span>
//                                                            </td>
//                                                        </tr>
//                                                    </table>
//                                                </td>
//                                            </tr>
//                                        </table>
//
//                                        <p>You can login into your dashboard then you check all details of Blog.</p>
//                                        <!-- Action -->
//                                        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%;margin: 30px auto;padding: 0;">
//                                            <tr>
//                                                <td align="center">
//                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
//                                                        <tr>
//                                                            <td align="center">
//                                                                <a href="'.$webpage_full_link_with_login.'" class="f-fallback button" target="_blank" style="background-color:#3869D4;border-top:10px solid #3869D4;border-right:18px solid #3869D4;border-bottom:10px solid #3869D4;border-left:18px solid #3869D4;display:inline-block;color:#FFF;text-decoration:none;border-radius:3px;box-shadow:0 2px 3px rgba(0,0,0,0.16);-webkit-text-size-adjust:none;box-sizing:border-box;">Access your dashboard</a>
//                                                            </td>
//                                                        </tr>
//                                                    </table>
//                                                </td>
//                                            </tr>
//                                        </table>
//                                        <p>If you have any questions, feel free to <a href="mailto:{{support_email}}">email our customer success team</a>. (We\'re lightning quick at replying .)</p >
//                                        <p> Thanks,
//                                            <br > '.$admin_site_name.' Team</p>
//                                        <p><strong>P.S.</strong> Need immediate help getting started? Check out our <a href="'.$webpage_full_link.'">help documentation</a>. Or, just reply to this email, the '.$admin_site_name.' support team is always ready to help!</p>
//                                        <!-- Sub copy -->
//                                        <table class="body-sub" role="presentation" style="margin-top: 25px;padding-top: 25px;border-top: 1px solid #EAEAEC;">
//                                            <tr>
//                                                <td>
//                                                    <p class="f-fallback sub">If you’re having trouble with the button above, copy and paste the URL below into your web browser.</p>
//                                                    <p class="f-fallback sub">'.$webpage_full_link.'</p>
//                                                </td>
//                                            </tr>
//                                        </table>
//                                    </div>
//                                </td>
//                            </tr>
//                        </table>
//                    </td>
//                </tr>
//                <tr>
//                    <td>
//                        <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px;margin: 0 auto;padding: 0;">
//                            <tr>
//                                <td class="content-cell" align="center" style="padding: 35px;">
//                                    <p class="f-fallback sub align-center">&copy; '.$admin_footer_copyright.' '.$admin_site_name.'. All rights reserved.</p>
//                                    <p class="f-fallback sub align-center">
//                                        '.$admin_site_name.'
//                                        <br>'.$admin_address.'
//                                    </p>
//                                </td>
//                            </tr>
//                        </table>
//                    </td>
//                </tr>
//            </table>
//        </td>
//    </tr>
//</table>
//</body>';
/*
            $headers1 = "From: " . "$admin_email" . "\r\n";
            $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
            $headers1 .= "MIME-Version: 1.0\r\n";
            $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";


            mail($to1, $subject1, $message2, $headers1); //admin email

//****************************    client email ends    *************************

            if ($blog_type_id == 1) {

                $_SESSION['status_msg'] = "Your Blog has been Updated Successfully!!!";

                header('Location: db-blog-posts');
                exit;
            } else {

                header("Location: paypal_pay?map_id=$blog_id&type_id=$blog_type_id");

                $_SESSION['status_msg'] = "Your Blog has been Updated Successfully!!!";

                //           header('Location: db-payment');

                exit;
            }

//            $_SESSION['status_msg'] = "Your blog has been Updated Successfully!!!";
//
//            header('Location: db-all-blogs');
        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header("Location: edit-blog-post?code=$blog_id");
        }

        //    blog Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: dashboard');
}