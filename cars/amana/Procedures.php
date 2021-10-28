<?php
    
    include_once 'database.php';
    include_once 'operation.php';

    class Procedures extends Database implements Operation{

        var $id; var $description; var $type_id;



        public function getid(){
            return $this->id;
        }
        public function getdescription(){
            return $this->description;
        }
        public function gettypeid(){
            return $this->type_id;
        }
        


        public function setid($id){
            $this->id=$id;
        }
        public function setdescription($description){
            $this->description=$description;
        }
        public function settypeid($type_id){
            $this->type_id=$type_id;
        }



        public function add(){
            $m=parent::RunDML("insert into procedures values (Default, '".$this->getdescription()."','".$_SESSION["type_id"]."')");

            return $m;
        }

        public function delete(){
            $m=parent::RunDML("delete from procedures where id='".$_GET["n"]."'");
            
        }

        public function update(){
            $m=parent::RunDML("update procedures set description='".$this->getdescription()."' where id='".$_SESSION["id"]."' ");
            
        }

        public function GetAll(){
            $rs=parent::GetData("select * from procedures where type_id=".$_SESSION["type_id"]);
            return $rs;
        }
        public function GetReqProcedures(){
            $rs=parent::GetData("select rqpro.*, pro.description as description, ustype.type as user_type from requests_procedures rqpro, procedures pro, users_types ustype where ustype.id = rqpro.type_id and rqpro.procedures_id =pro.id and rqpro.request_id = '".$_GET['n']."'");
            return $rs;
        }

    }


?>
