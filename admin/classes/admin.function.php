<?php

//Get All Super Admin
function getAllSuperAdmin()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "admin WHERE admin_type = 'Super Admin'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All Sub Admins
function getAllSubAdmin()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "admin WHERE admin_type = 'Sub Admin' ORDER BY admin_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

function getAllAdmin()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "admin ORDER BY admin_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular admin using admin id
function getAdmin($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "admin where admin_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

//Obtiene la info de la IP del cliente desde geoplugin
//function ip_info($ip) {
//    $data = @file_get_contents("https://api.ipgeolocationapi.com/geolocate/" . $_SERVER['REMOTE_ADDR']);
//    $items = json_decode($data, true);
//    
//    return $items;
//}

function cif_validation ($cif) {
  $cif = strtoupper($cif);
  if (preg_match('~(^[XYZ\d]\d{7})([TRWAGMYFPDXBNJZSQVHLCKE]$)~', $cif, $parts)) {
    $control = 'TRWAGMYFPDXBNJZSQVHLCKE';
    $nie = array('X', 'Y', 'Z');
    $parts[1] = str_replace(array_values($nie), array_keys($nie), $parts[1]);
    $cheksum = substr($control, $parts[1] % 23, 1);
    return ($parts[2] == $cheksum);
  } elseif (preg_match('~(^[ABCDEFGHIJKLMUV])(\d{7})(\d$)~', $cif, $parts)) {
    $checksum = 0;
    foreach (str_split($parts[2]) as $pos => $val) {
      $checksum += array_sum(str_split($val * (2 - ($pos % 2))));
    }
    $checksum = ((10 - ($checksum % 10)) % 10);
    return ($parts[3] == $checksum);
  } elseif (preg_match('~(^[KLMNPQRSW])(\d{7})([JABCDEFGHI]$)~', $cif, $parts)) {
    $control = 'JABCDEFGHI';
    $checksum = 0;
    foreach (str_split($parts[2]) as $pos => $val) {
      $checksum += array_sum(str_split($val * (2 - ($pos % 2))));
    }
    $checksum = substr($control, ((10 - ($checksum % 10)) % 10), 1);
    return ($parts[3] == $checksum);
  }
  return false;
}

function validation_email($email){
    $reg = "#^(((([a-z\d][\.\-\+_]?)*)[a-z0-9])+)\@(((([a-z\d][\.\-_]?){0,62})[a-z\d])+)\.([a-z\d]{2,6})$#i";
    return preg_match($reg, $email);
}

function validation_phone ($phone){
    return preg_match('/^[0-9]{9,9}$/', $phone); 
}

function dateFormat($date){
    $timestamp = strtotime($date);
    return date('d-m-Y',$timestamp);
}

function generar_texto_amigable($cadena, $delimiter = '-'){
    $slug = strtolower(trim(preg_replace('~[^0-9a-z]+~i', $delimiter, html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($cadena, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), $delimiter));
    return $slug;
}

function generar_texto_amigable_img($fileName){
    $array_img = explode('.', $fileName);
    $name_img = $array_img[0];
    $extension = $array_img[1];
    $file = rand(1000, 100000) . generar_texto_amigable($name_img).".".$extension;
    return $file;
}