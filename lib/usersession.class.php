<?php
session_start();
include_once 'config.class.php';

class usersession{
    public $config, $uid, $firstname, $lastname, $email, $companies_id, $roles_id;

    
    function __construct($page = null){
        $this->config = new config();
        
        if(!$this->isUserLoggedIn()){
            if($page != "login"){
                header("location: login.php");
            }
        }
    }
    
    function validateLogin($username, $password){
        //escape
        $username = $this->config->conn->escape($username);
        $password = $this->config->conn->escape($password);
        
        //make the key hashed
        $password = $this->config->passwordToHash($password);
        
        $results = $this->config->conn->rawQueryOne('
            SELECT 
                `cp_users_id`
            FROM
                `cp_users`
            WHERE
                `cp_users_email` = "'.$username.'"
            AND
                `cp_users_password` = "'.$password.'"
            LIMIT
                1
        ');
        
        if(!empty($results)){
            $userId = $results['cp_users_id'];
            
            $this->setLoginDate($userId);
            $this->loginUser($userId); 
            
            if($this->isUserLoggedIn()){
                header("location: index.php");
            }          
        }
    }
    
    function setLoginDate($user_id){
        $this->config->conn->rawQuery("
            UPDATE `cp_users`
            SET `cp_users_last_login` = '".date('Y-m-d H:i:s')."'
            WHERE `cp_users_id` = ".$user_id."
        ");
    }
    
    function loginUser($user_id){
       $_SESSION['uid'] = $user_id;
    }
    
    function isUserLoggedIn(){
        if(isset($_SESSION['uid'])){
            $uid = $_SESSION['uid'];
            
            if($this->setUserVars($uid)){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    function setUserVars($uid){
        $results = $this->config->conn->rawQueryOne('
            SELECT 
                `cp_users_id`,
                `cp_users_firstname`,
                `cp_users_lastname`,
                `cp_users_email`,
                `cp_companies_cp_companies_id`,
                `cp_roles_cp_roles_id`
            FROM
                `cp_users`
            WHERE
                `cp_users_id` = "'.$uid.'"
            LIMIT
                1
        ');
        
        if(!empty($results)){
            $this->uid = $results['cp_users_id'];
            $this->firstname = $results['cp_users_firstname'];
            $this->lastname = $results['cp_users_lastname'];
            $this->email = $results['cp_users_email'];
            $this->companies_id = $results['cp_companies_cp_companies_id'];
            $this->roles_id = $results['cp_roles_cp_roles_id'];
            return true;
        } else {
            return false;
        }
    }
    
    function logout(){
        session_destroy();
        header("location: login.php");
    }
}
?>