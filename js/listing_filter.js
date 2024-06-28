/**
 * Created by Vignesh on 10/12/2019.
 */

// $("input[type='checkbox'], input[type='radio']").on( "click", listingFilter() );
// $("select").on( "change", listingFilter() );


$(".city_check, .sub_cat_check ,.rating_check, .feature_check").on( "click", listingFilter );
$("select").on( "change", listingFilter );



function listingFilter() {

    $(".all-listing-total").css("opacity",0);


    var mainarray = [];

    var size = [];
    $('input[name="scheck"]:checked').each(function(){
        size.push($(this).val());
        $('.spansizecls').css('visibility','visible');
    });
    if(size=='') $('.spansizecls').css('visibility','hidden');
    var size_checklist = "&scheck="+size;

    //To get Category values from All listing page starts

    var cat_check = [];
    $('#cat_check :selected').each(function(){
        // $('input[name="cat_check"]:checked').each(function(){
        cat_check.push($(this).val());
    });

    var cat_checklist = "&cat_check="+cat_check;

    //To get Category values from All listing page ends


   //To get Sub category values from All listing page starts

    var sub_cat_check = [];
    $('input[name="sub_cat_check"]:checked').each(function(){
        sub_cat_check.push($(this).val());

    });

    var sub_cat_checklist = "&sub_cat_check="+sub_cat_check;

    //To get Sub category values from All listing page ends

    //To get Feature values from All listing page starts

    var feature_check = [];
    $('input[name="feature_check"]:checked').each(function(){
        feature_check.push($(this).val());

    });

    var feature_checklist = "&feature_check="+feature_check;

    //To get Feature values from All listing page ends

    var city_check = [];
    $('input[name="city_check"]:checked').each(function(){
        city_check.push($(this).val());

    });
    var city_checklist = "&city_check="+city_check;


    //To get Rating values from All listing page starts

    var rating_check = [];
    $('input[name="rating_check"]:checked').each(function(){
        rating_check.push($(this).val());
    });
    var rating_checklist = "&rating_check="+rating_check;

    //To get Rating values from All listing page ends


    var main_string = size_checklist+cat_checklist+sub_cat_checklist+rating_checklist+city_checklist+feature_checklist;
    main_string = main_string.substring(1, main_string.length);

    $.ajax({
        type: "POST",
        url: 'filter_listing.php',
        data: main_string ,
        cache: false,
        success: function(html){
            //alert(html);
            $(".all-listing-total").html(html);
            $(".all-listing-total").css("opacity",1);
            // $("#loaderID").css("opacity",0);
        }
    });

}

<!--    Listing Page Filter Script Ends-->


