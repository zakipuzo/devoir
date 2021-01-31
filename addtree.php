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
 

<form id="addnode" method="POST" name="addsheep">
    <div class="form-group">
        <label for="name">Nom du noeud:</label>
        <input  id="name" type="text" name="name" class="form-control" required />
    </div>
    

    <div class="form-group">
    <label for="parent">Noeud parent:</label>
    <select id="parent" name="parent" class="form-control">
    <?php
        
            echo "<option value='0'>Aucun noeud parent</option>";
        
        
        foreach ($arbres as $key => $value) {
            echo "<option value=" . $value->id . ">" . $value->name . "</option>";
        }
        ?>
    </select>


    </div>
    <div class="form-group">
        <label for="isquestion">Cocher si c'est une question ou un indicateur pour ne pas l'afficher à la recherche:</label><br>
        <input id="isquestion" type="checkbox" name="isquestion" style="height: 40px"   />
    </div>
    <input   type="submit" value="Ajouter" class="btn btn-primary btnsubmit">

</form> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
include("footer.php");
?>