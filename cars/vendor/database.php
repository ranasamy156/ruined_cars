<?php

    class Database{
        var $conn;

        function __construct(){
            $this->conn=mysqli_connect("localhost" ,"root" , "" ,"cars");
            $this->conn->set_charset("utf8");
        }

        function RunDML($statement){
            if(!mysqli_query($this->conn, $statement)){
                return mysqli_error($this->conn);
            }
            else{
                return "ok";
            }
        }

        function GetData($select){
            $result = mysqli_query($this->conn, $select);
            return $result;
        }

        function mysqli_insert_id(){
            $result = $this->conn->insert_id;
            return $result;
         }


    }
//"localhost" ,"ilcruumy_cars" , "lcQeKA0SuFG" ,"ilcruumy_cars"

?>