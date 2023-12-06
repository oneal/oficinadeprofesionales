$(document).ready(function () {
    "use strict";
    $('.ad-menu ul li a.mact').siblings().slideDown();
    $('.ad-menu ul li a').on('click', function () {
        if($('.mact').is(':visible')){
            $(".ad-menu ul li div").slideUp();
            $('.ad-menu ul li a').removeClass('mact');
            $(this).addClass('mact');
            $(this).siblings().slideDown();
        }else{
            $(this).addClass('mact');
            $(this).siblings().slideDown();
        }
    });
    $('.mopen').on('click', function () {
        $(this).fadeOut();
        $('.mclose').fadeIn();
        $('.ad-menu-lhs').addClass('mshow');
        $('.ad-dash').addClass('leftpadd');
    });
    $('.mclose').on('click', function () {
        $(this).fadeOut();
        $('.mopen').fadeIn();
        $('.ad-menu-lhs').removeClass('mshow');
        $('.ad-dash').removeClass('leftpadd');
    });
    //CREATE DUPLICATE LISTING
    $('.cre-dup-btn').on('click', function () {
        $('.cre-dup-form').slideDown();
    });
    //SERVICES LIST ADD - APPEND
    $(".lis-ser-add-btn").click(function () {
        if($('.item-service').length>=1 && $('.item-service').length<=7){
            $(".add-list-ser ul li:last-child").after('<li class="item-service"><div class="row"> <div class="col-md-6"> <div class="form-group"> <label>Nombre del servicio:</label> <input type="text" name="service_id[]" class="form-control" placeholder="Ej: Fontanero"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label>Imagen</label> <input type="file" name="service_image[]" class="form-control"> </div> </div> </div></li>');
        }
    });
    //SERVICES OFFER LIST REMOVE - APPEND
    $(".lis-ser-rem-btn").click(function () {
        if($('.item-service').length>1){
            $(".add-list-ser ul li:last-child").remove();
        }
    });
    //SPECIAL OFFER LIST ADD - APPEND
    $(".lis-add-off").click(function () {
        if($('.item-offer').length>=1 && $('.item-offer').length<=7){
            $(".add-list-off ul li:last-child").after('<li class="item-offer"><div class="row"> <div class="col-md-6"> <div class="form-group"> <input type="text" name="service_1_name[]" class="form-control" placeholder="Nombre Oferta *"> </div> </div> <div class="col-md-6"> <div class="form-group"> <input type="text" name="service_1_price[]" class="form-control" min=0 step="0.01" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?\'inherit\':\'inherit\'" placeholder="Precio"> </div> </div> </div><div class="row"> <div class="col-md-12"> <div class="form-group"> <textarea class="form-control" name="service_1_detail[]" placeholder="Detalles sobre esta oferta"></textarea> </div> </div> </div><div class="row"> <div class="col-md-12"> <div class="form-group"> <label>Elige la imagen de la oferta</label> <input type="file" name="service_1_image[]" class="form-control"> </div> </div> </div></li>');
        }
    });
    //SPECIAL OFFER LIST ADD - APPEND
    // $(".lis-add-off").click(function(){
    //     $(".add-list-off ul li:last-child").after('<li><div class="row"> <div class="col-md-6"> <div class="form-group"> <input type="text" class="form-control" placeholder="Offer name *"> </div> </div> <div class="col-md-6"> <div class="form-group"> <input type="text" class="form-control" placeholder="Price"> </div> </div> </div><div class="row"> <div class="col-md-12"> <div class="form-group"> <textarea class="form-control" placeholder="Details about this offer"></textarea> </div> </div> </div><div class="row"> <div class="col-md-12"> <div class="form-group"> <label>Choose offer image</label> <input type="file" class="form-control"> </div> </div> </div></li>');
    // });
    //SPECIAL OFFER LIST REMOVE - APPEND
    $(".lis-add-rem").click(function () {
        if($('.item-offer').length>1){
            $(".add-list-off ul li:last-child").remove();
        }
    });
    //SPECIAL OFFER LIST ADD - APPEND
    $(".lis-add-oad").click(function () {
        $(".add-lis-oth ul li:last-child").after('<li> <div class="row"> <div class="col-md-5"> <div class="form-group"> <input type="text" name="listing_info_question[]" class="form-control" placeholder="Escriba su información"> </div> </div><div class="col-md-2"> <div class="form-group"> <i class="material-icons">arrow_forward</i> </div> </div> <div class="col-md-5"> <div class="form-group"> <input type="text" name="listing_info_answer[]" class="form-control" placeholder="Sí"> </div> </div> </div> </li>');
    });
    //SPECIAL OFFER LIST REMOVE - APPEND
    $(".lis-add-ore").click(function () {
        $(".add-lis-oth ul li:last-child").remove();
    });
    //LISTING CATEGORY ADD - APPEND
    $(".cate-add-btn").click(function () {
        $(".add-ncate ul li:last-child").after('<li> <div class="row"> <div class="col-md-12"> <div class="form-group"> <input type="text" id="category_name" name="category_name[]" class="form-control" placeholder="Category name *" required> </div> </div><div class="col-md-12"><div class="form-group"><label>Choose category image</label><input type="file" name="category_image[]" id="category_image" class="form-control" required></div></div></div></li>');
    });
    //LISTING CATEGORY REMOVE - APPEND
    $(".cate-rem-btn").click(function () {
        $(".add-ncate ul li:last-child").remove();
    });
    //COUNTRY ADD - APPEND
    $(".count-add-btn").click(function () {
        $(".add-ncate ul li:last-child").after('<li> <div class="row"> <div class="col-md-12"> <div class="form-group"> <input type="text" class="form-control" name="country_name[]" placeholder="Region name *" required> </div> </div> </div> </li>');
    });
    //COUNTRY REMOVE - APPEND
    $(".count-rem-btn").click(function () {
        $(".add-ncate ul li:last-child").remove();
    });
    //CITY ADD - APPEND
    $(".city-add-btn").click(function () {
        $(".add-ncate ul li:last-child").after('<li> <div class="row"> <div class="col-md-12"> <div class="form-group"> <input type="text" class="form-control" name="city_name[]" placeholder="City name *" required> </div> </div> </div> </li>');
    });
    //CITY REMOVE - APPEND
    $(".city-rem-btn").click(function () {
        $(".add-ncate ul li:last-child").remove();
    });
    //SUB CATEGORY ADD - APPEND
    $(".scat-add-btn").click(function () {
        $(".add-ncate ul li:last-child").after('<li> <div class="row"> <div class="col-md-12"> <div class="form-group"> <input type="text" class="form-control" placeholder="Sub category name *" name="sub_category_name[]" required> </div> </div> </div> </li>');
    });
    //SUB CATEGORY REMOVE - APPEND
    $(".scat-rem-btn").click(function () {
        $(".add-ncate ul li:last-child").remove();
    });

    //VIDEO LIST ADD - APPEND
    $(".lis-add-oadvideo").on('click', function() {
        $(".add-list-map ul li:last-child").after('<li> <div class="row"> <div class="col-md-12"> <div class="form-group"> <textarea id="listing_video" name="listing_video[]" class="form-control" placeholder="Pega tu código iframe youtube aquí"></textarea> </div> </div> </div> </li>');
    });
    //VIDEO LIST REMOVE - APPEND
    $(".lis-add-orevideo").on('click', function() {
        $(".add-list-map ul li:last-child").remove();
    });

    //BOOTSTRAP TOOL TIP
    $('[data-toggle="tooltip"]').tooltip();

    //PRODUCT SPECIFICATION LIST ADD - APPEND
    $(".prod-add-oad").on('click', function() {
        $(".add-prod-oth ul li:last-child").after('<li> <div class="row"> <div class="col-md-5"> <div class="form-group"> <input type="text" name="product_info_question[]" class="form-control" placeholder="Escribe tu información"> </div> </div><div class="col-md-2"> <div class="form-group"> <i class="material-icons">arrow_forward</i> </div> </div> <div class="col-md-5"> <div class="form-group"> <input type="text" name="product_info_answer[]" class="form-control" placeholder="Si"> </div> </div> </div> </li>');
    });
    //PRODUCT SPECIFICATION LIST REMOVE - APPEND
    $(".prod-add-ore").on('click', function() {
        $(".add-prod-oth ul li:last-child").remove();
    });

    //PRODUCT HIGHLIGHTS LIST ADD - APPEND
    $(".prod-add-high-oad").on('click', function() {
        $(".add-prod-high-oth ul li:last-child").after('<li> <div class="row"> <div class="col-md-12"> <div class="form-group"> <input type="text" name="product_highlights[]" class="form-control" placeholder="Type your highlights"> </div> </div> </div> </li>');
    });
    //PRODUCT HIGHLIGHTS LIST REMOVE - APPEND
    $(".prod-add-high-ore").on('click', function() {
        $(".add-prod-high-oth ul li:last-child").remove();
    });

    //ENQUIRY AND REVIEW LIKE
    $(".enq-sav i").click(function () {
        $(this).toggleClass('sav-act');
    });

    //INTERNAL PAGE SEARCH
    $("#pg-sear").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#pg-resu tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    //ADS TOTAL DAYS CALCULATION
    $("#stdate, #endate, #adposi").change(function () {
        var firstDate = $("#stdate").val();
        var secondDate = $("#endate").val();
        var millisecondsPerDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        var startDay = new Date(firstDate);
        var endDay = new Date(secondDate);
        var diffDays = Math.abs((startDay.getTime() - endDay.getTime()) / (millisecondsPerDay));
        $(".ad-tdays").text(diffDays);
        $("#ad_total_days").val(diffDays);
        var adpocost = $('#adposi').find('option:selected', this).attr('mytag');
        $(".ad-pocost").text($.number(adpocost,2,',',''));
        $("#ad_cost_per_day").val(adpocost);
        var totcost = diffDays * adpocost;
        var tax = Math.round(totcost * (21 / 100));
        $(".ad-tax").text($.number(tax,2,',',''));
        $(".ad-tcost").text($.number(totcost,2,',',''));
        $("#ad_total_cost").val(totcost);
    });
});

function cerrar_modal_featured_listing(id_listing){
    setTimeout(function (){
        $("#addFeaturedModal"+id_listing).remove();
        $(".modal-backdrop").remove();
    },100)
}

function add_featured_listing(id_listing) {
    var adposi = $("#adposi").val();
    var date_start = $("#stdate").val();
    var date_end = $("#endate").val();
    var invoiceless = 0;
    if($("#featured_invoiceless").is(':checked')){
        invoiceless = 1;
    }
    var featured_total_days = parseInt($(".ad-tdays").html());
    var featured_cost_per_day = parseFloat($(".ad-pocost").html().replace(",", "."));
    var featured_total_cost = parseFloat($(".ad-tcost").html().replace(",", "."));
    
    var datos2 = {
        adposi: adposi
    }
    $.ajax({
        type: "POST",
        url: "num_featured_listing.php",
        data: datos2,
        success: function (data) {
            if(adposi != "" && date_start != "" && date_end != ""){
                if(data == 1){
                    var datos = {
                        id_listing: id_listing,
                        adposi: adposi,
                        date_start: date_start,
                        date_end: date_end,
                        featured_total_days: featured_total_days,
                        featured_cost_per_day: featured_cost_per_day,
                        featured_total_cost: featured_total_cost,
                        invoiceless: invoiceless
                    }
                    $.ajax({
                        type: "POST",
                        url: "update_featured_listing.php",
                        data: datos,
                        success: function (data) {
                            if(data == 1){
                                alert("Ficha destacada con exito");
                            }else if(data == 0){
                                alert("Se ha producido un error.");
                            }else if(data == 3){
                                alert("Tienes que rellenar tus datos personales para comprar créditos.");
                            }else if(data == 4){
                                alert("La fecha de fin debe ser superior a la fecha de inicio.");
                            }else if(data == 2){
                                alert("Debes rellenar todos los campos.");
                            }
                            window.location.reload();
                        }
                    });
                }else{
                    alert("Has llegado al maximo de destacados en el listado");
                    window.location.reload();
                }
            }else{
                alert("Debes rellenar todos los campos.");
            }
        }
    });
    
}

function add_featured_store(id_store) {
    var adposi = $("#adposi").val();
    var date_start = $("#stdate").val();
    var date_end = $("#endate").val();
    var invoiceless = 0;
    if($("#featured_invoiceless").is(':checked')){
        invoiceless = 1;
    }
    var featured_total_days = parseInt($(".ad-tdays").html());
    var featured_cost_per_day = parseFloat($(".ad-pocost").html().replace(",", "."));
    var featured_total_cost = parseFloat($(".ad-tcost").html().replace(",", "."));

    var datos2 = {
        adposi: adposi
    }
    $.ajax({
        type: "POST",
        url: "num_featured_store.php",
        data: datos2,
        success: function (data) {
            if(adposi != "" && date_start != "" && date_end != ""){
                if(data == 1){
                    var datos = {
                        id_store: id_store,
                        adposi: adposi,
                        date_start: date_start,
                        date_end: date_end,
                        featured_total_days: featured_total_days,
                        featured_cost_per_day: featured_cost_per_day,
                        featured_total_cost: featured_total_cost,
                        invoiceless: invoiceless
                    }
                    $.ajax({
                        type: "POST",
                        url: "update_featured_store.php",
                        data: datos,
                        success: function (data) {
                            if(data == 1){
                                alert("Ficha destacada con exito");
                            }else if(data == 0){
                                alert("Se ha producido un error.");
                            }else if(data == 3){
                                alert("Tienes que rellenar tus datos personales para comprar créditos.");
                            }else if(data == 4){
                                alert("La fecha de fin debe ser superior a la fecha de inicio.");
                            }else if(data == 2){
                                alert("Debes rellenar todos los campos.");
                            }
                            //window.location.reload();
                        }
                    });
                }else{
                    alert("Has llegado al maximo de destacados en el listado");
                    window.location.reload();
                }
            }else{
                alert("Debes rellenar todos los campos.");
            }
        }
    });

}

function aprove_featured_listing(id_listing,id_featured_listing) {
    var status = $("#featured_listing_status").val();
    var datos = {
        id_listing: id_listing,
        id_featured_listing: id_featured_listing,
        status: status,
        status_featured_listing: 1
    }
    $.ajax({
        type: "POST",
        url: "update_featured_listing.php",
        data: datos,
        success: function (data) {
            if(data == 1){
                window.location.reload();
            }else{
                alert("Se ha producido un error");
            }
        }
    });
}

function aprove_featured_store(id_store,id_featured_store) {
    var status = $("#featured_store_status").val();
    var datos = {
        id_store: id_store,
        id_featured_store: id_featured_store,
        status: status,
        status_featured_store: 1
    }
    $.ajax({
        type: "POST",
        url: "update_featured_store.php",
        data: datos,
        success: function (data) {
            if(data == 1){
                window.location.reload();
            }else{
                alert("Se ha producido un error");
            }
        }
    });
}

function del_featured_listing(id_listing) {
    var datos = {
        id_listing: id_listing,
        status: status
    }
    $.ajax({
        type: "POST",
        url: "del_featured_listing.php",
        data: datos,
        success: function (data) {
            if(data == 1){
                window.location.reload();
            }else{
                alert("Se ha producido un error.")
            }
        }
    });
}

function del_featured_store(id_store) {
    var datos = {
        id_store: id_store,
        status: status
    }
    $.ajax({
        type: "POST",
        url: "del_featured_store.php",
        data: datos,
        success: function (data) {
            if(data == 1){
                window.location.reload();
            }else{
                alert("Se ha producido un error.")
            }
        }
    });
}

//GET URL SOURCE
function urlParam(name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    } else {
        return results[1] || 0;
    }
}
//URL PAREM VALUE
//$("#source").val(urlParam("source"));
if (urlParam("login") == "register") {
    $('.log-1, .log-3').slideUp();
    $('.log-2').slideDown();
}

$(function () {
    var availlistings = [
        "Rn53 themes",
        "Real estates",
        "Room rent",
        "Directory and listing",
        "Health care in new york",
        "Child specality",
        "Plumping services",
        "Care and bike services",
        "Care showrooms",
        "Bike showroom",
        "Best t-shirts for men",
        "Tution center",
        "IT training institute",
        "Ui developer training center",
        "Job openings",
        "Lifestyle shops",
        "Medicale and health care",
        "Child care hospital",
        "Univercity and colleges",
        "Trust and help center",
        "Drinking water service",
        "Travel and transport",
        "Events"
    ];
    $("#search").autocomplete({
        source: availlistings
    });
});

$(function () {
    var availlcity = [
        "Alexandria",
        "Aurora",
        "Austin",
        "Chennai",
        "Delhi",
        "Mumbai",
        "Bangalure",
        "Chandler",
        "Dallas",
        "Dayton",
        "Elizabeth",
        "Eugene",
        "Gilbert",
        "Houston",
        "Jackson",
        "Lincoln",
        "Madison",
        "Memphis",
        "Orlando",
        "Phoenix",
        "Savannah",
        "Warren"
    ];
    $("#city").autocomplete({
        source: availlcity
    });
});

$(function () {
    $.datepicker.regional['es'] = {clearText: 'Effacer', clearStatus: '',
        closeText: 'Cerrar', closeStatus: 'Cerrar sin cambiar',
        prevText: 'Anterior ', prevStatus: 'Ver mes anterior',
        nextText: ' Siguiente', nextStatus: 'Ver el mes siguiente',
        currentText: 'Actual', currentStatus: 'Ver el mes actual',
        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
        'Julio','Agosto','Septiembre','Octobre','Noviembre','Diciembre'],
        monthNamesShort: ['En','Feb','Mar','Abr','May','Jun',
        'Jul','Ago','Sep','Oct','Nov','Dic'],
        monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
        weekHeader: 'Sm',
        weekStatus: '',
        dayNames: ['Domingo','Lúnes','Martes','Miercoles','Jueves','Viernes','Sabado'],
        dayNamesShort: ['Dom','Lun','Mar','Mir','Jue','Vie','Sab'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
        dayStatus: 'Usar DD como primer día de la semana',
        dateStatus: 'Elija el DD, MM d',
        dateFormat: 'yy-mm-dd', 
        initStatus: 'Elegir fecha', isRTL: false};
    $.datepicker.setDefaults($.datepicker.regional['es']);
 
    $("#event_start_date").datepicker({
        changeMonth: true,
        changeYear: true,
        minDate: 0
    });
    $("#stdate").datepicker({
        changeMonth: true,
        changeYear: true,
        minDate: 0
    });
    $("#endate").datepicker({
        changeMonth: true,
        changeYear: true,
        minDate: 0
    });
    $("#istdate").datepicker({
        changeMonth: true,
        changeYear: true
    });
    $("#iendate").datepicker({
        changeMonth: true,
        changeYear: true
    });
});

//DOWNLOAD INVOICE
//$('#downloadPDF').click(function () {
//    $.ajax({
//        type: "POST",
//        url: "download_invoice.php",
//        data: datos,
//        success: function (data) {
//            window.location.reload();
//        }
//    });
    
//    domtoimage.toPng(document.getElementById('content2'))
//        .then(function (blob) {
//            var pdf = new jsPDF('l', 'pt', [$('#content2').width(), $('#content2').height()]);
//
//            pdf.addImage(blob, 'PNG', 0, 0, $('#content2').width(), $('#content2').height());
//            pdf.save("invoice.pdf");
//
//            that.options.api.optionsChanged();
//        });
//});

//Number Only Input box

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}


//Auto complete For City List Starts

jQuery(document).ready(function ($) {

    $(function () {
        $.ajax({
            url: '../city_search.php',
            success: function (response) {
                var cityArray = JSON.parse(response);

                // var dataCountry = {};
                // for (var i = 0; i < cityArray.length; i++) {
                //     dataCountry[cityArray[i]] = undefined; //cityArray[i].flag or null
                // }

                $('#select-city.autocomplete').autocomplete({  //Home Page City Search Box
                    source: cityArray,
                    minLength: 3, // The minimum number of characters to be entered
                    limit: 5 // The max amount of results that can be shown at once. Default: Infinity.
                });
            }
        });
    });
});

$(function() {
    $('.chosen-select').chosen();
});

function check_ads_invoiceless(){
    if($('#ads_invoiceless').is(':checked')){
        $('#user_id').remove();
        $('#total-ads-cost').css('display','none');
    }else{
        $.ajax({
            type: "POST",
            url: "update_all_users.php",
            success: function (data) {
                $('#all-users').html(data);
            }
        });
        $('#total-ads-cost').css('display','block');
    }
}

function check_featured_invoiceless(){
    if($('#featured_invoiceless').is(':checked')){
        $('#total-ads-cost').css('display','none');
    }else{
        $('#total-ads-cost').css('display','block');
    }
}
