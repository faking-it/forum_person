<?php
if (isset($_POST['send_comment'])) {
     $user_id   =       intval($_POST['user_id']);
     $topic_id  =       intval($_POST['topic_id']);
     $comment   =       htmlspecialchars($_POST['comment']);
       
    #la condition if pour conditionner tous les parametres rentrés 'user_id' 'comment' 'comment2' 'password' 'password2'
    if (!empty($_POST['user_id']) 
    and !empty($_POST['comment']) 
    and !empty($_POST['topic_id']) 
    
    ) {
      
        $sql_inst = "INSERT 
        INTO comments(comment,user_id,topic_id)
        VALUES (user_id=:user_id,comment=:comment, topic_id=:topic_id);";

        $stmnt = $link->prepare($sql_inst);

        $stmnt->bindValue(':comment',           $comment,              PDO::PARAM_STR);
        $stmnt->bindValue(':user_id',           $user_id,              PDO::PARAM_INT);
        $stmnt->bindValue(':topic_id',          $$topic_id,            PDO::PARAM_INT);
        $stmnt->execute();

        if ($stmnt && $stmnt->rowCount() > 0) {
            $message = 'success';
            $message = $user_id." votre commentaire a été bien ajouté .. merci!";
            

            } else {
                $message = 'error 404';
                $message = 'error sql';
            }
    

    } else {
        $message = "Ajouter un commentaire!";
    }
}