<?php
    include_once 'database.php';
    include_once 'operation.php';

    class States extends Database implements Operation{

        var $id; var $name; var $lat; var $lng;

        public function getid(){
            return $this->id;
        }
        public function getname(){
            return $this->name;
        }
        public function getlat(){
            return $this->lat;
        }
        public function getlng(){
            return $this->lng;
        }
        
        public function setid($id){
           $this->id=$id;
        }
        public function setname($name){
           $this->name=$name;
        }
        public function setlat($lat){
           $this->lat=$lat;
        }
        public function setlng($lng){
           $this->lng=$lng;
        }
        
         public function add(){
            $m=parent::RunDML("insert into states values (Default, '".$this->getname()."' , '".$this->getlat()."' , 
            '".$this->getlng()."')");

            return $m;
        }

        public function delete(){
            $m=parent::RunDML("delete from states where id='".$_GET["id"]."' ");
            
        }

        public function update(){
            $m=parent::RunDML("update states set name='".$this->getname()."' , lat='".$this->getlat()."' , 
            lng='".$this->getlng()."' where id='".$_GET["id"]."' ");
            
        }

        public function GetAll(){
            $rs=parent::GetData("select * from states");
            return $rs;
        }
        
?>