<! DOCTYPE html>
	<?php
	session_start();
	include("connection.php");
	include("functions.php");

	if (!isset($_SESSION['user_email'])) {
		header("location: index.php");
	}
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
		<div class="wrapper">
			<!--##########################################################
		Left Side
		##########################################################-->
			<section class="friends">
				<header>
					<!--Infor of Me - The User-->
					<div class="content">
						<?php
						$my_email = $_SESSION['user_email'];
						$my_email_query = "SELECT * FROM users WHERE user_email = '$my_email'";
						$run_email = mysqli_query($connect, $my_email_query);
						$row_email = mysqli_fetch_array($run_email);

						$my_id = $row_email['user_id'];
						$my_name = $row_email['user_name'];
						$my_ava =  $row_email['user_avatar'];
						$my_status = $row_email['user_online'];
						printHeaderInfo($my_ava, $my_name, $my_status);
						?>
					</div>

					<!--Addfriend function-->
					<form method="post">
						<button class="Addfriend" name="add_friend">Add</button>
					</form>
					<?php
					if (isset($_POST['add_friend'])) {
						echo "<script>window.open('addfriend.php?id=$my_id', '_self')</script>";
					}
					?>
				</header>

				<div class="search">
					<span class="text">Select user to start chatt</span>
					<input type="text" placeholder="Enter name to search...">
					<button>&#x1F50D;</button>
				</div>

				<!--List friend to chat-->
				<div class="friendslist">
					<dt>
						<?php include("include/getListFriend.php") ?>
					</dt>
				</div>

				<!--Find friends in same country button-->
				<form method="post">
					<button class="FriendlistBottom" name="find_homies">&#x1F30E;</button>
				</form>
				<?php
				if (isset($_POST['find_homies'])) {
					echo "<script>window.open('findhomies.php?id=$my_id', '_self')</script>";
				}
				?>

			</section>


			<!--##########################################################
		Right Side
		##########################################################-->
			<section class="chat">
				<header>
					<!--Info of friend, who is chatting with me-->
					<div class="content">
						<?php
						if (isset($_GET['frd_id'])) {
							global $connect;
							$friend_id = $_GET['frd_id'];
							$get_friend_query = "SELECT * FROM users WHERE user_id = '$friend_id' ";
							$run_get_friend = mysqli_query($connect, $get_friend_query);
							$row_get_friend = mysqli_fetch_array($run_get_friend);

							$friend_name = $row_get_friend['user_name'];
							$friend_email = $row_get_friend['user_email'];
							$friend_ava = $row_get_friend['user_avatar'];
							$friend_status = $row_get_friend['user_online'];

							printHeaderInfo($friend_ava, $friend_name, $friend_status);
						} else {
							printHeaderInfo($my_ava, $my_name, $my_status);
						}
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

				<!--Chat details-->
				<div class="chatfenster">
					<dt>
						<?php
						if (isset($_GET['frd_id'])) {
							include("include/showChat.php");
						} else {
							echo "<div style='text-align: center; font-weight: bold; color: gray; margin-top: 220px;'>Select a person to start conversation!";
						}
						?>

					</dt>
				</div>

				<!--Send a message-->
				<?php
				if (isset($_GET['frd_id'])) {
					echo "
    					<form method='post' class='typing-area'>
        					<input autocomplete='off' type='text' name='msg_text' placeholder='Type a message here...'>
        					<button name='msg_submit'>Send</button>
    					</form>
					";

					if (isset($_POST['msg_submit'])) {
						$msg = htmlentities($_POST['msg_text']);

						if (!empty($msg)) {
							$insert_query = "INSERT INTO chats(msg_sender, msg_receiver, msg_content, msg_date) VALUES('$my_id', '$friend_id', '$msg', NOW())";
							$run_insert_query = mysqli_query($connect, $insert_query);
							echo "<script>window.open('chat.php?frd_id=$friend_id', '_self')</script>";
						}
					}
				}
				?>
			</section>
		</div>
	</body>

	</html>