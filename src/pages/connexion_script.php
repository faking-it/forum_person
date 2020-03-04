<?php
require "../pdo.php";

if(isset($_POST['connect'])) {
   $mail = htmlspecialchars($_POST['mail']);
   $password = sha1($_POST['password']);
   if(!empty($mail) AND !empty($password)) {

      $requser = $link->prepare("SELECT *
                                FROM users 
                                WHERE mail = ? AND password = ?");
      $requser->execute(array($mail, $password));
      $userexist = $requser->rowCount();


      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $user_pseudo = $userinfo['pseudo'];
         $user_id= $userinfo['id_user'];

        $message= $user_pseudo . "<a href='profil.php?id_user=$user_id'. 
          > Cliquer ici pour voir Votre profil </a> vous êtes connectés!" ;

        //on envoie un true dans logs pour vérifier la connection
        $sql_logs = "INSERT 
        INTO logs(user_id,status)
        VALUES (:user_id,:status);";

         $stmnt = $link->prepare($sql_logs);
         $stmnt->bindValue(':user_id',        $user_id,            PDO::PARAM_INT);
         $stmnt->bindValue(':status',          true,              PDO::PARAM_STR);
         $stmnt->execute();
     
      } else {
         $message = "Mauvais mail ou mot de passe !";
      }
   } else {
      $message = "Tous les champs doivent être complétés !";
   }
}


       
       