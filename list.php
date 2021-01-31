<?php
include("config.php");

include("TreeDAO.php");

$dao = new TreeDAO(Connection::getConnection());

 

$myJSON = json_encode($dao->all());
echo $myJSON; 

