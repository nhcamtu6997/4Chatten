<! DOCTYPE html>
	<?php
	session_start();
	include("connection.php");
	include("functions.php");

	if (!isset($_SESSION['user_email'])) {
		header("location: index.php");
	} else {
		$my_email = $_SESSION['user_email'];
		$my_email_query = "SELECT * FROM users WHERE user_email = '$my_email'";
		$run_email = mysqli_query($connect, $my_email_query);
		$row_email = mysqli_fetch_array($run_email);

		$my_id = $row_email['user_id'];
		$my_name = $row_email['user_name'];
		$my_ava =  $row_email['user_avatar'];
		$my_status = $row_email['user_online'];
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
						<?php printHeaderInfo($my_ava, $my_name, $my_status); ?>
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

				<!--Find friend in list chat-->
				<div class="search">
					<input type="text" id="search-item" placeholder="Enter name to search..." onkeyup="search()">
				</div>

				<!--List friend to chat-->
				<div class="friendslist" id="friends-list">
					<dt>
						<?php include("include/getListFriend.php"); ?>
					</dt>
				</div>

				<!--Find friends in same country button-->
				<form method="post">
					<button class="FriendlistBottom" name="find_homies">&#x1F30E;</button>
					<button class="AddFriendBottom" name="add_friend">Add friends</button>
				</form>
				<?php
				if (isset($_POST['find_homies'])) {
					echo "<script>window.open('findhomies.php?id=$my_id', '_self')</script>";
				}

				if (isset($_POST['add_friend'])) {
					echo "<script>window.open('addfriend.php?id=$my_id', '_self')</script>";
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

							echo "
							<button class='delete' onclick='return checkDelete()'><a href='chat.php?delete=$friend_id' >Delete</a></button>
							
							<button class='block' onclick='return checkBlock()'><a href='chat.php?block=$friend_id'>Block</a></button>";
						} else {
							printHeaderInfo($my_ava, $my_name, $my_status);
						}

						if (isset($_GET['delete'])) {
							global $connect;
							$del_fri_id = $_GET['delete'];
							$query = "DELETE FROM friends WHERE (user_one='$my_id' AND user_two='$del_fri_id') OR (user_two='$my_id' AND user_one='$del_fri_id')";
							mysqli_query($connect, $query);

							echo "<script>window.open('chat.php?id=$my_id', '_self')</script>";
						}

						if (isset($_GET['block'])) {
							global $connect;
							$blk_fri_id = $_GET['block'];
							$query = "INSERT INTO blocks(user_one, user_two) VALUES('$my_id', '$blk_fri_id')";
							mysqli_query($connect, $query);

							$query = "DELETE FROM friends WHERE (user_one='$my_id' AND user_two='$blk_fri_id') OR (user_two='$my_id' AND user_one='$blk_fri_id')";
							mysqli_query($connect, $query);

							echo "<script>window.open('chat.php?id=$my_id', '_self')</script>";
						}

						?>
					</div>

				</header>

				<!--Chat details-->
				<div class="chatfenster" id="chat-scroll">
					<dt>
						<?php
						if (isset($_GET['frd_id'])) {
							include("include/showChat.php");
						} else {
							echo "<div style='text-align: center; font-weight: bold; color: gray; margin-top: 220px;'>Select a person to start conversation!";
						}
						?>
					</dt>
					<script>
						let to_bot = document.getElementById('chat-scroll');
						to_bot.scrollTop = to_bot.scrollHeight;
					</script>
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
						$msg = htmlentities(mysqli_real_escape_string($connect, $_POST['msg_text']));

						if (!empty($msg)) {
							$insert_query = "INSERT INTO chats(msg_sender, msg_receiver, msg_content, msg_date, msg_status) VALUES('$my_id', '$friend_id', '$msg', NOW(), 0)";
							$run_insert_query = mysqli_query($connect, $insert_query);
							echo "<script>window.open('chat.php?frd_id=$friend_id', '_self')</script>";
						}
					}
				}
				?>
			</section>
		</div>
	</body>
	<script>
		const search = () => {
			const searchbox = document.getElementById("search-item").value.toUpperCase();
			const storeitems = document.getElementById("friends-list");
			const item = document.querySelectorAll(".friend-item");
			const friname = storeitems.getElementsByTagName("span");

			for (var i = 0; i < friname.length; i++) {
				let match = item[i].getElementsByTagName("span")[0];

				if (match) {
					let textvalue = match.textContent || match.innerHTML;

					if (textvalue.toUpperCase().indexOf(searchbox) > -1) {
						item[i].style.display = "";
					} else {
						item[i].style.display = "none";
					}
				}
			}
		}

		function checkDelete() {
			return confirm('Are you sure that you do not talk with this friend anymore?');
		}

		function checkBlock() {
			return confirm('You will no longer receive any messages from this friend. Still want to block?');
		}
	</script>

	</html>