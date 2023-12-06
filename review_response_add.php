<?php
if(file_exists('config/info.php'))
{
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['review_response_submit'])) {

        $review_id = $_POST['review_id'];
        $review_response_message = $_POST['review_response_message'];
        
        if($review_response_message != ""){
        
            $review_row = getReview($review_id);
            $user_id = $_SESSION['user_id'];

            if($review_row){
                
                $curDate = date("Y-m-d H:i:s", time());

                $review_qry = "INSERT INTO " . TBL . "review_response 
                                                    (review_id, user_id, response_message, response_cdt) 
                                                    VALUES 
                                                    ('$review_id', '$user_id', '$review_response_message', '$curDate')";

                $review_res = mysqli_query($conn,$review_qry);

                if ($review_res) {
                    
                    $admin_primary_email_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
                    $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
                    $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
                    $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
                    $admin_site_name = $admin_primary_email_fetchrow['website_address'];
                    $admin_address = $admin_primary_email_fetchrow['footer_address'];
                    
                    $review_email = $review_row['review_email'];
                    $review_name = $review_row['review_name'];
                    $review_mobile = $review_row['review_mobile'];
                    $review_message = $review_row['review_message'];
                    $review_city = $review_row['review_city'];
                    
                    $admin_email = $admin_primary_email;
                    
                    $webpage_full_link_with_login = $webpage_full_link. "login";  //URL Login Link
                    
                    $to1 = $review_email;
                    $subject1 = $admin_site_name." - Respuesta a tu reseña";

                    $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 40"); //User mail template fetch
                    $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

                    $mail_template_client = $client_sql_fetch_row['mail_template'];

                    $url_img_datasur = $webpage_full_link . "images/logo-data-sur.png";
                    $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
                    $message1 = stripslashes(str_replace(array('\' . $review_name . \'', '\' . $review_email . \'', '\' . $review_mobile . \'','\' . $review_message . \'','\' . $review_city . \'','\' . $webpage_full_link_with_login . \'','\' . $admin_site_name . \'','\' . $url_img_datasur . \'','\' . $logo . \'','\' . $review_response_message . \''),
                                array('' . $review_name . '', '' . $review_email . '', '' . $review_mobile . '','' . $review_message . '','' . $review_city . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $url_img_datasur . '','' . $logo . '', '' . $review_response_message . ''), $mail_template_client));

                    $headers1 = "From: " . "$admin_email" . "\r\n";
                    $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
                    $headers1 .= "MIME-Version: 1.0\r\n";
                    $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

                    mail($to1, $subject1, $message1, $headers1); //Client email 

                    $_SESSION['status_msg'] = $BIZBOOK['SAVED_SUCCESS'];
                    header('Location: db-review');

                } else {

                    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
                    header('Location: db-review');
                }
            }else{
                $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
                header('Location: db-review');
            }
        }else{
            $_SESSION['status_msg'] = "Debes rellenar el campo respuesta.";
            $url = 'review_response?review='.$review_id;
            header('Location: '.$url);
        }
    }else{
        $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
        header('Location: db-review');
    }
}else{
    $_SESSION['status_msg'] = $BIZBOOK['ERROR'];
    header('Location: db-review');
}