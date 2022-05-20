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
		<div class="wrapper">
			<section class="form signup">
				<header>4Chatten App</header>
				<form action="" method="post">
					<div class="nameAndCountry-details">
						<div class="field input">
							<label>Username</label>
							<input type="text" name="user_name" placeholder="Enter your username" autocomplete="off" required>
						</div>
						<div class="field input">
							<label>Homeland</label>
							<select name="user_country" required>
								<option disabled="">Select a Country</option>
								<option value="Argentina">Argentina</option>
								<option value="Australia">Australia</option>
								<option value="Austria">Austria</option>
								<option value="Belarus">Belarus</option>
								<option value="Belgium">Belgium</option>
								<option value="Brazil">Brazil</option>
								<option value="Cambodia">Cambodia</option>
								<option value="Canada">Canada</option>
								<option value="China">China</option>
								<option value="Colombia">Colombia</option>
								<option value="Croatia">Croatia</option>
								<option value="Denmark">Denmark</option>
								<option value="Finland">Finland</option>
								<option value="France">France</option>
								<option value="Georgia">Georgia</option>
								<option value="Germany">Germany</option>
								<option value="Great Britain">Great Britain</option>
								<option value="Hong Kong">Hong Kong</option>
								<option value="Hungary">Hungary</option>
								<option value="Luxembourg">Luxembourg</option>
								<option value="Macau">Macau</option>
								<option value="Sweden">Sweden</option>
								<option value="Switzerland">Switzerland</option>
								<option value="United States of America">United States of America</option>
								<option value="Vietnam">Vietnam</option>
							</select>
						</div>
					</div>
					<div class="email-address">
						<div class="field input">
							<label>Email Address</label>
							<input type="text" name="user_email" placeholder="Enter your email" autocomplete="off" required>
						</div>
						<div class="password">
							<div class="field input">
								<label>Password</label>
								<input type="password" name="user_password" placeholder="Enter new password" autocomplete="off" required>
							</div>
							<div class="field input">
								<label>Confirm Password</label>
								<input type="password" name="user_password2" placeholder="Confirm your password" autocomplete="off" required>
							</div>
							<!-- <div class="field image">
								<label>Upload Profile Picture</label>
								<input type="file">
							</div> -->
							<div class="field registerButton">
								<input type="submit" name="sign_up" value="Register">
							</div>
							<?php include("functions/signup_f.php"); ?>
				</form>
				<div class="link">Already signed up? <a href="index.php">Login now</a></div>
			</section>
		</div>
	</body>

	</html>