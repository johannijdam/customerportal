<?php
$active = "admin";
include_once '../../../includes/header.inc.php'; 
include_once '../../../lib/companies.class.php'; 

//init classes
$companies = new companies();

//get company info
if(!isset($_GET['id'])) die();

$company = $companies->getCompany($_GET['id']);

?>
<div class="row">
    <div class="col-12">
        <h1>Company information</h1>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                About
            </div>
            <div class="card-block">
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <td><?php echo $company['cp_companies_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo $company['cp_companies_address']; ?></td>
                    </tr>
                    <tr>
                        <th>Zipcode</th>
                        <td><?php echo $company['cp_companies_zipcode']; ?></td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td><?php echo $company['cp_companies_city']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Employees
            </div>
            <div class="card-block">
                <table class="table">
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                    </tr>
                <?php
                foreach($companies->getUsersByCompany($_GET['id']) as $user){
                    ?>
                    <tr class='clickable-row' data-href='<?php echo $config->url; ?>system/admin/companies_and_users/user_details.php?id=<?php echo $user['cp_users_id']; ?>'>
                        <td><?php echo $user['cp_users_firstname']; ?></td>
                        <td><?php echo $user['cp_users_lastname']; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </table>
                <a href="<?php echo $config->url; ?>system/admin/companies_and_users/add_user.php?company=<?php echo $company['cp_companies_id']; ?>" class="btn btn-primary">Add new employee</a>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 20px;">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Documents
            </div>
            <div class="card-block">
                Some notes here
            </div>
        </div>        
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Documents
            </div>
            <div class="card-block">
                Some notes here
            </div>
        </div>   
    </div>
</div>
<?php include_once '../../../includes/footer.inc.php'; ?>