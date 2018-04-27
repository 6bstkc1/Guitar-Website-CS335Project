<?php
include 'model.php';
if($_GET['mode'] == 'merch') // when the  view.php page loads get all the guitars
{
    $arr = $theDBA->getAllGuitars();
    echo json_encode($arr);
}
else if($_GET['mode'] == 'buy') //when the user buys an item
{
    $usr = $_GET['user'];
    $prodId = $_GET['id'];
    $theDBA->addToCart($usr, $prodId);
}
else if($_GET['mode'] == 'register') // when a new user attempts to register
{
    $usr = $_GET['user'];
    $pass = $_GET['pass'];
    $rt = $theDBA->createAccount($usr, $pass);
    echo json_encode($rt);
}
else if($_GET['mode'] == 'login') // when a user attempts to login
{
    $usr = $_GET['user'];
    $pass = $_GET['pass'];
    $rt = $theDBA->verifyCredentials($usr, $pass);
    echo json_encode($rt);
}
else if($_GET['mode'] == 'cart') // called from cart.php
{
    $username = $_GET['user'];
    $items = $theDBA->getPurchases($username);
    echo json_encode($items);
}
else if($_GET['mode'] == 'logout') //exiting
{
    session_start();
    $_SESSION = array();
    session_unset();
    session_destroy();
}

?>
