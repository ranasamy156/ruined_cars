<?php
    
    include_once 'database.php';
    include_once 'operation.php';

    class Models extends Database implements Operation{

        var $id; var $manufacture_id; var $name;
        var $release_year;



        public function getid(){
            return $this->id;
        }
        public function getname(){
            return $this->name;
        }
        public function getManufactureId(){
            return $this->manufacture_id;
        }
        public function getReleaseYear(){
            return $this->release_year;
        }



        public function setid($id){
           $this->id=$id;
        }
        public function setname($name){
            $this->name=$name;
        }
        public function setManufactureId($manufacture_id){
            $this->manufacture_id=$manufacture_id;
        }
        public function setReleaseYear($release_year){
            $this->release_year=$release_year;
        }



       public function add(){
            $m=parent::RunDML("insert into models values (Default, '".$this->getname()."' , '".$this->getManufactureId()."' , 
            '".$this->getReleaseYear()."')");

            return $m;
        }

        public function delete(){
            $m=parent::RunDML("delete from models where id='".$_SESSION["id"]."' ");
            
        }

        public function update(){
            $m=parent::RunDML("update models set name='".$this->getname()."' , phone='".$this->getphone()."' , 
            user_name='".$this->getusername()."' , password='".$this->getpassword()."' , type_id='".$this->gettypeid()."' where id='".$_SESSION["id"]."' ");
            
        }

        public function GetAll(){
            $rs=parent::GetData("select * from models");
            return $rs;
        }

    }


?>
