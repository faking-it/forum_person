<?php
define("PATH", "./");
include PATH."header.php";
require "../pdo.php";
//echo $_SESSION["id"];

    if(isset($_REQUEST["send_topic"])){
        $title          =       htmlspecialchars($_REQUEST["title"]) ;
        $categorie      =       intval($_REQUEST["categorie"]) ;
        $contenu        =       htmlspecialchars($_REQUEST["contenu"]) ;
        if(!empty($title)
        and !empty($categorie)
        and !empty($contenu)
        ){
           $user_id=   $_SESSION["id"];

            $sql_inst = "INSERT INTO topics ( title, content, user_id, board_id) 
            VALUES (? , ? , ? ,? );";
                
            $stmnt = $link->prepare($sql_inst);
            
            $stmnt->execute(array($title, $contenu, $user_id, $categorie));
           
            if ($stmnt && $stmnt->rowCount() > 0) {
               // $message = 'success';
               //header('Location: ../index.php'); 
                $message = " Votre topic a été bien ajouté .. merci!";

                // Effacer les articles en trop de l'onglet Random
                foreach ($topics as $topic){
                    if ($topic->board_id == 5){
                        $topics_rdm++;
                    }
                }

                if ($topics_rdm>5){
                    for ($j=5;$j<$topics_rdm;$j++){
                        $sql_delete = "DELETE FROM topics WHERE board_id = 5 ORDER BY date_crea ASC LIMIT 1";
                        $sth = $link->prepare($sql_delete);
                        $sth->execute();
                        $topics = $sth->fetchAll(PDO::FETCH_OBJ);
                    }
                }

                } else {
                 
                   // $message = 'error 404';
                    $message = 'error sql';
                }
        }else{
            $message = "Veuiller remplir tous les champs merci !";
        }
    }
?>
<head>
    <title>Créer un sujet</title>  
</head>
<?php // include PATH."header.php";?>


<?php ?>
    <div class="conteneur">

        <form>
            <?if(isset($message)){echo $message;}?>
            <div class="form-group">
                <label for="inputAddress">Titre</label>
                <input required name="title" type="text" class="form-control" id="saisieTitre" placeholder="Insérer un titre">
                <span id="counterGeo">0/40</span>
                <span id="champsVide"></span>
            </div>

            <div class="form-row">
                
                <div class="form-group col-md-4">
                <label for="inputState">Catégorie</label>
                <select id="inputState" name="categorie" class="form-control">
                    <option  value="1" selected>Général</option>
                    <option value="2" >Développement</option>
                    <option value="3" >Discussions</option>
                    <option value="4" >Evénements</option>
                    <option value="5" >Random</option>
                    <option value="6" >Top Secret</option>
                </select>
                </div>
                
            </div>
            <div class="">
                <div class="form-group" >
                    <label for="inputAddress2">Contenu</label>
                    <textarea required name="contenu" type="text" class="form-control contenu" id="saisieTitre2" 
                    ></textarea>
                    <span id="counterGeo2">0/800</span>
                </div>
            </div>
            
            
            <div class="new_topic_button" >
                <a class="new_topic_button" href="../index.php"><button type="button" class="btn return">Retour</button></a>
                <button type="submit" class="btn btn-primary" name="send_topic">Poster</button>
            </div>
        </form>
     

    </div> 
<script src="../js/input_limit.js"></script>
<?php include PATH."footer.php";?>



