<?php
include "header.php";

if (file_exists('config/user_authentication.php')) {
    include('config/user_authentication.php');
}
include "dashboard_left_pane.php";
?>
    <!--CENTER SECTION-->
    <div class="ud-cen">
        <div class="log-bor">&nbsp;</div>
        <span class="udb-inst"><?php echo $BIZBOOK['ALL_PAYMENT_DETAILS'];?></span>
        <?php
        if ($user_details_row['user_status'] == 'Inactive') {
            ?>
            <div class="log-error use-act-err"><p><?php echo $BIZBOOK['IMPORTANT_PROFILE'];?>.</p></div>
            <?php
        }
        ?>
        <div class="ud-cen-s2">
            <h2><?php echo $BIZBOOK['PAYMENT_DETAILS'];?></h2>
            <?php include "page_level_message.php"; ?>
            <div class="ad-int-sear">
                <input type="text" id="pg-sear-fa" placeholder="<?php echo $BIZBOOK['SEARCH'];?>...">
            </div>
            <table class="responsive-table bordered" id="pg-resu-fa">
                <thead>
                <tr>
                    <th>No</th>
                    <th><?php echo $BIZBOOK['NAME'];?></th>
                    <th>Nº transación</th>
                    <th><?php echo $BIZBOOK['DATE'];?> emisión</th>
                    <th><?php echo $BIZBOOK['DATE'];?> pago</th>
                    <th><?php echo $BIZBOOK['AMOUNT_PAID'];?></th>
                    <th><?php echo $BIZBOOK['PAYMENT_TYPE'];?></th>
                    <th><?php echo $BIZBOOK['DOWNLOAD'];?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $si = 1;
                $session_user_id = $_SESSION['user_id'];
                foreach (getAllUserTransaction($session_user_id) as $row) {
                    $transaction_id = $row['transaction_id'];
                    $status_transaction_row_actual = getStatusTransaction($row['id_status_transaction']);
                    $status_row_actual = getStatus($status_transaction_row_actual['id_status']);
                    
                    if($row['plan_type_id']>0){
                        $transaction_plan_type_id = $row['plan_type_id'];
                        $transaction_user_plan_type = getCreditType($transaction_plan_type_id);
                    }

                    if($row['ad_enquiry_id']>0){
                        $transaction_ad_enquiry_id = $row['ad_enquiry_id'];
                        $row_ad_enquiry = getAdsEnquiry($transaction_ad_enquiry_id);
                        $all_ads_price_id = $row_ad_enquiry['all_ads_price_id'];
                        $transaction_ad_enquiry_type = getAdsPrice($all_ads_price_id);
                    };
                    
                    if($row['featured_listing_id']>0){
                        $transaction_featured_listing_id = $row['featured_listing_id'];

                        $sql = "SELECT * FROM  " . TBL . "featured_listings  where featured_listing_id = ".$transaction_featured_listing_id;
                        $featured_listings_rs = mysqli_query($conn, $sql);
                        $featured_listings_row = mysqli_fetch_array($featured_listings_rs);
                        $featured_listing_price_id = $featured_listings_row['featured_listing_price_id'];

                        $sql = "SELECT * FROM  " . TBL . "featured_listing_price where featured_listing_prices_id = ".$featured_listing_price_id;
                        $featured_listing_price_rs = mysqli_query($conn, $sql);
                        $featured_listing_price_row = mysqli_fetch_array($featured_listing_price_rs);
                    }
                    
                    $user_details1 = getUser($row['user_id']);
                    if($row['method_pay'] == 1){
                        $method_pay = "Transferencia";
                    }else if($row['method_pay'] == 2){
                        $method_pay = "Paypal";
                    }else if($row['method_pay'] == 3){
                        $method_pay = "Stripe";
                    }else if($row['method_pay'] == 4){
                        $method_pay = "Tarjeta";
                    }
                    ?>

                    <tr>
                        <td><?php echo $si; ?></td>
                        <?php if($row['plan_type_id']>0){?>
                            <td><?php echo $transaction_user_plan_type['credit_name']; ?></td>
                        <?php }?>
                        <?php if($row['ad_enquiry_id']>0){?>
                            <td><?php echo $transaction_ad_enquiry_type['ad_price_name'];?></td>
                        <?php }?>
                        <?php if($row['featured_listing_id']>0){?>
                            <td><?php echo $featured_listing_price_row['description'];?></td>
                        <?php }?>
                        <td><?php echo $row['transaction_code']; ?></td>
                        <td><?php echo dateFormatconverter($row['transaction_create_cdt']); ?></td>
                        <td><?php echo dateFormatconverter($row['transaction_pay_cdt']); ?></td>
                        <td><span class="db-list-rat"><?php echo number_format($row['transaction_amount'],2,',','') . '' . $footer_row['currency_symbol']; ?></span></td>
                        <td><span class="db-list-rat"><?php echo $method_pay;?></span><br/><br/>
                            <?php 
                                if($status_row_actual['id'] == 1){
                                    $class_status = 'btn btn-default btn-success';
                                }else if($status_row_actual['id'] == 2){
                                    $class_status = 'btn btn-default btn-warning';
                                }else if($status_row_actual['id'] == 3){
                                    $class_status = 'btn btn-default btn-danger';
                                }
                            ?>
                            <button class="<?php echo $class_status;?>" data-toggle="modal" data-target="#statustransactionsModal<?php echo $transaction_id;?>" style="font-size: 11px;"><?php echo $status_row_actual['description'];?></button>
                        </td>
                        <td>
                            <?php if(!empty($status_row_actual['id'] == 1)){?>
                                <a href="download_invoice_credit_plan.php?transaction_code=<?php echo $row['transaction_code']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DOWNLOAD'];?></a>
                            <?php }?>
                        </td>
                        <div class="modal fade" id="statustransactionsModal<?php echo $transaction_id;?>" tabindex="-1" aria-labelledby="statustransactionsModalLabel<?php echo $transaction_id;?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Estados</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-6 col-6">
                                                <p>Estado</p>
                                            </div>
                                            <div class="col-sm-6 col-6">
                                                <p>Fecha</p>
                                            </div>
                                        </div>
                                        <?php foreach (getAllStatusTransaction($transaction_id) as $row_s) {?>
                                                <?php $status_row = getStatus($row_s['id_status']);?>
                                                <div class="row">
                                                    <div class="col-sm-6 col-6">
                                                        <?php 
                                                            if($status_row['id'] == 1){
                                                                $class_status = 'p-3 mb-2 bg-success text-white';
                                                            }else if($status_row['id'] == 2){
                                                                $class_status = 'p-3 mb-2 bg-warning text-dark';
                                                            }else if($status_row['id'] == 3){
                                                                $class_status = 'p-3 mb-2 bg-danger text-white';
                                                            }
                                                        ?>
                                                        <p class="<?php echo $class_status;?>"><?php echo $status_row['description'];?></p>
                                                    </div>
                                                    <div class="col-sm-6 col-6">
                                                        <?php 
                                                            $phpdate = strtotime( $row_s['status_transaction_cdt'] );
                                                            $date_final = date("d-m-Y H:i:s",$phpdate);
                                                            echo $date_final;
                                                        ?>
                                                    </div>
                                                </div>
                                        <?php }?>
                                    </div>      
                                </div>
                            </div>
                        </div>
                    </tr>
                    <?php
                    $si++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
include "dashboard_right_pane.php";
?>