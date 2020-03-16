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
                    <label for="exampleInputEmail1">Avatar</label>
                    <input name="avatar" type="text" class="form-control" id="" placeholder="Avatar" value="<?php if (isset($avatar)) {
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
