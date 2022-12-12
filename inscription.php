<?php
session_start();
?>
<?php include 'dbconnect.php';?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <title>Inscription</title>

</head>
<body>
<?php include('header.php'); ?> 
    <div id="sessionlog">
        <?php if (isset($_SESSION['login'])){
                        echo "<p>Bonjour ".$_SESSION['login'].". Vous êtes connecté</p>";
                    }
        ?>
    </div>
    <main>
            <section id="connexion_form">
                <form action="" method="post">
                    <h3>Création de compte</h3>
                    <input type="text" name="login" id="login" placeholder="Login*" required minlength="5"> 
                    <input type="password" name="password" id="password" placeholder="Password*" required minlength="5">
                    <input type="password" name="conf_password" id="conf_password" placeholder="Confirmation du mot de passe*" required minlength="2">
                    </select>
                    <input class="submit" type="submit" value="Envoyer">
                    <i class="small">* Champs obligatoires avec 5 caractères minimum</i>

        
    <?php
     $login = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['login'])); //protection pour éviter injection SQL malveillante
     $password = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['password'])); 
     $checkpassword = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['conf_password'])); //protection pour éviter injection SQL malveillante
         

     $check_login = "SELECT count(*) FROM utilisateurs where login = '$login'";
     $exec_requete = mysqli_query($mysqli,$check_login);
     $reponse = mysqli_fetch_array($exec_requete);
     $count = $reponse['count(*)'];

    if ($count==1){
        $error_login="<p>Ce login est déjà pris, veuillez en choisir un autre!</p>";
        echo $error_login;
    }elseif($password!=$checkpassword) {
        $error_password="<p>Vous n'avez pas retapé correctement le mot de passe</p>";
        echo $error_password;
    }else{
        if (($password==$checkpassword) && (!empty($login)) && (!empty($password))){
        $password = password_hash($password, PASSWORD_DEFAULT); 
            $newuser = "INSERT INTO utilisateurs ( login, password)
            VALUES( '$login', '$password')";
        
            if ($mysqli->query($newuser) === TRUE) {
                //echo "Vous avez ajouté un utilisateur avec succés";
                header('Location: http://localhost/reservation-salles/connection.php'); // <- redirection vers la page connexion si l'inscription fonctionne
                exit();
                } else {
                echo "Erreur: " . $newuser . "
                " . $mysqli->error;
                }

        }elseif ((empty($name)) OR (empty($firstname)) OR (empty($password))){
            $error_empty="<p>L'un des champs du formulaire est vide<p>";
            
        }
    }
    $mysqli->close();
    
    ?>

    </form>
</section>
</main>
<?php include('footer.php'); ?>
</body>
