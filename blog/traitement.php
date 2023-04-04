<?php
// traitement de page single
$id = '';
//  var_dump($_GET);
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
$id = $_GET['id'];


}
if (empty($_GET['id'])){

    die("L'article demandé n'hexiste pas !");
}


// sauvegarde d'un commentaire

if (isset($_POST['add-comment'])) {
    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
       $author   = $_POST['author'];
       $comment  = $_POST['comment'];
       $id       = $_POST['id'];

       saveComment($author,$id, $comment);
       header('location:single.php?id='.$_POST['id']);
       exit();
    }

 
}

?>