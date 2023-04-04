<?php 
// echo json_encode($_POST);

session_start();
$success = 0;
$msg = "Une erreur est survenue (script.php)";

if (!empty($_POST['pseudo']) AND !empty($_POST['email']) AND !empty($_POST['mdp']) AND !empty($_POST['confirmed-mdp']))
    {
        $pseudo = htmlspecialchars((strip_tags($_POST['pseudo'])));
        $email = htmlspecialchars((strip_tags($_POST['email'])));
        $mdp = htmlspecialchars((strip_tags($_POST['mdp'], PASSWORD_DEFAULT)));
        $confirmedMdp = htmlspecialchars((strip_tags($_POST['confirmed-mdp'], PASSWORD_DEFAULT)));
        
        if (strlen($pseudo) < 25) 
        {
            if (strlen($email) < 50) 
            {
                if (strlen($mdp) < 25) 
                {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
                    {
                        if ($mdp == $confirmedMdp) 
                        {
                            require_once('require/connexion_db.php');
                            $req = mysqli_query($conn, "SELECT login FROM utilisateurs WHERE login = '$pseudo'"); 
                            $num_rows = mysqli_num_rows($req); // Compter le nombre de ligne ayant rapport a la requette SQL
                            if ($num_rows == 0)
                            {
                                $req = mysqli_query($conn, "SELECT email FROM utilisateurs WHERE email = '$email'"); 
                                $num_rows = mysqli_num_rows($req); // Compter le nombre de ligne ayant rapport a la requette SQL
                                if ($num_rows == 0)
                                {
                                    $req = mysqli_query($conn, "SELECT password FROM utilisateurs WHERE password = '$mdp'"); 
                                    $num_rows = mysqli_num_rows($req); // Compter le nombre de ligne ayant rapport a la requette SQL
                                    if ($num_rows == 0)
                                    {
                                        $req = "INSERT INTO utilisateurs
                                        VALUES (NULL, '$pseudo', '$email', '$mdp')";
                                        if ($conn->query($req) === TRUE) 
                                        {
                                            $msg = "<p style='color:green'> Inscription réussie ! </p>";
                                            $success = 1;
                                        }
                                        else {
                                            $msg = "<p style='color:red'> Erreur non identifiée ! (Requête fausse ?) </p>";
                                        }
                                    } else {
                                        $msg = "<p style='color:red'>Mot de passe déjà pris</p>";
                                    }
                                } else {
                                    $msg = "<p style='color:red'>Email déjà pris</p>";
                                }
                            } else {
                                $msg = "<p style='color:red'>Login déjà pris</p>";
                            }
                        } else {
                            $msg = "<p style='color:red'> Les deux mots de passe ne sont pas identiques </p>";
                        }
                    } else {
                       $msg = "<p style='color:red'> Adresse email invalide </p>";
                    }
                } else {
                        $msg = "<p style='color:red'> Votre mot de passe ne doit pas dépasser 25 caractères </p>";    
                }
            } else {
                $msg = "<p style='color:red'> Votre email ne doit pas dépasser 50 caractères";
            }
        } else {
                $msg = "<p style='color:red'> Votre pseudo ne doit pas dépasser 25 caractères </p>";
        }
    } else {
        $msg = "<p style='color:red'> Veuillez renseigner tous les champs </p>";
    }

$res = ["success" => $success, "msg" => $msg];
echo json_encode($res);
?>