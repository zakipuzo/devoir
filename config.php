<?php

class Connection{
    private $servername="localhost";
    private $username="root";
    private  $psw='$Zaki2704';
    private $PDOConnection;
    function __construct()
    {

        try{
            
            $this->PDOConnection=new PDO("mysql:host=$this->servername;dbname=arbresdb",$this->username,$this->psw);
            $this->PDOConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          // echo "conneted";
        }catch(PDOException $e){
            echo "Database connection failed ".$e->getMessage();
        }
    }
    public static function  getConnection(){
        $con=new Connection();

          return $con->PDOConnection;
    }

    
}





///SELECT



//INSERR



?>

