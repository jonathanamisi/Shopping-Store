<?php
//session_start();
error_reporting(-1);
ini_set('display_errors', 1);
include('includes/functions.php');



if ($_SERVER['HTTP_HOST'] == 'localhost')
    $conn = mysqli_connect('localhost', 'root', '1550', 'palindromes');
else
    $conn = mysqli_connect('localhost', 'variabl1_jonam', '[g]533aKh_~v', 'variabl1_palindromes');

//$results = mysqli_query($conn, 'select * from palindrome;');
//var_dump($results);

//the user is trying to log in

if (isset($_POST['submit'])) {
    $badLogin = true;

    //the user entered both a username and password
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        $sql = "SELECT * FROM user WHERE username = '$user' AND password = '$pass';";
        $result = mysqli_query($conn, $sql);

        //the username and password entered are valid
        if (mysqli_num_rows($result) > 0) {
            $badLogin = false;
            $_SESSION['granted'] = true;
            $_SESSION['user'] = $user;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='https://css.gg/log-off.css' rel='stylesheet'>
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <title>Catalog</title>
</head>

<body>
    <?php navigationMenu(); ?>
    <br><br>
    <br><br>
    <?php
    //the user wasn't able to log in
    if (isset($_POST['submit']) && $badLogin === true) {
        loginFormErrorMessage();
    }
    //the user is already logged in
    else if (isGranted()) {
        echo '<h2 class="success"> Hello ' . ucfirst($_SESSION['user']) . '! Welcome to Variable X Store. Bellow are the Deals of the Week</h2>';
        $fs = fopen('includes/fbi.txt', 'r');
        $contents = fread($fs, filesize('includes/fbi.txt'));
        $words = explode('||>><<||', $contents);

        //  var_dump($words);

        echo "<table>";

        echo '<tr><th>Product</th><th>Price (USD)</th></tr>';
        foreach ($words as $word) {
            $names = explode(',', $word);
            echo "<tr><td>" . $names[0] . "</td><td>" . $names[1] . "</td></tr>";
        }
        echo "</table>";
    }
    //the user is not logged in
    else {
        loginForm();
    }
    ?>
</body>

</html>