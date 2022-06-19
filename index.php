<! DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA Compatible" content="ie=edge">
		<title>4Chatten</title>
		<link rel="stylesheet" href="css/myStyles.css" type="text/css">
	</head>

	<body style="font-family: sans-serif">
		<div class="wrapper" style="width: auto; height: auto;">
			<section class="form login" style="display: table; margin: auto;">
				<header>4Chatten App</header>
				<form action="" method="post">
					<?php include("include/login.php"); ?>
					<!-- <div class="error-txt">This is an error message!</div> -->
					<div class="email-address">
						<div class="field input">
							<label>Email Address</label>
							<input type="text" name="user_email" placeholder="Enter your email" autocomplete="off" required>
						</div>
						<div class="password">
							<div class="field input">
								<label>Password</label>
								<input type="password" name="user_password" placeholder="Enter your password" autocomplete="off" required>
							</div>
							<div class="field loginButton">
								<input type="submit" name="log_in" value="Login">
							</div>
				</form>
				<div class="link">Not signed up yet? <a href="signup.php">Register now</a></div>
			</section>
		</div>
	</body>

	</html>