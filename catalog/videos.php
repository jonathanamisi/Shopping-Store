<?php
session_start();
include('includes/functions.php');

//error_reporting(-1);
//ini_set('display_errors', 1);

//redirect to index if the session is not set
if (!isGranted()) {
    // session_write_close();
    header('location:.');
    exit;
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

    <title>Hashbrown</title>
</head>

<body>
    <?php navigationMenu(); ?>
    <?php
    echo '<br><br><h1>Welcome ' . ucfirst($_SESSION['user']) . '! Here are some of the Songs variable X Likes.</h1>';
    ?>
    <div class="vid_row_1"><iframe width="560" height="315" src="https://www.youtube.com/embed/KrgJp7Z1Hv8?start=8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
    <div class="vid_row_1"><iframe width="560" height="315" src="https://www.youtube.com/embed/sM6U7DlKCOY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><span class="b">USA & FRANCE</span></div>
    <div class="vid_row_1"><iframe width="560" height="315" src="https://www.youtube.com/embed/K_yzGPyECFE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
    <div class="vid_row_1"><iframe width="560" height="315" src="https://www.youtube.com/embed/Hka7csvMOEQ?start=8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><span class="b">NIGERIA & DR.CONGO</span></div>
    <div class="vid_row_1"><iframe width="560" height="315" src="https://www.youtube.com/embed/f-JgVgybiBM?start=8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></iframe></div>
    <div class="vid_row_1"><iframe width="560" height="315" src="https://www.youtube.com/embed/X-R9qyML9IU?start=8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><span class="b">TANZANIA & RWANDA</span></div>
    <div class="vid_row_1"></div>
</body>

</html>