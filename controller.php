<?php
include 'model.php';
if($_GET['mode'] == 'merch')
{
    $arr = $theDBA->getAllGuitars();
    echo json_encode($arr);
}
else if($_GET['mode'] == 'buy')
{
    $usr = $_GET['user'];
    $prodID = $_GET['pass'];
    $theDBA->addToCart($usr, $prodId);
}
else if($_GET['mode'] == 'register')
{
    $usr = $_GET['user'];
    $pwd = $_GET['pass'];
    $rt = $theDBA->createAccount($usr, $pwd);
    echo json_encode($rt);
}
