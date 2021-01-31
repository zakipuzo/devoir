<?php
include("config.php");

include("TreeDAO.php");

$dao = new TreeDAO(Connection::getConnection());



if(isset($_POST["deleteall"])){
    //TODO TRY CATCH
    $dao->deleteAll();
    header('location:manage.php');

 }





if(isset($_GET["deleteid"])){
    //TODO TRY CATCH
    $id=$_GET["deleteid"];
    $dao->deleteByID($id);
    header('location:manage.php');
 }


 ?>