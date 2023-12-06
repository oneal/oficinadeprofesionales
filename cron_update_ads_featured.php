<?php

//***************** Important Part Do Not Delete **************************

# Auto Update Of Listing Status when it has expiry dates starts

if (file_exists('config/info.php')) {
    include('config/info.php');
}

function diff_days($start_date,$end_date)
{
    $days = (strtotime($start_date)-strtotime($end_date))/86400;
    $days = abs($days); 
    $days = floor($days);
    return $days;
}

$exp_ads_enquiry_sql = "SELECT * FROM " . TBL . "all_ads_enquiry WHERE ad_enquiry_status = 'Active' AND invoice_less = '0' ORDER BY all_ads_enquiry_id ASC";
$exp_ads_enquiry_rs = mysqli_query($conn,$exp_ads_enquiry_sql);

if($exp_ads_enquiry_rs->num_rows > 0){
    while ($exp_ads_enquiry = mysqli_fetch_array($exp_ads_enquiry_rs)) {
        $actual_date_timestamp = time();
        $ad_end_date = date('d-m-Y',$exp_ads_enquiry['ad_end_date']);
        $actual_date = date('d-m-Y', $actual_date_timestamp);
        //$actual_date = '15-09-2021';
        
        if($actual_date_timestamp<$exp_ads_enquiry['ad_end_date']){
            $diff = diff_days($ad_end_date, $actual_date);

            if($diff >= 15 or $diff >= 5){
                $continue_1 = FALSE;
                $send_email_expired_15_days_1 = 0;
                $send_email_expired_10_days_1 = 0;
                $send_email_expired_5_days_1 = 0;
                $days_1 = 0;
                $date_15_days_1 = date("d-m-Y",strtotime($actual_date."+ 15 days"));
                if($ad_end_date == $date_15_days_1){
                    $email_expired_sql = "SELECT * FROM " . TBL . "mail_send_announce_expired WHERE ads_enquiry_id = ".$exp_ads_enquiry['all_ads_enquiry_id']." and send_email_expired_15_days =1";
                    $email_expired_sql_rs = mysqli_query($conn,$email_expired_sql);
                    if($email_expired_sql_rs->num_rows == 0){
                        $days_1 = 15;
                        $continue_1 = TRUE;
                        $send_email_expired_15_days_1 = 1;
                    }
                }

                $date_10_days_1 = date("d-m-Y",strtotime($actual_date."+ 10 days"));
                if($ad_end_date == $date_10_days_1){
                    $email_expired_sql = "SELECT * FROM " . TBL . "mail_send_announce_expired WHERE ads_enquiry_id = ".$exp_ads_enquiry['all_ads_enquiry_id']." and send_email_expired_10_days =1";
                    $email_expired_sql_rs = mysqli_query($conn,$email_expired_sql);
                    if($email_expired_sql_rs->num_rows == 0){
                        $days_1 = 10;
                        $continue_1 = TRUE;
                        $send_email_expired_10_days_1 = 1;
                    }
                }

                $date_5_days_1 = date("d-m-Y",strtotime($actual_date."+ 5 days"));
                if($ad_end_date == $date_5_days_1){
                    $email_expired_sql = "SELECT * FROM " . TBL . "mail_send_announce_expired WHERE ads_enquiry_id = ".$exp_ads_enquiry['all_ads_enquiry_id']." and send_email_expired_5_days =1";
                    $email_expired_sql_rs = mysqli_query($conn,$email_expired_sql);
                    if($email_expired_sql_rs->num_rows == 0){
                        $days_1 = 5;
                        $continue_1 = TRUE;
                        $send_email_expired_5_days_1 = 1;
                    }
                }
                
                if($continue_1){
                    $ads_enquiry_id = $exp_ads_enquiry['all_ads_enquiry_id'];
                    $user_id = $exp_ads_enquiry['user_id'];

                    $ad_total_days = $exp_ads_enquiry['ad_total_days'];
                    $ad_cost_per_days = $exp_ads_enquiry['ad_cost_per_day'];
                    $ad_total_cost = $exp_ads_enquiry['ad_total_cost'];

                    $curDate = date("Y-m-d H:i:s", time());

                    $ads_price_id = $exp_ads_enquiry['all_ads_price_id'];

                    $start_date = date('d-m-Y', $exp_ads_enquiry['ad_start_date']);
                    $end_date = date('d-m-Y', $exp_ads_enquiry['ad_end_date']);

                    $user_row = getUser($user_id);

                    $ads_price_row = getAdsPrice($ads_price_id);

                    $ad_price_name = $ads_price_row['ad_price_name'];

                    //****************************    Admin Primary email fetch starts    *************************

                    $webpage_full_link_with_login = $webpage_full_link. "login";

                    $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
                    $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
                    $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
                    $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
                    $admin_site_name = $admin_primary_email_fetchrow['website_address'];
                    $admin_address = $admin_primary_email_fetchrow['footer_address'];

                    //****************************    Admin Primary email fetch ends    *************************

                    $admin_email = $admin_primary_email; // Admin Email Id

                    //****************************    Client email starts    *************************

                    $to1 = $user_row['email_id'];
                    $subject1 = $admin_site_name." - Pronto va a caducar tu anuncio";

                    $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 41"); //User mail template fetch
                    $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

                    $mail_template_client = $client_sql_fetch_row['mail_template'];

                    $ads_img = $webpage_full_link . "images/ads/".$exp_ads_enquiry['ad_enquiry_photo'];
                    $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
                    $message1 = stripslashes(str_replace(array('\'.$days.\'', '\' . $ad_price_name . \'', '\' . $start_date . \'','\' . $end_date . \'','\' . $webpage_full_link_with_login . \'','\' . $admin_site_name . \'','\' . $ads_img . \'','\' . $logo . \'', '\' . $ad_total_days . \'', '\' . $ad_cost_per_days . \'', '\' . $ad_total_cost . \''),
                                array(''.$days_1.'', '' . $ad_price_name . '', '' . $start_date . '','' . $end_date . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $ads_img . '','' . $logo . '','' . $ad_total_days . '','' . $ad_cost_per_days . '','' . $ad_total_cost . ''), $mail_template_client));

                    $headers1 = "From: " . "$admin_email" . "\r\n";
                    $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
                    $headers1 .= "MIME-Version: 1.0\r\n";
                    $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

                    $enviado = mail($to1, $subject1, $message1, $headers1); //Client email


                    if($enviado){
                        $transaction_qry = "INSERT INTO " . TBL . "mail_send_announce_expired 
                                                (ads_enquiry_id, user_id, mail_send_cdt,send_email_expired_15_days,send_email_expired_10_days,send_email_expired_5_days) 
                                                VALUES 
                                                ('$ads_enquiry_id', '$user_id', '$curDate', '$send_email_expired_15_days_1', '$send_email_expired_10_days_1', '$send_email_expired_5_days_1')";
                        $transaction_res = mysqli_query($conn,$transaction_qry);
                    }
                }
            }
        }
    }
}

$exp_featured_listing_sql = "SELECT * FROM " . TBL . "featured_listings WHERE status = 'Active' AND invoice_less = '0' ORDER BY featured_listing_id ASC";
$exp_featured_listing_rs = mysqli_query($conn,$exp_featured_listing_sql);

if($exp_featured_listing_rs->num_rows > 0){
    while ($exp_featured_listing = mysqli_fetch_array($exp_featured_listing_rs)) {
        $actual_date_timestamp = time();
        $featured_end_date = date('d-m-Y',$exp_featured_listing['date_end']);        
        $actual_date = date('d-m-Y', $actual_date_timestamp);

        if($actual_date_timestamp<$exp_featured_listing['date_end']){
            $diff = diff_days($featured_end_date,$actual_date);
            if($diff >= 15 or $diff >= 5){
                $continue_2 = FALSE;
                $send_email_expired_15_days_2 = 0;
                $send_email_expired_10_days_2 = 0;
                $send_email_expired_5_days_2 = 0;
                $days_2 = 0;
                $date_15_days_2 = date("d-m-Y",strtotime($actual_date."+ 15 days"));
                if($featured_end_date == $date_15_days_2){
                    $email_expired_sql = "SELECT * FROM " . TBL . "mail_send_announce_expired WHERE featured_listing_id = ".$exp_featured_listing['featured_listing_id']." and send_email_expired_15_days =1";
                    $email_expired_sql_rs = mysqli_query($conn,$email_expired_sql);
                    if($email_expired_sql_rs->num_rows === 0){
                        $days_2 = 15;
                        $continue_2 = TRUE;
                        $send_email_expired_15_days_2 = 1;
                    }
                }

                $date_10_days_2 = date("d-m-Y",strtotime($actual_date."+ 10 days"));
                if($featured_end_date == $date_10_days_2){
                    $email_expired_sql = "SELECT * FROM " . TBL . "mail_send_announce_expired WHERE featured_listing_id = ".$exp_featured_listing['featured_listing_id']." and send_email_expired_10_days = 1";
                    $email_expired_sql_rs = mysqli_query($conn,$email_expired_sql);
                    if($email_expired_sql_rs->num_rows === 0){
                        $days_2 = 10;
                        $continue_2 = TRUE;
                        $send_email_expired_10_days_2 = 1;
                    }
                }

                $date_5_days_2 = date("d-m-Y",strtotime($actual_date."+ 5 days"));
                if($featured_end_date == $date_5_days_2){
                    $email_expired_sql = "SELECT * FROM " . TBL . "mail_send_announce_expired WHERE featured_listing_id = ".$exp_featured_listing['featured_listing_id']." and send_email_expired_5_days = 1";
                    $email_expired_sql_rs = mysqli_query($conn,$email_expired_sql);
                    if($email_expired_sql_rs->num_rows === 0){
                        $days_2 = 5;
                        $continue_2 = TRUE;
                        $send_email_expired_5_days_2 = 1;                        
                    }
                }
                
                if($continue_2){
                    $featured_listing_id = $exp_featured_listing['featured_listing_id'];
                    $listing_id = $exp_featured_listing['listing_id'];
                    
                    $listing_row = getIdListing($listing_id);
                    
                    $user_id = $listing_row['user_id'];
                    $listing_name = $listing_row['listing_name'];

                    $featured_total_days = $exp_featured_listing['featured_total_days'];
                    $featured_cost_per_days = $exp_featured_listing['featured_cost_per_day'];
                    $featured_total_cost = $exp_featured_listing['featured_total_cost'];

                    $curDate = date("Y-m-d H:i:s", time());

                    $featured_listing_price_id = $exp_featured_listing['featured_listing_price_id'];
                    
                    $featured_listing_price_rs = mysqli_query($conn,"SELECT * FROM " . TBL . "featured_listing_price  WHERE featured_listing_prices_id=" . $featured_listing_price_id);
                    $featured_listing_price_row = mysqli_fetch_array($featured_listing_price_rs);

                    $start_date = date('d-m-Y', $exp_featured_listing['date_start']);
                    $end_date = date('d-m-Y', $exp_featured_listing['date_end']);
                    
                    $featured_price_name = $featured_listing_price_row['description'];

                    $user_row = getUser($user_id);

                    //****************************    Admin Primary email fetch starts    *************************

                    $webpage_full_link_with_login = $webpage_full_link. "login";

                    $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
                    $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
                    $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
                    $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
                    $admin_site_name = $admin_primary_email_fetchrow['website_address'];
                    $admin_address = $admin_primary_email_fetchrow['footer_address'];

                    //****************************    Admin Primary email fetch ends    *************************

                    $admin_email = $admin_primary_email; // Admin Email Id

                    //****************************    Client email starts    *************************

                    $to1 = $user_row['email_id'];
                    $subject1 = $admin_site_name." - Pronto va a caducar tu destacado";

                    $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 42"); //User mail template fetch
                    $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

                    $mail_template_client = $client_sql_fetch_row['mail_template'];

                    $ads_img = $webpage_full_link . "images/ads/".$exp_featured_listing['ad_enquiry_photo'];
                    $logo = $webpage_full_link . "images/home/24147logo-blanco.png";
                    $message1 = stripslashes(str_replace(array('\'.$days.\'', '\' . $listing_name . \'', '\' . $featured_price_name . \'', '\' . $start_date . \'','\' . $end_date . \'','\' . $webpage_full_link_with_login . \'','\' . $admin_site_name . \'','\' . $logo . \'', '\' . $featured_total_days . \'', '\' . $featured_cost_per_days . \'', '\' . $featured_total_cost . \''),
                                array(''.$days_2.'', '' . $listing_name . '', '' . $featured_price_name . '', '' . $start_date . '','' . $end_date . '','' . $webpage_full_link_with_login . '','' . $admin_site_name . '','' . $logo . '','' . $featured_total_days . '','' . $featured_cost_per_days . '','' . $featured_total_cost . ''), $mail_template_client));

                    $headers1 = "From: " . "$admin_email" . "\r\n";
                    $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
                    $headers1 .= "MIME-Version: 1.0\r\n";
                    $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

                    $enviado = mail($to1, $subject1, $message1, $headers1); //Client email

                    if($enviado){
                        $transaction_qry = "INSERT INTO " . TBL . "mail_send_announce_expired 
                                                (featured_listing_id, user_id, mail_send_cdt,send_email_expired_15_days,send_email_expired_10_days,send_email_expired_5_days) 
                                                VALUES 
                                                ('$featured_listing_id', '$user_id', '$curDate', '$send_email_expired_15_days_2', '$send_email_expired_10_days_2', '$send_email_expired_5_days_2')";
                        $transaction_res = mysqli_query($conn,$transaction_qry);
                    }
                }
            }
        }
    }
}


# Auto Update Of Listing Status when it has expiry dates ends

//***************** Important Part Do Not Delete **************************