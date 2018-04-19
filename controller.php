<?php
include 'model.php';
if($_GET['mode'] == 'merch')
{
    $arr = $theDBA->getAllGuitars();
    echo json_encode($arr);
}
?>
