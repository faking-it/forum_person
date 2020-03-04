<?php
require "../pdo.php";
if (isset($_POST['send_inscription'])) {
   echo  $pseudo =       htmlspecialchars($_POST['pseudo']);
   echo  $mail =         htmlspecialchars($_POST['mail']);
   echo  $mail2 =        htmlspecialchars($_POST['mail2']);
   echo  $password =     sha1($_POST['password']);
   echo  $password2 =    sha1($_POST['password2']);
   echo $signature =     htmlspecialchars($_POST['signature']);
   echo $avatar =        htmlspecialchars($_POST['avatar']);
       
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
                   
                        if ($password == $password2) {
                            //on fait en premier un select  avec where mail =: mail pour vérifier si il un déjà un mail existant dans la base de données
                            $sqlmail = "SELECT mail
                            FROM users 
                            WHERE mail=:mail;";
                            $stmt1 = $link->prepare($sqlmail);
                            $stmt1->bindvalue(':mail', $mail, PDO::PARAM_STR);
                            $stmt1->execute();

                            if ($stmt1 && $stmt1->rowCount() > 0) {
                                $message = "error";
                                $message =  "mail existe déjà";
                            } else {
                                $sql_inst = "INSERT INTO users(pseudo,mail,password,signature,avatar)
                                VALUES (:pseudo,:mail,:password,:signature,:avatar);";

                                $stmnt = $link->prepare($sql_inst);

                                $stmnt->bindValue(':pseudo',        $pseudo,            PDO::PARAM_STR);
                                $stmnt->bindValue(':mail',          $mail,              PDO::PARAM_STR);
                                $stmnt->bindValue(':password',      $password,          PDO::PARAM_STR);
                                $stmnt->bindValue(':signature',     $signature,         PDO::PARAM_STR);
                                $stmnt->bindValue(':avatar',        $avatar,            PDO::PARAM_STR);
                          

                                $stmnt->execute();

                                if ($stmnt && $stmnt->rowCount() > 0) {
                                    $message = 'success';
                                    $message = $pseudo.' votre compte a été bien ajouté <a href="connexion.php">Cliquez ici pour vous connecter .. merci!</a>';
                                   

                                    } else {
                                        $message = 'error 404';
                                        $message = 'error sql';
                                    }
                            }
                        } else {
                            $message = "Vos mots de passes ne correspondent pas ! Veuillez recommencer";
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



