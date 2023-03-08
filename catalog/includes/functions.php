<?php

session_start();

error_reporting(-1);
ini_set('display_errors', 1);

function isGranted()
{
    if (isset($_SESSION['granted'])) return true;

    return false;
}

function eatCookie($name)
{
    setcookie($name, '', time() - 3600);
}
?>
<?php function navigationMenu()
{

    echo '<ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="videos.php">Videos</a></li>
        <li><a href="catalog.php">Products</a></li>';
    if (isGranted()) {

        $cartAmount = isset($_SESSION['product_id']) ? sizeof($_SESSION['product_id']) : 0;

        echo '
        <li><a href="cart.php"><i class="fa badge fa-lg" value ="' . $cartAmount . '">&#xf07a;</i></a></li>';
        echo ' <li style="float:right"><a href="logout.php"><i class="gg-log-off"></i></a></li>';
        if (isset($_SESSION['user'])) echo "<p class='us'>Logout " . ucfirst($_SESSION['user']) . " =></p>";
    }
    echo  '</ul>';
}
function loginFormErrorMessage()
{
    echo '
<form method="Post">
    <h1>Welcome</h1>
    <h2 class="error">Access Denied!</h2>
    <input name="username" type="username" placeholder="Username">
    <input name="password" type="password" placeholder="password">
    <button name="submit" type="submit">Login</button>
    <button name="reset" type="reset">Reset</button>
    <p>OR</p>
    <a href="create-account.php">Create Account</a>

</form>';
}

function loginForm()
{
    echo ' <form method="Post">
    <h1>Welcome</h1>
    <p>Please enter your username and password</p>
    <input autocomplete="off" name="username" type="username" placeholder="Username">
    <input name="password" type="password" placeholder="password">
    <button name="submit" type="submit">Login</button>
    <button name="reset" type="reset">Reset</button>
    <p>OR</p>
    <a href="create-account.php">Create Account</a>
</form>';
}
function createuser()
{

    echo '<section>
    <form method="Post">
        <h1>Sign Up</h1>';
    accountcreated();
    usertaken();
    accounterror();
    formempty();
    echo ' 
        <script type="text/javascript" src="js/script.js"></script>
        <p id="errorMessage"></p><br>
        <input autocomplete="off" name="username" type="username" placeholder=" Username" required><br></br>

        <input name="password" type="password" id="password" placeholder="New password" onChange="checkPassword()" required><br></br>
        <input name="checkpassword" type="password" id="checkpassword" placeholder="confirm password" onChange="checkPassword()" required><br></br>
        <input name="Scretcode" type="password" placeholder="Sercret Code is on the top-left corner" required><br></br>

        <button id="createaccount" name="createaccount" type="submit">Create Account</button>
        <button name="reset" type="reset">Reset</button><br></br>
        <p>OR</p>
        <a href="index.php">Log in</a>


    </form>
</section>';
}


function accountcreated()
{
    if (isset($_POST['username']))
        $user = $_POST['username'];
    if (isset($_POST['password']))
        $pass = $_POST['password'];
    if (isset($_POST['checkpassword']))
        $passII = $_POST['checkpassword'];
    if (isset($_POST['Scretcode']))
        $secretcdode = $_POST['Scretcode'];

    if (isset($_POST['createaccount'])) {

        if ($_SERVER['HTTP_HOST'] == 'localhost')
            $conn = mysqli_connect('localhost', 'root', '1550', 'palindromes');
        else
            $conn = mysqli_connect('localhost', 'variabl1_jonam', '[g]533aKh_~v', 'variabl1_palindromes');
        $user = $_POST['username'];
        $check = "SELECT username FROM user WHERE username = '$user' ";
        $results = mysqli_query($conn, $check);
        if ($secretcdode == "LILIAC") {
            $sql = "INSERT INTO `user` (`username`, `password`) VALUES ('$user', '$pass')";
            if ($passII == $pass)
                echo '<h2 class="success">User Created Successfully</h2>';
        }

        if ($user != '')
            if ($pass != '')
                if ($passII != '')
                    if ($secretcdode != '');
    }
}

function forismempty()
{
    if (empty($_POST['createaccount'])) echo '';
}


function accounterror()
{
    if (isset($_POST['password']))
        $pass = $_POST['password'];
    if (isset($_POST['checkpassword']))
        $passII = $_POST['checkpassword'];

    if (isset($_POST['createaccount'])) {
        if ($passII != $pass) {
            echo '<h2 class="error">Password Missmatch</h2>';
        }
    }
}


function formempty()
{
    if (isset($_POST['username']))
        $user = $_POST['username'];
    if (isset($_POST['password']))
        $pass = $_POST['password'];
    if (isset($_POST['checkpassword']))
        $passII = $_POST['checkpassword'];
    if (isset($_POST['Scretcode']))
        $secretcdode = $_POST['Scretcode'];

    if (isset($_POST['createaccount'])) {

        if ($user == '') {
            echo '<h3 class="error">Enter Username!</h3>';
        }
        if ($pass == '') {
            echo '<h3 class="error">Enter password!</h3>';
        }
        if ($passII == '') {
            echo '<h3 class="error">Enter comfirm password!</h3>';
        }
        if ($secretcdode == '') {
            echo '<h3 class="error">Enter Secret Code!</h3>';
        }
    } else echo '';
}

function usertaken()
{
    if ($user = '') {
    }
    if ($_SERVER['HTTP_HOST'] == 'localhost')
        $conn = mysqli_connect('localhost', 'root', '1550', 'palindromes');
    else
        $conn = mysqli_connect('localhost', 'variabl1_jonam', '[g]533aKh_~v', 'variabl1_palindromes');
    if (isset($_POST['username']))
        $user = $_POST['username'];
    $check = "SELECT username FROM user WHERE username = '$user' ";
    $results = mysqli_query($conn, $check);
    if (mysqli_num_rows($results) > 0) {
        echo '<h2 class="error">User Taken</h2>';
    }
}
