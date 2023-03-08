<?php
session_start();
include('includes/functions.php');



if ($_SERVER['HTTP_HOST'] == 'localhost')
    $conn = mysqli_connect('localhost', 'root', '1550', 'palindromes');
else
    $conn = mysqli_connect('localhost', 'variabl1_jonam', '[g]533aKh_~v', 'variabl1_palindromes');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/user.css">
    <title>Hashbrown</title>
</head>

<body>
    <?php navigationMenu(); ?><br></br>

    <div class="container">
        <div class="card">
            <br>
            <div class="front">SECRET CODE</div>
            <div class="back">LILIAC</div>
        </div>
    </div>

    <?php createuser(); ?>

    <?php

    if (isset($_POST['createaccount'])) {

        //the user entered both a username and password
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $passII = $_POST['checkpassword'];
            $secretcdode = $_POST['Scretcode'];

            if ($passII ==  $pass) {
                if (isset($_POST['createaccount']))
                    if (!empty($_POST['username'])) {
                        $check = "SELECT username FROM user WHERE username = '$user' ";
                        $results = mysqli_query($conn, $check);
                        if (mysqli_num_rows($results) > 0) {
                        } elseif ($secretcdode == "LILIAC") {
                            $sql = "INSERT INTO `user` (`username`, `password`) VALUES ('$user', '$pass')";
                            $result = mysqli_query($conn, $sql);
                            $showdata = true;
                        } elseif ($secretcdode == "") {
                            echo '';
                        } else {
                            echo '<h2 class="error">Secret Code Invalid!</h2>';
                        }
                    }
            }
        }
    }
    ?>
</body>

</html>