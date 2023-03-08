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
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <title>Catalog</title>
</head>

<body>
    <?php navigationMenu(); ?>

    <?php

    $user = '';
    if (isset($_POST['username']))
        $user = $_POST['username'];

    $sqlII = 'SELECT * FROM product;';
    $results = mysqli_query($conn, $sqlII);
    ?>

    <br><br><br><br>
    <table border="1px" line-height:40px;>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Product price (USD)</th>
            <th> Description </th>
            <th>Purchase it Now</th>
        </tr>

        <?php
        $mamboyandani = "";
        while ($rows = mysqli_fetch_array($results, MYSQLI_ASSOC)) {

            $id = $rows['Id'];
            $mamboyandani .= '<tr>';
            $mamboyandani .= '<td><img src=" ' . $rows['image'] . '"></td>';
            $mamboyandani .= '<td>' . $rows['name'] . '</td>';
            $mamboyandani .= '<td> $ ' . $rows['price'] . '</td>';
            $mamboyandani .= '<td>' . $rows['description'] . '</td>';
            $mamboyandani .= '<td><a href="product.php?id=' . $id . ' ">View this Item</a></td>';
        }
        echo $mamboyandani . '</table>';
        ?>

</body>

</html>
<?php
?>