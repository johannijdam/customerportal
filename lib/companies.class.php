<?php
include_once 'config.class.php';

class companies{
    private $config;
    function __construct(){
        $this->config = new config();
    }
    
    function getCompanies(){
        $companies = $this->config->conn->rawQuery("
            SELECT
                `cp_companies_id`,
                `cp_companies_name`,
                `cp_companies_address`,
                `cp_companies_zipcode`,
                `cp_companies_city`
            FROM
                `cp_companies`
        ");
        
        return $companies;
    }
    
    //get company info0
    function getCompany($company_id){
        $company_id = $this->config->conn->escape($company_id);
        
        $company = $this->config->conn->rawQueryOne("
            SELECT
                `cp_companies_id`,
                `cp_companies_name`,
                `cp_companies_address`,
                `cp_companies_zipcode`,
                `cp_companies_city`
            FROM
                `cp_companies`
            WHERE
                `cp_companies_id` = '".$company_id."'
        ");
        
        return $company;
    }
    
    //add user to company
    function addUserToCompany($firstname, $lastname, $email, $password, $company){
        $firstname = $this->config->conn->escape($firstname);
        $lastname = $this->config->conn->escape($lastname);
        $email = $this->config->conn->escape($email);
        $password = $this->config->passwordToHash($this->config->conn->escape($password));
        $company = $this->config->conn->escape($company['cp_companies_id']);
                
        if($this->checkMailDuplicity($email) > 0){
            ?>
                <div class="alert alert-danger" role="alert">
                  <strong>Email</strong> already in use by an other company. The user was not added.<br />
                  <i>User e-mail addresses are used for the login process, it can only exist once</i>
                </div>
            <?php
            return;
        }
                
        $this->config->conn->rawQuery("
            INSERT INTO `cp_users`
                (`cp_users_firstname`,`cp_users_lastname`,`cp_users_email`,`cp_users_password`,`cp_companies_cp_companies_id`,`cp_roles_cp_roles_id`)
            VALUES
                ('".$firstname."','".$lastname."','".$email."','".$password."','".$company."','2')
        ");
        
        ?>
            <div class="alert alert-success" role="alert">
              <strong>Success!</strong> The user was added 
            </div>
        <?php
    }
    
    //check if mail exists
    function checkMailDuplicity($email){
        $count = $this->config->conn->rawQueryOne("
            SELECT
                count(*) as `count`
            FROM
                `cp_users`
            WHERE
                `cp_users_email` = '".$email."'
        ");
        
        return $count['count'];
    }
}