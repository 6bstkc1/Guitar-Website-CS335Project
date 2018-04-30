!DOCTYPE html>
<html>

    <head>
    		<title>Guitar Site Login</title>
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>

	<body>
	
		<h1>Login!</h1>
		
		<a href="view.php"><button class='backToHome'>Home</button></a>
	
		<form id="loginForm" onsubmit="checkUserAndPass(event); return false">
		
			<p>Username:</p> <input type="text" id="username" required> <br>
			
			<p>Password:</p> <input type="password" id="password" required> <br>
			
			<button type="submit" id="loginButton">Login</button>
		
		</form>
		
		<div id="errorBox"></div> <!-- Area to display potential password errors -->
		
		<script>

		function checkUserAndPass(event)
		{
			
			event.preventDefault();

			user = document.getElementById("username").value;
			
			password = document.getElementById("password").value;
			
			errors = document.getElementById("errorBox");

			else if(password == confirmPassword)
			{

				var ajax = new XMLHttpRequest();
				ajax.open("GET", "controller.php?mode=login&user=" + user + "&pass=" + password, true);
				ajax.send();

				ajax.onreadystatechange = function()
				{
					if (ajax.readyState == 4 && ajax.status == 200)
					{
						if (ajax.responseText == 0) //If the username exists, and the user entered their password correctly
						{
							window.location.href="view.php";
						}
						else if (ajax.responseText == 1) //If the username is not in the database
						{
							errors.innerHTML = "Sorry, that username is not in the database.";
						}
						else if (ajax.responseText == 2) //If the username exists, but the password was not entered correctly
						{
							errors.innerHTML = "Password is incorrect.";
						}
					}
				}
				

			}
			
		}
		</script>
		
<?php 
?>
	</body>
</html>
