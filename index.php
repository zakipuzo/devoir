<?php
include("config.php");

include("TreeDAO.php");

$dao = new TreeDAO(Connection::getConnection());


if (isset($_POST["name"], $_POST["parent"])) {
   $name = $_POST["name"];
   $parent = $_POST["parent"];
   //VALIDATION todo

   
   $tree = new Tree(0, $name);

   $tree->setParent($parent);
  
  

  

   $res=$dao->add($tree);


   $arbres = $dao->all();
} else {

   $arbres = $dao->all();
}


include("header.php");
?>



<div class="row">
<div class="col-md-12">
<div id="nodelist">
 

   </div>
</div>
 <br><br>
<div id="nodedetails" class="container-fluid pt-5">


   </div>
</div>
</div>

</div>


 
  
   <?php
      
   foreach ($arbres as $key => $value) {
      //echo  $value->node;
      //echo  char_count($arbres[$key]->node, ".")  ;
   }
   ?>
  
<?php

include("footer.php");

