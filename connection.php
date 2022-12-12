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
    

    <main>
            <section id="connexion_form">
                <form action="" method="post">
                    <h3>Connexion</h3>
                    <input type="text" name="login" id="login" placeholder="Login*" required minlength="3"> 
                    <input type="password" name="password" id="password" placeholder="Password*" required minlength="5">
                    </select>
                    <input class="submit" type="submit" value="Envoyer">
                    <i class="small">* Champs obligatoires avec 5 caractères minimum</i>
                    <?php
                        $login = mysqli_real_escape_string($mysqli,htmlspecialchars($_POST['login'])); //protection pour éviter injection SQL malveillante
                        //$_SESSION['login'] = $login;
                        //$_SESSION['password'] = $password;

                        //------------------------code pour le formulaire de connexion --------------------------
                    
                        if(isset($_POST['login']) && isset($_POST['password'])){
                            if($login !== "" && $password !== ""){
                                $password_post=$_POST['password'];
                                $request=$mysqli->query("SELECT * FROM utilisateurs where login = '$login'");
                                $result=$request->fetch_all();
                                $password_hash=$result[0][2]; // <-retrouve mot de passe crypté
                                if (password_verify($password_post, $password_hash)) {    //<=password verify pour checker un mot de passe crypté
                                    $requete = "SELECT count(*) FROM utilisateurs where login = '$login' and password= '$password_hash'"; //recherche si login et password cripté existe
                                    $exec_requete = mysqli_query($mysqli,$requete);
                                    $reponse = mysqli_fetch_array($exec_requete);
                                    $count = $reponse['count(*)'];
                                
                                        if($count!=0) // login et mot de passe correctes
                                        {
                                            echo "Bravo vous êtes connectés!";
                                            $_SESSION['login'] = $login;
                                            $_SESSION['password'] = $password_post;
                                            header('Location: http://localhost/reservation-salles/profil.php'); // <- redirection vers la page admin
                                            exit();
                                        }
                                        else
                                        {
                                        $error_info = "Utilisateur ou mot de passe invalide!";
                                        
                                        }

                                    }else{
                                        $error_info = "Utilisateur ou mot de passe invalide!";
                                        echo $error_info;
                                    }
                                }
                            }
                                mysqli_close($mysqli);
                        ?>
                </form>
            </section>
    </main>
    <?php include('footer.php'); ?>
</body>
    
    
        