<?php
include("connection.php");

$all_friends = "SELECT * FROM friends WHERE user_one = '$my_id' OR user_two = '$my_id' ";
$run_all_friends = mysqli_query($connect, $all_friends);

while ($row_friend = mysqli_fetch_array($run_all_friends)) {
    $user_one = $row_friend['user_one'];
    $user_two = $row_friend['user_two'];
    if ($user_one == $my_id) {
        $get_friends = "SELECT * FROM users WHERE user_id = '$user_two'";
        $run_get_friends = mysqli_query($connect, $get_friends);
        while ($row_get_friends = mysqli_fetch_array($run_get_friends)) {
            $frd_name = $row_get_friends['user_name'];
            $frd_ava = $row_get_friends['user_avatar'];
            $frd_status = $row_get_friends['user_online'];
            $frd_id = $row_get_friends['user_id'];

            echo "
                <dt>
                
                    <div class='content'>
                        <img src=$frd_ava height='45' width='45'> 
					    <div class='details'> 
                        <p><a href='homechat.php?frd_id=$frd_id'>$frd_name</a></p>";
            if ($frd_status == 1) {
                echo "<p>Online</p>";
            } else {
                echo "<p>Offline</p>";
            }
            "                         
					    </div>
                    </div>
                </dt>
                
            ";
        }
    }
    if ($user_two == $my_id) {
        $get_friends = "SELECT * FROM users WHERE user_id = '$user_one'";
        $run_get_friends = mysqli_query($connect, $get_friends);
        while ($row_get_friends = mysqli_fetch_array($run_get_friends)) {
            $frd_name = $row_get_friends['user_name'];
            $frd_ava = $row_get_friends['user_avatar'];
            $frd_status = $row_get_friends['user_online'];
            $frd_id = $row_get_friends['user_id'];

            echo "
                <dt>
                
                    <div class='content'>
                        <img src=$frd_ava height='45' width='45'> 
					    <div class='details'> 
                        <p><a href='homechat.php?frd_id=$frd_id'>$frd_name</a></p>";
            if ($frd_status == 1) {
                echo "<p>Online</p>";
            } else {
                echo "<p>Offline</p>";
            }
            "                         
					    </div>
                    </div>
                </dt>
                
            ";
        }
    }
}
