<?php
//define root
if($_SERVER['HTTP_HOST'] == "localhost"){
    $root = "/Applications/XAMPP/xamppfiles/htdocs/customerportal/";
} else {
   //$root = "/export/home/project/opendag/public_html/";
}

include_once $root . 'lib/config.class.php';
include_once $root . 'lib/usersession.class.php';

//load connection
$usersession = new usersession();
$config = new config();
$active = (empty($active) ? "" : $active )
?>
<!doctype html>

<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Customer Portal</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">

    <link rel="stylesheet" href="<?php echo $config->url; ?>assets/css/tether.min.css">
    <link rel="stylesheet" href="<?php echo $config->url; ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $config->url; ?>assets/css/style.css">

    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-toggleable-md navbar navbar-inverse fixed-top" style="background-color: #26b6d1;">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">CP</a>
        
            <div class="collapse navbar-collapse" id="navbarColor02">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php if($usersession->roles_id == 1){ ?>
                  <li class="nav-item dropdown <?php echo ($active == "admin") ? "active" : "" ?>"">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Admin
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="<?php echo $config->url; ?>system/admin/prepare_documents/index.php">Prepare documents</a>
                      <a class="dropdown-item" href="<?php echo $config->url; ?>system/admin/companies_and_users/index.php">Companies and Users</a>
                      <a class="dropdown-item" href="#">Listings</a>
                    </div>
                  </li>
                <?php } ?>
                <li class="nav-item" <?php echo ($active == "documents") ? "active" : "" ?>">
                  <a class="nav-link" href="#">Documents</a>
                </li>
                <li class="nav-item <?php echo ($active == "settings") ? "active" : "" ?>"">
                  <a class="nav-link" href="#">Settings</a>
                </li>
               </ul>
               <ul class="navbar-nav ">
                 <li class="nav-item float-right">
                  <a class="nav-link" href="<?php echo $config->url; ?>logout.php">Logout</a>
                </li>
              </ul>
            </div>
          </nav>