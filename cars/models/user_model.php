<?php

class UserModel
{
    public $id;
    public $name;
    public $phone;
    public $user_name;
    public $password;
    public $type_id;

    function __construct($id, $name, $phone, $user_name, $password, $type_id)
    {
        $this->name = $name;
        $this->id = $id;
        $this->phone = $phone;
        $this->user_name = $user_name;
        $this->password = $password;
        $this->type_id=$type_id;
    }




}
