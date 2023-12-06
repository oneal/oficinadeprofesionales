<?php

$caducidad = time() + (60 * 60 * 24 * 365);
$value = md5(md5(time()+1000));
setcookie('c_9iyy1aqp7', $value, $caducidad);

echo 1;

