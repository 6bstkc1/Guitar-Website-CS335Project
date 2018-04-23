<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="con">
<?php
    include 'model.php';
    $id = $_GET['id'];
    $arr = $theDBA->getGuitarById($id);
    
        echo "<img class='buy' src='img/$id.jpg'><br><br>";
       // echo $arr[0]['ID'] ."<br>";
        echo "Brand: ".$arr[0]['brand'] ."<br><br>";
        echo "Name: ".$arr[0]['name'] ."<br><br>";
        echo "Price: $".$arr[0]['price'] ."<br><br>";
        
?>

<button class='buy'>Add To Cart</button>
</div>


</body>
</html>