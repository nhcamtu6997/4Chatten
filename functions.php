<?php
function checkStatus($status)
{
    if ($status == 1) {
        echo "<p style='font-size: 12px; color: green; margin: 0px'>Online</p>";
    } else {
        echo "<p style='font-size: 12px; color: grey; margin: 0px'>Offline</p>";
    }
}

function printHeaderInfo($ava, $name, $status)
{
    echo "
			<img src= $ava alt=''>
			<div class='details' style='margin-top: 15px;'>
				<span>$name</span>";
    checkStatus($status);
    "
							
			</div>
		";
}

function getFriends($connect, $user)
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
                
                    <div class='content'>
                        <img src=$frd_ava> 
					    <div class='details'> 
                        <span><a href='chat.php?frd_id=$frd_id'>$frd_name</a></span>";
        checkStatus($frd_status);
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

function isFriendAlready($connect, $find_id, $my_id)
{
    $query = "SELECT * FROM friends WHERE (user_one = '$find_id' AND user_two = '$my_id') OR (user_two = '$find_id' AND user_one = '$my_id')";
    $run = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($run);
    if ($row != null) {
        return true;
    } else {
        return false;
    }
}
