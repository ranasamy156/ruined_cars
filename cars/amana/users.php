<?php
    
    include_once 'database.php';
    include_once 'operation.php';

    class Users extends Database implements Operation{

        var $id; var $name; var $phone;
        var $user_name; var $password; var $type_id; var $permission_des;

        public function getid(){
            return $this->id;
        }
        public function getname(){
            return $this->name;
        }
        
        public function getphone(){
            return $this->phone;
        }
        public function getusername(){
            return $this->user_name;
        }
        public function getpassword(){
            return $this->password;
        }
        public function gettypeid(){
            return $this->type_id;
        }
        public function getpermission_des(){
            return $this->permission_des;
        }



        public function setid($id){
           $this->id=$id;
        }
        public function setname($name){
            $this->name=$name;
        }
        
        public function setphone($phone){
            $this->phone=$phone;
        }
        public function setusername($username){
            $this->user_name=$username;
        }
        public function setpassword($password){
            $this->password=$password;
        }
        public function settypeid($typeid){
            $this->type_id=$typeid;
        }
        public function setpermission_des($permission_des){
            $this->permission_des=$permission_des;
        }



       public function add(){
            $m=parent::RunDML("insert into users values (Default, '".$this->getname()."' ,'".$this->getphone()."' , 
            '".$this->getusername()."' , '".$this->getpassword()."' , '2', 'regular', 'nonsuper')");

            return $m;
        }

        public function delete(){
            $m=parent::RunDML("delete from users where id='".$_GET["n"]."' ");
            
        }

        public function update(){
            $m=parent::RunDML("update users set name='".$this->getname()."' , phone='".$this->getphone()."' , 
            user_name='".$this->getusername()."' , password='".$this->getpassword()."' , type_id='2' where id='".$_GET["n"]."' ");
            
        }
        public function update2(){
            $m=parent::RunDML("update users set name='".$this->getname()."' , phone='".$this->getphone()."' , 
            user_name='".$this->getusername()."' , password='".$this->getpassword()."' , type_id='2' where id='".$_SESSION["id"]."' ");
            
        }

        public function GetAll(){
            $rs=parent::GetData("select * from users where id != '".$_SESSION['id']."' and type_id='2'");
            return $rs;
        }
        
        public function Login(){
            $rs=parent::GetData("select * from users where user_name='".$this->getusername()."' and password='".$this->getpassword()."'");
            return $rs;
        }


        public function GetUserByID(){
            $rs=parent::GetData("select * from users where id = '".$_SESSION["id"]."' ");
            return $rs;
        }
        public function GetUserByID2(){
            $rs=parent::GetData("select * from users where id = '".$_GET["n"]."' ");
            return $rs;
        }

    }


?>
