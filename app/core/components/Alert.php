<?php


namespace App\core\components;


class Alert
{
    public $code;
    public $message;
    public function __construct(){
        $this->code=$_SESSION['code'];
        $this->message=$_SESSION['message'];
        unset($_SESSION['message'],$_SESSION['code']);
        if($this->code==50000) clear_session();
    }
    public function get(){
        return ['code'=>$this->code,'message'=>$this->message];
    }

}