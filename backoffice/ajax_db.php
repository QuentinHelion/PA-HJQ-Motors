<?php

  include('../includes/db_connexion.php');

  switch($_GET['db']){
    case 'event':
      echo
        "<table class='table table-striped mt-4'>
          <tr>
            <th scope='col'> id </th>
            <th scope='col'> Titre </th>
            <th scope='col'> Créateur </th>
            <th scope='col'> Type </th>
            <th scope='col'> Date </th>
            <th scope='col'> Image </th>
          </tr>";
          $s = 'SELECT event.id, event.title, event.type, event.image_0, event.date_event, users.firstname ,users.lastname
                FROM event,users
                WHERE users.id = event.id_creater AND title LIKE "%'.htmlspecialchars($_GET['id']).'%"';
          $req_select = $db->query($s);
          $select = $req_select->fetchAll(PDO::FETCH_ASSOC);

          foreach ($select as $event) {
            $date = date_create($event["date_event"]);
            echo '<tr>
                    <td scope="row"><a href="../event_page.php?id='.$event["id"].'">'.$event["id"].'</a></td>
                    <td scope="row"><a href="../event_page.php?id='.$event["id"].'">'.$event["title"].'</a></td>
                    <td scope="row"><a href="../event_page.php?id='.$event["id"].'">'.$event["firstname"].' '.$event["lastname"].'</a></td>
                    <td scope="row"><a href="../event_page.php?id='.$event["id"].'">'.$event["type"].'</a></td>
                    <td scope="row"><a href="../event_page.php?id='.$event["id"].'">'.date_format($date,"d/m/Y").'</a></td>
                    <td scope="row"><img src="../uploads/event/'.$event["image_0"].'"/></td>
                  </tr>';
          }
          echo "</table>";
      break;

    case 'moto':
      echo
        "<table class='table table-striped mt-4'>
          <tr>
            <th scope='col'> id </th>
            <th scope='col'> Marque </th>
            <th scope='col'> Model </th>
            <th scope='col'> Puissance </th>
            <th scope='col'> Permis requis </th>
            <th scope='col'> Age minimum </th>
            <th scope='col'> Ajout </th>
            <th scope='col'> Image </th>
          </tr>";
          $s = 'SELECT moto.id, moto.marque, moto.model, moto.puissance, moto.permis_req, moto.age_min, moto.image1, moto.add_date, users.firstname ,users.lastname
                FROM moto,users
                WHERE users.id = moto.add_admin AND (moto.model LIKE "%'.htmlspecialchars($_GET['id']).'%"  OR moto.marque LIKE "%'.htmlspecialchars($_GET['id']).'%")';
          $req_select = $db->query($s);
          $select = $req_select->fetchAll(PDO::FETCH_ASSOC);

          foreach ($select as $moto) {
            $date = date_create($moto["add_date"]);
            echo '<tr>
                    <td scope="row"><a href="../moto_page.php?id='.$moto["id"].'">'.$moto["id"].'</a></td>
                    <td scope="row"><a href="../moto_page.php?id='.$moto["id"].'">'.$moto["marque"].'</a></td>
                    <td scope="row"><a href="../moto_page.php?id='.$moto["id"].'">'.$moto["model"].'</a></td>
                    <td scope="row"><a href="../moto_page.php?id='.$moto["id"].'">'.$moto["puissance"].'</a></td>
                    <td scope="row"><a href="../moto_page.php?id='.$moto["id"].'">'.$moto["permis_req"].'</a></td>
                    <td scope="row"><a href="../moto_page.php?id='.$moto["id"].'">'.$moto["age_min"].'</a></td>
                    <td scope="row"><a href="../moto_page.php?id='.$moto["id"].'">'.$moto["firstname"].' '.$moto["lastname"].' '.date_format($date,"d/m/Y").'</a></td>
                    <td scope="row"><img src="../uploads/motos/'.$moto["image1"].'"/></td>
                  </tr>';
          }
          echo "</table>";
      break;
    case 'equipement':
      echo
        "<table class='table table-striped mt-4'>
          <tr>
            <th scope='col'> id </th>
            <th scope='col'> Type </th>
            <th scope='col'> Marque </th>
            <th scope='col'> Model </th>
            <th scope='col'> Prix </th>
            <th scope='col'> Ajout </th>
            <th scope='col'> Image </th>
          </tr>";
          $s = 'SELECT equipement.id, equipement.type, equipement.marque, equipement.model, equipement.prix, equipement.image1, equipement.add_date, users.firstname ,users.lastname
                FROM equipement,users
                WHERE users.id = equipement.add_admin AND (equipement.model LIKE "%'.htmlspecialchars($_GET['id']).'%" OR equipement.marque LIKE "%'.htmlspecialchars($_GET['id']).'%" OR equipement.type LIKE "%'.htmlspecialchars($_GET['id']).'%")';
          $req_select = $db->query($s);
          $select = $req_select->fetchAll(PDO::FETCH_ASSOC);

          foreach ($select as $equipement) {
            $date = date_create($equipement["add_date"]);
            echo '<tr>
                    <td scope="row"><a href="../equipement_page.php?id='.$equipement["id"].'">'.$equipement["id"].'</a></td>
                    <td scope="row"><a href="../equipement_page.php?id='.$equipement["id"].'">'.$equipement["type"].'</a></td>
                    <td scope="row"><a href="../equipement_page.php?id='.$equipement["id"].'">'.$equipement["marque"].'</a></td>
                    <td scope="row"><a href="../equipement_page.php?id='.$equipement["id"].'">'.$equipement["model"].'</a></td>
                    <td scope="row"><a href="../equipement_page.php?id='.$equipement["id"].'">'.$equipement["prix"].'</a></td>
                    <td scope="row"><a href="../equipement_page.php?id='.$equipement["id"].'">'.$equipement["firstname"].' '.$equipement["lastname"].''.date_format($date,"d/m/Y").'</a></td>
                    <td scope="row"><img src="../uploads/equipements/'.$equipement["image1"].'"/></td>
                  </tr>';
          }
          echo "</table>";
      break;
    case 'reservation':
      echo
        "<table class='table table-striped mt-4'>
					<tr>
						<th scope='col'> Numéro </th>
						<th scope='col'> Utilisateur </th>
            <th scope='col'> Moto </th>
						<th scope='col'> Du </th>
            <th scope='col'> Au </th>
					</tr>";
          $s = 'SELECT reservation.id, reservation.date_from, reservation.date_to, users.firstname, users.lastname, moto.marque, moto.model
                FROM reservation,users,moto
                WHERE reservation.id_user = users.id AND reservation.id_moto = moto.id AND (users.firstname LIKE "%'.htmlspecialchars($_GET['id']).'%" OR users.lastname LIKE "%'.htmlspecialchars($_GET['id']).'%" OR moto.model LIKE "%'.htmlspecialchars($_GET['id']).'%")';
          $req_select = $db->query($s);
          $select = $req_select->fetchAll(PDO::FETCH_ASSOC);

          foreach ($select as $reserv) {
            $date_from = date_create($reserv["date_from"]);
            $date_to = date_create($reserv["date_to"]);
            echo '<tr>
                   <td scope="row">' . $reserv['id'] .'</td>
                   <td scope="row">' . $reserv['firstname'] .' '.$reserv['lastname']. '</td>
                   <td scope="row">' . $reserv['marque'] .' '. $reserv['model'] .'</td>
                   <td scope="row">' . date_format($date_from,"d/m/Y") .'</td>
                   <td scope="row">' . date_format($date_to,"d/m/Y") .'</td>
                  </tr>';
            }
          echo "</table>";
      break;
    case 'annonce':
      echo
        "<table class='table table-striped mt-4'>
  				<tr>
            <th scope='col'> id </th>
            <th scope='col'> Titre de l'annonce </th>
            <th scope='col'> Prix </th>
            <th scope='col'> Ajouter le </th>
            <th scope='col'> Par </th>
  				</tr>";
          $s = 'SELECT annonce.id, annonce.title, annonce.price, annonce.add_date, users.firstname, users.lastname
                FROM annonce,users
                WHERE annonce.id_creater = users.id AND (users.firstname LIKE "%'.htmlspecialchars($_GET['id']).'%" OR users.lastname LIKE "%'.htmlspecialchars($_GET['id']).'%" OR annonce.title LIKE "%'.htmlspecialchars($_GET['id']).'%")';
          $req_select = $db->query($s);
          $select = $req_select->fetchAll(PDO::FETCH_ASSOC);

          foreach ($select as $annonce) {
            $date = date_create($annonce["add_date"]);
            echo '<tr>
                   <td scope="row"><a href="../annonce_page.php?id='.$annonce['id'].'">' . $annonce['id'] .'</a></td>
                   <td scope="row"><a href="../annonce_page.php?id='.$annonce['id'].'">' . $annonce['title'] .'</a></td>
                   <td scope="row"><a href="../annonce_page.php?id='.$annonce['id'].'">' . $annonce['price'] .'</a></td>
                   <td scope="row"><a href="../annonce_page.php?id='.$annonce['id'].'">' . date_format($date,"d/m/Y") .'</a></td>
                   <td scope="row"><a href="../annonce_page.php?id='.$annonce['id'].'">' . $annonce['firstname'] .' '.$annonce['lastname']. '</a></td>
                  </tr>';
            }
          echo "</table>";
      break;
    case 'users':
      echo
        "<table class='table table-striped mt-4'>
          <tr>
            <th scope='col'> id </th>
            <th scope='col'> Prénom </th>
            <th scope='col'> Nom </th>
            <th scope='col'> Email </th>
            <th scope='col'> Téléphone </th>
            <th scope='col'> Adresse </th>
            <th scope='col'> Date de naissance </th>
            <th scope='col'> Permis </th>
            <th scope='col'> Photo permis </th>
            <th scope='col'> Photo profil </th>
          </tr>";
          $s = 'SELECT id, firstname, lastname, email, tel, adresse, birth_date, permis_class, permis_img, pp
                FROM users
                WHERE (firstname LIKE "%'.htmlspecialchars($_GET['id']).'%" OR lastname LIKE "%'.htmlspecialchars($_GET['id']).'%")';
          $req_select = $db->query($s);
          $select = $req_select->fetchAll(PDO::FETCH_ASSOC);

          foreach ($select as $users) {
            $date = date_create($users["birth_date"]);
            echo '<tr>
                   <td scope="row">' . $users['id'] .'</td>
                   <td scope="row">' . $users['firstname'] .'</td>
                   <td scope="row">' . $users['lastname'] .'</td>
                   <td scope="row">' . $users['email'] .'</td>
                   <td scope="row">' . $users['tel'] .'</td>
                   <td scope="row">' . $users['adresse'] .'</td>
                   <td scope="row">' . date_format($date,"d/m/Y") .'</td>
                   <td scope="row">' . $users['permis_class'] .'</td>
                   <td scope="row"><img src="../uploads/photos_profils/' . $users["permis_img"] .'"/></td>
                   <td scope="row"><img src="../uploads/photos_profils/' . $users["pp"] .'"/></td>
                  </tr>';
            }
          echo "</table>";
      break;
  }
?>
