<?php
session_start();
require "header.php";

/* php requete side by berthold
* delete topic sur base de l'id topic
*/
require "../pdo.php";
if(isset($_REQUEST["id_comment"]) and $_SESSION["id"]!=""){
    $id_comment   = intval($_REQUEST["id_comment"])   ;
        $sql_delete = ("DELETE  
        FROM comments
        WHERE id_comment=?;");
    $requete = $link->prepare($sql_delete);
    //$requete->bindvalue(':id_topic', $id_topic, PDO::PARAM_INT);
    $requete->execute(array($id_comment));
    
    //var_dump($requete->execute());

    if ($requete && $requete->rowCount() > 0) {

    if(isset($_SESSION["id"])){
        echo  $message = 'le commentaire ' . $id_comment . ' a été bien effacé';
        //header("Location:index.php");
    } 
       
      
    } else {
        
        //$message_del = 'error';
      
       if(isset($_SESSION["id"])){
        echo $message = 'erreur sql';
        //header("Location:index.php");
    } 
    }
}