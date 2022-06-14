<?php
include("connection.php");
session_start();

// if(!isset())

// $my_email = $_SESSION['user_email'];
// $my_email_query = "SELECT * FROM users WHERE user_email = '$my_email'";
// $run_email = mysqli_query($connect, $my_email_query);
// $row_email = mysqli_fetch_array($run_email);

// $my_id = $row_email['user_id'];
// $my_name = $row_email['user_name'];
// $my_ava =  $row_email['user_avatar'];
// $my_status = $row_email['user_online'];

$all_friends = "SELECT * FROM friends WHERE user_one = '10' OR user_two = '10' ";
$run_all_friends = mysqli_query($connect, $all_friends);
// $return_data = [];
while ($row_friend = mysqli_fetch_array($run_all_friends)) {
    $user_one = $row_friend['user_one'];
    $user_two = $row_friend['user_two'];
    if ($user_one == '10') {
        $get_friends = "SELECT * FROM users WHERE user_id = '$user_two'";
        $run_get_friends = mysqli_query($connect, $get_friends);
        while ($row_get_friends = mysqli_fetch_array($run_get_friends)) {
            $frd_name = $row_get_friends['user_name'];
            $frd_ava = $row_get_friends['user_avatar'];
            $frd_status = $row_get_friends['user_online'];

            echo "
                <li>
                <div class='content'>
							<div class='details'>  
                                    <span>User: $frd_name</span>";
            if ($frd_status == 1) {
                echo "<p>Online</p>";
            } else {
                echo "<p>Offline</p>";
            }
            "                           
							</div>
						</div>
                </li>
            ";
        }
    }
    if ($user_two == '10') {
        $get_friends = "SELECT * FROM users WHERE user_id = '$user_one'";
        $run_get_friends = mysqli_query($connect, $get_friends);
        while ($row_get_friends = mysqli_fetch_array($run_get_friends)) {
            $frd_name = $row_get_friends['user_name'];
            $frd_ava = $row_get_friends['user_avatar'];
            $frd_status = $row_get_friends['user_online'];

            echo "
                <li>
                <div class='content'>
							<div class='details'>  
                                    <span>User: $frd_name</span>";
            if ($frd_status == 1) {
                echo "<p>Online</p>";
            } else {
                echo "<p>Offline</p>";
            }
            "                           
							</div>
						</div>
                </li>
            ";
        }
    }
}
