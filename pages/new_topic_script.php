<?php 

require "../pdo.php";
$titre = $_POST['titre'];
$categorie = $_POST['categorie'];
$contenu = $_POST['contenu'];
$sql = "INSERT INTO topics(title, content, user_id, board_id) VALUES ('$titre','$contenu',4,'$categorie')";
    $sth = $link->prepare($sql);
    $sth->execute();

    $topics = $sth->fetchAll(PDO::FETCH_OBJ);
    
    

  header('Location: http://192.168.99.100/index.php'); 
  // Après avoir executer la requete, nous redirigeons l'utilisateur vers la page précédente!
  

?>

    