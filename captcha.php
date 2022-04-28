<?php

session_start();

$_SESSION['captcha'] = mt_rand(1000,9999); // on stock un nombre compris entre 1000 et 9999
$img = imagecreate(100,40);  // création de l'image
$bg = imagecolorallocate($img,0,123,255); // couleur de l'arrière plan de l'image

$text_color = imagecolorallocate($img, 255,255,255); // on stock la couleur dans l'image
$font = 'fonts/Raleway-Light.ttf'; // on stock la police
imagettftext($img, 23,0,0,30, $text_color, $font, $_SESSION['captcha']); // permet d'écrire du texte sur l'image


header("Content-type:image/jpeg"); // permet de dire a notre page d'afficher une image dans le nav
imagejpeg($img); //  permet d'envoyer une img vers le nav
imagedestroy($img); // libère la memoire de l'img

?>
