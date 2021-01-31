
<?php
include("config.php");

include("TreeDAO.php");

$dao = new TreeDAO(Connection::getConnection());


function char_count($str, $letter) {
   $letter_Count = 0;
   for ($position = 0; $position < strlen($str); $position++) {
     if (strcmp($str[$position],$letter)) {
       $letter_Count ++;
     }
   }
   return $letter_Count;
 }

$arbres = $dao->all();


include("header.php");
?>

<?php 

if(isset($_GET["added"])){
   if($_GET["added"]==1){?>
      <div class="text-success">Element ajouté avec succès</div>
      <?php }else if($_GET["added"]==0){ ?>
      <div class="text-danger">Erreur</div>
      <?php 
      }
   }

   
      ?>

<div class="container">
<div>
   <a href="addtree.php"><h6> + Nouveau neaud</h6></a>
</div>
   <table id="example" class="display table" style="width:100%">
      <thead> 
    
      <th>Nom</th>
      <th>Parent</th> 
      <th></th>
      </thead>
      <tbody>
      <?php
      
   foreach ($arbres as $key => $value) {
      echo "<tr><td>" . $value->name. "</td><td>" . $value->parent->name. "</td><td><a href='app.php?deleteid=" . $value->id. "'>Supprimer</a></td></tr>";
   }
   ?>
      </tbody>

   </table>


   <hr>

   
   <?php
      
   foreach ($arbres as $key => $value) {
      //echo  $value->node;
      //echo  char_count($arbres[$key]->node, ".")  ;
   }
   ?>
</div>
<?php

include("footer.php");

