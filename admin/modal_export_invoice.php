<div class="modal fade" id="exportInvoiceModal" tabindex="-1" aria-labelledby="exportInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Exportar facturas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerrar_modal_featured_listing(<?php echo $listing_row['listing_id'];?>)">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="export_invoices.php" id="export_invoce_form" name="export_invoce_form" method="post" enctype="multipart/form-data">
                    <!--FILED START-->
                   <div class="row">
                       <div class="col-md-12">
                           <div class="form-group">
                            <input type="text" id="istdate" autocomplete="off" name="start_date" class="form-control" placeholder="<?php echo $BIZBOOK['STAR_DATE'];?> (DD/MM/YYYY)">
                           </div>
                       </div>
                   </div>
                   <!--FILED END-->
                   <!--FILED START-->
                    <div class="row">
                       <div class="col-md-12">
                           <div class="form-group">
                            <input type="text" id="iendate" autocomplete="off" name="end_date" class="form-control" placeholder="<?php echo $BIZBOOK['END_DATE'];?> (DD/MM/YYYY)">
                           </div>
                       </div>
                    </div>
                   <button type="submit" id="export_invoce_submit" name="export_invoce_submit" class="btn btn-primary">Exportar facturas</button>
                </form>   
            </div>      
        </div>
    </div>
</div>