<header>
        <nav>
        <li><?php if (isset($_SESSION['login'])){echo "<p>Bienvenue ".$_SESSION['login']." ! Vous êtes connecté ! </p>";}?></li>

            <ul>
                <li><a href=index.php>Home</a></li>
                <li><a href=planning.php>Planning</a></li>
                <?php if (isset($_SESSION['login'])&& !empty($_SESSION['login'])){?>
                <li><a href=reservation-form.php>Faire une réservation</a></li>
                <li><a href=profil.php>Profil</a></li>
                <li><a href=logout.php>Déconnexion</a></li>
                <?php } ?>
                <?php if (empty($_SESSION['login'])){?>
                <li><a href=connection.php>Connexion</a></li>
                <li><a href=inscription.php>Inscription</a></li>
                <?php } ?>

            </ul>
        </nav>
    </header>