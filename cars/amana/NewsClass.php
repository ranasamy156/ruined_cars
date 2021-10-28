<?php
    
    include_once 'database.php';
    include_once 'operation.php';

    class News extends Database implements Operation{

        var $id; var $description;



        public function getid(){
            return $this->id;
        }
        public function getdescription(){
            return $this->description;
        }
        


        public function setid($id){
            $this->id=$id;
        }
        public function setdescription($description){
            $this->description=$description;
        }



        public function add(){
            $m=parent::RunDML("insert into news values (Default, '".$this->getdescription()."')");

            return $m;
        }

        public function delete(){
            $m=parent::RunDML("delete from news where id='".$_GET["n"]."' ");
            
        }

        public function update(){
            $m=parent::RunDML("update news set description='".$this->getdescription()."' where id='".$_SESSION["id"]."' ");
            
        }

        public function GetAll(){
            $rs=parent::GetData("select * from news");
            return $rs;
        }

    }


?>
