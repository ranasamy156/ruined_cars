<?php
    include_once 'database.php';
    include_once 'operation.php';

    class Requests extends Database implements Operation{

       var $id; var $model_id; var $plate_number; var $color; 
       var $lat; var $lng; var $state_id; var $city_id; var $area_id;
       var $user_id; var $created_at; var $status_id;

        public function getid(){
        return $this->id;
        }
        public function getmodelid(){
            return $this->model_id;
        }
        public function getplatenumber(){
            return $this->plate_number;
        }
        public function getcolor(){
            return $this->color;
        }
        public function getlat(){
            return $this->lat;
        }
        public function getlng(){
            return $this->lng;
        }
        public function getstateid(){
            return $this->state_id;
        }
        public function getcityid(){
            return $this->city_id;
        }
        public function getareaid(){
            return $this->area_id;
        }
        public function getuserid(){
            return $this->user_id;
        }
        public function getcreatedat(){
            return $this->created_at;
        }
        public function getstatusid(){
            return $this->status_id;
        }



        public function setid($id){
            $this->id=$id;
        }
        public function setmodelid($model_id){
            $this->model_id=$model_id;
        }
        public function setplate_number($plate_number){
            $this->plate_number=$plate_number;
        }
        public function setcolor($color){
            $this->color=$color;
        }
        public function setlat($lat){
            $this->lat=$lat;
        }
        public function setlng($lng){
            $this->lng=$lng;
        }
        public function setstateid($state_id){
            $this->state_id=$state_id;
        }
        public function setcityid($city_id){
            $this->city_id=$city_id;
        }
        public function setareaid($area_id){
            $this->area_id=$area_id;
        }
        public function setuserid($user_id){
            $this->user_id=$user_id;
        }
        public function setcreatedat($created_at){
            $this->created_at=$created_at;
        }
        public function setstatusid($status_id){
            $this->status_id=$status_id;
        }
        


        public function add(){
            $m=parent::RunDML("insert into request values (Default, )");
            return $m;
        }

        public function delete(){
            $m=parent::RunDML("delete from request where id='".$_GET["n"]."' ");
            return $m;
            
        }

        public function update(){
            $m=parent::RunDML("update request set status_id='13' where id='".$_GET["id"]."' ");
            return $m;
        }

        public function GetAll(){
            $rs=parent::GetData("select rq.* ,st.description as status_name ,us.name from request rq ,statuses st, users us where rq.user_id = us.id and rq.status_id=st.id and rq.status_id not in (24,25,26) order by rq.id desc");
            return $rs;
        }

        public function GetAllUsers(){ 
            $rs=parent::GetData("select * from users");
            return $rs;
        }
        public function GetReqById(){
            $rs=parent::GetData("select  rq.* ,sts.description as sts_name,model.name as model_name ,model.en_name as model_arname ,man.name as man_name,man.ar_name as man_arname,us.name , ct.name as ct_name, ar.name as ar_name, st.name as st_name from request rq ,models as model, manufactures man,users us ,areas ar ,cities ct,statuses sts,states st where rq.id='".$_GET["n"]."' and rq.model_id=model.id and model.manufacture_id=man.id	 and rq.user_id = us.id and rq.city_id=ct.id and rq.area_id =ar.id and rq.state_id=st.id and rq.status_id=sts.id");
            return $rs;
        }
        
        public function GetReqById2(){
            $rs=parent::GetData("select  rq.* ,sts.description as sts_name,us.name , ct.name as ct_name, ar.name as ar_name, st.name as st_name 
            
            from request rq ,users us ,areas ar ,cities ct,statuses sts,states st 
            
            where rq.id='".$_GET["n"]."'  and rq.user_id = us.id and rq.city_id=ct.id and rq.area_id =ar.id and rq.state_id=st.id and rq.status_id=sts.id");
            return $rs;
        }
        public function GetReqById3(){
            $rs=parent::GetData("select  rq.* ,sts.description as sts_name,man.name as man_name,man.ar_name as man_arname,us.name , ct.name as ct_name, ar.name as ar_name, st.name as st_name 
            
            from request rq , manufactures man,users us ,areas ar ,cities ct,statuses sts,states st 
            
            where rq.id='".$_GET["n"]."' and rq.man_id=man.id and rq.user_id = us.id and rq.city_id=ct.id and rq.area_id =ar.id and rq.state_id=st.id and rq.status_id=sts.id");
            return $rs;
        }
        // public function  GetReqById(){
        //     $rs=parent::GetData("select * from request where id ='".$_GET["n"]."'");
        //     return $rs;
        // }

        public function GetReqImagesById(){
            $rs=parent::GetData("select  * from images where request_id='".$_GET["n"]."'");
            return $rs;
        }
        public function GetMapById(){
            $rs=parent::GetData("select * from request where id = '".$_GET["n"]."' ");
            return $rs;
        }
        public function SearchFunction(){
            $rs=parent::GetData("select rq.* ,st.description as status_name ,us.name from request rq ,status st, users us where (rq.plate_number like '%".$_GET["n"]."%' or rq.en_platenum like '%".$_GET["n"]."%') and rq.user_id = us.id and rq.status_id=st.id and rq.status_id not in ('10', '12')");
            return $rs;
            
        }
        public function GetSearch(){
            // $phpdate = strtotime($_GET["n"]);
            // $mysqldate = date( 'Y-m-d', $phpdate );
           // print_r($mysqldate);
            $reverse = str_replace(' ', '_', $_GET["n"]);
            $rs=parent::GetData("select  rq.* ,sts.description as status_name,model.name as model_name ,man.name as man_name,us.name , ct.name as ct_name, ar.name as ar_name, st.name as st_name 
            
            from request rq ,models as model, manufactures man,users us ,areas ar ,cities ct,statuses sts,states st 
            
            where (rq.created_at between '".$_GET["f"]."' and '".$_GET["t"]."' or rq.plate_number like '%".$reverse."%' or rq.en_platenum like '%".$reverse."%' or rq.id like '%".$_GET["n"]."%' or ct.name like '%".$_GET["n"]."%' or ar.name like '%".$_GET["n"]."%') and rq.model_id=model.id and model.manufacture_id=man.id and rq.user_id = us.id and rq.city_id=ct.id and rq.area_id =ar.id and rq.state_id=st.id and rq.status_id=sts.id");
           
            return $rs;
        }
    }
        
?>