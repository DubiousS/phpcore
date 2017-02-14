<?php
session_start();
$Random = rand(10001, 99999);
$_SESSION['captcha'] = md5(md5($Random).'cod'.md5($Random));
$im = imagecreatetruecolor(135, 50);
imagefilledrectangle($im, 0, 0, 173, 50, imagecolorallocate($im, 155, 155, 155));
imagettftext($im, 60, 0, 20, 35, imagecolorallocate($im, 255, 255, 255), 'font.ttf', $Random);
header('Expires: Wed, 1 Jan 1997 00:00:00 GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header ('Content-type: image/gif');
imagegif($im);
imagedestroy($im);
?>