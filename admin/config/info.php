<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if(file_exists('config/db.php'))
{
    include('config/db.php');
}

if(file_exists('config/config.php'))
{
    include('config/config.php');
}

if(file_exists('config/all_texts.php'))
{
    include('config/all_texts.php');
}

if (file_exists('classes/index.function.php')) 
{
    include('classes/index.function.php');
}


$current_page = basename($_SERVER['PHP_SELF']);
?>