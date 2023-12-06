<?php
if (file_exists('config/info.php')) {
    include('config/info.php');
}

$id_lis = $_POST['id_listing'];

$sql = "SELECT * FROM  " . TBL . "listings where listing_id='" . $id_lis . "'";
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
        }

        $modal = '<div class="modal fade" id="addFeaturedModal'.$listing_row['listing_id'].'" tabindex="-1" aria-labelledby="addFeaturedModalModalLabel'.$listing_row['listing_id'].'" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Añadir a favoritos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerrar_modal_featured_listing('.$listing_row['listing_id'].')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ca-sh-user">
                                    <select name="all_feature_listing_price_id" required="required" class="form-control" id="adposi">
                                        <option value="">'.$BIZBOOK['AD_POSITION'].' *</option>
                                        '.$options_features_listing_price.'
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--FILED END--> 
                        <!--FILED START-->
                       <div class="row">
                           <div class="col-md-12">
                               <div class="form-group">
                                <input type="text" id="stdatefeatured" autocomplete="off" name="ad_start_date" class="form-control" placeholder="'.$BIZBOOK['STAR_DATE'].' (DD/MM/YYYY)" required>
                               </div>
                           </div>
                       </div>
                       <!--FILED END-->
                       <!--FILED START-->
                        <div class="row">
                           <div class="col-md-12">
                               <div class="form-group">
                                <input type="text" id="endatefeatured" autocomplete="off" name="ad_end_date" class="form-control" placeholder="'.$BIZBOOK['END_DATE'].' (DD/MM/YYYY)" required>
                               </div>
                           </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="ad-pri-cal">
                                    <ul>
                                        <li>
                                            <div>
                                            <span>'.$BIZBOOK['TOTAL_DAYS'].'</span>
                                            <h5 class="ad-tdays">0</h5>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                            <span>'.$BIZBOOK['COST_PER_DAYS'].'</span>
                                                <h5><b class="ad-pocost">0</b>'.$footer_row['currency_symbol'].'</h5>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                            <span>Tax</span>
                                            <h5><b class="ad-tax">0</b>'.$footer_row['currency_symbol'].'</h5>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                            <span>'. $BIZBOOK['TOTAL_COST'].'</span>
                                                <h5><b class="ad-tcost">0</b>'.$footer_row['currency_symbol'].'</h5>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary" onclick="add_featured_listing('.$listing_row['listing_id'].')">Guardar destacado</button>

                    </div>      
                </div>
            </div>
        </div>';
    }else{
        if($featured_listings_row['status'] == 'Active'){ 
            $value = "Inactive"; 
        }else{ 
            $value = "Active"; 
        }
        $checked = "";
        if($featured_listings_row['status'] == 'Active'){ 
            $checked = "checked";
        }

        $modal = '<div class="modal fade" id="addFeaturedModal'.$listing_row['listing_id'].'" tabindex="-1" aria-labelledby="addFeaturedModalModalLabel'.$listing_row['listing_id'].'" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir a favoritos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerrar_modal_featured_listing('.$listing_row['listing_id'].')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>'.$featured_listing_price_row['description'].'</strong></p>
                            <p><strong>Fecha inicio:</strong> '.date('d/m/Y', strtotime($featured_listings_row['date_start'])).'</p>
                            <p><strong>Fecha fin:</strong> '.date('d/m/Y', strtotime($featured_listings_row['date_end'])).'</p>
                            <p><strong>Número de días:</strong> '.$featured_listings_row['featured_total_days'].' días</p>  
                            <p><strong>Coste por día:</strong> '.$featured_listings_row['featured_cost_per_day'].' €/dia</p>
                            <p><strong>Coste total:</strong> '.$featured_listings_row['featured_total_cost'].' €</p>  
                            <p>
                                <input type="checkbox" id="featured_listing_status" name="featured_listing_status" value="'.$value.'" onclick="aprove_featured_listing('.$listing_row['listing_id'].','.$featured_listings_row['featured_listing_id'].')" '.$checked.'>
                                <label for="featured_listing_status"> Activo</label>
                            </p>
                            <p>';
                            if($featured_listings_row['status'] == 'Inactive'){
                                $modal .= '<button type="button" class="btn btn-danger" title="Quitar destacado" id="btn-del-featured" onclick="del_featured_listing('. $listing_row['listing_id'].');">Quitar destacado</button>';
                            }
                            $modal .= '</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
    }
    $modal .= '<script type="text/javascript">
        $("#addFeaturedModal'.$listing_row['listing_id'].'").modal({
            backdrop: "static", 
            keyboard: false
        });

        $(function () {
            $("#stdatefeatured").datepicker({
                changeMonth: true,
                changeYear: true,
                minDate: 0
            });
            $("#endatefeatured").datepicker({
                changeMonth: true,
                changeYear: true,
                minDate: 0
            });
        });

        $("#stdatefeatured, #endatefeatured, #adposi").change(function () {
            var firstDate = $("#stdatefeatured").val();
            var secondDate = $("#endatefeatured").val();
            var millisecondsPerDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
            var startDay = new Date(firstDate);
            var endDay = new Date(secondDate);
            var diffDays = Math.abs((startDay.getTime() - endDay.getTime()) / (millisecondsPerDay));
            $(".ad-tdays").text(diffDays);
            $("#ad_total_days").val(diffDays);
            var adpocost = $("#adposi").find("option:selected", this).attr("mytag");
            $(".ad-pocost").text($.number(adpocost,2,",",""));
            $("#ad_cost_per_day").val(adpocost);
            var totcost = diffDays * adpocost;
            var tax = Math.round(totcost * (21 / 100));
            $(".ad-tax").text($.number(tax,2,",",""));
            $(".ad-tcost").text($.number(totcost,2,",",""));
            $("#ad_total_cost").val(totcost);
        });
    </script>';
}else{
    echo 0;
}

echo $modal;
?>