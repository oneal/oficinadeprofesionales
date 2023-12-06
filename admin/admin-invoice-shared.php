<?php
include "header.php";
?>
<?php if ($admin_row['admin_invoice_options'] != 1) {
    header("Location: profile.php");
}
?>
    <!-- START -->
    <section>
        <div class="ad-com">
            <div class="ad-dash leftpadd">
                <div class="ud-cen">
                    <div class="log-bor">&nbsp;</div>
                    <span class="udb-inst"><?php echo $BIZBOOK['SHARE_INVOICES'];?></span>
                    <div class="ud-cen-s2">
                        <h2><?php echo $BIZBOOK['SHARE_INVOICES'];?></h2>
                        <?php include "../page_level_message.php"; ?>
                        <div class="ad-int-sear">
                            <input type="text" id="pg-sear" placeholder="<?php echo $BIZBOOK['SEARCH'];?>...">
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <?php /*<a href="admin-invoice-create.php" class="db-tit-btn" style="position: initial;"><?php echo $BIZBOOK['CREATE_INVOICE'];?></a>*/?>
                                <a href="#" class="db-tit-btn" data-toggle="modal" data-target="#exportInvoiceModal" style="position: initial;">Exportar facturas</a>
                            </div>
                        </div>
                        <table class="responsive-table bordered" id="pg-resu">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th><?php echo $BIZBOOK['NAME'];?></th>
                                    <th>NºTrans</th>
                                    <th>Id. Usuario</th>
                                    <th>Concepto</th>
                                    <th>Cantidad</th>
                                    <th><?php echo $BIZBOOK['AMOUNT_PAID'];?></th>
                                    <th><?php echo $BIZBOOK['DATE'];?> emisión</th>
                                    <th><?php echo $BIZBOOK['DATE'];?> pago</th>
                                    <th><?php echo $BIZBOOK['PAYMENT_TYPE'];?></th>
                                    <th><?php echo $BIZBOOK['DOWNLOAD'];?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $si = 1;
                                    $session_user_id = $_SESSION['user_id'];
                                    foreach (getAllTransaction(0) as $row) {                                        
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
                                        }

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

                                        if($row['featured_store_id']>0){
                                            $transaction_featured_store_id = $row['featured_store_id'];

                                            $sql = "SELECT * FROM  " . TBL . "featured_stores  where featured_store_id = ".$transaction_featured_store_id;
                                            $featured_stores_rs = mysqli_query($conn, $sql);
                                            $featured_stores_row = mysqli_fetch_array($featured_stores_rs);
                                            $featured_store_price_id = $featured_stores_row['featured_store_price_id'];

                                            $sql = "SELECT * FROM  " . TBL . "featured_store_price where featured_listing_prices_id = ".$featured_store_price_id;
                                            $featured_store_price_rs = mysqli_query($conn, $sql);
                                            $featured_store_price_row = mysqli_fetch_array($featured_store_price_rs);
                                        }
                                        $user_details_row = getUser($row['user_id']);
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
                                            <td><img src="../images/user/<?php if(($user_details_row['profile_image'] == NULL) || empty($user_details_row['profile_image'])){  echo $footer_row['user_default_image'];}else{ echo $user_details_row['profile_image']; } ?>" alt=""><?php echo $user_details_row['first_name']; ?></td>
                                            <td><span class="db-list-rat"><?php echo $row['transaction_code'];?></span></td>
                                            <td><span class="db-list-rat"><?php echo $row['user_code'];?></span></td>
                                            <?php if($row['plan_type_id']>0){?>
                                                <td><span class="db-list-rat"><?php echo $transaction_user_plan_type['credit_name'];?></span></td>
                                                <td><span class="db-list-rat"><?php echo $transaction_user_plan_type['credit_points'];?> cr&eacute;ditos</span></td>
                                            <?php }?>
                                            <?php if($row['ad_enquiry_id']>0){?>
                                                <td><span class="db-list-rat"><?php echo $transaction_ad_enquiry_type['ad_price_name'];?></span></td>
                                                <td><span class="db-list-rat"><?php echo $row_ad_enquiry['ad_total_days'];?> días</span></td>
                                            <?php }?>
                                            <?php if($row['featured_listing_id']>0){?>
                                                <td>
                                                    <span class="db-list-rat"><?php echo $featured_listing_price_row['description'];?></span>
                                                    
                                                </td>
                                                <td><span class="db-list-rat"><?php echo $featured_listings_row['featured_total_days'];?> días</span></td>
                                            <?php }?>
                                            <?php if($row['featured_store_id']>0){?>
                                                <td>
                                                    <span class="db-list-rat"><?php echo $featured_store_price_row['description'];?></span>

                                                </td>
                                                <td><span class="db-list-rat"><?php echo $featured_stores_row['featured_total_days'];?> días</span></td>
                                            <?php }?>
                                            <?php if($row['plan_type_id']>0){?>
                                                <td><span class="db-list-rat"><?php echo number_format($row['transaction_amount'],2,',',''). '' .$footer_row['currency_symbol']; ?></span></td>
                                            <?php }?>
                                            <?php if($row['ad_enquiry_id']>0){?>
                                                <td><span class="db-list-rat"><?php echo number_format($row_ad_enquiry['ad_cost_per_day'],2,',',''). '' .$footer_row['currency_symbol']; ?>/día</span></td>
                                            <?php }?>
                                            <?php if($row['featured_listing_id']>0){?>
                                                <td><span class="db-list-rat"><?php echo number_format($featured_listings_row['featured_cost_per_day'],2,',',''). '' .$footer_row['currency_symbol']; ?>/día</span></td>
                                            <?php }?>
                                            <?php if($row['featured_store_id']>0){?>
                                                <td><span class="db-list-rat"><?php echo number_format($featured_stores_row['featured_cost_per_day'],2,',',''). '' .$footer_row['currency_symbol']; ?>/día</span></td>
                                            <?php }?>
                                            <td><?php echo dateFormatconverter($row['transaction_create_cdt']); ?></td>
                                            <td><?php echo dateFormatconverter($row['transaction_pay_cdt']); ?></td>
                                            <td>
                                                <span class="db-list-rat"><?php echo $method_pay;?></span><br/><br/>
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
                                                <a href="download_invoice_credit_plan.php?transaction_code=<?php echo $row['transaction_code']; ?>" class="db-list-edit"><?php echo $BIZBOOK['DOWNLOAD'];?></a>
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
            </div>
        </div>
    </section>
    
    <?php include 'modal_export_invoice.php';?>
    <!-- END -->    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="js/admin-custom.js"></script>
    <script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>