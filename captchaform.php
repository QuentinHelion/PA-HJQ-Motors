<?php

session_start();

?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Captcha</title>

</head>

<body>

  <style>
  body{
    padding: 0;
    margin: 0;
    background-image: url('../img/photo.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
  }

  #change {
  text-align: center;
  margin-top:15%;
  }

  #grandi{
    font-size: 5em;
    color: #2a2c2c;
  }
  #grand{
    font-size: 2em;
  }

  </style>

<form id='change'method="POST" action="verif_captcha.php">

<h4 id="grandi" >Recopier ce que vous voyez ! </h4>
<img id="grand"src="captcha.php" style="width: 5%;" > <br><br>
<input class="btn btn-primary btn" id="grand"type="text" name="captcha" > <br><br>
<input class="btn btn-dark btn" id="grand" type="submit" >


</form>

</body>

</html>
