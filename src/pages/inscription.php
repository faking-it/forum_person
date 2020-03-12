<?php
require "header.php";
//define("PATH", "./");
?>
<head>
<title>F_Person Inscription</title>
</head>

<?php 

//require "./inscription_script.php";
require "../pdo.php";
if (isset($_POST['send_inscription'])) {
    $pseudo     =       htmlspecialchars($_POST['pseudo']);
    $mail       =       htmlspecialchars($_POST['mail']);
    $mail2      =       htmlspecialchars($_POST['mail2']);
    $password   =       sha1($_POST['password']);
    $password2  =       sha1($_POST['password2']);
    $signature  =       htmlspecialchars($_POST['signature']);
    $avatar     =       htmlspecialchars($_POST['avatar']);
       
    #la condition if pour conditionner tous les parametres rentrés 'pseudo' 'mail' 'mail2' 'password' 'password2'
    if (!empty($_POST['pseudo']) 
    and !empty($_POST['mail']) 
    and !empty($_POST['mail2']) 
    and !empty($_POST['password']) 
    and !empty($_POST['password2'])
    and !empty($_POST['signature']) 
    and !empty($_POST['avatar'])
   
    ) {
       //on compte avec la fonction strlen de php le nombre de caractère
        $pseudolength = strlen($pseudo);
        if ($pseudolength <= 64) {
            if ($mail == $mail2) {
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {

                  if (filter_var($avatar, FILTER_VALIDATE_EMAIL)) {
                   
                        if ($password == $password2) {

                            //on fait en premier un select  avec where mail =: mail pour vérifier si il un déjà un mail existant dans la base de données
                            $sqlmail = "SELECT mail, pseudo
                            FROM users 
                            WHERE mail=:mail
                            OR pseudo =:pseudo;";
                            $stmt1 = $link->prepare($sqlmail);
                            $stmt1->bindvalue(':mail', $mail, PDO::PARAM_STR);
                            $stmt1->bindvalue(':pseudo', $pseudo, PDO::PARAM_STR);
                            $stmt1->execute();

                            if ($stmt1 && $stmt1->rowCount() > 0) {
                             /*  var_dump($stmt1->rowCount());
                              die; */
                                $res=$stmt1->fetch(PDO::FETCH_ASSOC);
                                var_dump($stmt1->rowCount());
                                
                                if($res["pseudo"]==$pseudo and $res["mail"]!=$mail){
                                  $message =  "Le pseudo : ". $pseudo." existe déjà!";
                                  
                                }
                                if($res["mail"]==$mail and $res["pseudo"]!=$pseudo){
                                  $message = "Le mail : ". $mail." existe déjà!";
                                  
                                }
                                // L'utilisateur n'est pas enregistré mais le message ne s'affiche pas!
                                if($res["mail"]==$mail){
                                  if($res["pseudo"]==$pseudo){
                                    $message ="Le mail : ".$mail." et le pseudo : " .$pseudo." existent déjà!";
                                  }
                                }

                              /*   $message = "error";
                                $message =  "mail existe déjà"; */

                            } else {
                                $sql_inst = "INSERT INTO users(pseudo,mail,password,signature,avatar)
                                VALUES (:pseudo,:mail,:password,:signature,:avatar);";

                                $stmnt = $link->prepare($sql_inst);
                                
                                //die;
                                $stmnt->bindValue(':pseudo',        $pseudo,            PDO::PARAM_STR);
                                $stmnt->bindValue(':mail',          $mail,              PDO::PARAM_STR);
                                $stmnt->bindValue(':password',      $password,          PDO::PARAM_STR);
                                $stmnt->bindValue(':signature',     $signature,         PDO::PARAM_STR);
                                $stmnt->bindValue(':avatar',        $avatar,            PDO::PARAM_STR);
                          
                                
                               // $stmnt->execute($pseudo, $mail,$password, $signature, $avatar);
                                var_dump($stmnt->execute());
                               
                                if ($stmnt && $stmnt->rowCount() > 0) {
                                    $message = 'success';
                                    $message = $pseudo.' votre compte a été bien ajouté <a href="connexion.php">Cliquez ici pour vous connecter .. merci!</a>';
                                   
                                    } else {
                                        //$message = 'error 404';
                                        $message = 'error sql';
                                    }
                            }


                        } else {
                            $message = "Vos mots de passes ne correspondent pas ! Veuillez recommencer";
                        }
                      } else {
                        $message = "Votre adresse avatar doit être au format email !";
                    }


                } else {
                    $message = "Votre adresse mail n'est pas valide !";
                }
            } else {
                $message = "Vos adresses mail ne correspondent pas !";
            }
        } else {
            $message = "Votre pseudo ne doit pas dépasser 64 caractères !";
        }
    } else {
        $message = "Tous les champs doivent être complétés !";
    }
}
?>

<div class="conteneur">

    <h1>Inscription</h1>
    <?php
        if (isset($message)) {
            echo '<font color="red">' . $message . "</font>";
        }
        ?>  

   <div class="conteneur">

   <form method="POST" action="">
   <div class="form-group">
    <label for="inputAddress">Pseudo</label>
    <input name="pseudo" type="text" class="form-control" id="inputAddress" placeholder="Entrer votre pseudo">
  </div>

   <div class="form-group">
    <label for="inputAddress">Email</label>
    <input name="mail" type="email" class="form-control" id="inputEmail4" placeholder="Entrer votre Email">
  </div>

  <div class="form-group">
  <label for="inputAddress">Email confirmation</label>
  <input name="mail2" type="email" class="form-control" id="inputEmail4" placeholder="Entrer votre Email">
</div>
  <div class="form-row">

  
    <div class="form-group col-md-6">
      <label for="inputEmail4">Mot de passe</label>
      <input name="password" type="password" class="form-control" id="inputPassword4" placeholder="Entrer votre mot de passe">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4"> Confirmation de mot de Passe</label>
      <input name="password2" type="password" class="form-control" id="inputPassword4" placeholder="Confirmation votre mot de passe">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputAddress2">Signature</label>
    <input name="signature" type="text" class="form-control" id="inputAddress2" placeholder="Entrer votre Signature">
  </div>
  <div class="form-row">
   
    <div class="form-group col-md-4">
      <label for="inputState">Choisissez votre Avatar</label>
     <input type="email" name ="avatar">
    </div>
  </div>
  
  <input type="submit" value="S'inscrire" name="send_inscription">
</form>
   </div>
  
       

<?php include "footer.php";



