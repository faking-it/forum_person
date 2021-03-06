<?php
session_start();
//include "header.php";
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
    
            $_SESSION['id']     = $userinfo['id_user'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['mail']   = $userinfo['mail'];
            if(isset($_SESSION["id"])){
                header('Location: ../index.php'); 
            }
            $message= "$user_pseudo . 
            <a href='affiche.php'>Cliquez ici pour voir la liste des topics</a> <br>
            <a href='profil.php?id_user=$user_id'>Cliquez ici pour voir la liste des topics</a> <br>
            " ;
            
            //on envoie un true dans logs pour vérifier la connection
            /* $sql_logs = "INSERT 
            INTO logs(user_id,status)
            VALUES (:user_id,:status);";
    
            $stmnt = $link->prepare($sql_logs);
            $stmnt->bindValue(':user_id',        $user_id,           PDO::PARAM_INT);
            $stmnt->bindValue(':status',          true,              PDO::PARAM_STR);
            $stmnt->execute(); */
    
        } else {
            $message = "Mauvais mail ou mot de passe !";
        }
        } else {
        $message = "Tous les champs doivent être complétés !";
        }
    }

define("PATH", "./");
include PATH."header.php";
?>

<div class="conteneur">
    <h1>Connexion</h1>
   <div class="conteneur">
   <form method="post">
   
   <div class="form-group">
  
    <label for="inputAddress">Email</label>
    <input name="mail" type="email" class="form-control" id="inputEmail4" placeholder="Entrer votre Email">
  </div>
  <div class="form-row">

  
    <div class="form-group col-md-6">
      <label for="inputEmail4">Mot de passe</label>
      <input name="password" type="password" class="form-control" id="inputPassword4" placeholder="Entrer votre mot de passe">
    </div>
    
  
  <button type="submit" name ="connect" class="btn btn-primary">Sign in</button>
  <?php     
         if(isset($message)) {
            echo "<font color='red'>.$message.'</font>";
         }
         ?>
</form>
   </div>
   </div>
   </div>
        
       

<?php

include PATH."footer.php";