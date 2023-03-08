<?php
session_start();

include('includes/functions.php');

if (isset($_SESSION['product_id'])) {
    //var_dump($_POST);
}

if (isset($_POST['update'])) {

    // var_dump($_SESSION['product_id']);
    // var_dump($_SESSION['quantity']);

    //loop through $_SESSION['product_id']
    for ($x = 0; $x < sizeof($_SESSION['product_id']); $x++) {

        $postId = 'qty-' . $x;
        if ($_POST[$postId] > 0) {
            $_SESSION['quantity'][$x] = $_POST[$postId];
        } elseif ($_POST[$postId] == 0) { //remove item from cart
            unset($_SESSION['image'][$x]);
            unset($_SESSION['product_id'][$x]);
            unset($_SESSION['quantity'][$x]);
            unset($_SESSION['price'][$x]);
            unset($_SESSION['name'][$x]);
            /*
            $_SESSION['image'] = array();
        $_SESSION['product_id'] = array();
        $_SESSION['quantity'] =  array();
        $_SESSION['price'] = array();
        $_SESSION['name'] = array();
        */
            break;
        } else echo '<br><br><br><br><h3 class="error">Negative Numbers are not allowed</h3>';
    }
    $_SESSION['image'] = array_values($_SESSION['image']);
    $_SESSION['product_id'] = array_values($_SESSION['product_id']);
    $_SESSION['quantity'] = array_values($_SESSION['quantity']);
    $_SESSION['price'] = array_values($_SESSION['price']);
    $_SESSION['name'] = array_values($_SESSION['name']);

    //var_dump($_SESSION['product_id']);
    //var_dump($_SESSION['quantity']);

    echo '<br><br><br><h2 class="success">Cart Updated</h2>';
}

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
    <title>Catalog</title>
</head>

<body>
    <?php navigationMenu(); ?>
    <br><br><br>
    <?php
    if (isset($_POST['place-order'])) {
        echo '<h2 class="success">THANKS FOR SHOPPING AT VARIABLE X STORE</h2>';

        echo '<table border="1px" line-height:40px;>';
        echo '<tr><th>Product Image</th><th>Product</th><th>Price-(USD)</th><th>Quantity</th><th>Total</th></tr>';
        $bought = '';
        $totalprice = '0';
    ?>
        <form method="POST">
            <?php

            if (isset($_SESSION['product_id'])) {
                echo '<h1 class="header">Bellow is a List of what you Purchased</h1>';

                for ($x = 0; $x < sizeof($_SESSION['product_id']); $x++) {

                    $bought .= '<tr>';
                    $bought .= '<td><img src=" ' . $_SESSION['image'][$x] . '"></td>';
                    $bought .= '<td>' . $_SESSION['name'][$x] . '</td>';
                    $bought .= '<td>$ ' . $_SESSION['price'][$x] . '</td>';
                    $bought .= '<td>' . $_SESSION['quantity'][$x] . '</td>';
                    $bought .= '<td>$ ' . ($_SESSION['price'][$x] * $_SESSION['quantity'][$x]) . '</td>';
                    $bought .= '</tr>';
                    $totalprice +=  $_SESSION['price'][$x] * $_SESSION['quantity'][$x];
                }
                $bought .= '<tr><td colspan="4">Total amount</td><td class="totalamount">$ ' . $totalprice . '</td>';
                echo $bought . '</table>';
                echo '<h3 class="danger">Return to the <a href="index.php">HOME</a> page</h3>';

                //remove everything from the Cart

                unset($_SESSION['image'], $_SESSION['product_id'],  $_SESSION['quantity'], $_SESSION['price'], $_SESSION['name']);
                //unset($cartAmount);
            }
            //the checkout page was reloaded
            else {
                //send an error message and redirect them to their cart
                echo '<h3 class="error">There was an error. Please return to the <a href="index.php">HOME</a> page</h3>';
            }
        } elseif (isset($_SESSION['product_id']) && sizeof($_SESSION['product_id']) > 0) {

            echo '<h1 class="header">View your shopping cart</h1>';

            echo '<table border="1px" line-height:40px;>';
            echo '<tr><th>Product Image</th><th>Product</th><th>Price-(USD)</th><th>Quantity</th><th>Total</th></tr>';
            $bought = '';
            $totalprice = '0';
            ?>
            <form method="POST">
                <?php
                for ($x = 0; $x < sizeof($_SESSION['product_id']); $x++) {
                    $bought .= '<input type="hidden" value="product-' . $_SESSION['product_id'][$x] . '" />';
                    $bought .= '<tr>';
                    $bought .= '<td><img src=" ' . $_SESSION['image'][$x] . '"></td>';
                    $bought .= '<td>' . $_SESSION['name'][$x] . '</td>';
                    $bought .= '<td>$ ' . $_SESSION['price'][$x] . '</td>';
                    $bought .= '<td><input type="text" name="qty-' . $x . '" value="' . $_SESSION['quantity'][$x] . '" ></input></td>';
                    $bought .= '<td>$ ' . ($_SESSION['price'][$x] * $_SESSION['quantity'][$x]) . '</td>';
                    $bought .= '</tr>';
                    $totalprice +=  $_SESSION['price'][$x] * $_SESSION['quantity'][$x];
                }
                $bought .= '<tr><td colspan="4">Total amount</td><td class="totalamount">$ ' . $totalprice . '</td>';
                echo $bought . '</table>';



                /* var_dump($_SESSION['product_id']);
    var_dump($_SESSION['quantity']);
    var_dump($_SESSION['price']);
    var_dump($_SESSION['name']); */
                ?>
                <br>
                <div style="width: 50%; margin: 0 auto;">
                    <input name="update" type="submit" value="Update Cart">
                    <input name="place-order" type="submit" value="Place order">
                    <p>
                        <button><a href="catalog.php">Continue Shopping</a></button>
                    </p>
                </div>
            </form>

        <?php } else  echo '<h1 class="error">Your Cart is Empty</h1>'; ?>
</body>

</html>
<?php
?>