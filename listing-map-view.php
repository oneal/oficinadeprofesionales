<?php
/*
session_start();

if (isset($_GET['category'])) {


    $category_search_name = str_replace('-', ' ', $_GET['category']);

    $cat_search_row = getNameCategory($category_search_name);  //Fetch Category Id using category name

    $category_id = $cat_search_row['category_id'];

    $_SESSION['cat_check'] = $category_id;


}
if (isset($_GET['sub_category'])) {

    $_SESSION['sub_cat_check'] = $_GET['sub_category'];

}else{
    $_SESSION['sub_cat_check'] = '';
}

if (isset($_GET['feature'])) {

    $_SESSION['feature_check'] = $_GET['feature'];

}else{
    $_SESSION['feature_check'] = '';
}

if (isset($_GET['city'])) {

    $_SESSION['city_check'] = $_GET['city'];

}else{
    $_SESSION['city_check'] = '';
}

//Important Dont delete
$WHERE = array();
$inner = $w = '';

// Category Check starts
if (!empty($_SESSION['cat_check'])) {
    if (strstr($_SESSION['cat_check'], ',')) {
        $data2 = explode(',', $_SESSION['cat_check']);
        $cat_array = array();
        foreach ($data2 as $c) {
//            $cat_array[] = "t1.category_id = $c";
            $cat_array[] = "FIND_IN_SET($c,t1.category_id)";

        }
        $WHERE[] = '(' . implode(' OR ', $cat_array) . ')';
    } else {
//        $WHERE[] = '(t1.category_id = ' . $_SESSION['cat_check'] . ')';
        $WHERE[] = '(FIND_IN_SET(' . $_SESSION['cat_check'] . ',t1.category_id))';

    }
}

// Category Check Ends


//Sub Category Check starts
if (!empty($_SESSION['sub_cat_check'])) {
    if (strstr($_SESSION['sub_cat_check'], ',')) {
        $data2 = explode(',', $_SESSION['sub_cat_check']);
        $sub_cat_array = array();
        foreach ($data2 as $c) {
//            $sub_cat_array[] = "t1.sub_category_id = $c";
            $sub_cat_array[] = "FIND_IN_SET($c,t1.sub_category_id)";

        }
        $WHERE[] = '(' . implode(' OR ', $sub_cat_array) . ')';
    } else {
//        $WHERE[] = '(t1.category_id = ' . $_SESSION['sub_cat_check'] . ')';
        $WHERE[] = '(FIND_IN_SET(' . $_SESSION['sub_cat_check'] . ',t1.sub_category_id))';

    }
}

//Sub Category Check Ends

//City Check starts
if (!empty($_SESSION['city_check'])) {

    if (strstr($_SESSION['city_check'], ',')) {
        $data8 = explode(',', $_SESSION['city_check']);
        $cityarray = array();
        foreach ($data8 as $ci) {
            $cityarray[] = "FIND_IN_SET($ci,t1.city_id)";

        }
        $WHERE[] = '(' . implode(' OR ', $cityarray) . ')';
    } else {
//        $WHERE[] = '(t1.category_id = ' . $_SESSION['cat_check'] . ')';
        $WHERE[] = '(FIND_IN_SET(' . $_SESSION['city_check'] . ',t1.city_id))';

    }

}

//City Check Ends


$w = implode(' AND ', $WHERE);
if (!empty($w)) {
    $w = 'WHERE ' . $w;
    $q = 'AND ';
} else {
    $q = 'WHERE ';
}
$sql1 = mysqli_query($conn, "SELECT t1 . listing_lat, t1 . listing_lng FROM  " . TBL . "listings  AS t1 $inner $w $q listing_status= 'Active' AND listing_is_delete != '2' ORDER BY listing_id DESC ");
while ($row1 = mysqli_fetch_array($sql1)) {

    $lat[] =  $row1['listing_lat'];
    $lng[]=  $row1['listing_lng'];
}

$lat = array_filter($lat);
$lng = array_filter($lng);
$latitude_average = array_sum($lat)/count($lat);
$longitude_average1 = array_sum($lng)/count($lng);

if(($latitude_average !=0 || $latitude_average != NULL)&&($longitude_average1 !=0 || $longitude_average1 != NULL)) {
    $_SESSION['lati'] = $latitude_average;
    $_SESSION['longi'] = $longitude_average1;
}else{
    unset($_SESSION['lati']);
    unset($_SESSION['longi']);
}

//Important Dont delete

?>
<span id="map-error-box" class="map-error-box" style="display:none;">!!! Oops No Listing with the Selected Category</span>
<div class="list-map-resu map-view" id="map-view"></div>
<div class="list-map-filt">
    <div class="map-fi-com map-fi-view">
        <div class="vfilter">
            <i class="material-icons ic-map-1" title="Grid view">apps</i>
            <i class="material-icons ic-map-2" title="List view">format_list_bulleted</i>
            <i class="material-icons ic-map-3 act" title="Map view">layers</i>
        </div>
    </div>
    <?php if ($all_listing_filter_row['category_filter'] == "Active") {
        ?>
        <div class="map-fi-com map-fi-cate">
            <select onChange="SubcategoryFilter1(this.value);" name="cat_check" id="cat_check1"
                    class="cat_check chosen-select ">
                <option value=""><?php echo $BIZBOOK['SELECT_CATEGORY'];?></option>
                <?php
                foreach (getAllActiveCategoriesPos() as $categories_row) {
                    ?>
                    ?>
                    <option <?php if ($category_id === $categories_row['category_id']) {
                        echo 'selected';
                    } ?>
                        value="<?php echo $categories_row['category_slug']; ?>"><?php echo $categories_row['category_name']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    <?php } ?>
    <?php /*<div class="sub_cat_section1 map-fi-com map-fi-subcate">
        <select name="sub_cat_check" id="sub_cat_check1" class="sub_cat_check">
            <option value="">Select sub-category</option>
            <?php
            if (isset($_GET['category'])) {
                $sub_category_qry = getCategorySubCategories($category_id);
            } else {
                $sub_category_qry = getAllSubCategories();
            }
            foreach ($sub_category_qry as $sub_category_row) { ?>
                <option <?php if ($_SESSION['sub_cat_check'] === $sub_category_row['sub_category_id']) {
                    echo 'selected';
                } ?> value="<?php echo $sub_category_row['sub_category_id']; ?>">
                    <?php echo $sub_category_row['sub_category_name']; ?></option>
                <?php
            }
            ?>
        </select>
    </div>?>
    <?php
    if ($all_listing_filter_row['rating_filter'] == "Active") {
        ?>
        <?php /*<div class="map-fi-com map-fi-rat">
            <select id="rating_check1" name="rating_check">
                <option value="">Select Rating</option>
                <option value="5">5 Star</option>
                <option value="4">4 Star</option>
                <option value="3">3 Star</option>
                <option value="2">2 Star</option>
                <option value="1">1 Star</option>
            </select>
        </div>?>
        <?php
    }
    if ($all_listing_filter_row['city_filter'] == "Active") {
        ?>
        <div class="map-fi-com map-fi-fea">
            <select id="city_check1" name="city_check">
                <option value=""><?php echo $BIZBOOK['SELECT_YOUR_STATE'];?></option>
                <?php
                foreach (getAllListingCities() as $listrow) {
                    
                    if (strpos($listrow['city_id'], ',') !== false) {
                        $city_id_array = explode(',', $listrow['city_id']);
                        foreach ($city_id_array as $places) {
                            $cityrow = getCity($places);
                            ?>
                            <option <?php if ($_SESSION['city_check'] === $cityrow['city_id']) {
                                echo 'selected';
                            } ?> value="<?php echo $cityrow['city_id']; ?>"><?php echo $cityrow['city_name']; ?></option>
                            <?php
                        }
                    } else {
                        $cityrow = getCity($listrow['city_id']);

                        ?>
                        <option
                            <?php if ($_SESSION['city_check'] === $cityrow['city_id']) {
                                echo 'selected';
                            } ?>
                            value="<?php echo $cityrow['city_id']; ?>"><?php echo $cityrow['city_name']; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <?php
    }
    if ($all_listing_filter_row['feature_filter'] == "Active") {
        ?>
        <div class="map-fi-com map-fi-fea">
            <select id="feature_check1" name="feature_check">
                <option value=""><?php echo $BIZBOOK['SELECT_FEATURE'];?></option>
                <?php
                foreach (getAllActiveFeaturedFilter() as $featuredfilterrow) {
                    ?>
                    <option <?php if ($_SESSION['feature_check'] == $featuredfilterrow['all_featured_filter_value']) {
                        echo 'selected';
                    } ?>
                        value="<?php echo $featuredfilterrow['all_featured_filter_value']; ?>"><?php echo $featuredfilterrow['all_featured_filter_name']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <?php
    }
    ?>
    
</div>

<?php
include "custom-geo-map.php";
?>
<script src="<?php echo $slash;?>js/jquery.min.js"></script>
<script src="<?php echo $slash;?>js/popper.min.js"></script>
<script src="<?php echo $slash;?>js/bootstrap.min.js"></script>
<script src="<?php echo $slash;?>js/jquery-ui.js"></script>
<script>
    $('.ic-map-1').on('click', function () {
        window.location = "all-listing?grid=yes&category=<?php echo $_GET['category']; ?>";
    });
    $('.ic-map-2').on('click', function () {
        window.location = "all-listing?list=yes&category=<?php echo $_GET['category']; ?>";
    });
</script>
<script>
    //    $(".city_check, .sub_cat_check ,.rating_check, .feature_check").on( "click", mapListingFilter );
//    $("select").on("change", mapListingFilter);
    $('#cat_check1').change(mapListingFilter);
    $('#sub_cat_check1').change(mapListingFilter);
    $('#city_check1').change(mapListingFilter);
    $('#feature_check1').change(mapListingFilter);
    function mapListingFilter() {

//        $(".map-view").css("opacity",0);

        var mainarray = [];

        var size = [];
        $('input[name="scheck"]:checked').each(function () {
            size.push($(this).val());
            $('.spansizecls').css('visibility', 'visible');
        });
        if (size == '') $('.spansizecls').css('visibility', 'hidden');
        var size_checklist = "&scheck=" + size;

        //To get Category values from All listing page starts

        var cat_check = [];
        $('#cat_check1 :selected').each(function () {
            // $('input[name="cat_check"]:checked').each(function(){
            cat_check.push($(this).val());
        });

        var cat_checklist = "&category=" + cat_check;

        //To get Category values from All listing page ends


        //To get Sub category values from All listing page starts

        var sub_cat_check = [];
        $('#sub_cat_check1 :selected').each(function () {
            sub_cat_check.push($(this).val());

        });

        var sub_cat_checklist = "&sub_category=" + sub_cat_check;

        //To get Sub category values from All listing page ends

        //To get Feature values from All listing page starts

        var feature_check = [];
        $('#feature_check1 :selected').each(function () {
//        $('input[name="feature_check"]:checked').each(function(){
            feature_check.push($(this).val());

        });

        var feature_checklist = "&feature=" + feature_check;

        //To get Feature values from All listing page ends

        var city_check = [];
        $('#city_check1 :selected').each(function () {
//        $('input[name="city_check"]:checked').each(function () {
            city_check.push($(this).val());

        });
        var city_checklist = "&city=" + city_check;


        //To get Rating values from All listing page starts

        var rating_check = [];
        $('#rating_check1 :selected').each(function () {
//        $('input[name="rating_check"]:checked').each(function(){
            rating_check.push($(this).val());
        });
        var rating_checklist = "&rating=" + rating_check;

        //To get Rating values from All listing page ends


//        var main_string = size_checklist + cat_checklist + sub_cat_checklist + rating_checklist + city_checklist + feature_checklist;
        var main_string = cat_checklist + sub_cat_checklist + city_checklist + feature_checklist;
        main_string = main_string.substring(1, main_string.length);

        window.location = "all-listing?map=yes&"+main_string;
        

//        $.ajax({
//            type: "POST",
//            url: 'map-view-process.php',
//            data: main_string,
//            cache: false,
//            success: function (html) {
////                alert((new XMLSerializer()).serializeToString(html));
//                location.reload();
//                $(".all-list-bre, .all-listing").hide();
//                $(".list-map").show();
////                $.getScript("https://maps.googleapis.com/maps/api/js?key=<?php ////echo $footer_row['admin_geo_map_api']; ?>////&callback=initMap");
//
//            }
//        });
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo $footer_row['admin_geo_map_api']; ?>&callback=initMap">
</script>
<script>
    function SubcategoryFilter1(val) {
//        alert(val);
//        $(".sub_cat_section").remove();
//        breadcrumbs(val);                        //Function call to change breadcrumb
        $(".sub_cat_section1").css("opacity", 0);
        $.ajax({
            type: "POST",
            url: "sub_category_map_filter.php",
            data: 'category_id=' + val,
            success: function (data) {
                if (data == null) {
                    $(".sub_cat_section1").remove();
                } else {
                    $(".sub_cat_section1").html(data);
                    $(".sub_cat_section1").css("opacity", 1);
                }

            }
        });
    }
</script>