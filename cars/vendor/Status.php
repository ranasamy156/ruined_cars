<?php
    include_once 'database.php';
    include_once 'operation.php';

    class Status extends Database implements Operation{

        var $id; var $description; var $user_id;

        public function getid(){
            return $this->id;
        }
        public function getdescription(){
            return $this->description;
        }
        public function getuser_id(){
            return $this->user_id;
        }
        
        
        public function setid($id){
           $this->id=$id;
        }
        public function setdescription($description){
           $this->description=$description;
        }
        public function setuser_id($user_id){
            $this->user_id=$user_id;
         }


        public function add(){
            $m=parent::RunDML("insert into statuses values (Default, '".$this->getdescription()."', '".$_SESSION['id']."')");

            return $m;
        }

        public function delete(){
            $m=parent::RunDML("delete from statuses where id='".$_GET["n"]."' ");
            
        }

        public function update(){
            $m=parent::RunDML("update statuses set description='".$this->getdescription()."', user_id='".$_SESSION['id']."' where id='".$_GET["id"]."' ");
            
        }

        public function GetAll(){
            $rs=parent::GetData("select st.*, us.name from statuses st, users us where st.user_id = us.id");
            return $rs;
        }
    }
?>