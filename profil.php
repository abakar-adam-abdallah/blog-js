<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Css/profil.css" rel="stylesheet">
    <style type="text/css">a:link{text-decoration:none}</style>
    <title>Profil</title>    
</head>
<body>
    <header>
        <?php 
            session_start();       
            if (!isset($_SESSION) || !isset($_SESSION['id'])){
                header('location:warning.php'); 
            }
            elseif ($_SESSION['loggedin'] = true) {
                echo ("<li><h4>Numéro id : ".$_SESSION['id']." </h4></li>");
                echo ("<li><a href='blog/index.php' style='color:black'><h2 style:'color=red'>VOIR LES ARTICLES</h2></a>");
                echo ("<li><a href='require/deconnexion.php'><img src='Images/button-power.png' width='75px' height='75px'></a></li>");
            }
        ?>
    </header>

    <p> Vous pouvez changer vos coordonnées ci-dessous </p>

    <p> Ou alors lire, ajouter et modifier des articles en cliquant sur la rubrique "Articles" </p>

    <div class="profile" id="profile">
        <div class="profile-form" id="profile-form">
            <li><h4>Login : <?php echo $_SESSION['logUsername']?></h4></li>
            <button class="change-login-btn" id="change-login-btn">
                Changer
            </button>

            <li><h4>Mot de passe : <?php echo $_SESSION['logPassword']?></h4></li>
            <button class="change-password-btn" id="change-password-btn">
                Changer
            </button>
        </div>
    </div>

    <div class="change-login" id="change-login">
        <form class="form-login" id="form-login">
            <input type="text" placeholder="Nouveau login" name="new-login" autocomplete="off">
            <button class="submit-new-login" id="submit-new-login">
                <img src="Images/swap-symbol.png" width="30px" height="30px">
            </button>
            <div class="edit-message" id="edit-message"></div>
        </form>
            <button class="login-comeback" id="login-comeback">
                Retour
            </button>
    </div>

    <div class="change-password" id="change-password">
        <form class="form-password" id="form-password">
            <input type="password" placeholder="Nouveau mot de passe" name="new-password" autocomplete="off">
            <button class="submit-new-password" id="submit-new-password">
                <img src="Images/swap-symbol.png" width="30px" height="30px">
            </button>
            <div class="edit-message" id="edit-message"></div>
        </form>
            <button class="password-comeback" id="password-comeback">
                Retour
            </button>
    </div>

    <script src="profil.js"></script>
    <footer>
        <div class="footer-left">
            <h3>IBRAHIM Rabaou</h3>
            <div class="footer-center">
                <li><a href="https://linkedin.com/in/rabaou-ibrahim-92897124b/" target="_blank"><img src="Images/linkedinlogo.png" height=50px width=50px></li>
                <li><a href="https://github.com/rabaou-ibrahim" target="_blank"><img src="Images/GitHub-Mark.png" height=50px width=50px></a></li>
            </div>
        </div>

        <div class="footer-right">
            <h3>ABAKAR ABDALLAH Adam</h3>
            <div class="footer-center">
                <li><a href="https://www.linkedin.com/in/adam-abdallah-abakar-9585a8259/" target="_blank"><img src="Images/linkedinlogo.png" height=50px width=50px></a></li>
                <li><a href="https://github.com/abakar-adam-abdallah" target="_blank"><img src="Images/GitHub-Mark.png" height=50px width=50px></a></li>
            </div>
        </div>

        <div class="laplateforme">
            <h3>Adresses mail</h3>
            <li>rabaou.ibrahim@laplateforme.io</li>
            <li>adam-abdallah.abakar@laplateforme.io</li>
        </div>
    </footer>
</body>