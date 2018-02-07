<?php
include "phpqrcode.php";
$qrdata = $_SERVER['QUERY_STRING'];
QRcode::png($qrdata,false,QR_ECLEVEL_H,6,4);
?>