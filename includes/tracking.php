<?php
  include("db_connexion.php");

  if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ipClient = $_SERVER['HTTP_CLIENT_IP'];
  }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ipClient = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }else{
    $ipClient = $_SERVER['REMOTE_ADDR'];
  }


  $page = $_SERVER['REQUEST_URI'];
  $page = explode('/',$page);
  $page = end($page);
  $page = explode('?',$page);
  $page = $page[0];


  $session =  isset($_SESSION['id']) ? $_SESSION['id'] : NULL;

  if($ipClient && $page){
    $i = "INSERT INTO track (ip,page,user_id) VALUES (:ip, :page,:user_id)";
    $req_insert = $db->prepare($i);
    $req_insert->execute([
      'ip' => $ipClient,
      'page' => $page,
      'user_id' => $session
    ]);
  }

?>
