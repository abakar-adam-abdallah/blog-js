<?php
require("db.php");

// Validation d'un article
function validatePost($post){
    $errors = array();
    if (empty($post['author'])) {
     array_push($errors, 'veillez écrire votre nom');
    }

    if (empty($post['title'])) {
        array_push($errors, 'un titre est démendé');
       }
    if (empty($post['content'])) {
    array_push($errors, 'le contenu est vide');
    }

    return $errors;

}
// récuperer les tous les articles  de ma  basse de données
    function selectAll($noPage,$parpage){
        global $conn;
        $resultats =    $conn->query('SELECT * FROM posts 
        ORDER BY created_at DESC LIMIT '.($parpage*($noPage-1)).',' .$parpage);
        $posts     = $resultats->fetchAll();
        return $posts;
    }
 // récuperer une seule article  de ma  basse de données 
    function selectOne($id){
        global $conn;
        $query = $conn->prepare('SELECT * FROM posts WHERE id = :id');
        $query->execute(array('id'=>$id));
        $post  = $query->fetch(PDO::FETCH_ASSOC);
        return $post;
    }
// selection de tous les articles 

function pargination(){
    global $conn;
    $query =$conn->prepare('SELECT count(*) as nbr_articles FROM posts');
    $query->execute([]);
    $nombre = $query->fetch();
    return $nombre['nbr_articles'];
}

    // enregistrement d'un article
    function create($author,$title,$content,$image){
        global $conn;
        $query = $conn->prepare('INSERT INTO  posts(author,title,content,image,created_at) 
        VALUES(:auteur,:titre,:contenu,:image,NOW())');
        $query->execute([

            'auteur'=>$author,
            'titre'=>$title,
            'contenu'=>$content,
            'image'=>$image
        ]);
        
    }


     // modifier d'un article
     function updatePost($id,$author,$title,$content,$image){

        global $conn;
        $query = $conn->prepare ('UPDATE posts  SET   author = :auteur,title = :titre ,content = :content,
        image =:image WHERE id = :id ');
        $query->execute([

            'auteur'=>$author,
            'titre'=>$title,
            'content'=>$content,
            'image'=>$image,
            'id'=>$id
        ]);
        
     }

// supprimer un article 

function deletePost($id){
    global $conn;
    $query = $conn->prepare('DELETE FROM posts WHERE id =:id');
    $query->execute(['id'=>$id]);
}

// sauvegarder un commentaire 
    function saveComment($auteur,$post_id,$comment){
        global $conn;
        $query = $conn->prepare('INSERT INTO comments(id_post,auteur,comment,created_at)
        VALUES(:id_post, :auteur, :comment, NOW())');
        $query->execute([
            'id_post'=>$post_id,
            'auteur'=>$auteur,
            'comment'=>$comment
        ]);
        
    }
// recuperation des articles dans la base

function findAllComments($id_post){
    global $conn;
    $query = $conn->prepare('SELECT * FROM comments WHERE id_post= :post_id');
    $query->execute(['post_id'=>$id_post]);
    $comments = $query->fetchAll();
    return $comments;
}
        
    

?>

