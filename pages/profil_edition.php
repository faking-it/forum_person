<?php
session_start();
define("PATH", "./");
include PATH . "header.php";
?>

<head>
    <title>F_Person Edidter le Profil</title>
</head>

<?php

require "../pdo.php";

if (isset($_GET['id_user']) and $_GET["id_user"] != $_SESSION["id"]) {
    //echo ("redirection");
    header("Location:connexion.php");
    die;
} else {
    
    var_dump("text ok " . $_SESSION["pseudo"]);

    if (isset($_GET['edit_profil'])) {

        $mail          =   htmlspecialchars($_REQUEST['mail']);
        $password      =   sha1($_REQUEST['password']);
        $password2     =   sha1($_REQUEST['password2']);
        $signature     =   htmlspecialchars($_REQUEST['signature']);
        $avatar        =   htmlspecialchars($_REQUEST['avatar']);
        $user_id       =   intval($_SESSION["id"]);
        $pseudo        =   htmlspecialchars($_REQUEST['pseudo']);

        if(!empty($mail) 
        AND !empty($user_id)
        AND !empty($password)
        AND !empty($password2)
        AND !empty($signature)
        AND !empty($avatar)
        AND !empty($user_id)
        ){

        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            if ($password == $password2) {
                $sql = "UPDATE users
                SET 
                pseudo=:pseudo ,
                signature=:signature ,  
                avatar=:avatar ,
                password=:password
            
                WHERE id_user=:id_user";

                $stmnt = $link->prepare($sql);

                $stmnt->bindValue(':pseudo',        $pseudo,            PDO::PARAM_STR);
                $stmnt->bindValue(':id_user',       $user_id,           PDO::PARAM_INT);
                $stmnt->bindValue(':password',      $password,          PDO::PARAM_STR);
                $stmnt->bindValue(':signature',     $signature,         PDO::PARAM_STR);
                $stmnt->bindValue(':avatar',        $avatar,            PDO::PARAM_STR);


                $stmnt->execute();

                if ($stmnt && $stmnt->rowCount() > 0) {
                    $message = 'success update profil';
                } else {
                    //$message = 'error';
                    $message = 'erreur sql requete update';
                }
            } else {
                $message = "Vos Mots de passe ne correspondent pas !";
            }
        } else {
            $message = "Votre adresse mail n'est pas valide !";
        }
        } else {

         $message = 'tous les champs doinent être remplis !';
        } 
    } else {
        $message = "Veuiller remplir un champs ... merci !";
    }

?>

    <div class="conteneur">
        <h1>Editer votre profil : <?php if (isset($_SESSION["id"])) {
                                        echo $_SESSION["pseudo"];
                                    }; ?></h1>
        

<!-- Ajout de l'insertion d'image perso d'un utilisateur -->
<!-- Nous reprenons les lien/mail dans avatar des utilisateurs! -->
<?php 
require "../pdo.php";
$sql = ("SELECT avatar FROM users WHERE id_user =8");
    $sth = $link->prepare($sql);
    $sth->execute();
    $topics = $sth->fetchAll(PDO::FETCH_OBJ);
?>
<div id="changementImageProfilG">
<p> Votre image de profil actuelle : <?php 
foreach ($topics as $topic)  {
   $imageDeProfil= $topic->avatar; }?></p>
   <!-- fin -->




<?php if(preg_match("#../image_users/#",$imageDeProfil)){
                            ?> <img src= <?php echo($imageDeProfil); ?> alt="avatar" class="imageProfilActuelG" height="100px" width="100px">  <?php
                        }
                        else{
                           ?> <img src= "https://2.gravatar.com/avatar/<?php echo md5($imageDeProfil)."s=100&";?>" alt="avatar" class="imageProfilActuelG" height="100px" width="100px"> <?php
                        }
                        ?>
                        
        <form action="../js/upload.php" method="post" enctype="multipart/form-data" >
    <h4 id="selectionImageUpload">Select image to upload:</h4>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit" id="validerNouvelleImage">
    </div>
</form>
<?php
        if (isset($message)) {
            echo "<font color='red'> . $message . '</font>'";
        }
        ?>
        <div class="conteneur">
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pseudo</label>
                    <input name="pseudo" type="text" class="form-control" id="" placeholder="Nouveau pseudo" value="<?php if (isset($pseudo)) {
                                                                                                                        echo $pseudo;
                                                                                                                    }; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Signature</label>
                    <input name="signature" type="text" class="form-control" id="" value="<?php if (isset($signature)) {
                                                                                                echo $signature;
                                                                                            } ?>">
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email Gravatar</label>
                    <input name="avatar" type="email" class="form-control" id="" placeholder="Avatar" value="<?php if (isset($avatar)) {
                                                                                                                echo $avatar;
                                                                                                            } ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="mail" value="<?php if (isset($pseudo)) {
                                                    echo $mail;
                                                } ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirmation Password</label>
                    <input name="password2" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                

                <button type="submit" name="edit_profil" class="btn btn-primary">Submit</button>

                
            </form>
        </div>
    <?php
}
    ?>


    </div>
    <?php
include PATH . "footer.php";
