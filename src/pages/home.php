 <!DOCTYPE html>
 <html lang="fr">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../sass/css/style.css">
     <title>Home</title>
 </head>
 <body>
     
    <nav class="home">
        <ul class="nav nav-pills nav-fill">
        <li class="nav-item All">
            <a class="nav-link active" href="#">All</a>
        </li>
        <li class="nav-item gen">
            <a class="nav-link" href="#">General</a>
        </li>
        <li class="nav-item dvlpt">
            <a class="nav-link" href="#">Development</a>
        </li>
        <li class="nav-item st">
            <a class="nav-link" href="#">Small Talks</a>
        </li>
        <li class="nav-item ev">
            <a class="nav-link" href="#">Events</a>
        </li>
        </ul>
    </nav>

<?php require "topics_home.php";?>

<div class="conteneur">
    <div class="list-group">
    <ul class="ul_topic">

<!-- C'est ici qu'on va rechercher les données dans la sélection exécutée dans topics_home.php -->
   <?php require "home_avatar_script.php";?>
        <?php foreach ($topics as $topic)  {?>
        
        <li class="id_topic"><?php echo $topic->board_name?>">
        <a href="topic.php?id=<?php $topic->id_user ?>" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <div>      
                <div class="board"><?php echo $topic->board_name?></div>
                <div>         
                <!-- ajout de l'image gravatar des utilisateurs grâce à leur e-mail -->
                <?php 
                $avatar = trim($mail_Post[$parcour]);
                $parcour++; 
                ?>
                    <img src= "https://2.gravatar.com/avatar/<?php echo md5($avatar)."s=100&";?>" alt="avatar" class="avatar">
                </div>
                <div class="title"><h5><?php echo $topic->title?></h5></div>
                <small class="date"><?php echo $topic->date_up?></small>
            </div>
        </a>
        </li>
        <?php } ?>
    </ul>

    <!-- Pagination -->
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <?php $nbr_pages=$nbr_lignes/5;for ($i=0;$i<$nbr_pages;$i++){?>
        <div class="btn-group mr-2" role="group" aria-label="First group">
            <button type="button" class="btn btn-secondary <?php echo $i?>"></button>
        </div>
        <?php }?>
    </div>

    <!-- Créer un sujet -->
    <div style="text-align:center;"><a class="new_topic_button" href="./pages/new_topic.php"><button type="button" class="btn btn-primary">Créer un sujet</button></a></div>

    </div>
</div>

<?php include "./js/home_script.php" ?>

</body>
</html>

