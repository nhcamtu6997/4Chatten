<?php
include("connection.php");

$sel_msg = "SELECT * FROM chats WHERE (msg_sender='$my_email' AND msg_receiver='$friend_email') OR (msg_sender='$friend_email' AND msg_receiver='$my_email') ORDER by 1 ASC";
$run_sel_msg = mysqli_query($connect, $sel_msg);

while ($row_msg = mysqli_fetch_array($run_sel_msg)) {
    $msg_sender = $row_msg['msg_sender'];
    $msg_receiver = $row_msg['msg_receiver'];
    $msg_content = $row_msg['msg_content'];
    $msg_date = $row_msg['msg_date'];

    if ($msg_sender == $my_email and $msg_receiver == $friend_email) {
        echo "
        <dl>
            <div class='chat-senden'>
                <div class='details'>
                <span><small>$msg_date</small></span>
                <p>$msg_content</p>
                </div>
            </div>
        </dl>
    ";
    }
    if ($msg_sender == $friend_email and $msg_receiver == $my_email) {
        echo "
        <dl>
            <div class='chat-empfangen'>
                <div class='details'>
                <span><small>$msg_date</small></span>
                <p>$msg_content</p>
                </div>
            </div>
        </dl>
    ";
    }
}
