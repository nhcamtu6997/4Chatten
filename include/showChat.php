<?php

$sel_msg = "SELECT * FROM chats WHERE (msg_sender='$my_id' AND msg_receiver='$friend_id') OR (msg_sender='$friend_id' AND msg_receiver='$my_id') ORDER by 1 ASC";
$run_sel_msg = mysqli_query($connect, $sel_msg);

while ($row_msg = mysqli_fetch_array($run_sel_msg)) {
    $msg_sender = $row_msg['msg_sender'];
    $msg_receiver = $row_msg['msg_receiver'];
    $msg_content = $row_msg['msg_content'];
    $msg_date = $row_msg['msg_date'];

    if ($msg_sender == $my_id and $msg_receiver == $friend_id) {
        $msg_person = "chat-senden";
        showMessages($msg_date, $msg_content, $msg_person);
    }
    if ($msg_sender == $friend_id and $msg_receiver == $my_id) {
        $msg_person = "chat-empfangen";
        showMessages($msg_date, $msg_content, $msg_person);
    }
}
