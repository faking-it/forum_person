<?php

//on fait en premier un select  avec where mail =: mail pour vérifier si il un déjà un mail existant dans la base de données
$sqlmail = "SELECT mail
        FROM users 
        WHERE mail=:mail;";
        $stmt1 = $db->prepare($sqlmail);
        $stmt1->bindvalue(':mail', $inst_mail, PDO::PARAM_STR);
        $stmt1->execute();

        if ($stmt1 && $stmt1->rowCount() > 0) {
            $message = "error";
            $message =  "mail existe déjà";
        } else {
            $sql_inst = "INSERT INTO 
            `users`( `pseudo`, `mail`, `password`,`signature`, `avatar`)
                VALUES (:pseudo,:mail,:password,:signature, :avatar);";

            $stmnt = $db->prepare($sql_inst);

            $stmnt->bindValue(':pseudo',        $pseudo,            PDO::PARAM_STR);
            $stmnt->bindValue(':mail',          $insert_mail,       PDO::PARAM_STR);
            $stmnt->bindValue(':password',      $password_hashed,   PDO::PARAM_STR);
            $stmnt->bindValue(':signature',     $signature,         PDO::PARAM_INT);
            $stmnt->bindValue(':avatar',         $avatar,           PDO::PARAM_STR);
          

            $stmnt->execute();

        if ($stmnt && $stmnt->rowCount() > 0) {
            $message = 'success';
            $message = 'user added';
        } else {
            $message = 'error 404';
            $message = 'error sql';
        }
    }

     //on envoie un tru dans logs pour vérifier la connection
     $sql_logs = "INSERT 
     INTO logs(user_id,status)
     VALUES (:user_id,:status);";

         $stmnt = $link->prepare($sql_logs);

         $stmnt->bindValue(':user_id',        $user_id,            PDO::PARAM_INT);
         $stmnt->bindValue(':status',          true,              PDO::PARAM_STR);
         $stmnt->execute();
     