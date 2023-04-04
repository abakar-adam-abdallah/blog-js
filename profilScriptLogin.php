<?php
session_start();
$success = 0;
$msg = "Une erreur est survenue (script.php)";

if (!empty($_POST['new-login']))
    {
        $newLogPseudo = htmlspecialchars((strip_tags($_POST['new-login'])));
                
        if (strlen($newLogPseudo) < 25) 
        {   
            include('require/connexion_db.php');
            $sql = "SELECT login FROM utilisateurs WHERE login = '$newLogPseudo'";
            $result = $conn->query($sql);
            if (mysqli_num_rows($result) == 0) {
                $sql = "UPDATE utilisateurs SET login = '$newLogPseudo' WHERE id = '$_SESSION[id]'"; 
                $result = $conn->query($sql);

                if ($conn->query($sql) === TRUE) {
                    $success = 1;
                    $msg = "<p style='color:green'> Modification prise en compte :) ! </p>";
                }
                else {
                    $msg = "<p style='color:red'> Echec de la requête </p>";
                }
            }
            else {
                $msg = "<p style='color:red'> Login déjà pris </p>";
            }
        } 
        else {
            $msg = "<p style='color:red'> Votre pseudo ne peut pas dépasser 25 caractères </p>";
        }
    }
    else {
        $msg = "<p style='color:red'> Veuillez renseigner ce champ </p>";
    }

$res = ["success" => $success, "msg" => $msg];
echo json_encode($res);
?>