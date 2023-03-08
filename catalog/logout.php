<?php
session_start();
include('includes/functions.php');


error_reporting(-1);
ini_set('display_errors', 1);

unset($_SESSION['granted']);
session_destroy();
eatCookie('name');
header('location:.')
?>
<!DOCTYPE html>

</html>