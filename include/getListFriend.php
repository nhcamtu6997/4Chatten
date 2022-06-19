<?php

$all_friends = "SELECT * FROM friends WHERE user_one = '$my_id' OR user_two = '$my_id' ";
$run_all_friends = mysqli_query($connect, $all_friends);

while ($row_friend = mysqli_fetch_array($run_all_friends)) {
    $user_one = $row_friend['user_one'];
    $user_two = $row_friend['user_two'];
    if ($user_one == $my_id) {
        getFriends($connect, $user_two);
    }
    if ($user_two == $my_id) {
        getFriends($connect, $user_one);
    }
}
