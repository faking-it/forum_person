<?php 
define("PATH", "./pages/");
require PATH."header.php";


//requete affichage topics
require "pdo.php";
$sql = "SELECT * 
        FROM topics
         ORDER BY date_crea DESC";
    $sth = $link->prepare($sql);
    $sth->execute();

    $topics = $sth->fetchAll(PDO::FETCH_OBJ);
//fin requete
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Topics</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type='text/css'href="../sass/css/style.css">
</head>

    
   <nav class="home">
       <ul class="nav nav-pills nav-fill">
       <li class="nav-item">
           <a class="nav-link active" href="#">All</a>
       </li>
       <li class="nav-item">
           <a class="nav-link" href="#">General</a>
       </li>
       <li class="nav-item">
           <a class="nav-link" href="#">Development</a>
       </li>
       <li class="nav-item">
           <a class="nav-link" href="#">Small Talks</a>
       </li>
       <li class="nav-item">
           <a class="nav-link" href="#">Events</a>
       </li>
       </ul>
   </nav>


<div class="conteneur">
   <div class="list-group">
   <ul class="ul_topic">
       <?php 
       foreach ($topics as $topic)  {?>
       <li class="id_topic">
       <a href="<? if (isset($_SESSION["id"])){echo 'pages/topic_details.php?id_topic='.$topic->id_topic;} else{ echo "#";} ?>" 
       class="list-group-item list-group-item-action">
           <div class="d-flex w-100 justify-content-between">
               <div>
               <img src="https://2.gravatar.com/avatar/<?php echo md5($_SESSION["avatar"]); ?>" class="card-img-top" alt="image de l'avatar">
          </div>
               <div class="title"><h5><?php echo $topic->title?></h5></div>
               <small class="date"><?php echo $topic->date_crea?> </small>
           </div>
       </a>
       </li>
       <?php } ?>
   </ul>
   <?php if (isset($_SESSION['id'])){echo "<a class='new_topic_button' href='./pages/new_topic.php'>
       <button type='button' class='btn btn-primary'>Créer un sujet</button>
   </a>";}else{echo "";} ?>
   

   </div>
</div>
<?php
require PATH."footer.php";
