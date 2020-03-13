<?php
define("PATH", "./");
?>
<head>

    <title>Créer un sujet</title>

    
</head>
<?php include PATH."header.php";?>


    <div class="conteneur">

        <form action="new_topic_script.php" method="post">
            
            <div class="form-group">
                <label for="inputAddress">Titre</label>
                <input required name="titre"type="text" class="form-control" id="saisieTitre" placeholder="Insérer un titre">
                  <span id="counterGeo">0/40</span>
                  <span id="champsVide"></span>
            </div>

            <div class="form-row">
                
                <div class="form-group col-md-4">
                <label for="inputState">Catégorie</label>
                <select id="inputState" class="form-control" name="categorie">
                    <option  value="1"selected>Général</option>
                    <option  value="2">Développement</option>
                    <option  value="3">Discussions</option>
                    <option  value="4">Evénements</option>
                </select>
                </div>
                
            </div>

            <div class="form-group">
                <label for="inputAddress2">Contenu</label>
                <textarea required name="contenu" type="text" class="form-control contenu" id="saisieTitre2"></textarea>
                <span id="counterGeo2">0/800</span>
            </div>
            
            <div class="new_topic_button">
                <a class="new_topic_button" href="../index.php"><button type="button" class="btn return">Retour</button></a>
                <button type="submit" class="btn btn-primary" name="envoyer">Poster</button>
            </div>
        </form>
     

    </div> 
<script src="../js/input_limit.js"></script>
<?php include PATH."footer.php";






