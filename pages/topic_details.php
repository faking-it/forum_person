<?php 
session_start();
define("PATH", "./");
include PATH . "header.php";
require_once "./parsedown-1.7.4/Parsedown.php";


?>

<?php
/* php requete side by berthold
* nous selectionons sur base de l'id topic
*/
include "../pdo.php";
if (isset($_GET['id_topic']) and is_numeric($_GET['id_topic']) and $_GET['id_topic'] > 0) {

    $id_topic = $_GET['id_topic'];
   
    //var_dump($id_topic);

    $sql2 = ("SELECT  id_topic, title, content, topics.date_crea , topics.date_up,  board_name AS categorie, users.id_user, pseudo
        pseudo
        FROM topics
        INNER JOIN users ON users.id_user= topics.user_id
        INNER JOIN boards ON topics.board_id = boards.id_board
        WHERE id_topic=:id_topic;");
    $requete = $link->prepare($sql2);
    $requete->bindvalue(':id_topic', $id_topic, PDO::PARAM_INT);
    $requete->execute();
    
    $requete->rowCount();
    $topic_infos = $requete->rowCount();
   
    if ($topic_infos == 1) {
        $topic_infos = $requete->fetch();
       // var_dump($topic_infos);

         //$message = " #bne requete# ";
    } else {
         $message = " #erreur sql info article# ";
    }
} else {
    $message =  " id_topic doit être numeric et non vide";
}
?>





    <div class="conteneur">
    <?php
    if (isset($message)) {
        echo "<font color='red'>" . $message . "</font>";
    }
    ?>

        <h1>Titre du L'article : <?php echo $topic_infos['title']; ?></h1> <br>


        <div class="card text-white bg-primary mb-3" style="max-width: 600px;">
            <div class="card-header">Titre du topic :<?php echo $topic_infos['title']; ?> <br>
                Ecrit par <h4><?php echo $topic_infos['pseudo']; ?></h4> Le <?php echo $topic_infos['date_crea']; ?></div>
            <div class="card-body">
                <p class="card-text">Catégorie: <?php echo $topic_infos['categorie']; ?></p>

                <h5 class="card-title"><?php 
                 
           $Parsedown = new Parsedown();
         
            
            $content=$topic_infos['content'];
            $content= $Parsedown->text($content); 
                
                echo $topic_infos['content']; ?></h5>
                <p class="card-text">Date de création du topic : <?php echo $topic_infos['date_crea']; ?></p>
                <p class="card-text">Date de mise à jour : <?php echo $topic_infos['date_up']; ?></p>
                <!-- <p class="card-text">Date de mise à jour : <?php echo $topic_infos['id_user']; ?></p>-->
            </div>
            <div>
           
               

            </div>
        </div>
        </ol>

        <!-- Ajoutez un commentaire 
            je récupère en premier id du topic et id de l'user qui ajoute un commentaire
        -->
    <?php
        //envoie commentaire
        if (isset($_POST['send_comment'])) {
            $user_id   =       intval($_POST['user_id']);
            $topic_id  =       intval($_POST['topic_id']);
            $comment   =      htmlspecialchars($_POST['content']) ;

            $user_id    =   $_SESSION["id"];
            $topic_id   =   $topic_infos['id_topic'];
            /* var_dump($comment);
            die; */
              
           #la condition if pour conditionner tous les parametres rentrés 'user_id' 'comment' 'comment2' 'password' 'password2'
           if (!empty($user_id) 
           AND !empty($topic_id ) 
           AND !empty($comment) 
           
           ) {
               
             
               $sql_inst = "INSERT INTO `comments` ( `content`, `user_id`, `topic_id`) 
               VALUES (? , ? , ?  );";
                   
               $stmnt = $link->prepare($sql_inst);
               $stmnt->execute(array($comment, $user_id, $topic_id));
              var_dump($stmnt->execute());
               if ($stmnt && $stmnt->rowCount() ==1 ) {
                  // $message = 'success';
                   $message = "Votre commentaire a été bien ajouté .. merci!";
                   } else {
                     /* var_dump($stmnt && $stmnt->rowCount());
                    die;  */
                       $message = 'error 404';
                       $message = 'Problème de réseau, recommencer si le problème persiste veuiller contacter l\'équipe Person :hamilton 3.19';
                   }
           
           } else {
               $message = "Ajouter un commentaire!";
           }
       }
       
      /*  else{
           echo $message = "debug isset";
       } */

    ?>
    
    <div class="commentaire">
        <div class="form">
            <h3>Ajouter un commentaire</h3>
            <?php
    if (isset($message)) {
        echo "<font color='red'>" . $message . "</font>";
    }
    ?>
            <form method="POST" >
                <!-- <label>Nouveau Commentaire</label>  --><br>
                <div class="lead emoji-picker-container">
                <input name="content" type="text" placeholder="Ajouter un commentaire" 
                data-emojiable="true" data-emoji-input="unicode"/><br>
                <input type="submit" name="send_comment" value="Ajouter un commentaire">
                </div>
               
            </form>
        </div>

       <!-- select commentaires -->
        <?php
            $topic_id   =   $topic_infos['id_topic'];

            if(isset($_REQUEST["id_topic"])){
                $topic_id   =  intval($_REQUEST["id_topic"]);
                $sql_com="SELECT DISTINCT C.id_comment, C.content, C.date, U.pseudo
                FROM comments AS C
                INNER JOIN users AS U
                ON C.user_id=U.id_user
                INNER JOIN topics AS T 
                ON T.id_topic=C.topic_id
                WHERE T.id_topic=:id_topic
                ORDER BY date DESC";
        
                $req=$link->prepare($sql_com);
                $req->bindValue(':id_topic',           $id_topic,              PDO::PARAM_INT);
                $req->execute();
                //var_dump($req->execute());
                //$comment=$req->fetch();
                //echo $comment['comment'] ;

                
            }
        ?>
      
    </div>  
    <h4>Liste des commentaires</h4>
        <ul class="">
           <?php 
           
           $Parsedown = new Parsedown();
           while ($comment = $req->fetch()) {
            
            $content=$comment['content'];
            //$content= $Parsedown->text($content); 
             ?>  
            <li class="list-group-item">
               <div class="left">
               <p> <?php echo $content= $Parsedown->text($content);  ?> </p>
            <p>
                <strong>Ecrit  le : <?php echo $comment['date'];?></strong> <br>
                <strong> Par : </strong><?php echo $comment['pseudo'];?>
            </p>
               </div>
               <form method="post">
               <?php
                    if (isset($message)) {
                        echo "<font color='red'>" . $message . "</font>";
                    }
                    ?>
                    <button type="submit" name="id_topic" class="btn btn-outline-danger" >
                        <a class="delete_topic" href="delete_comment.php?id_comment=<?php echo $comment['id_comment']; ?>">Effacer</a>
                    </button>
                </form>
            </li>
            <?php }?>
        </ul>
    </nav>
    </div>

   

    <?php 
include PATH."footer.php";
