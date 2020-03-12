<?php
session_start();
define("PATH", "./");

require "../pdo.php";
  

if(isset($_GET['id_user']) AND $_GET['id_user'] ==$_SESSION["id"] AND $_GET['id_user'] > 0) {
  
    $getid = intval($_GET['id_user']);
    $user = ("SELECT * FROM users WHERE id_user=:id_user");

    $stmt1 = $link->prepare($user);
    $stmt1->bindvalue(':id_user', $getid, PDO::PARAM_INT);
    $stmt1->execute();

    $userinfo= $stmt1->fetch();
    $user_id= $userinfo['id_user'];
    $pseudo= $userinfo['pseudo'];
    $avatar= $userinfo['avatar'];
    $mail= $userinfo['mail'];
    $signature= $userinfo['signature'];
    
    
    //selection des topics selon leur catégories 
    $tpcs = ("SELECT DISTINCT date_up, title, avatar, board_id, Board_name, id_topic
    FROM topics
    INNER JOIN users ON topics.user_id = users.id_user
    INNER JOIN boards ON topics.board_id = boards.id_board
    WHERE id_user=:id_user
    ORDER BY date_up DESC;");

    $rqt =$link->prepare($tpcs);
    $rqt->bindvalue(':id_user', $user_id, PDO::PARAM_INT);
    $rqt->execute();
    //var_dump($rqt->fetch());
    /* fin requete */

}else{
    //header("Location:http://localhost/pages/connexion.php"); 
   header('Location: deconnexion.php'); 
      }

?>

<head>
    <title>F_Person Profil</title>
</head>

<?php
include PATH . "header.php";

?>
<div class="conteneur">
<h1>Welcome to your profil : <?php echo $pseudo ;?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <img src="https://2.gravatar.com/avatar/<?php echo $avatar;?>" class="card-img-top" alt="image de l'avatar">
            </li>
        </ol>
    </nav>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <strong>Votre Email enrégisté :</strong> <?php echo $mail ;?>
            </li>
        </ol>
    </nav>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><strong>Pseudo :</strong><?php echo $pseudo; ?></li>
            <li class="breadcrumb-item active" aria-current="page"><strong>Signature :</strong><?php echo $signature ;?></li>
        </ol>
    </nav>

    <nav aria-label="breadcrumb">
    <h4>Liste de vos Articles</h4>
        <ol class="list-group list-group-flush">
           <?php while ($topic = $rqt->fetch()) { ?>
            <li class="list-group-item">
                <p>
                <strong>Titre :<a href="topic_detail.php?id_topic=<?php echo $topic['id_topic'] ;?>"> <?php echo $topic['title'] ;?></a></strong> <br>
                    <strong>Créé le : <?php echo $topic['date_up'];?></strong> <br>
                   <strong> Nom de la catégorie </strong><?php echo $topic['name'];?>
            </p>
            </li>
            <?php }?>
        </ol>
    </nav>
        <button name=<?php echo $user_id ?> class="btn_editer_profil"><a href="profil_edition.php?id_user=<?php echo $user_id;?>" class="card-link">Editer Votre Profil</a></button>
        

    <?php
    if (isset($message)) {
        echo "<font color='red'> . $message . '</font>'";
    }
    ?>



</div>
<?php
include PATH . "footer.php";
