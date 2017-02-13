<?php
$active = "admin";
include_once '../../../includes/header.inc.php'; 
include_once '../../../lib/companies.class.php'; 

//init classes
$companies = new companies();

//get company info
if(!isset($_GET['company'])) die();

//set company
$company = $companies->getCompany($_GET['company']);

//save user
if(isset($_POST['submit'])){
    $companies->addUserToCompany($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $company);
}

?>
<div class="row">
    <div class="col-12">
        <form method="post" action="">
            <h1>Add employee for <?php echo $company['cp_companies_name']; ?></h1>
            <div class="form-group row">
                <label for="firstname" class="col-2 col-form-label">Firstname</label>
                <div class="col-10">
                    <input class="form-control" type="text" name="firstname" value="" placeholder="..." id="firstname">
                </div>
            </div>
            <div class="form-group row">
                <label for="lastname" class="col-2 col-form-label">Lastname</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="" name="lastname" placeholder="..." id="lastname">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-2 col-form-label">Email</label>
                <div class="col-10">
                    <input class="form-control" type="email" value="" name="email" placeholder="..." id="email">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-2 col-form-label">Password</label>
                <div class="col-10">
                    <input class="form-control" type="password" value="" name="password" placeholder="..." id="password">
                </div>
            </div>
            <div class="form-group row">
                <label for="company" class="col-2 col-form-label">Company</label>
                <div class="col-10">
                    <input class="form-control" type="text" value="<?php echo $company['cp_companies_name']; ?>" disabled id="company">
                </div>
            </div>
            <div class="form-group row">
              <div class="offset-sm-2 col-sm-10">
                <button type="submit" name="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
        </form>
    </div>
</div>
<?php include_once '../../../includes/footer.inc.php'; ?>