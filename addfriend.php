<! DOCTYPE html>
	<?php
	session_start();
	include("connection.php");
	include("functions.php");
	include("include/findFriend.php");

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
					<a href="chat.php?id=$my_id" class="backIcontoChat">&larr; To Chat</a>

					<!--Infor of Me - The User-->
					<div class="content">
						<?php
						printHeaderInfo($my_ava, $my_name, $my_status);
						?>
					</div>
					<!--Logout function-->
					<form method="post">
						<button class="logout" name="log_out">Logout</button>
					</form>
					<?php
					if (isset($_POST['log_out'])) {
						$logout_update = mysqli_query($connect, "UPDATE users SET user_online = 0 WHERE user_email='$my_email'");
						header("location: logout.php");
						exit();
					}
					?>
				</header>
				<form class="addFriend-area">
					<input type="text" name="txt_find" placeholder="Enter your friend's email address">
					<button name="btn_find">Find friend</button>
				</form>
				<?php search_user($my_id); ?>
			</section>
		</div>
	</body>

	</html>