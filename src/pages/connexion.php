<?php
define("PATH", "./");
?>
<head>

<title>F_Person Connexion</title>


</head>

<?php include PATH."header.php";
require "./connexion_script.php";
?>
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
            echo '<font color="red">'.$message."</font>";
         }
         ?>
</form>
   </div>
        
       

<?php
 include PATH."footer.php";



