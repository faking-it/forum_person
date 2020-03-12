<?php
session_start();
<<<<<<< HEAD
=======
//include "header.php";
>>>>>>> 078f4dd02e0123df7b9f14af06f2e231e1d908ce
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
            $_SESSION['avatar']   = $userinfo['avatar'];
            if(isset($_SESSION["id"])){
                header('Location: http://192.168.99.100/index.php'); 
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

<<<<<<< HEAD
    define("PATH", "./");
    include PATH."header.php";
?>
<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type='text/css'href="../sass/css/style.css">
</head>
<body>
    
<nav class="navbar">
<ul class="nav justify-content-end">
  <li class="nav-item">
            <a class="nav-link active" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo PATH;?>"><?php if(isset($_SESSION["id"]))
            {echo "Profil"; } else{echo "";}
               ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo PATH;?>inscription.php"><?php if(isset($_SESSION["id"]))
            {echo ""; } else{echo "Inscription";}
               ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo PATH;?>connexion.php"><?php if(isset($_SESSION["id"]))
            {echo ""; } else{echo "Se Connecter";}
               ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo PATH;?>deconnexion.php"><?php if(isset($_SESSION["id"]))
            {echo "Déconnexion"; } else{echo "";}
               ?></a>
        </li>
        
    </ul>
</nav>
 -->
=======
define("PATH", "./");
include PATH."header.php";
?>

>>>>>>> 078f4dd02e0123df7b9f14af06f2e231e1d908ce
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
        
       

<?php
<<<<<<< HEAD
 include PATH."footer.php";


=======
>>>>>>> 078f4dd02e0123df7b9f14af06f2e231e1d908ce

include PATH."footer.php";