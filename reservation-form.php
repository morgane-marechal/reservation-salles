<?php
session_start();
?>
<?php include 'dbconnect.php';?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <title>Formulaire de réservation</title>
</head>

<body>
    <?php include('header.php'); ?> 

    <section id="reservation_form">
        <form action="" method="post">
            <h3>Réservation</h3>
            <input class= "titre" type="text" name="titre" id="titre" placeholder="Nom de la réservation*" required >
            </select>
            <label for="heure_debut">Heure de début :</label>
            <SELECT name="heure_debut" >
            <OPTION>8h
            <OPTION>9h
            <OPTION>10h
            <OPTION>11h
            <OPTION>12h
            <OPTION>13h
            <OPTION>14h
            <OPTION>15h
            <OPTION>16h
            <OPTION>17h
            <OPTION>18h
            </SELECT>

            <label for="heure_fin">Heure de fin :</label>
            <SELECT name="heure_fin" >
            <OPTION>9h
            <OPTION>10h
            <OPTION>11h
            <OPTION>12h
            <OPTION>13h
            <OPTION>14h
            <OPTION>15h
            <OPTION>16h
            <OPTION>17h
            <OPTION>18h
            <OPTION>19h
            </SELECT>
            <label for="date">Date :</label>
            <input id="date" type="date" name="date" >
            <input class= "description" type="text" name="description" id="description" placeholder="Objectif de la réservation*" required >
            </select>
            <input class="submit" type="submit" value="Envoyer">
        </form>

        <?php

/*-------récupération du formulaire sous forme de variable */
        
        $titre = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['titre'])); 
        $description = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['description'])); 
        $hdebut=$_POST['heure_debut'];
        $hfin=$_POST['heure_fin'];
        $dday=$_POST['date'];
        $int_hdebut = intval($hdebut);
        $int_hfin = intval($hfin);
        $name=$_SESSION['login'];

        /* -------------mettre variable YYYY-MM-DD hh:mm:ss-----------*/
        $hdebut_sql = "$dday $int_hdebut:00:00";
        $hfin_sql = "$dday $int_hfin:00:00";
        echo "Format début : $hdebut_sql<br>Format fin : $hfin_sql<br>";

        //SELECT utilisateurs.id from utilisateurs where login = $name
        $request=$mysqli->query("SELECT utilisateurs.id from utilisateurs where login = '$name'");
        $result=$request->fetch_all();
        //echo var_dump($result);
        $id_utilisateur=$result[0][0];
        $int_utilisateur=(int)$id_utilisateur;

        /* -------------prépare requête sql-----------*/
        $newreservation = "INSERT INTO reservations ( titre, description, debut, fin, id_utilisateur)
        VALUES( '$titre','$description', '$hdebut_sql', '$hfin_sql', '$int_utilisateur' )";

        if($int_hdebut>$int_hfin){
            echo "Vous ne pouvez pas avoir l'heure de fin inférieure à l'heure de début";
        }elseif($int_hdebut==$int_hfin){
            echo "La réservation de la salle dure une heure minimum";
        }else{
            if ($mysqli->query($newreservation) === TRUE) {
                echo "Vous avez ajouté une réservation avec succés";
                } else {
                echo "Erreur: " . $newreservation . "
                " . $mysqli->error;
                }
            echo "Heure de début : ".$hdebut."<br>";
            echo "Heure de fin : ".$hfin."<br>";
            echo "Le : ".$dday."<br>";         
        }
        
        ?>
    </section>
    
</main>


    <?php include('footer.php'); ?>
</body>