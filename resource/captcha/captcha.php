<?php 
 session_save_path("C:/AppServ/www/hexaceram/resource/captcha");
session_start(); 
$width = 160; 
$height = 80; 
$image = imagecreate($width, $height); 
$bgColor = imagecolorallocate($image, 0, 0, 0); 

$length = 7; 
$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; 
$string = ''; 
for ($i = 0; $i < $length; $i++) { 
    $pos = rand(0, strlen($chars)-1); 
    $string .= $chars{$pos}; 
} 
$_SESSION['captchaText'] = md5($string); 

$gridColor = imagecolorallocate($image, 175, 0, 0); 
$lines = ceil($width / 20); 
for($i = 0; $i <$lines; $i++) { 
    $x = ($i + 1) * 20; 
    imageline($image, $x, 0, $x, $height, $gridColor); 
} 
$lines = ceil($height / 10); 
for($i = 0; $i < $lines; $i++) { 
    $y = ($i + 1) * 10; 
    imageline($image, 0, $y, $width, $y, $gridColor); 
} 


$randomNumber = rand(5,40); 
$lineColor = imagecolorallocate($image, 130, 0, 0); 
for($i = 0; $i < $randomNumber; $i++) { 
    $randX = rand(0, $width - 1); 
    $randX2 = rand(0, $width - 1); 
    $randY = rand(0, $height - 1); 
    $randY2 = rand(0, $height - 1); 
    imageline($image, $randX, $randY, $randX2, $randY2, $lineColor); 
} 

// write the text 
$textColor = imagecolorallocate($image, 255, 0, 0); 
$randX = rand(0, $width - 50); 
$randY = rand(0, $height - 15); 
imagestring($image, 10, $randX, $randY, $string, $textColor); 


header ("Content-type: image/png"); 
imagepng($image); 
?>
