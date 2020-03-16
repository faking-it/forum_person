 <?php 
    $parcour=0 ; // Va permettre de selectionner la bonne adresse mail présent dans la liste $mail_Post
                $sql = "SELECT users.avatar FROM users, topics WHERE topics.user_id = users.id_user";
                $sth = $link->prepare($sql);
                $sth->execute();

                $test = $sth->fetchAll(PDO::FETCH_OBJ);
$mail_Post=[]; // Stock les adresses mail dans l'ordre pour chaque post des utilisteurs
                for($i =0;$i<count($test);$i++){
                foreach($test[$i] as $valeur)
                 $mail_Post[$i]= $valeur;     
                }  
                ?>