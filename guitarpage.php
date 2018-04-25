<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h1>Purchase</h1>

<?php
    include 'model.php';
    $id = $_GET['id'];
    $arr = $theDBA->getGuitarById($id);
    
    
        echo "<div class='con'>";
        echo "<img class='buy' src='img/$id.jpg'><br><br>";
       // echo $arr[0]['ID'] ."<br>";
        echo "Brand: ".$arr[0]['brand'] ."<br><br>";
        echo "Name: ".$arr[0]['name'] ."<br><br>";
        echo "Price: $".$arr[0]['price'] ."<br><br>";
        echo "</div>";
        if(isset($_SESSION['user']))
            echo "<button class='buy'>Add To Cart</button>";
        else
            echo "<div class='warn'>You Must Have An Account To Purchase Guitars!</div><br>
             <button class='acc'onclick='login()'>Login</button><button class='acc' onclick='register()'>Register</button>";
?>

<script>
function register()
{
		window.location.href = "register.php";
}

function login()
{
		window.location.href = "login.php";
}
</script>
</body>
</html>
