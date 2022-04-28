<!DOCTYPE html>
<html>
  <head>
    <title>Stats</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
       div.marg{
         margin-left: 10px;
         margin-right: 10px;
         width: 3vw;
         z-index: 1;
         background-color: orange;
       }
       div.marg:hover{
         background-color: #272e38;
       }
       div.position-absolute{
         z-index:0;
         height: 15vh;
       }
      hr#firstChart {
        width: calc(4.5vw*8) !important;
        /* margin-bottom: 10px !important; */
        margin: 0px !important;
      }
      div.d-flex.align-items-end.wrap{
        width:calc(4.5vw*8) !important;
        z-index:0;
        position: absolute;
        height: 15vh;
        flex-wrap: wrap;
      }
      p#statsHour{
        transform: rotate(80deg);
        margin-bottom: -3vh !important;
        height: 10px;
        font-size: .8vw;
      }
      p#statsUsers{
        height: 20px;
        width: 50px;
        transform: rotate(80deg);
        margin-bottom: -6vh !important;
        height: 10px;
        font-size: .8vw;
      }
    </style>
  </head>
  <body>
    <?php include('../includes/backoffice-header.php'); ?>
    <main class="mb-4 pb-4">
      <div class="container mb-4">
        <div class="d-flex justify-content-center" id="charts">
          <div class="d-flex align-items-end wrap">
            <?php
              for($i = 1; $i <= 3; $i++){
                echo '<hr id="firstChart" class="col-12">';
              }
            ?>
          </div>
          <div class="d-flex align-items-end">
            <?php
              $hourArray = ["00h-3h","3h-7h","7h-10h","10h-13h","13h-16h","16h-19h","19h-21h","21h-00h"];
              for($i = 1; $i <= 8; $i++){
                echo '<div class="marg d-flex align-items-end justify-content-center" data-bs-toggle="tooltip" data-bs-placement="top" title="" id='.$i.'><p id="statsHour">'.$hourArray[$i-1].'</p></div>';
              }
            ?>
          </div>
        </div>
        <script>
          let array = [];

          function bigger(array){
            let bigger = 0;
            for(let i = 0; i < array.length; i++){
              if(array[i] > bigger){
                bigger = array[i];
              }
            }
            // document.getElementById('max').innerHTML = bigger;
            return bigger;
          }

          function setSize(array, bigger){
            for(let i = 0; i < array.length; i++){
              const div = document.getElementById(i+1);
              let taille = (array[i]*15)/bigger;
              div.style.height = taille+"vh";
              div.title = array[i];
            }
          }

        </script>
        <?php
          include("../includes/db_connexion.php");
          for($i = 0; $i <= 21; $i += 3){
            $s = 'SELECT COUNT(*) FROM track WHERE (DATE_FORMAT(hour,"%H") > '.$i.' OR (DATE_FORMAT(hour,"%H") = '.$i.' AND DATE_FORMAT(hour,"%i") > 1 ))  AND DATE_FORMAT(hour,"%H") <= '.($i+3);
            $req_select = $db->query($s);
            $select = $req_select->fetch();
            echo "<script>array.push(".$select[0].")</script>";
          }
          echo '<script>let biigger = bigger(array);
                        setSize(array,biigger);</script>';

        ?>

        <br>
        <div class="d-flex justify-content-center mt-5">
          <div class="mt-5" id="charts" style="width: 35vw">
            <?php
              $s = 'SELECT COUNT(page), page FROM track GROUP BY page ORDER BY COUNT(page) DESC';
              $req_select = $db->query($s);
              $select = $req_select->fetchAll();
              $y = 0;
              $maxWidth = $select[0][0]; //prend le premier count
              foreach($select as $stats){
                if($y <= 4){
                  $y++;
                  $width = (20*$stats[0])/$maxWidth; //produit en crois
                  echo '<div class="d-flex" style="width:35vw">
                          <p style="width: 10vw; text-align: end">'.$stats['page'].'</p>
                          <div class="marg border" title="'.$stats[0].'" style="width:'.$width.'vw; height: 4vh"></div>
                        </div>';
                }
              }
            ?>
          </div>
        </div>
        <div class="d-flex justify-content-center mt-5 mb-3">
          <div class="d-flex mt-5 align-items-end " id="charts" style="20vh">
            <?php
              $s = 'SELECT COUNT(*) FROM track';
              $req_select = $db->query($s);
              $totalLine = $req_select->fetch();
              $totalLine = $totalLine[0];

              $s = 'SELECT COUNT(user_id) FROM track';
              $req_select = $db->query($s);
              $totalConnect = $req_select->fetch();

              $totalNoConnect = $totalLine - $totalConnect[0]; //total d'utilisateurs non connecter

              $totalConnect = ($totalConnect[0]*20)/$totalLine; //converti en taille le total d'utilisateurs connecter
              $totalNoConnect = ($totalNoConnect * 20)/$totalLine; //converti en taille le total d'utilisateurs non connecter

              echo '<div class="marg d-flex align-items-end justify-content-center" style="height:'.$totalConnect.'vh" data-bs-toggle="tooltip" data-bs-placement="top" title="'.(($totalConnect*100)/20).'%"><p id="statsUsers">Connecter</p></div>
                    <div class="marg d-flex align-items-end justify-content-center" style="height:'.$totalNoConnect.'vh" data-bs-toggle="tooltip" data-bs-placement="top" title="'.(($totalNoConnect*100)/20).'%"><p id="statsUsers">Non connecter</p></div>';
            ?>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
