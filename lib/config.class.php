<?php
include_once 'MysqliDb.php';

class config{
    private $db_location;
    private $db_username;
    private $db_password;
    private $db_database;
    public $conn;
    public $hash;
    public $url;
    
    function __construct(){
        $this->setDatabaseVars();
        $this->setupConnection();
    }
    
    public function setupConnection(){
        $this->conn = new MysqliDb($this->get_db_location(), $this->get_db_username(), $this->get_db_password(), $this->get_db_database());
    }
    
    private function setDatabaseVars(){
        if($_SERVER['HTTP_HOST'] == "localhost"){
            $this->db_location = "localhost";
            $this->db_username = "root";
            $this->db_password = "";
            $this->db_database = "customerportal";
            $this->url = "http://localhost/customerportal/";
        }
    }
    
    public function get_db_location(){
        return $this->db_location;
    }
    
    public function get_db_username(){
        return $this->db_username;
    }
    
    public function get_db_password(){
        return $this->db_password;
    }
    
    public function get_db_database(){
        return $this->db_database;
    }
    
    function passwordToHash($password){
        $salt = "";
        return md5($password . $salt);
    }
}
