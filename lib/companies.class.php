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
}