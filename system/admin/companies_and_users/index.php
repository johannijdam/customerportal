<?php
$active = "admin";
include_once '../../../includes/header.inc.php'; 
include_once '../../../lib/companies.class.php'; 

//init classes
$companies = new companies();

?>
<div class="row">
    <div class="col-12">
        <h1>Companies and Users</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Zipcode</th>
                    <th>City</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($companies->getCompanies() as $company){
                ?>
                <tr class='clickable-row' data-href='<?php echo $config->url; ?>system/admin/companies_and_users/company_details.php?id=<?php echo $company['cp_companies_id']; ?>'>
                    <td><?php echo $company['cp_companies_name']; ?></td>
                    <td><?php echo $company['cp_companies_address']; ?></td>
                    <td><?php echo $company['cp_companies_zipcode']; ?></td>
                    <td><?php echo $company['cp_companies_city']; ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once '../../../includes/footer.inc.php'; ?>