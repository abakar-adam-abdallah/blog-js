<?php
session_start();
if (!$_SESSION) {
  header("location:include/warning.php");
} 
// connexion à la base de données      
require("refactoring.php");

$parpage = 3;
$nombreTotal = pargination();

$noPage =1;
$pages = ceil($nombreTotal/$parpage);
  if(isset($_GET['page'])){
    $noPage = $_GET['page'];
  }


// récuperer les tous les articles  de ma  base de données  
$posts = selectAll($noPage, $parpage);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

 
  <link rel="stylesheet" href="css/style.css">

  <title>Mini-Blog</title> 
</head>

<body>
  <!-- header Page  -->
  <?php require("include/header.php") ?>

  <!-- Page Wrapper -->
  <div class="page-container">

    
    <!-- Post Slider -->
    <div class="posts">
      <h1 class="posts-title">Articles</h1>
      <div class="post-container">  
            <?php
                foreach($posts as $post):
            ?>
            <div class="post" id="post">
              <img src="<?php echo 'images/'.$post['image']?>" alt="mon image" class="slider-image">
              <div class="post-info">
                <h4><a href="single.php?id=<?= $post['id']?>"><?php echo $post['title']?></a></h4>
                <i> <?php echo $post['author']?> </i>
                &nbsp;
                <i> <?php echo date('d, m, y', strtotime($post['created_at']))?></i>
              </div>
            </div>
            <!-- <div class="post">
              <img src="images/istock.jpeg" alt="" class="slider-image">
              <div class="post-info">
                <h4><a href="single.html">La vies est belle</a></h4>
                <i > Ronas</i>
                &nbsp;
                <i > 25 Mai 2021</i>
              </div>
            </div>
            <div class="post">
              <img src="images/istock.jpeg" alt="" class="slider-image">
              <div class="post-info">
                <h4><a href="single.html">La vies est belle</a></h4>
                <i > Ronas</i>
                &nbsp;
                <i > 25 Mai 2021</i>
              </div>
            </div> -->
            <?php endforeach; ?>
          
      </div>
    </div> 
    <!-- pargination -->
    <div class="pagination">
      <?php 
        for($i=1; $i<=$pages; $i++) {?>
          <a href="index.php?page=<?= $i ?>" class="page <?= ($noPage == $i)?'active':'' ?>"><?= $i ?></a>

          <?php
          }
      ?>

    </div>
    <!-- footer -->
    <?php require("include/footer.php") ?>
  <!-- // footer --> 
</body>
</html>