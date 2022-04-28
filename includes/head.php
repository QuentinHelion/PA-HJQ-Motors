<meta charset="utf-8">
<link rel="icon" type="image/png" href="uploads/icon.png">
<!-- lien bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<!-- lien icon bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
<?php
  $path = "uploads/";
  include('includes/motoMessage.php');
  session_start();
  if(!isset($_SESSION['id'])){
    include('includes/pub.php');
  }
  include('includes/tracking.php');
?>
