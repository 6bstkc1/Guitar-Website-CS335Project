<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h1>My Cart</h1>

<div id='cart'></div>



<?php 
    session_start();
    $user = $_SESSION['user'];
 ?>
 
<script>
function getItems(user)
{
	var ajax = new XMLHttpRequest();
	var cart = document.getElementById("cart");
	ajax.open("GET","controller.php?mode=cart&user="+user,true);
	ajax.send();
	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4 && ajax.status == 200)
		{
			var re = JSON.parse(ajax.responseText);
			
			if(re[0] == null) // empty
				cart.innerHTML = "It Appears You Haven't Bought Anything!";
			else
				cart.innerHTML = "Found items!";
		}	
	}
}	
</script>

<?php
echo" <script>
    getItems('$user');
    </script>";
?>


</body>
</html>