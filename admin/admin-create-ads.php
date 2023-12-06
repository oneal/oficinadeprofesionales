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
                    <span class="udb-inst"><?php echo $BIZBOOK['CREATE_AD'];?></span>
                    <div class="log log-1">
                        <div class="login">
                            <h4><?php echo $BIZBOOK['CREATE_AD'];?></h4>
                            <?php include "../page_level_message.php"; ?>
                            <form name="create_ads_form" id="create_ads_form" method="post" action="insert_new_ads.php" enctype="multipart/form-data">
                                <input type="hidden" value="" name="ad_total_days" id="ad_total_days" class="validate">
                                <input type="hidden" value="" name="ad_cost_per_day" id="ad_cost_per_day" class="validate">
                                <input type="hidden" value="" name="ad_total_cost" id="ad_total_cost" class="validate">
                                <ul>
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" class="form-check-input" id="ads_invoiceless" name="ads_invoiceless" onclick="check_ads_invoiceless()">
                                                <label class="form-check-label" for="ads_invoiceless"> Crear anuncios sin factura</label>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" id="all-users">
                                                <select name="user_id" required="required" class="form-control" id="user_id">
                                                    <option value=""><?php echo $BIZBOOK['CHOOSE_USER'];?> *</option>
                                                    <?php
                                                    foreach (getAllUser() as $row) {

                                                        ?>
                                                        <option value="<?php echo $row['user_id']; ?>"><?php echo $row['first_name']; ?></option>
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
                                            <div class="form-group ca-type">
                                                <select name="all_type" onchange="changeCategories()" required="required" class="form-control" id="adtype">
                                                    <option value="">Sección *</option>
                                                    <option value="1">Ficha de profesionales</option>
                                                    <option value="2">Ofertas de trabajo</option>
                                                    <option value="3">Almacenes</option>
                                                    <option value="4">Home</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED START-->
                                    <!--FILED START-->
                                    <div id="type_section">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group add-category">
                                                    <select name="all_category" required="required" class="form-control" id="adcategory">
                                                        <option value="0">Selecciona una categoría</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group ca-sh-user">
                                                    <select name="all_ads_price_id" required="required" class="form-control" id="adposi">
                                                        <option value=""><?php echo $BIZBOOK['AD_POSITION'];?> *</option>
                                                        <?php
                                                        foreach (getAllActiveAdsPrice() as $row) {
                                                            ?>
                                                            <option myTag = "<?php echo $row['ad_price_cost']; ?>"
                                                                    value="<?php echo $row['all_ads_price_id']; ?>"><?php echo $row['ad_price_name']; ?> (<?php echo $row['ad_price_cost']; ?><?php echo $footer_row['currency_symbol']; ?>/por día)</option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                 <?php /*<a href="../ad-details.php" class="frmtip" target="_blank"><?php echo $BIZBOOK['PRICING_DETAILS'];?></a>*/?>
                                                </div>
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
                                             <input type="text" id="endate" autocomplete="off" name="ad_end_date" class="form-control" placeholder="<?php echo $BIZBOOK['END_DATE'];?> (MM/DD/YYYY)" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?php echo $BIZBOOK['CHOOSE_AD_IMAGE'];?></label>
                                              <input type="file" name="ad_enquiry_photo" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                                            <!--FILED START-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea  id="ad_link"  name="ad_link" class="form-control" placeholder="<?php echo $BIZBOOK['ADVERTISEMENT_EXTERNAL_LINK'];?>" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--FILED END-->
                                    <!--FILED START-->
                                    <div class="row" id="total-ads-cost">
                                        <div class="col-md-12">
                                            <div class="ad-pri-cal">
                                                <ul>
                                                    <li>
                                                        <div>
                                                        <span><?php echo $BIZBOOK['TOTAL_DAYS']?></span>
                                                        <h5 class="ad-tdays">0</h5>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div>
                                                        <span><?php echo $BIZBOOK['COST_PER_DAYS']?></span>
                                                            <h5><b class="ad-pocost">0</b><?php echo $footer_row['currency_symbol']; ?></h5>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div>
                                                        <span>Tax</span>
                                                        <h5><b class="ad-tax">0</b><?php echo $footer_row['currency_symbol']; ?></h5>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div>
                                                        <span><?php echo $BIZBOOK['TOTAL_COST'];?></span>
                                                            <h5><b class="ad-tcost">0</b><?php echo $footer_row['currency_symbol']; ?></h5>
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
                                            <button type="submit" name="create_ad_submit" class="btn btn-primary"><?php echo $BIZBOOK['PUBLISH_THIS_AD'];?></button>
                                        </div>
                                        <div class="col-md-12">
                                            <a href="profile.php" class="skip"><?php echo $BIZBOOK['GO_TO_DASHBOARD'];?> >></a>
                                        </div>
                                    </div>
                                    <!--FILED END-->
                            </form>
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
    <script src="../js/jquery.number.min.js"></script>
    <script src="https://harvesthq.github.io/chosen/chosen.jquery.js"></script>
    <script src="js/admin-custom.js"></script>
    <script type="application/javascript">
        function changeCategories () {
            var type = $('#adtype').val();

            $.ajax({
                type: "POST",
                url: "<?php echo $webpage_full_link;?>admin/type_categories_process.php",
                data: {type: type},
                success: function (data) {
                    $("#type_section").css('display', 'block');
                    $("#type_section").html(data);
                    $('#type_section').trigger("chosen:updated");
                    if (type == '4') {
                        $("#adcategory").css('display', 'none');
                    }
                }
            });
        }
    </script>
</body>

</html>