<?php
 
class dbManager
{
    protected $db;
    private $host = "localhost";
    private $login = "admin";
    private $password = "online2017";
 
    public function __construct()
    {
        $db = new PDO('mysql:host=' . $this->host . ';dbname=share_file;charset=utf8', $this->login, $this->password);
        $db->exec("SELECT CHARACTER SET utf8");
        $this->db = $db;
 
    }
    public function getBdd(){
    	return $this->db;
    }
 
}