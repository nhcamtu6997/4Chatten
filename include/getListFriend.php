<?php

$all_friends = "SELECT c.FriendID, a2.LastDate, 
    (CASE WHEN b.msg_sender = '$my_id' THEN 1 ELSE b.msg_status END) AS MsgStatus 
FROM 
    (SELECT a1.FriendID, MAX(msg_date) AS LastDate 
        FROM 
            (SELECT 
                (CASE WHEN msg_sender = '$my_id' THEN msg_receiver ELSE msg_sender END) AS FriendID,
                msg_date 
                FROM chats WHERE msg_receiver = '$my_id' OR msg_sender = '$my_id'
            ) AS a1 
        GROUP BY a1.FriendID 
    ) AS a2 
INNER JOIN 
    chats AS b 
    ON a2.LastDate = b.msg_date 
RIGHT JOIN 
    (SELECT 
        (CASE WHEN user_one = '$my_id' THEN user_two ELSE user_one END) AS FriendID 
        FROM friends WHERE user_one = '$my_id' OR user_two = '$my_id'
    ) AS c 
    ON a2.FriendID = c.FriendID 
ORDER BY a2.LastDate DESC;";

$run = mysqli_query($connect, $all_friends);
$items = array();

if (mysqli_num_rows($run) > 0) {
    while ($row = mysqli_fetch_assoc($run)) {
        $items[] = $row;
    }
}

foreach ($items as $item) {
    $user_id = $item['FriendID'];
    $last_msg_date = $item['LastDate'];
    $last_msg_status = $item['MsgStatus'];

    getFriends($connect, $user_id, $last_msg_status);
}
