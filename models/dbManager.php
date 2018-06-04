<?php
 
class dbManager
{
    protected $db;
    private $host = "localhost";
    private $login = "claireb";
    private $password = "7TQUD3FakR";
    
 
    public function __construct($database)
    {
        $db = new PDO('mysql:host=' . $this->host . ';dbname='.$database.';charset=utf8', $this->login, $this->password);
        $db->exec("SELECT CHARACTER SET utf8");
        $this->db = $db;
        
    }
    public function getBdd(){
    	return $this->db;
    }
 
}