<?php
include "header.php";
?>

<?php if($admin_row['admin_ads_options'] != 1){
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <section class="login-reg">
                <div class="container">
                    <div class="row">
                        <div class="login-main add-list posr">
                            <div class="log-bor">&nbsp;</div>
                            <span class="udb-inst">Ficha destacada</span>
                            <div class="log log-1">
                                <div class="login">
                                    <h4>Ficha destacada</h4>
                                    <?php include "../page_level_message.php"; ?>
                                    <form name="create_ads_form" id="create_ads_form" method="post" action="" enctype="multipart/form-data">

                                        <?php $id_lis = $_GET['code'];

                                        $sql = "SELECT * FROM  " . TBL . "listings where listing_code='" . $id_lis . "'";
                                        $listing_rs = mysqli_query($conn, $sql);
                                        $listing_row = mysqli_fetch_array($listing_rs);

                                        if(!empty($listing_row)){

                                            $featured_listings_row = NULL;

                                            if($listing_row['featured_listing_id'] > 0){

                                                $featured_listing_id = $listing_row['featured_listing_id'];

                                                $sql = "SELECT * FROM  " . TBL . "featured_listings  where featured_listing_id = ".$featured_listing_id;
                                                $featured_listings_rs = mysqli_query($conn, $sql);
                                                $featured_listings_row = mysqli_fetch_array($featured_listings_rs);

                                                $featured_listing_price_id = $featured_listings_row['featured_listing_price_id'];

                                                $sql = "SELECT * FROM  " . TBL . "featured_listing_price where featured_listing_prices_id = ".$featured_listing_price_id;
                                                $featured_listing_price_rs = mysqli_query($conn, $sql);
                                                $featured_listing_price_row = mysqli_fetch_array($featured_listing_price_rs);
                                            }

                                            $sql = "SELECT * FROM  " . TBL . "featured_listing_price";
                                            $all_featured_listing_price_rs = mysqli_query($conn, $sql);   

                                            $footer_rs = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
                                            $footer_row = mysqli_fetch_array($footer_rs);
                                            if(empty($featured_listings_row)){
                                                $options_features_listing_price = "";
                                                foreach ($all_featured_listing_price_rs as $row) {
                                                    $options_features_listing_price .='<option myTag = "'.$row['price'].'"
                                                                                            value="'.$row['featured_listing_prices_id'].'">'.$row['description'].'('.$row['price']." ". $footer_row['currency_symbol'].'/día)</option>';
                                                }?>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check form-check-inline">
                                                            <input type="checkbox" class="form-check-input" id="featured_invoiceless" name="featured_invoiceless" onclick="check_featured_invoiceless()">
                                                            <label class="form-check-label" for="featured_invoiceless"> Crear destacado sin factura</label>
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group ca-sh-user">
                                                            <select name="all_feature_listing_price_id" required="required" class="form-control" id="adposi">
                                                                <option value=""><?php echo $BIZBOOK['AD_POSITION'];?> *</option>
                                                                <?php echo $options_features_listing_price;?> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END--> 
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                         <input type="text" id="stdate" autocomplete="off" name="ad_start_date" class="form-control" placeholder="<?php echo $BIZBOOK['STAR_DATE'];?> (DD/MM/YYYY)" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                   <div class="col-md-12">
                                                       <div class="form-group">
                                                        <input type="text" id="endate" autocomplete="off" name="ad_end_date" class="form-control" placeholder="<?php echo $BIZBOOK['END_DATE'];?> (DD/MM/YYYY)" required>
                                                       </div>
                                                   </div>
                                                </div>

                                                <div class="row" id="total-ads-cost">
                                                    <div class="col-md-12">
                                                        <div class="ad-pri-cal">
                                                            <ul>
                                                                <li>
                                                                    <div>
                                                                    <span><?php echo $BIZBOOK['TOTAL_DAYS'];?></span>
                                                                    <h5 class="ad-tdays">0</h5>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div>
                                                                    <span><?php echo $BIZBOOK['COST_PER_DAYS'];?></span>
                                                                        <h5><b class="ad-pocost">0</b><?php echo $footer_row['currency_symbol'];?></h5>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div>
                                                                    <span>Tax</span>
                                                                    <h5><b class="ad-tax">0</b><?php echo $footer_row['currency_symbol'];?></h5>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div>
                                                                    <span><?php echo $BIZBOOK['TOTAL_COST'];?></span>
                                                                        <h5><b class="ad-tcost">0</b><?php echo $footer_row['currency_symbol'];?></h5>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-primary" onclick="add_featured_listing(<?php echo $listing_row['listing_id'];?>)">Guardar destacado</button>

                                            <?php }else{?>
                                                <?php if($featured_listings_row['status'] == 'Active'){ 
                                                    $value = "Inactive"; 
                                                }else{ 
                                                    $value = "Active"; 
                                                }
                                                $checked = "";
                                                if($featured_listings_row['status'] == 'Active'){ 
                                                    $checked = "checked";
                                                }?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-check form-check-inline" style="position: absolute; right: 0; top: -93px">
                                                            <input type="checkbox" class="form-check-input" id="featured_listing_status" name="featured_listing_status" value="<?php echo $value;?>" onclick="aprove_featured_listing(<?php echo $listing_row['listing_id'];?>,<?php echo $featured_listings_row['featured_listing_id'];?>)" <?php echo $checked;?>>
                                                            <label class="form-check-label" for="featured_listing_status"> Activo</label>
                                                        </div>
                                                        <p><strong><?php echo $featured_listing_price_row['description'];?></strong></p>
                                                        <p><strong>Fecha inicio:</strong> <?php echo date('d/m/Y', $featured_listings_row['date_start']);?></p>
                                                        <p><strong>Fecha fin:</strong> <?php echo date('d/m/Y', $featured_listings_row['date_end']);?></p>
                                                        <?php if($featured_listings_row['invoice_less'] == 0){?>
                                                            <p><strong>Número de días:</strong> <?php echo $featured_listings_row['featured_total_days'];?> días</p>  
                                                            <p><strong>Coste por día:</strong> <?php echo $featured_listings_row['featured_cost_per_day'];?> €/dia</p>
                                                            <p><strong>Coste total:</strong> <?php echo $featured_listings_row['featured_total_cost'];?> €</p>  
                                                        <?php }?>
                                                        <p>
                                                            <?php if($featured_listings_row['status'] == 'Inactive'){?>
                                                                <button type="button" class="btn btn-danger" title="Quitar destacado" id="btn-del-featured" onclick="del_featured_listing(<?php echo $listing_row['listing_id'];?>);">Quitar destacado</button>
                                                            <?php }?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php }?>
                                                
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a href="admin-all-listings.php" class="skip">Volver al listado de fichas >></a>
                                                </div>
                                            </div>
                                                
                                            
                                            
                                        <?php }?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.min.js"></script>
<script src="js/admin-custom.min.js"></script>
<script src="../js/jquery.number.min.js"></script>
<script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>    

</body>

</html>