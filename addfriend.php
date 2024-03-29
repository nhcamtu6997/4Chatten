<! DOCTYPE html>
	<?php
	session_start();
	include("connection.php");
	include("functions.php");

	if (!isset($_SESSION['user_email'])) {
		header("location: index.php");
	}

	$my_email = $_SESSION['user_email'];
	$my_email_query = "SELECT * FROM users WHERE user_email = '$my_email'";
	$run_email = mysqli_query($connect, $my_email_query);
	$row_email = mysqli_fetch_array($run_email);

	$my_id = $row_email['user_id'];
	$my_name = $row_email['user_name'];
	$my_ava =  $row_email['user_avatar'];
	$my_status = $row_email['user_online'];
	?>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA Compatible" content="ie=edge">
		<title>4Chatten</title>
		<link rel="stylesheet" href="css/myStyles.css" type="text/css">
	</head>

	<body style="font-family: sans-serif">
		<div class="wrapper" style="width: auto;">
			<section class="AddFriend">
				<header>
					<!--Back To Chat-->
					<a href="chat.php" class="backIcontoChat">&#x25c0;</a>

					<!--Infor of Me - The User-->
					<div class="content">
						<?php
						printHeaderInfo($my_ava, $my_name, $my_status);
						?>
					</div>
				</header>
				<form class="addFriend-area">
					<input type="text" name="txt_find" placeholder="Enter your friend's email address">
					<button name="btn_find">Find friend</button>
				</form>
				<?php searchUser($my_id); ?>
			</section>
		</div>
	</body>

	</html>