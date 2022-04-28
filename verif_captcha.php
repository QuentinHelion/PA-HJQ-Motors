<?php

session_start();
if(isset($_POST['captcha']) && $_POST['captcha'] == $_SESSION['captcha']){
    header('location: index.php?Captcha valide.');
    exit;
}else {
  header('location: captchaform.php?Captcha invalide.');
  exit;
}



?>
