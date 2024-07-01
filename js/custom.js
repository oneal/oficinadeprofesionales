var dir = '';
if(window.location.origin == 'http://oficinad.test:5000'){
    dir = '/';
}else if(window.location.origin == 'https://www.oficinadeprofesionales.com'){
    dir = '/';
}

var host = window.location.origin;

$(document).ready(function () {
    "use strict";
    //getsource();

    setTimeout(function () {
        $(".ani-quo").addClass("ani-quo-act")
    }, 7000);
    setTimeout(function () {
        $(".ani-quo").removeClass("ani-quo-act")
    }, 14000);
    setTimeout(function () {
        $(".btn-ser-need-ani").fadeIn();
    }, 15000);

    //TOP MENU OPEN AND CLOSE
    $('.menu').on('click', function () {
        $('.mob-me-all').removeClass('mobmenu-show');
        $('.pop-menu').toggleClass("ani-menu");
    });
    $('.clopme').on('click', function () {
        $('.pop-menu').removeClass("ani-menu");
    });

    $('.ani-quo, .btn-ser-need-ani').on('click', function () {
        $('.ani-quo-form').addClass('ani-quo-form-act');
    });
    $('.ani-req-clo').on('click', function () {
        $('.ani-quo-form').removeClass('ani-quo-form-act');
    });
    // $('.qvv').on('click', function() {
    //     $('.list-qview').addClass('qview-show');
    // });
    // $('.list-qview').on('mouseleave', function() {
    //     $('.list-qview').removeClass('qview-show');
    // });
    $('.clo-list').on('click', function () {
        $('.list-qview').removeClass('qview-show');
    });
    $('.mob-me-ic').on('click', function () {
        $('.pop-menu').removeClass("ani-menu");
        $('.mob-me-all').addClass('mobmenu-show');
    });
    $('.mob-me-clo').on('click', function () {
        $('.mob-me-all').removeClass('mobmenu-show');
    });
    $('.ll-1').on('click', function () {
        $('.log-1').slideDown();
        $('.log-2, .log-3').slideUp();
    });
    $('.ll-2').on('click', function () {
        $('.log-2').slideDown();
        $('.log-1, .log-3').slideUp();
    });
    $('.ll-3').on('click', function () {
        $('.log-3').slideDown();
        $('.log-1, .log-2').slideUp();
    });
    //FILTER ON ALL LISTING PAGE - MOBILE VIEW ONLY
    $('.fil-mob').on('click', function () {
        //$('.fil-mob-view').slideToggle();
        $('.fil-mob-view').toggleClass("fil-mmob-act");
    });
    //ALL LISTING GRID AND LIST VIEW CHANGE
    $('.vfilter i').on('click', function () {
        $('.vfilter i').removeClass('act')
        $(this).addClass('act')
    });
    $('.ic1').on('click', function () {
        $(".list-map").hide();
        $(".all-list-bre, .all-listing").show();
        $('.all-list-sh').removeClass('cview3');
        $('.all-list-sh').addClass('cview1');
    });
    $('.ic2').on('click', function () {
        $(".list-map").hide();
        $(".all-list-bre, .all-listing").show();
        $('.all-list-sh').removeClass('cview1');
        $('.all-list-sh').removeClass('cview3');
    });
    $('.ic3').on('click', function () {
        $(".all-list-bre, .all-listing").hide();
        $(".list-map").show();
    });
    //NOTIFICATION POPUP SHOW AND HIDE
    $('.btn-sure').on('click', function () {
        $('.noti-sure').addClass('cnoti-show');
        setTimeout(function () {
            $('.noti-sure').removeClass('cnoti-show');
        }, 5000);
    });
    setTimeout(function () {
        $('.status_message').fadeOut();
    }, 5000);
    $('.no').on('click', function () {
        $('.noti-sure').removeClass('cnoti-show');
    });
    //HOW TO TAB OPTIONS
    $('.how-to-coll li h4').on('click', function () {
        if($('.colact').is(':visible')){
            $('.how-to-coll li h4').removeClass('colact');
            $('.how-to-coll li div').slideUp();
        }else{
            $(this).addClass('colact');
            $(this).next("div").slideDown();
        }
    });
    //CREATE DUPLICATE LISTING
    $('.cre-dup-btn').on('click', function () {
        $('.cre-dup-form').slideDown();
    });
    //DASHBOARD PROFILE OPEN AND CLOSE
    $('.al').on('mouseenter', function () {
        $('.db-menu').slideDown();
        $('.ud').addClass('op1');
    });
    $('.al').on('mouseleave', function () {
        $('.db-menu').slideUp();
        $('.ud').removeClass('op1');
    });
    $('.dropdown-menu li').on('click', function () {
        var getValue = $(this).text();
        $('.dropdown-select').text(getValue);
        //alert(getValue);
    });
    //CREATE USER - SHOW USER TYPE SECTION
    $(".ca-check-plan").on('change', function () {
        if ($(this).val() == "Service provider") {
            $('.ca-sh-plan').slideDown();
        }
        else {
            $('.ca-sh-plan').slideUp();
        }
    });
    //USER PROFILE TAB
    $('.us-pro-nav ul li span').on('click', function () {
        $('.us-pro-nav ul li span').removeClass('act');
        $(this).addClass('act');
    });
    $('.us-pro-nav ul li:nth-child(1) span').on('click', function () {
        $('.us-ppg-com').slideUp();
        $('.us-ppg-listings').slideDown();
    });
//    $('.us-pro-nav ul li:nth-child(2) span').on('click', function () {
//        $('.us-ppg-com').slideUp();
//        $('.us-ppg-listings').slideDown();
//    });
//    $('.us-pro-nav ul li:nth-child(3) span').on('click', function () {
//        $('.us-ppg-com').slideUp();
//        $('.us-ppg-blog').slideDown();
//    });
//    $('.us-pro-nav ul li:nth-child(4) span').on('click', function () {
//        $('.us-ppg-com').slideUp();
//        $('.us-ppg-event').slideDown();
//    });
    $('.us-pro-nav ul li:nth-child(2) span').on('click', function () {
        $('.us-ppg-com').slideUp();
        $('.us-ppg-follow').slideDown();
    });
    //SERVICES LIST ADD - APPEND
    $(".lis-ser-add-btn").on('click', function () {
        if($('.item-service').length>=1 && $('.item-service').length<=7){
            $(".add-list-ser ul li:last-child").after('<li class="item-service"><div class="row"> <div class="col-md-6"> <div class="form-group"> <label>Nombre del servicio :</label>  <input type="text" name="service_id[]" class="form-control" placeholder="Ej: Fontanero"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label>Imagen</label> <input type="file" name="service_image[]" class="form-control"> </div> </div> </div></li>');
        }
    });
    //SERVICES OFFER LIST REMOVE - APPEND
    $(".lis-ser-rem-btn").on('click', function () {
        if($('.item-service').length>1){
            $(".add-list-ser ul li:last-child").remove();
        }
    });
    //SPECIAL OFFER LIST ADD - APPEND
    $(".lis-add-off").click(function () {
        if($('.item-offer').length>=1 && $('.item-offer').length<=7){
            $(".add-list-off ul li:last-child").after('<li class="item-offer"><div class="row"> <div class="col-md-6"> <div class="form-group"> <input type="text" name="service_1_name[]" class="form-control" placeholder="Nombre de la oferta *"> </div> </div> <div class="col-md-6"> <div class="form-group"> <input type="number" class="form-control" min=0 step="0.01" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?\'inherit\':\'inherit\'" name="service_1_price[]" placeholder="Precio"> </div> </div> </div><div class="row"> <div class="col-md-12"> <div class="form-group"> <textarea class="form-control" name="service_1_detail[]" placeholder="Detalles sobre esta oferta"></textarea> </div> </div> </div><div class="row"> <div class="col-md-12"> <div class="form-group"> <label>Elige imagen de oferta</label> <input type="file" name="service_1_image[]" class="form-control"> </div> </div> </div></li>');
        }
    });
    //SPECIAL OFFER LIST REMOVE - APPEND
    $(".lis-add-rem").on('click', function () {
        if($('.item-offer').length>1){
            $(".add-list-off ul li:last-child").remove();
        }
    });
    //SPECIAL OFFER LIST ADD - APPEND
    $(".lis-add-oad").on('click', function () {
        $(".add-lis-oth ul li:last-child").after('<li> <div class="row"> <div class="col-md-5"> <div class="form-group"> <input type="text" name="listing_info_question[]" class="form-control" placeholder="Escriba su información"> </div> </div><div class="col-md-2"> <div class="form-group"> <i class="material-icons">arrow_forward</i> </div> </div> <div class="col-md-5"> <div class="form-group"> <input type="text" name="listing_info_answer[]" class="form-control" placeholder="Si"> </div> </div> </div> </li>');
    });
    //SPECIAL OFFER LIST REMOVE - APPEND
    $(".lis-add-ore").on('click', function () {
        $(".add-lis-oth ul li:last-child").remove();
    });
    //MOBILE MENU - DASHBOARD BOARD MENU SHOW
    $(".mv-pro").on('click', function () {
        $(".mv-pro-menu").slideToggle();
    });
    //BOOTSTRAP TOOL TIP
    $('[data-toggle="tooltip"]').tooltip();

    //PRODUCT SPECIFICATION LIST ADD - APPEND
    $(".prod-add-oad").on('click', function () {
        $(".add-prod-oth ul li:last-child").after('<li> <div class="row"> <div class="col-md-5"> <div class="form-group"> <input type="text" name="product_info_question[]" class="form-control" placeholder="Escriba su información"> </div> </div><div class="col-md-2"> <div class="form-group"> <i class="material-icons">arrow_forward</i> </div> </div> <div class="col-md-5"> <div class="form-group"> <input type="text" name="product_info_answer[]" class="form-control" placeholder="Si"> </div> </div> </div> </li>');
    });
    //PRODUCT SPECIFICATION LIST REMOVE - APPEND
    $(".prod-add-ore").on('click', function () {
        $(".add-prod-oth ul li:last-child").remove();
    });

    //PRODUCT HIGHLIGHTS LIST ADD - APPEND
    $(".prod-add-high-oad").on('click', function () {
        $(".add-prod-high-oth ul li:last-child").after('<li> <div class="row"> <div class="col-md-12"> <div class="form-group"> <input type="text" name="product_highlights[]" class="form-control" placeholder="Escriba sus aspectos más destacados"> </div> </div> </div> </li>');
    });
    //PRODUCT HIGHLIGHTS LIST REMOVE - APPEND
    $(".prod-add-high-ore").on('click', function () {
        $(".add-prod-high-oth ul li:last-child").remove();
    });

    //VIDEO LIST ADD - APPEND
    $(".lis-add-oadvideo").on('click', function () {
        $(".add-list-map ul li:last-child").after('<li> <div class="row"> <div class="col-md-12"> <div class="form-group"> <textarea id="listing_video" name="listing_video[]" class="form-control" placeholder="Pega tu código iframe youtube aquí"></textarea> </div> </div> </div> </li>');
    });
    //VIDEO LIST REMOVE - APPEND
    $(".lis-add-orevideo").on('click', function () {
        $(".add-list-map ul li:last-child").remove();
    });
    //LISTING OFFER ADD - APPEND
    $(".offer-add-btn").click(function () {
        $(".add-noffer ul li:last-child").after('<li><div class="row"><div class="col-md-6 col-sm-12"><div class="form-group"><label>Expecificación</label><input type="text" id="details_id" name="details_id[]" class="form-control" placeholder="Expedificacion"></div> </div><div class="col-md-6 col-sm-12"><div class="form-group"><label>Valor</label><input type="text" id="details_text" name="details_text[]" class="form-control" placeholder="Valor"></div></div></div></li>');
    });
    //LISTING OFFER REMOVE - APPEND
    $(".offer-rem-btn").click(function () {
        $(".add-noffer ul li:last-child").remove();
    })

    //ENQUIRY AND REVIEW LIKE
    // $(".enq-sav i").click(function(){
    //   $(this).toggleClass('sav-act');
    // });

    //ENQUIRY AND REVIEW LIKE
    // $(".ldelik").click(function(){
    //   $(this).toggleClass('sav-act');
    // });

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
        $(".ad-pocost").text(adpocost);
        $("#ad_cost_per_day").val(adpocost);
        var totcost = diffDays * adpocost;
        $(".ad-tcost").text(totcost);
        $("#ad_total_cost").val(totcost);
    });

    //COPY RIGHTS YEAR
    $('#cry').text("2050");

    //PRE LOADING
    $('#status').css('display','none');
    $('#preloader').delay(350).css('display','none');
    $('body').delay(350).css({
        'overflow': 'visible'
    });

    //BLOG POST SEARCH - BLOG DETAIL PAGE
    $("#pg-sear").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#pg-resu *").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $("#pg-sear-blog").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#pg-resu-blog *").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('.p_c').on('click', function () {
        $.ajax({
            type: 'POST',
            url: host+dir+"accept_politica_cookie.php",
            cache: false,
            data: null,
            success: function (response) {
                window.location.reload();
            }
        });
    });
});

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
$("#source").val(urlParam("source"));
if (urlParam("login") == "register") {
    $('.log-1, .log-3').slideUp();
    $('.log-2').slideDown();
}
if (urlParam("login") == "forgot") {
    $('.log-1, .log-2').slideUp();
    $('.log-3').slideDown();
}
//CATEGORY FILTER ONLOAD ACTIVE
if (urlParam("features") == "trending") {
    $('.lhs-featu input:checkbox').removeAttr('checked');
    $('#trending').attr('checked', 'checked');
}

//SEARCH FUNCTION
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

//CITY SEARCH
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

//DATE PICKER
$(function () {
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
});

//FOLLOW & UN FOLLOW Logic Starts

$(".userfollow").click(function () {

    var user_id = $(this).attr('data-item'); //User Id
    var sender_user_id = $(this).attr('data-num'); //Sender User Id
    var like_status = $(this).attr('data-section');

    var url  = window.location.href;


    var status_msg_old = $(".follow-content" + user_id).html();

    if(url.indexOf('db-followings') === -1){
        if (status_msg_old == "Dejar de seguir") {
            var status_msg = "Seguir";
        } else {
            var status_msg = "Dejar de seguir";
        }

    }else{
        if (status_msg_old == "Lo has dejado de seguir") {
            var status_msg = "Siguiendo";
        } else {
            var status_msg = "Lo has dejado de seguir";
        }
    }
    if (user_id) {  //Check Current User is Null Means redirect to login page
        if (sender_user_id == user_id) {  //Check send User and Current User is Same
            // alert("same user");
        } else {
            // alert("other user");
            $.ajax({
                type: 'POST',
                url: 'follow_users.php',
                cache: false,
                data: {sender: sender_user_id, user: user_id, status: like_status},
                success: function (response) {
                    // alert(response);
                    if (response == 1) {

                        $(".follow-content" + user_id).html(status_msg);

                    } else {

                        $(".follow-content" + user_id).html(status_msg);
                    }

                    if(url.indexOf('db-followings') > 0){
                        setTimeout(function(){
                            window.location.reload();
                        },1000);
                    }
                }
            });
        }
    } else {
        window.location.href = "login.php";
    }

});

function savedproffesional(){
    var email = $('#email').val();
    var url_actual = window.location.href;
    $.ajax({
        type: 'POST',
        url: host+dir+'save_proffessional.php',
        cache: false,
        data: {email: email, url_actual: url_actual},
        success: function (response) {
            if(response == 1){
                alert("Se le ha enviado un email con la información de este profesional");
            }
            if(response == 2){
                alert("Debes introducir un email");
            }
            if(response == 3){
                alert("El email no es válido");
            }
            if(response == 0){
                alert("Se ha producido un error");
            }
        }
    });
}

function savedlisting(listing_id = 0,url=""){
    var id_listing = "";
    if(listing_id != 0){
        id_listing = listing_id;
    }
    var email = $('#email'+id_listing).val();
    var url_actual = window.location.href;
    if(url != ""){
        url_actual = url;
    }

    $.ajax({
        type: 'POST',
        url: host+dir+'save_listing.php',
        cache: false,
        data: {email: email, url_actual: url_actual},
        success: function (response) {
            if(response == 1){
                alert("Se le ha enviado un email con la información de esta ficha");
            }
            if(response == 2){
                alert("Debes introducir un email");
            }
            if(response == 3){
                alert("El email no es válido");
            }
            if(response == 0){
                alert("Se ha producido un error");
            }
        }
    });
}

//FOLLOW & UN FOLLOW Logic ends

//Auto complete For City List Starts

/*jQuery(document).ready(function ($) {

    $(function () {
        $.ajax({
            url: 'city_search.php',
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
});*/

//Auto complete For Listing Name Starts Header Page

/*jQuery(document).ready(function ($) {

    $(function () {
        $.ajax({
            url: 'list_category_search.php',
            success: function (response) {

                var categoryArray = JSON.parse(response);

                // var dataCountry = {};
                // for (var i = 0; i < categoryArray.length; i++) {
                //     dataCountry[categoryArray[i]] = undefined; //categoryArray[i].flag or null
                // }
                $('#select-search.autocomplete').autocomplete({  //Home Page City Search Box
                    source: categoryArray,
                    limit: 10 // The max amount of results that can be shown at once. Default: Infinity.
                });
            }
        });
    });
});*/

//Auto complete For Category Name Starts Header Page

/*jQuery(document).ready(function ($) {

    $(function () {
        $.ajax({
            url: 'category_search.php',
            success: function (response) {

                var categoryArray = JSON.parse(response);

                // var dataCountry = {};
                // for (var i = 0; i < categoryArray.length; i++) {
                //     dataCountry[categoryArray[i]] = undefined; //categoryArray[i].flag or null
                // }
                $('#select-cate.autocomplete').autocomplete({  //Home Page City Search Box
                    source: categoryArray,
                    limit: 10 // The max amount of results that can be shown at once. Default: Infinity.
                });
            }
        });
    });
});*/


//Auto complete For Listing Name and Category Name Starts Top Header Page

/*jQuery(document).ready(function ($) {

    $(function () {
        $.ajax({
            url: 'list_category_search.php',
            success: function (response) {

                var categoryArray = JSON.parse(response);

                // var dataCountry = {};
                // for (var i = 0; i < categoryArray.length; i++) {
                //     dataCountry[categoryArray[i]] = undefined; //categoryArray[i].flag or null
                // }
                $('#top-select-search.autocomplete').autocomplete({  //Home Page City Search Box
                    source: categoryArray,
                    limit: 10 // The max amount of results that can be shown at once. Default: Infinity.
                });
            }
        });
    });
});*/


//Auto complete For Event Name Starts Events Page

/*jQuery(document).ready(function ($) {

    $(function () {
        $.ajax({
            url: 'event_search.php',
            success: function (response) {

                var eventArray = JSON.parse(response);

                // var dataCountry = {};
                // for (var i = 0; i < categoryArray.length; i++) {
                //     dataCountry[categoryArray[i]] = undefined; //categoryArray[i].flag or null
                // }
                $('#event-search.autocomplete').autocomplete({  //Home Page City Search Box
                    source: eventArray,
                    limit: 10, // The max amount of results that can be shown at once. Default: Infinity.
                    select: function (eventArray, ui) {
                        window.location.href = ui.item.link;
                    }
                });
            }
        });
    });
});*/
//Auto complete For Event Name ends Events Page

//Auto complete For Blog Name Starts Blog-Posts Page

/*jQuery(document).ready(function ($) {

    $(function () {
        $.ajax({
            url: 'blog_search.php',
            success: function (response) {

                var blogArray = JSON.parse(response);

                // var dataCountry = {};
                // for (var i = 0; i < categoryArray.length; i++) {
                //     dataCountry[categoryArray[i]] = undefined; //categoryArray[i].flag or null
                // }
                $('#blog-search.autocomplete').autocomplete({  //Home Page City Search Box
                    source: blogArray,
                    limit: 10, // The max amount of results that can be shown at once. Default: Infinity.
                    select: function (blogArray, ui) {
                        window.location.href = ui.item.link;
                    }
                });
            }
        });
    });
});*/
//Auto complete For Blog Name ends Blog-Posts Page

//URL SOURCE TRACKING
// function getsource() {
//     var queryParams = {},
//         param;
//     var params = window.location.search.substring(1);
//     for (var i = 0; i < params.length; i++) {
//         param = params[i].split('=');
//         queryParams[param[0]] = param[1];
//     }
//    document.getElementById("source").value = params;
//     return params;
// }

//DOWNLOAD INVOICE
$('#downloadPDF').click(function () {
    // alert("viki");
    domtoimage.toPng(document.getElementById('content2'))
        .then(function (blob) {
            var pdf = new jsPDF('l', 'pt', [$('#content2').width(), $('#content2').height()]);

            pdf.addImage(blob, 'PNG', 0, 0, $('#content2').width(), $('#content2').height());
            pdf.save("invoice.pdf");

            that.options.api.optionsChanged();
        });
});

//Number Only Input box

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

jQuery(document).ready(function ($) {
    $("#pg-sear-fa").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#pg-resu-fa tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

//Header Page Search Box Process Starts
jQuery(document).ready(function ($) {


    $('#top-select-search').on('keypress',function(e) {
        if(e.which == 13) {
            event.preventDefault();
            var select_search = $("#top-select-search").val();
            window.location.href = host+dir+"/search-results?q="+select_search;
        }
    });

    $('#top-select-search-new').on('keypress',function(e) {
        if(e.which == 13) {
            event.preventDefault();
            var select_search = $("#top-select-search-new").val();
            window.location.href = host+dir+"/search-results?q="+select_search;
        }
    });

    $("#top_filter_submit").click(function () {
        event.preventDefault();
        var select_search = "";
        if($('#top-select-search').is(':visible')){
            select_search = $("#top-select-search").val();
        }else if($('#top-select-search-new').is(':visible')){
            select_search = $("#top-select-search").val();
        }
        window.location.href = host+dir+"search-results?q="+select_search;
    });

    $('#filter_submit').click(function () {
        var select_city = $("#select-city").val();
        var select_state = $("#select-state").val();
        var select_cate = $("#select-cate").val();


        if(select_cate!="" && select_state!="" && select_city!=""){
            window.location.href = host+dir+"anuncios/" + select_cate+"/" + select_city + "/" + select_state;
        }

        if(select_cate!="" && select_state!="" && select_city==""){
            window.location.href = host+dir+"anuncios/" + select_cate + "/" + select_state;
        }

        if(select_cate!="" && select_state=="" && select_city==""){
            window.location.href = host+dir+"anuncios/" + select_cate;
        }

        if(select_cate=="" && select_state=="" && select_city==""){
            window.location.href = host+dir+"anuncios";
        }

    });

    $('#year_id').on('change', function () {
        var select_year = $(this).val();
        if(select_year!==""){
            window.location.href = host+dir+"eventos/" + select_year;
        } else {
            window.location.href = host+dir+"eventos";
        }

    });

    $('#filter_submit_offer').click(function () {
        var select_city = $("#select-city").val();
        var select_state = $("#select-state").val();
        var select_cate = $("#select-cate").val();

        if(select_cate!="" && select_state!="" && select_city!=""){
            window.location.href = host+dir+"ofertas-trabajo/" + select_cate+"/" + select_city + "/" + select_state;
        }

        if(select_cate!="" && select_state!="" && select_city==""){
            window.location.href = host+dir+"ofertas-trabajo/" + select_cate + "/" + select_state;
        }

        if(select_cate!="" && select_state=="" && select_city==""){
            window.location.href = host+dir+"ofertas-trabajo/" + select_cate;
        }

        if(select_cate=="" && select_state=="" && select_city==""){
            window.location.href = host+dir+"ofertas-trabajo";
        }

    });

    $('#filter_submit_store').click(function () {
        var select_city = $("#select-city").val();
        var select_state = $("#select-state").val();
        var select_cate = $("#select-cate").val();
        var select_text = $("#select-text").val();
        var urlweb = host+dir+"almacenes/";
        var url = "";
        if(select_cate!="" && select_state!="" && select_city!=""){
            url =  urlweb + select_cate+"/" + select_city + "/" + select_state;
        }

        if(select_cate!="" && select_state!="" && select_city==""){
            url = urlweb + select_cate + "/" + select_state;
        }

        if(select_cate!="" && select_state=="" && select_city==""){
            url = urlweb + select_cate;
        }

        if(select_cate=="" && select_state=="" && select_city==""){
            url = urlweb;
        }

        if(select_text !== ""){
            url += "?s="+select_text
        }

        window.location.href = url;
    });

    $('#filter_submit_offer_store').click(function () {
        var select_text = $("#select-text").val();
        var urlweb = host+dir+"todas-ofertas-almacenes";
        var url = "";

        if(select_text != ""){
            url = urlweb+"?s="+select_text
        } else {
            url = urlweb;
        }

        window.location.href = url;
    });
});
//Header Page Search Box Process Ends

//Header Page Top Search Box Process Starts
jQuery(document).ready(function ($) {
    $("#top_filter_submit").click(function () {
        event.preventDefault();
        var select_search = $("#top-select-search").val();
        var select_city = $("#select-city").val();
        window.location.href = "search_box_process.php?select_search=" + select_search + "&select_city=" + select_city;

    });
});
//Header Page Top Search Box Process Ends

$('.count1').each(function () {
    $(this).prop('Counter', 0).animate({
        Counter: $(this).text()
    }, {
        duration: 5000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});

//CREATE USER - SHOW USER TYPE SECTION
$(".ca-check-promote").on('change', function () {
    if ($(this).val() == 2) {
        $('.ca-sh-promote').slideDown();
    }
    else {
        $('.ca-sh-promote').slideUp();
    }
});