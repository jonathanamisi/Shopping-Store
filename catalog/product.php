<?php
session_start();
include('includes/functions.php');

if ($_SERVER['HTTP_HOST'] == 'localhost')
    $conn = mysqli_connect('localhost', 'root', '1550', 'palindromes');
else
    $conn = mysqli_connect('localhost', 'variabl1_jonam', '[g]533aKh_~v', 'variabl1_palindromes');



if (!isGranted()) {
    if (isset($_POST['add_to_cart']))
        echo '<br><br><h1 class="error">YOU MUST<button><a href="index.php">LOGIN</a> </button>TO ADD TO CART!</h1>';
}
echo '<br><br><br><br>
    <table border="1px" line-height:40px;>
        <th>Image</th>
        <th>Name</th>
        <th>Product price (USD)</th>
        <th> Description </th>';

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $sql = 'SELECT * FROM product WHERE ID = ' . $_GET['id'];

    $results = mysqli_query($conn, $sql);

    $product = '';
    while ($rows = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
        $product .= '<tr>';
        $product .= '<td><img src=" ' . $rows['image'] . '"></td>';
        $product .= '<td>' . $rows['name'] . '</td>';
        $product .= '<td> $ ' . $rows['price'] . '</td>';
        $product .= '<td>' . $rows['description'] . '</td>';
    }
    echo $product . '</table>';
}



if (isGranted() && isset($_POST['add_to_cart'])) {
    echo '<h3 class="success">You added a product</h3>';
    $sql = 'SELECT * FROM product WHERE ID = ' . $_POST['id'] . ' LIMIT 1';

    $results = mysqli_query($conn, $sql);

    while ($rows = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
        $productprice = $rows['price'];
        $productname = $rows['name'];
        $productimage = $rows['image'];
    }

    if (!isset($_SESSION['product_id'])) {

        $_SESSION['image'] = array();
        $_SESSION['product_id'] = array();
        $_SESSION['quantity'] =  array();
        $_SESSION['price'] = array();
        $_SESSION['name'] = array();
    }

    //check to see if the item is already in the cart
    $duplicate = false;
    for ($x = 0; $x < sizeof($_SESSION['product_id']); $x++) {
        if ($_SESSION['product_id'][$x] === $_POST['id']) {
            $duplicate = true;
            $_SESSION['quantity'][$x] += $_POST['quantity'];
        }
    }
    if (!$duplicate) {
        array_push($_SESSION['product_id'], $_POST['id']);
        array_push($_SESSION['quantity'], $_POST['quantity']);
        array_push($_SESSION['price'], $productprice);
        array_push($_SESSION['name'], $productname);
        array_push($_SESSION['image'], $productimage);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/product.css">
    <link href='https://css.gg/log-off.css' rel='stylesheet'>
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <script src="js/script.js" type="text/javascript" defer></script>
    <title>Catalog</title>
</head>

<body>
    <?php navigationMenu();

    if (isset($_GET['id']) && !empty($_GET['id'])) { ?>
        <section class="addtocartproduct">
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <label for="quantity">Choose the Quantity:</label>
                <select name="quantity" id="quantity">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <input onclick="playAudio()" type="submit" name="add_to_cart" value="Add to cart">
            </form>
        </section>

    <?php } ?>

    <div style="width: 10%; margin: 0 auto;">
        <br><button><a href="catalog.php">Continue Shopping</a></button>
        <br>
        <p>or</p>
        <audio id="myAudio">
            <source src="Audio/item.mp3" type="audio/mp3">
        </audio>
        <br><button onclick="playAudio()" type="button"><a href="cart.php">Check Out</a></button>
    </div>
</body>

</html>