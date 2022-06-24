<?php
function checkOnlineStatus($status)
{
    if ($status == 1) {
        echo "<p style='font-size: 12px; color: green; margin: 0px'>Online</p>";
    } else {
        echo "<p style='font-size: 12px; color: grey; margin: 0px'>Offline</p>";
    }
}

function checkMsgStatus($msg_status, $frd_id, $frd_name)
{
    if ($msg_status == 1 or $msg_status == NULL) {
        echo "<span><a href='chat.php?frd_id=$frd_id'>$frd_name</a></span>";
    } else {
        echo "<span style='font-weight: bold;'><a href='chat.php?frd_id=$frd_id'>$frd_name</a></span>";
    }
}

function printHeaderInfo($ava, $name, $status)
{
    echo "
			<img src= $ava alt=''>
			<div class='details' style='margin-top: 15px;'>
				<span>$name</span>";
    checkOnlineStatus($status);
    "					
			</div>
		";
}

function getFriends($connect, $user, $last_msg_status)
{
    $query = "SELECT * FROM users WHERE user_id = '$user'";
    $run = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_array($run)) {
        $frd_name = $row['user_name'];
        $frd_ava = $row['user_avatar'];
        $frd_status = $row['user_online'];
        $frd_id = $row['user_id'];

        echo "
                <dt>
                    <div class='content friend-item'>
                        <img src=$frd_ava> 
					    <div class='details'> ";
        checkMsgStatus($last_msg_status, $frd_id, $frd_name);
        checkOnlineStatus($frd_status);
        "                         
					    </div>
                    </div>
                </dt>
                
            ";
    }
}

function showMessages($msg_date, $msg_content, $msg_person)
{
    echo "
    <dl>
        <div class='$msg_person'>
            <div class='details'>
            <span><small>$msg_date</small></span>
            <p>$msg_content</p>
            </div>
        </div>
    </dl>
";
}

function isBlockFriends($connect, $find_id, $my_id)
{
    $query = "SELECT * FROM blocks WHERE (user_one = '$find_id' AND user_two = '$my_id') OR (user_two = '$find_id' AND user_one = '$my_id') ";
    $run = mysqli_query($connect, $query);
    $row = mysqli_num_rows($run);
    if ($row > 0) {
        return true;
    } else {
        return false;
    }
}

function isFriendAlready($connect, $find_id, $my_id)
{
    $query = "SELECT * FROM friends WHERE (user_one = '$find_id' AND user_two = '$my_id') OR (user_two = '$find_id' AND user_one = '$my_id') ";
    $run = mysqli_query($connect, $query);
    $row = mysqli_num_rows($run);
    if ($row > 0) {
        return true;
    } else {
        return false;
    }
}

function searchUser($my_id)
{
    global $connect;

    if (isset($_GET['btn_find'])) {
        $txt_find = htmlentities(mysqli_real_escape_string($connect, $_GET['txt_find']));

        $find_friend = "SELECT * FROM users WHERE user_email = '$txt_find'";
        $run_find = mysqli_query($connect, $find_friend);
        $row_find = mysqli_fetch_array($run_find);

        if (mysqli_num_rows($run_find) > 0) {
            $find_id = $row_find['user_id'];
            $find_name = $row_find['user_name'];
            $find_ava = $row_find['user_avatar'];
            $find_country = $row_find['user_country'];

            if (!isFriendAlready($connect, $find_id, $my_id) && $my_id != $find_id && !isBlockFriends($connect, $find_id, $my_id)) {
                echo "
                    <div class='content-tab'>
                        <img src=$find_ava> 
                        <div class='details-tab'> 
                        <span>$find_name</span>
                        <p>From: $find_country</p>
                        <form method='post'>
                        <button name='insert_Friend'>Chat with friend</button>
                        </form>                        
                        </div>
                    </div>
                    ";

                if (isset($_POST['insert_Friend'])) {

                    $insert_friend_query = "INSERT INTO friends(user_one, user_two) VALUES('$my_id', '$find_id')";
                    mysqli_query($connect, $insert_friend_query);

                    echo "<script>window.open('chat.php?frd_id=$find_id', '_self')</script>";
                }
            } else {
                echo "<script>alert('You should find another friend!'); </script>";
            }
        } else {
            echo "<script>alert('No user was found :('); </script>";
        }
    }
}
