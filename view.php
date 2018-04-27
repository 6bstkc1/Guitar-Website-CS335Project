<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="img/favicon.png">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body onload="getGuitars()">
	<h1>Guitar Site</h1>
<?php
session_start();
if (isset($_SESSION['user']))
{
    $user = $_SESSION['user'];
    echo "<div class='welcome'>Welcome $user</div><br>
    <button class='acc' onclick='viewCart()'>View Cart</button>
    <button class='acc' onclick='logout()'>Logout</button>";
}
else
{
    echo "<button class='acc' onclick='login()'>Login</button>
    <button class='acc' onclick='register()'>Register</button>
    <div class='warn'>Account needed to purchase guitars!</div><br>";
}
?>

<hr>

<h1>Guitars</h1>

<hr>

<div class="maincon">
	<div id="merch"></div>
</div>


	<script>
	function getGuitars()
	{
		var merch = document.getElementById("merch");
		var ajax = new XMLHttpRequest();
		ajax.open("POST","controller.php?mode=merch",true);
		ajax.send();
		
		ajax.onreadystatechange = function()
		{
			if(ajax.readyState == 4 && ajax.status == 200)
			{
				var array = JSON.parse(ajax.responseText);
				var str = '';
				for(i = 0; i < array.length; i++)
				{
					var id = array[i]['ID'];
					str += "<p class= item ><img onclick='getGuitar("
					str += id;
					str +=	")'class='pic' src=img/" + id + ".jpg><br>";
					str += array[i]['brand'] + " " + array[i]['name'] + "<br><br>";
					str += "$" + array[i]['price'];
					str += "</p>";
				}
				merch.innerHTML = str;
			}
		}
	}

	function getGuitar(id)
	{
		window.location.href = "guitarpage.php?id=" + id;
	}

	function register()
	{		
		window.location.href = "register.php";
	}
	
    function login()
    {
    	window.location.href = "login.php";
    }
        
	function viewCart()
	{
		window.location.href = "cart.php";
	}
    
    function logout()
    {
    	var ajax = new XMLHttpRequest();
    	ajax.open("GET","controller.php?mode=logout",true);
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

<?php
if (!isset($_SESSION['user']))
    echo "<div class='warn'>Account needed to purchase guitars!</div ><br>";
?>

</body>
</html>
