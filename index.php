<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog - Accueil</title>
  <link href='Css/index.css' rel='stylesheet'>
  <style type="text/css">a:link{text-decoration:none}</style>
</head>
<body>
    <header>
        <br>
        <h2 class="blog-title">par Adam et Rabaou</h2>

        <h1>ACTU SPORT</h1>
    </header>
    <div class="container">
        <div class="container-1">
            <p class="intro"> Un blog ouvert à tout le monde (rédacteurs, abonnés) qui regroupe des articles pour suivre l'actualité sportive !</p>
            <div class="articles">
                <?php
                 require("blog/refactoring.php");

                 $parpage = 3;
                 $nombreTotal = pargination();
                 
                 $noPage =1;
                 $pages = ceil($nombreTotal/$parpage);
                   if(isset($_GET['page'])){
                     $noPage = $_GET['page'];
                   }
                 // récuperer les tous les articles  de ma  basse de données  
                 $posts = selectAll($noPage, $parpage);
                 foreach($posts as $post):
                ?>
                <div class="post">
                    <br>
                    <img src="<?php echo 'blog/images/'.$post['image']?>" alt="mon image" class="slider-image" width="100px" height="100px">
                    <div class="post-info">
                        <h4><?php echo $post['title']?></h4>
                        <i><?php echo $post['author']?> </i>
                        &nbsp;
                        <i> <?php echo date('d, m, y', strtotime($post['created_at']))?></i>
                        <div class="line"></div>
                    </div>
                    <br>
                </div>
                <?php endforeach; ?>
            </div>
            <div class=""></div>
        </div>
        <div class="container-2">
            <h3>Vous souhaitez participer ?</h3>
            <div class="green-arrow">
                <img src="Images/green-arrow.png" width="50px" height="50px">
            </div>
            <a href="authentification.php"><button class='call-to'>Cliquez ici !</button></a>  
        </div> 
    </div>

    <div class="references">
        <h2>Contact et liens utiles</h2>
    </div>

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
</html>