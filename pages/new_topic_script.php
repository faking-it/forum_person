<?php 

require "../pdo.php";
$titre = $_POST['titre'];
$categorie = $_POST['categorie'];
$contenu = $_POST['contenu'];
$sql = "INSERT INTO topics(title, content, user_id, board_id) VALUES ('$titre','$contenu',4,'$categorie')";
    $sth = $link->prepare($sql);
    $sth->execute();

    $topics = $sth->fetchAll(PDO::FETCH_OBJ);
    
// Effacer les articles en trop de l'onglet Random


    foreach ($topics as $topic){
        if ($topic->board_id == 5){
            $topics_rdm++;
        }
    }

    if ($topics_rdm>5){
        for ($j=5;$j<$topics_rdm;$j++){
            $sql_delete = "DELETE FROM topics WHERE board_id = 5 ORDER BY date_crea ASC LIMIT 1";
            $sth = $link->prepare($sql_delete);
            $sth->execute();
            $topics = $sth->fetchAll(PDO::FETCH_OBJ);
        }
    }


  header('Location: ../index.php'); 
  // Après avoir executer la requete, nous redirigeons l'utilisateur vers la page précédente!
  

?>

    