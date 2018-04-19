<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="img/favicon.png">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body onload="getGuitars()">
	<h1>Guitar Site</h1>
	<button>Register</button>
	<button>Login</button>
<?php
if (isset($_SESSION['user']))
    echo "<hr>";
else
    echo "<h3>Account needed to purhase guitars!</h3>";
?>

<div id="merch"></div>

<script>
	function getGuitars()
	{
		var merch = document.getElementById("merch");
		var ajax = new XMLHttpRequest();
		ajax.open("GET","controller.php?mode=merch",true);
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
					str += "<p class= item ><img class='pic' src=img/" + id + ".jpg><br>";
					str += array[i]['brand'] + " " + array[i]['name'] + "<br><br>";
					str += "$" + array[i]['price'];
					str += "</p>";
				}
				merch.innerHTML = str;
			}
		}
	}
</script>


</body>
</html>
