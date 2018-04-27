<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h1>Purchase</h1>

<?php

session_start();
    include "model.php";
    $id = $_GET['id'];
    $id = (int)$id;
    echo $id;
    $arr = $theDBA->getGuitarById($id);
    
    if(isset($_SESSION['user']))
    {
        $user = $_SESSION['user'];
        $user = (string)$user;
    }
    
        echo "<div class='itemcon'>";
        echo "<img class='buy' src='img/$id.jpg'><br><br>";
        echo "Brand: ".$arr[0]['brand'] ."<br><br>";
        echo "Name: ".$arr[0]['name'] ."<br><br>";
        echo "Price: $".$arr[0]['price'] ."<br><br>";
        if(isset($user))
        {
            echo "<button class='acc'
                    onclick=addToCart('$user','$id')>Add To Cart</button></div>";
        }
        else
        {     
            echo "<div class='warn'>You Must Have An Account To Purchase Guitars!</div><br>
             <button class='acc'onclick='login()'>Login</button><button class='acc' onclick='register()'>Register</button>";
        }
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

function addToCart(user,id)
{
	var ajax = new XMLHttpRequest();
	ajax.open("GET","controller.php?mode=buy&user="+user + "&id=" +id,true);
	ajax.send();
	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4 && ajax.status == 200)
		{
			window.location.href = "view.php";
		}	
	}
}
</script>

</body>
</html>
