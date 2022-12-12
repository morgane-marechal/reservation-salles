<?php
session_start();
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <title>Profil</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    </head>
<?php include 'dbconnect.php';?>
<body>
<?php include('header.php'); ?> 

    <main>
            <h2>Paramètres du profil</h2>
            <?php
     $login=$_SESSION['login'];
     if ($_POST['newlogin']){
        $login=$_SESSION['login'];
        $changelogin=$_POST['newlogin'];

        $check_login = "SELECT count(*) FROM utilisateurs where login = '$changelogin'";
        $exec_requete = mysqli_query($mysqli,$check_login);
        $reponse = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        echo $count;
        if($count==0){       
            echo "<p>Changement de login $login en $changelogin. Veuillez rafraichir la page</p>";
            $sqllogin = "update utilisateurs set login = '$changelogin' where login = '$login'";
            $rs = mysqli_query($mysqli,$sqllogin);
            $_SESSION['login']=$changelogin;
        } else {
            $login_error= "Ce nom de login est déjà utilisé";
        }
    }elseif (($_POST['newpassword']) && ($_POST['newconf_password']) && (($_POST['newpassword']) == ($_POST['newconf_password'])) ){
        //echo "Changement de MP";
        $newpassword=$_POST['newpassword'];
        $newsecurepassword = password_hash($newpassword, PASSWORD_DEFAULT);
        $sqlpassword = "update utilisateurs set password = '$newsecurepassword' where login = '$login'";
        $rs = mysqli_query($mysqli,$sqlpassword); 
    }
    ?> 
            <section id="compte_form">
                <form action="" method="post" autocomplete="off">
                    <h3>Modification du compte</h3>
                    <input type="text" name="newlogin" id="login" placeholder= "<?php echo $_SESSION['login']; ?>" minlength="3" autocomplete="off">
                    <?php if ($_POST['newlogin']&&$count==0) 
                    {echo "<p>Vous avez bien changé votre login en ".$_POST['newlogin']."</p>"; }
                    if ($_POST['newlogin']&&$count!=0) 
                    {echo "<p>$login_error</p>"; }?>
                    <input type="text" name="newpassword" id="password" placeholder= "*****" minlength="5">
                    <input type="text" name="newconf_password" id="conf_password" placeholder="*****" minlength="5">
                    <?php if(($_POST['newpassword']) && ($_POST['newconf_password']) && (($_POST['newpassword']) == ($_POST['newconf_password']))) 
                    {echo "<p>Vous avez bien changé votre mot de passe en ".$_POST['newpassword']."</p>"; }
                    if(($_POST['newpassword']) && ($_POST['newconf_password']) && (($_POST['newpassword']) != ($_POST['newconf_password']))) 
                    {echo "<p>Erreur dans la confirmation du mot de passe</p>"; }
                    ?>
                    </select>
                    <input class="submit" type="submit" value="Modifier">
                    <i class="small">* Mofidier le champs que vous voulez changer, un seul champs à la fois. 5 caractère minimum pour le mot de passe.</i>
                </form>
            </section>
    

    

    
    
                <?php 
                    echo "<h2>Hello ".$_SESSION['login']." !</h2>";
                    echo "<br>";

                    ?>

        

    </main>

    <?php include('footer.php'); ?>

</body>