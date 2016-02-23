<?php
session_start();
phpinfo();
function randString($length) {
	$char = "123456789BCDFGHJKLMNPQRSTVWXYZ";
	$char = str_shuffle($char);
	for($i = 0, $rand = '', $l = strlen($char) - 1; $i < $length; $i ++) {
		$rand .= $char{mt_rand(0, $l)};
	}
	return $rand;
}
$string = randString(6);
$_SESSION['captchaText'] = $string;
header("Content-Type: image/png");
//$im = @imagecreate(82, 35) or error_log("Cannot Initialize new GD image stream");
$im = imagecreate(82, 35)
$background_color = imagecolorallocate($im, 255, 255, 255);
$text_color = imagecolorallocate($im, 0, 0, 0);
$line_color = imagecolorallocate($im, 120, 120, 120);
$pixel_color = imagecolorallocate($im, 255 , 0, 0);
// for($i=0;$i<3;$i++) {
// 	imageline($im,0,rand()%50,200,rand()%50,$line_color);
// }
for($i=0;$i<100;$i++) {
	imagesetpixel($im,rand()%200,rand()%50,$pixel_color);
}
imagestring($im, 5, 15, 10, $string, $text_color);
imagepng($im);
imagedestroy($im);
?>
