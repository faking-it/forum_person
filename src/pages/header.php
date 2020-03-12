<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="../lib/css/emoji.css" rel="stylesheet">

    <link rel="stylesheet" type='text/css'href="../sass/css/style.css">
</head>
<body>
<nav class="navbar">
<ul class="nav justify-content-end">
  <li class="nav-item">
            <a class="nav-link active" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?php echo PATH;?>profil.php?id_user=<?php if(isset($_SESSION["id"])){
                echo $_SESSION["id"];
            } else{echo"";}
                ?>"><?php if(isset($_SESSION["id"]))
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
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- ** Don't forget to Add jQuery here ** -->


