<?php

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1

$imagesDir = '3615_files/';

$images = glob($imagesDir . '*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);

shuffle($images);

$randomImages = array_rand($images, 3);

// echo '<div class="mntl-title"><img src="/MaisonNue/assets/3615/3615.svg" onerror="this.src="img/logo_mn.png"; this.onerror=null;" alt="3615"></div>';

foreach ($randomImages as $key => $value) {
	list($width, $height, $type, $attr) = getimagesize($images[$value]);
	echo "<div class='image new' data-width=".$width." data-height=".$height."><img src='http://".$_SERVER['HTTP_HOST'].'/MaisonNue/3615/'.$images[$value]."'></div>";
}
?>
