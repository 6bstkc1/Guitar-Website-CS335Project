<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h1>Purchase</h1>

<?php
    include 'model.php';
    session_start();
    $id = $_GET['id'];
    $arr = $theDBA->getGuitarById($id);
    $user = $_SESSION['user'];
    
    echo $user;
    
        echo "<div class='con'>";
        echo "<img class='buy' src='img/$id.jpg'><br><br>";
       // echo $arr[0]['ID'] ."<br>";
        echo "Brand: ".$arr[0]['brand'] ."<br><br>";
        echo "Name: ".$arr[0]['name'] ."<br><br>";
        echo "Price: $".$arr[0]['price'] ."<br><br>";
        if(isset($user))
        {
            echo "<button class='acc' onclick='addToCart($user,$id)'>Add To Cart</button>";
        }
        else
        {     
            echo "<div class='warn'>You Must Have An Account To Purchase Guitars!</div><br>
             <button class='acc'onclick='login()'>Login</button><button class='acc' onclick='register()'>Register</button>";
        }
        echo "</div>";
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

function addToCart($user,$id)
{
	alert("Called function");
	var ajax = new XMLHttpRequest();
	ajax.open("GET","controller.php?mode=buy&user="+$user + "&id=" +$id,true);
	ajax.send();
	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4 && ajax.status == 200)
		{
			window.loaction.href = "view.php";
		}	
	}
}

</script>

</body>
</html>

