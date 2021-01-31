<?php
include("config.php");

include("TreeDAO.php");

$dao = new TreeDAO(Connection::getConnection());


if (isset($_POST["name"], $_POST["parent"])) {
   $name = $_POST["name"];
   $parent = $_POST["parent"];
   //VALIDATION todo

   $isquestion= $_POST["isquestion"];
   

   echo "<h1>".$_POST["isquestion"]."</h1>";
 
   $tree = new Tree(0, $name);

   $tree->setParent($parent);
   if(isset($_POST["isquestion"])){
       
       $tree->setIsQuestion(1);
   }
   else{
       $tree->setIsQuestion(0);
   }
  

  

   $res=$dao->add($tree);


   $arbres = $dao->all();
} else {

   $arbres = $dao->all();
}


include("header.php");
?>



<div class="row">
<div class="col-md-4">
<div id="nodelist">
<ul id="menuNoeud" style="position: absolute; display:none">
  <li>
    <div class="add">Ajouter Noeud</div>
    <ul>
      <li>
        <div class="inside">Â l'interieur</div>
      </li>
      <li>
        <div class="next">Â coté</div>
      </li>
    </ul>
  </li>
  <li>
    <div class="edit">Modifier</div>
  </li>
  <li>
    <div class="remove">Supprimer</div>
  </li>
</ul>

   </div>
</div>
<div class="col-md-8">

<div id="nodesettings">


   </div>
</div>
</div>

</div>


<div id="formnode" style="visibility: hidden;">
<form id="addnode" method="POST" name="addsheep">
    <div class="form-group">
        <label for="name">Nom du noeud:</label>
        <input  id="name" type="text" name="name" class="form-control" required />
    </div>
    

    <div class="form-group">
    <input type="hidden"   name="parent" class="form-control">
    
    </div>
     
    <input   type="submit" value="Ajouter" class="btn btn-primary btnsubmit">

</form> 
</div>


   
  
   <?php
      
   foreach ($arbres as $key => $value) {
      //echo  $value->node;
      //echo  char_count($arbres[$key]->node, ".")  ;
   }
   ?>
  
<?php

include("footer.php");

