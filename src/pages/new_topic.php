
<head>

    <title>Créer un sujet</title>

    
</head>

<?php include "./header.php";?>
    <div class="conteneur">

        <form>
            
            <div class="form-group">
                <label for="inputAddress">Titre</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Insérer un titre">
            </div>

            <div class="form-row">
                
                <div class="form-group col-md-4">
                <label for="inputState">Catégorie</label>
                <select id="inputState" class="form-control">
                    <option selected>Général</option>
                    <option>Développement</option>
                    <option>Discussions</option>
                    <option>Evénements</option>
                </select>
                </div>
                
            </div>

            <div class="form-group">
                <label for="inputAddress2">Contenu</label>
                <input type="text" class="form-control contenu" id="inputAddress2">
            </div>
            
            <div class="new_topic_button">
                <a class="new_topic_button" href="../index.php"><button type="button" class="btn return">Retour</button></a>
                <button type="submit" class="btn btn-primary">Poster</button>
            </div>
        </form>

    </div>

<?php include "./footer.php";



