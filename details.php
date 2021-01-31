<?php
include("config.php");

include("TreeDAO.php");

$dao = new TreeDAO(Connection::getConnection());

if(isset($_GET["id"])){

   $id=$_GET["id"];
   $myJSON = json_encode($dao->findById($id));
   echo $myJSON; 
   
}

