<?php
define("PATH", "./");
?>
<head>

<title>F_Person Inscription</title>


</head>

<?php include PATH."header.php";
require "./inscription_script.php";
?>

<div class="conteneur">

    <h1>Inscription</h1>

   <div class="conteneur">

   <form method="POST" action="">
   <div class="form-group">
    <label for="inputAddress">Pseudo</label>
    <input name="pseudo" type="text" class="form-control" id="inputAddress" placeholder="Entrer votre pseudo">
  </div>

   <div class="form-group">
    <label for="inputAddress">Email</label>
    <input name="mail" type="email" class="form-control" id="inputEmail4" placeholder="Entrer votre Email">
  </div>

  <div class="form-group">
  <label for="inputAddress">Email confirmation</label>
  <input name="mail2" type="email" class="form-control" id="inputEmail4" placeholder="Entrer votre Email">
</div>
  <div class="form-row">

  
    <div class="form-group col-md-6">
      <label for="inputEmail4">Mot de passe</label>
      <input name="password" type="password" class="form-control" id="inputPassword4" placeholder="Entrer votre mot de passe">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4"> Confirmation de mot de Passe</label>
      <input name="password2" type="password" class="form-control" id="inputPassword4" placeholder="Confirmation votre mot de passe">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputAddress2">Signature</label>
    <input name="signature" type="text" class="form-control" id="inputAddress2" placeholder="Entrer votre Signature">
  </div>
  <div class="form-row">
   
    <div class="form-group col-md-4">
      <label for="inputState">Choisissez votre Avatar</label>
     <input type="text" name ="avatar">
     <!--  <select id="inputState" class="form-control">
        <option name="0" selected>Avatar</option>
        <option name="1">sagular</option>
        <option name="2">apular</option>
        <option name="2">kogular</option>
      </select> --->
    </div>
  </div>
  
  <input type="submit" value="S'inscrire" name="send_inscription">
</form>
   </div>
   <?php
        if (isset($message)) {
            echo '<font color="red">' . $message . "</font>";
        }
        ?>   
       

<?php include PATH."footer.php";



