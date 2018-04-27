<!DOCTYPE html>
<html>

    <head>
    		<title>Guitar Site Register</title>
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>

	<body>
	
		<h1>Register!</h1>
	
		<form id="registerForm" onsubmit="checkPasswordMatch(event); return false">
		
			<p>Username:</p> <input type="text" id="username" pattern="[A-Z+a-z+0-9]{6,19}" 
			required title="Username can only contain letters or numbers and must be between 6-19 characters."> <br>
			
			<p>Password:</p> <input type="password" id="password" pattern="[A-Z+a-z+0-9]{8,19}" 
			title="Your password must be between 8 and 19 characters and can only contain letters and numbers." required> <br> <!-- Password must be 8 or more characters in length for security reasons -->
			
			<p>Confirm Password:</p> <input type="password" id="confirmPassword" required> <br><br>
			
			
			<input type="submit" id="submit" value="Create Account">
		
		</form>
		
		<div id="errorBox"></div> <!-- Area to display potential password errors -->
		
		<script>
		function checkPasswordMatch(event)
		{
			
			event.preventDefault();
			user = document.getElementById("username").value;
			
			password = document.getElementById("password").value;
			
			confirmPassword = document.getElementById("confirmPassword").value;
			
			errors = document.getElementById("errorBox");
			errors.innerHTML = '';
			
			if(password != confirmPassword)
			{		
				errors.innerHTML += "<br>" + "The passwords do not match";
			}
			else if(password == confirmPassword)
			{
				//ajax call
				//check if it goes threw
				//get the response
				//if check
				// on 0 error msg
				// on 1 create a sesson called S_SESSON['user'] = username
				// go back to view.php
				var ajax = new XMLHttpRequest();
				ajax.open("GET", "controller.php?mode=register&user=" + user + "&pass=" + password, true);
				ajax.send();
				ajax.onreadystatechange = function()
				{
					if (ajax.readyState == 4 && ajax.status == 200)
					{
						if (ajax.responseText == 0)
						{
							errors.innerHTML = "<br>Sorry, that account name is taken.";
						}
						else 
						{
							window.location.href="view.php";
						}
					}
				}
				
			}
		}
		</script>
	</body>
</html>
