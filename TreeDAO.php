
<?php

include("Treeclass.php");

class TreeDAO
{
    public $con;

    function __construct($con)
    {
        $this->con = $con;
    }

    //SELECT ALL

    public  function all()
    {
        //$sql = "SELECT t1.name pname, t2.name cname FROM Tree t1 inner join Tree t2 on t1.id=t2.tree_parent";
        $sql = "SELECT t1.node node, t1.id cid, t1.name cname, t2.id pid, t2.name pname FROM trees t1 left join trees t2 on t1.treeId=t2.id order by t1.node asc";

        $stm = $this->con->prepare($sql);

        try {
            $stm->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        //return true or false
        $result = $stm->setFetchMode(PDO::FETCH_ASSOC);
        $arbres = [];
        if ($result) {
            $data = $stm->fetchAll();
            $output = array();

            $arbres = array();
            foreach ($data as $value) {
                $tree = new Tree($value['cid'], $value['cname']);
                $tree->setnode($value['node']);
                $parent = new Tree($value['pid'], $value['pname']);
                $tree->setParent($parent);

                
                array_push($output, $tree);
            }

            return $output;
        }

        return $arbres;
    }

    //CREATE
    public  function add($tree)
    {
        try {
            if ($tree->parent == 0)
                $sql = "INSERT INTO trees (name, treeId) VALUES ('" . $tree->name . "', NULL)";
            else
                $sql = "INSERT INTO trees (name, treeId ) VALUES ('" . $tree->name . "', " . $tree->parent . ")";


            // use exec() because no results are returned
            $this->con->exec($sql);

            header('location:arbre.php');


            $sql = "INSERT INTO trees (name, treeId) VALUES ('" . $tree->name . "', " . $tree->parent . ")";
        } catch (PDOException $e) {

            //header('location:index.php?added=0');
            echo $sql . "<br>" . $e->getMessage();
        }
    }


    public function findById($id)
    {
        $sql = "SELECT t1.id id, t1.name, t2.id cid, t2.name cname  from trees t1 left join trees t2 on t1.treeId=t2.id where t1.id=" . $id;

        $stm = $this->con->prepare($sql);
        
        try {
            $stm->execute();
            $data = $stm->fetchAll();
            if ($data) {
                return $data;
            } else {
                echo "nothing";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }





    public function update()
    {
    }


    public function search($text)
    {

        $arr = explode(' ', $text);

        foreach ($arr as $key => $word) {
            if (strlen($word) > 1) {
                $sql = "SELECT * from trees where name like '%$word%'";
                $stm = $this->con->prepare($sql);
                $result = [];
                try {
                    $stm->execute();
                    $data = $stm->fetchAll();
                    if ($data) {
                        foreach ($data as $value) {
                            array_push($result, $value);
                            //echo $value['name'] . "<br>";
                            $node = $value["node"];


                            $sql2 = "SELECT * from trees where node like '$node.%'";

                            $stm2 = $this->con->prepare($sql2);
                            $result = [];
                            try {
                                $stm2->execute();
                                $datas = $stm2->fetchAll();
                                if ($datas) {
                                    foreach ($datas as $v) {
                                        array_push($result, $v);
                                        echo $v['name'] . "<br>";
                                        $node = $v["node"];
                                    }
                                } else {
                                    echo "nothing";
                                }
                            } catch (PDOException $e) {
                                echo $e->getMessage();
                            }
                        }
                    } else {
                        echo "Aucun Résultat";
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }


        /* foreach ($result as $key => $value) {
            echo $value;
        }*/
    }

    public function getSubNodes($id)
    {
  //$sql = "SELECT t1.name pname, t2.name cname FROM Tree t1 inner join Tree t2 on t1.id=t2.tree_parent";
        if($id==NULL)
  $sql = "SELECT id cid, name cname, treeId ctreeId, node cnode  FROM trees where treeId is null";
  else
  $sql="SELECT t1.node cnode, t1.id cid, t1.name cname, t2.id pid, t2.name pname FROM trees t1 left join trees t2 on t1.treeId=t2.id where t1.treeId=".$id." order by t1.node asc ";

  $stm = $this->con->prepare($sql);

  try {
      $stm->execute();
  } catch (PDOException $e) {
      echo $e->getMessage();
  }

  //return true or false
  $result = $stm->setFetchMode(PDO::FETCH_ASSOC);
  $arbres = [];
  if ($result) {
      $data = $stm->fetchAll();
      $output = array();
 
      foreach ($data as $value) {
          
          $tree = new Tree($value['cid'], $value['cname']);
          $tree->setnode($value['cnode']); 
          $parent = new Tree($value['pid'], $value['pname']);
          $tree->setParent($parent);
   
          array_push($output, $tree);
      }

      return $output;
    }
}


    public function deleteByID($id)
    {
        $sql = "Delete  FROM trees where id=" . $id;

        $this->con->exec($sql);
    }

    public function deleteAll()
    {

        $sql = "Delete  FROM trees";

        $this->con->exec($sql);
    }
}
