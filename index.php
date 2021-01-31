<?php
include("config.php");

include("TreeDAO.php");

$dao = new TreeDAO(Connection::getConnection());


include("header.php");
?>



<h6>Cette version support la recherche exacte du mot</h6>
    
    <form method="GET" class="text-center">
    <div class="form-group">
        <input id="s" type="text" placeholder="Rechercher" name="s" class="form-control" required />
    </div>
    
 
    <input   type="submit" value="Rechercher" class="btn btn-primary btnsubmit">

</form> 
   <hr>

   <div id="Result">
       <?php
if(isset($_GET["s"])){
    $search= $_GET["s"];
 
    $arbres = $dao->search($search);
 
       
    }
  ?>
     
   </div>
  


   <hr>

  
   <?php
      
   foreach ($arbres as $key => $value) {
      //echo  $value->node;
      //echo  char_count($arbres[$key]->node, ".")  ;
   }
   ?>
  
<?php

include("footer.php");

