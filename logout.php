<?php
include_once 'lib/usersession.class.php';

//load connection
$usersession = new usersession();
$usersession->logout();
?>