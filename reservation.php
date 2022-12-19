<?php
session_start();
?>

<?php
    include 'dbconnect.php';
?>

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <title>Connection</title>

</head>
<body>
<?php include('header.php'); ?>
<div id= "evenement">
<?php
//On vérifie qu'une variable GET à été transmise
if(isset($_GET['id']))
{
  //On se sert de la variable GET pour récupérer l'entrée dans la table correspondant au membre choisi
  $query_id = $mysqli->query("SELECT * from utilisateurs inner join reservations on utilisateurs.id = reservations.id_utilisateur where reservations.id = ".$_GET['id']);
  $result=$query_id->fetch_all();
      //var_dump($result);
  echo '<h1>'.$result[0][4].'</h1><br>
  <p>Description : '.$result[0][5].'</p><br>
  <p>Heure de début : '.$result[0][6].'
   / Heure de fin : '.$result[0][7].'</p><br>
  <p>Réservation faîte par : '.$result[0][1].'</p>';

}
else die("Aucun utilisateur choisi");
?>

</div>

</body>