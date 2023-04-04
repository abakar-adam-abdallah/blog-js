<?php 
// echo json_encode($_POST);
session_start();
$success = 0;
$msg = "Une erreur est survenue (script.php)";

if (!empty($_POST['log-pseudo']) AND !empty($_POST['log-mdp']))
    {
        $logPseudo = htmlspecialchars((strip_tags($_POST['log-pseudo'])));
        $logMdp = htmlspecialchars((strip_tags($_POST['log-mdp'], PASSWORD_DEFAULT)));
                
        if (strlen($logPseudo) < 25) 
        {
            if (strlen($logMdp) < 25) 
            {
                require_once('require/connexion_db.php');
                $sql = "SELECT * FROM utilisateurs WHERE login = '$logPseudo' AND password = '$logMdp'"; 
                $result = mysqli_query($conn, $sql); // Compter le nombre de ligne ayant rapport a la requette SQL
                if (mysqli_num_rows($result) > 0) {
                    $msg = "<p style='color:green'> Connexion  réussie ! </p>";
                    $success = 1;
                    $row = mysqli_fetch_assoc($result);
                    // Si la ligne contenant le bon login et le bon mot de passe est trouvée dans la bdd,
                    if ($row['login'] === $logPseudo && $row['password'] === $logMdp) {
                        $_SESSION['loggedin'] = true;
                        $_SESSION['logUsername'] = $logPseudo; 
                        $_SESSION['logPassword'] = "";
                        for ($i = 0; $i<strlen($logMdp); $i++){
                            $_SESSION['logPassword'] .= "*";
                        }
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['email'] = $row['email'];
                        header("location:profil.php");
                    }
                   
                } else {
                    $msg = "<p style='color:red'>Login et/ou mot de passe incorrect/s</p>";
                }
            } else {
                    $msg = "<p style='color:red'> Votre mot de passe ne peut pas dépasser 25 caractères </p>";    
            }
        } else {
                $msg = "<p style='color:red'> Votre pseudo ne peut pas dépasser 25 caractères </p>";
        }
    } else {
        $msg = "<p style='color:red'> Veuillez renseigner tous les champs </p>";
    }

$res = ["success" => $success, "msg" => $msg];
echo json_encode($res);
?>