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
                    <span class="udb-inst"><?php echo $BIZBOOK['EDIT_ADS'];?></span>
                    <div class="log log-1">
                        <div class="login">
                            <h4><?php echo $BIZBOOK['EDIT_ADS'];?></h4>
                            <?php include "../page_level_message.php"; ?>
                            <?php
                                $path = $_GET['path'];
                                $all_ads_enquiry_id = $_GET['row'];
                                $row = getAdsEnquiry($all_ads_enquiry_id);
                            ?>
                            <?php if($row['ad_enquiry_status'] == 'Active'){?>

                                <?php
                                    foreach (getAllUser() as $user_row) {?>
                                        <?php if ($user_row['user_id'] == $row['user_id']) {
                                            $first_name = $user_row['first_name'];
                                        } ?>
                                <?php }?>

                                <?php foreach (getAllActiveAdsPrice() as $ad_row) {
                                    if ($ad_row['all_ads_price_id'] == $row['all_ads_price_id']) {
                                        $ad_price_name = $ad_row['ad_price_name']."(".$ad_row['ad_price_cost'].$footer_row['currency_symbol']."/por día)";
                                    }
                                }?>
                                <form name="edit_ads_form" id="edit_ads_form" method="post" action="update_ads.php" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><strong>Usuario: </strong><?php echo $first_name;?></p>
                                            <p><strong>Tipo anuncio: </strong><?php echo $ad_price_name;?></p>
                                            <p><strong>Fecha inicio: </strong> <?php echo date('d/m/Y', $row['ad_start_date']); ?></p>
                                            <?php
                                                if ($row['type'] == 1) {
                                                    $type = "Ficha de profesionales";
                                                    $category_name = "";
                                                    if($row['category_id'] > 0) {
                                                        $category_sql = "SELECT * FROM  " . TBL . "categories WHERE category_id = ".$row['category_id'];
                                                        $category_rs = mysqli_query($conn, $category_sql);
                                                        $category = mysqli_fetch_array($category_rs);
                                                        $category_name = $category['category_name'];
                                                    }
                                                } else if ($row['type'] == 2) {
                                                    $type = "Ofertas de trabajo";
                                                    $category_name = "";
                                                    if($row['category_id'] > 0) {
                                                        $category_sql = "SELECT * FROM  " . TBL . "categories_work_offer WHERE category_id = ".$row['category_id'];
                                                        $category_rs = mysqli_query($conn, $category_sql);
                                                        $category = mysqli_fetch_array($category_rs);
                                                        $category_name = $category['category_name'];
                                                    }
                                                } else if ($row['type'] == 3) {
                                                    $type = "Almacenes";
                                                    $category_name = "";
                                                    if($row['category_id'] > 0) {
                                                        $category_sql = "SELECT * FROM  " . TBL . "categories_stores WHERE category_id = ".$row['category_id'];
                                                        $category_rs = mysqli_query($conn, $category_sql);
                                                        $category = mysqli_fetch_array($category_rs);
                                                        $category_name = $category['category_name'];
                                                    }
                                                } else if ($row['type'] == 4) {
                                                    $type = "Home";
                                                    $category_name = "";
                                                }
                                            ?>
                                            <p><strong>Tipo: </strong> <?php echo $type ?></p>
                                            <p><strong>Categoría: </strong> <?php echo $category_name ?></p>

                                            <?php if($row['invoice_less']==0){?>
                                                <p><strong>Número de días: </strong> <?php echo number_format($row['ad_total_days'],2,',',''); ?> días</p>  
                                                <p><strong>Coste por día: </strong> <?php echo number_format($row['ad_cost_per_day'],2,',',''); ?><?php echo $footer_row['currency_symbol']; ?>/dia</p>
                                                <p><strong>Total IVA</strong>: <?php echo $tax = number_format(round($row['ad_total_cost'] * (21 / 100), 2, PHP_ROUND_HALF_UP),2,',',''); ?><?php echo $footer_row['currency_symbol']; ?></p>
                                                <p><strong>Coste total:</strong> <?php echo number_format($row['ad_total_cost'],2,',',''); ?><?php echo $footer_row['currency_symbol']; ?></p>
                                            <?php }?>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="ad_end_date"><?php echo $BIZBOOK['END_DATE'];?> (MM/DD/YYYY)</label>
                                                            <input type="text" id="endate" autocomplete="off" name="ad_end_date" class="form-control" placeholder="<?php echo $BIZBOOK['END_DATE'];?> (MM/DD/YYYY)" value="<?php echo date('Y-m-d', $row['ad_end_date']); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php  if($row['ad_enquiry_photo']!==""){?>
                                                    <img src="../images/ads/<?php echo $row['ad_enquiry_photo']; ?>" style="max-width: 120px"/><br/>
                                                    <input type="hidden" class="validate" id="ad_enquiry_photo_old" name="ad_enquiry_photo_old" value="<?php echo $row['ad_enquiry_photo']; ?>" required="required">
                                                <?php }?>
                                                <label><?php echo $BIZBOOK['CHOOSE_AD_IMAGE'];?></label>
                                                <input type="file" name="ad_enquiry_photo" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                <textarea  id="ad_link"  name="ad_link" class="form-control" placeholder="<?php echo $BIZBOOK['ADVERTISEMENT_EXTERNAL_LINK'];?>" required><?php echo $row['ad_link']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" name="edit_ad_submit" class="btn btn-primary"><?php echo $BIZBOOK['SAVE_AND_EXIT'];?></button>
                                        </div>
                                        <div class="col-md-12">
                                            <?php if($row['invoice_less']==0){?>
                                                <a href="admin-current-ads.php" class="skip">Ir a anuncios actuales >></a>
                                            <?php }else{?>
                                                <a href="admin-current-ads-invoice-less.php" class="skip">Ir a anuncios sin facturación >></a>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <input type="hidden" class="validate" id="all_ads_enquiry_id" name="all_ads_enquiry_id" value="<?php echo $row['all_ads_enquiry_id']; ?>" required="required">
                                </form>
                            <?php }else{?>
                                <form name="edit_ads_form" id="edit_ads_form" method="post" action="update_ads.php" enctype="multipart/form-data">
                                    <input type="hidden" class="validate" id="all_ads_enquiry_id" name="all_ads_enquiry_id" value="<?php echo $row['all_ads_enquiry_id']; ?>" required="required">
                                    <input type="hidden" class="validate" id="ad_enquiry_photo_old" name="ad_enquiry_photo_old" value="<?php echo $row['ad_enquiry_photo']; ?>" required="required">
                                    <input type="hidden" value="<?php echo $row['ad_total_days']; ?>" name="ad_total_days" id="ad_total_days" class="validate">
                                    <input type="hidden" value="<?php echo $row['ad_cost_per_day']; ?>" name="ad_cost_per_day" id="ad_cost_per_day" class="validate">
                                    <input type="hidden" value="<?php echo $row['ad_total_cost']; ?>" name="ad_total_cost" id="ad_total_cost" class="validate">
                                    <input type="hidden" value="<?php echo $path; ?>" name="path" id="path" class="validate">
                                    <ul>
                                        <li>
                                            <!--FILED START-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <select name="user_id" required="required" class="form-control" id="user_id">
                                                            <option value=""><?php echo $BIZBOOK['CHOOSE_USER'];?> *</option>
                                                            <?php
                                                            foreach (getAllUser() as $user_row) {

                                                                ?>
                                                                <option <?php if ($user_row['user_id'] == $row['user_id']) {
                                                                    echo "selected";
                                                                } ?>
                                                                    value="<?php echo $user_row['user_id']; ?>"><?php echo $user_row['first_name']; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--FILED END-->
                                            <!--FILED START-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group ca-sh-user">
                                                        <select name="all_ads_price_id" required="required" class="form-control" id="adposi">
                                                            <option value=""><?php echo $BIZBOOK['AD_POSITION'];?> *</option>
                                                            <?php
                                                            foreach (getAllActiveAdsPrice() as $ad_row) {
                                                                ?>
                                                                <option <?php if ($ad_row['all_ads_price_id'] == $row['all_ads_price_id']) {
                                                                    echo "selected";
                                                                } ?> myTag = "<?php echo $ad_row['ad_price_cost']; ?>"
                                                                    value="<?php echo $ad_row['all_ads_price_id']; ?>"><?php echo $ad_row['ad_price_name']; ?> (<?php echo $ad_row['ad_price_cost']; ?><?php echo $footer_row['currency_symbol']; ?>/por día)</option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <a href="../ad-details.php" class="frmtip" target="_blank"><?php echo $BIZBOOK['PRICING_DETAILS'];?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--FILED END-->
                                            <!--FILED START-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" id="stdate" name="ad_start_date" value="<?php echo $row['ad_start_date']; ?>" class="form-control" placeholder="<?php echo $BIZBOOK['STAR_DATE'];?> (DD/MM/YYYY)" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--FILED END-->
                                            <!--FILED START-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" id="endate" name="ad_end_date" value="<?php echo $row['ad_end_date']; ?>" class="form-control" placeholder="<?php echo $BIZBOOK['END_DATE'];?> (MM/DD/YYYY)" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--FILED END-->
                                            <!--FILED START-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <?php if($row['ad_enquiry_photo']!=""){?>
                                                            <img src="../images/ads/<?php echo $row['ad_enquiry_photo']; ?>" style="max-width: 120px"/><br/>
                                                            <input type="hidden" class="validate" id="ad_enquiry_photo_old" name="ad_enquiry_photo_old" value="<?php echo $row['ad_enquiry_photo']; ?>" required="required">
                                                        <?php }?>
                                                        <label><?php echo $BIZBOOK['CHOOSE_AD_IMAGE'];?></label>
                                                        <input type="file" name="ad_enquiry_photo" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                            <!--FILED END-->
                                            <!--FILED START-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea  id="ad_link"  name="ad_link" class="form-control" placeholder="<?php echo $BIZBOOK['ADVERTISEMENT_EXTERNAL_LINK'];?>" required><?php echo $row['ad_link']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--FILED END-->
                                            <!--FILED START-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="ad-pri-cal">
                                                        <ul>
                                                            <li>
                                                                <div>
                                                                    <span><?php echo $BIZBOOK['TOTAL_DAYS'];?></span>
                                                                    <h5 class="ad-tdays"><b class="ad-pocost"><?php echo number_format($row['ad_total_days'],2,',',''); ?></b></h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div>
                                                                    <span><?php echo $BIZBOOK['COST_PER_DAYS'];?></span>
                                                                    <h5><b class="ad-pocost"><?php echo number_format($row['ad_cost_per_day'],2,',',''); ?></b><?php echo $footer_row['currency_symbol']; ?></h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div>
                                                                    <span>Tax</span>
                                                                    <h5 class="ad-tax"><?php echo $tax = number_format(round($row['ad_total_cost'] * (21 / 100), 2, PHP_ROUND_HALF_UP),2,',',''); ?><?php echo $footer_row['currency_symbol']; ?></h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div>
                                                                    <span><?php echo $BIZBOOK['TOTAL_COST'];?></span>
                                                                    <h5><b class="ad-tcost"><?php echo number_format($row['ad_total_cost'],2,',',''); ?><?php echo $footer_row['currency_symbol']; ?></b></h5>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--FILED END-->
                                        </li>
                                    </ul>
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" name="edit_ad_submit" class="btn btn-primary"><?php echo $BIZBOOK['PUBLISH_THIS_AD'];?></button>
                                        </div>
                                        <div class="col-md-12">
                                            <?php if($row['invoice_less']==0){?>
                                                <a href="admin-current-ads.php" class="skip">Ir a anuncios actuales >></a>
                                            <?php }else{?>
                                                <a href="admin-current-ads-invoice-less.php" class="skip">Ir a anuncios sin facturación >></a>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                </form>
                            <?php }?>
                            <div class="ud-notes">
                                <p><?php echo $BIZBOOK['NOTE_ADS'];?></p>
                    </div>
                        </div>
                        
                    </div>
                </div>
			</div>
		</div>
	</section>

            </div>
        </div>
    </section>
    <!-- END -->    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-ui.js"></script>
    <script src="js/admin-custom.js"></script> 
    <script src="../js/jquery.number.min.js"></script>
    <script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
</body>

</html>