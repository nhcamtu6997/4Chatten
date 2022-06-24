<?php

$all_friends = "SELECT f.MyID, c2.LastDate, CASE WHEN c3.msg_sender = '$my_id' THEN 1 ELSE c3.msg_status END AS MsgStatus FROM ( select c1.MyID, MAX(msg_date) as LastDate from ( SELECT CASE WHEN msg_sender = '$my_id' THEN msg_receiver ELSE msg_sender END AS MyID, msg_date FROM `chats` WHERE msg_receiver = '$my_id' or msg_sender = '$my_id' ) c1 group by c1.MyID ) c2 INNER join `chats` c3 on c2.LastDate = c3.msg_date right JOIN (SELECT CASE WHEN user_one = '$my_id' THEN user_two ELSE user_one END AS MyID FROM friends WHERE user_one = '$my_id' OR user_two = '$my_id' ) f on c2.MyID = f.MyID ORDER BY c2.LastDate DESC;";

$run = mysqli_query($connect, $all_friends);
$items = array();

if (mysqli_num_rows($run) > 0) {
    while ($row = mysqli_fetch_assoc($run)) {
        $items[] = $row;
    }
}

foreach ($items as $item) {
    $user_id = $item['MyID'];
    $last_msg_date = $item['LastDate'];
    $last_msg_status = $item['MsgStatus'];

    getFriends($connect, $user_id, $last_msg_status);
}
