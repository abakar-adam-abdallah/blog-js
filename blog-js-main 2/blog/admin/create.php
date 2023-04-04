<?php 
session_start();
if (!$_SESSION) {
  header("location:include/warning.php");
} 
?>
<?php require("../refactoring.php"); ?>
<?php
 $errors = array();
 $title = '';
 $author = '';
 $content = '';
    // var_dump($_POST);
    if (isset($_POST['add-post'])) {
        // La gestion des erreurs sur les champs du fformulaire
        $errors = validatePost($_POST);
        // var_dump($_FILES['image']);
      
        // Traitement de l'image
        if (!empty($_FILES['image']['name'])){
        
           $image_name = time().'_'.$_FILES['image']['name'];
           $destination = "../images/$image_name";

           $result = move_uploaded_file($_FILES['image']['tmp_name'],$destination);
           if ($result) {
            $_POST['image'] = $image_name;
                
           } else {
            
               array_push($errors, 'enregistrement du lechoué');
           }

        }else {
            
            array_push($errors, 'une image est demandé');
        } 
        if(count($errors) == 0){
            $_POST['content'] = nl2br(htmlentities($_POST['content']));
    
                // Enregistrement de l'article dans la base
                create($_POST['author'], $_POST['title'], $_POST['content'], $_POST['image']);
                 header("location: index.php");
                exit();

        }else{
            $title = $_POST['title'];
            $author = $_POST['author'];
            $content = $_POST['content'];
        }
        }

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Custom Styling -->
        <link rel="stylesheet" href="../css/style.css">

        <!-- Admin Styling -->
        <link rel="stylesheet" href="../css/admin.css">

        <title>Section admin - Ajouter un article</title>
    </head>

    <body>
         <!-- page header -->
    <?php require("include/header-admin.php") ?>

        <!-- Admin Page Wrapper -->
        <div class="admin-container">

        
            <!-- // Left Sidebar -->


            <!-- Admin Content -->
            <div class="admin-content">
                <div class="button-group">
                    <a href="create.php" class="btn btn-big">Ajouter un article</a>
                    <a href="index.php" class="btn btn-big">Gérer des articiles</a>
                </div>


                <div class="container">

                    <h2 class="page-title">Gérer les articles</h2>
                    <?php require('error.php');?>
                    <form action="create.php" enctype="multipart/form-data" method="post">
                        <div>
                            <label>Auteur</label>
                            <input type="text" name="author"  value="<?= $author ?>" class="text-input">
                        </div>
                        <div>
                            <label>Titre</label>
                            <input type="text" name="title"  value="<?= $title ?>" class="text-input">
                        </div>
                        <div>
                            <label>Contenu</label>
                            <textarea cols="130", rows="10" name="content"  id="body"> </textarea>
                        </div>
                        <div>
                            <label>Image</label>
                            <input type="file" name="image"  class="text-input">
                        </div>
                        
                        <div>
                            <button type="submit" name="add-post" class="btn btn-big">Ajouter un article</button>
                        </div>
                    </form>

                </div>

            </div>
            <!-- // Admin Content -->

        </div>
        <!-- // Page Wrapper -->
        <!-- page footer -->
        <?php require("../include/footer.php") ?>
   
    </body>

</html>